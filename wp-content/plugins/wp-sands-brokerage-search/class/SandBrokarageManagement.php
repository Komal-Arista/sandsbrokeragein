<?php

class SandBrokarageManagement {

    private $success = "";
    private $error = "";
    public function __construct() {
        
        //Add Menu
        add_action('admin_menu', array($this, 'addSBMMenus'));

        //Add Plugin Scripts
        add_action('admin_enqueue_scripts', array($this, 'addSBMPluginScripts'));

    }

    //setup Menus and Submenus
    public function addSBMMenus() {

        add_menu_page('S&S Customer Data System', 'S&S Customer Data', 'manage_options', 'sands-system', array($this, 'sbmListHandler'), 'dashicons-admin-users', 2);

        add_submenu_page('sands-system', 'Customer List', 'Customer List', 'manage_options', 'sands-system', array($this, 'sbmListHandler'));

        add_submenu_page('sands-system', 'Import Customer Data', 'Import Customer Data', 'manage_csv_data', 'upload-csv', array($this, 'sbmCSVHandler'));

        add_submenu_page('sands-system', 'User Analytics', 'User Analytics', 'manage_options', 'user-search-data', array($this, 'sbmUserListHandler'));

        add_submenu_page('sands-system', 'Search Page', 'Search Page', 'manage_options', 'search-page', array($this, 'sbmSearchPageHandler'));
    }

     //call this function when Search Page Menu is called
     public function sbmSearchPageHandler() {
        ob_start();
        include_once PLUGIN_PATH . 'public/search-page.php';
        $content = ob_get_contents();
        ob_get_clean();

        echo $content;
    }
    
    //call this function when List Sand Menu is called
    public function sbmListHandler() {
        ob_start();
        include_once PLUGIN_PATH . 'public/list-sands.php';
        $content = ob_get_contents();
        ob_get_clean();

        echo $content;
    }

    //call this function when User List Menu is called
    public function sbmUserListHandler() {
        ob_start();
        include_once PLUGIN_PATH . 'public/user-list.php';
        $content = ob_get_contents();
        ob_get_clean();

        echo $content;
    }


    //call this function when Upload CSV Menu is called
    public function sbmCSVHandler() {
        
        $this->upload_csv();
        $success = $this->success;
        $error = $this->error;
        ob_start();
        include_once PLUGIN_PATH . 'public/upload-csv.php';
        $content = ob_get_contents();
        ob_get_clean();

        echo $content;
    }

    public function upload_csv() {
        
        if (isset($_POST['upload_csv'])) {

            if(!$_FILES['upload_csv']) {
                $this->error = 'Please upload a valid CSV file.';
            }

            if (isset($_FILES['upload_csv']) && $_FILES['upload_csv']['error'] == 0) {

                // Validate that the file is a CSV
                $file_type = wp_check_filetype(basename($_FILES['upload_csv']['name']));
                $allowed_types = array('csv' => 'text/csv', 'txt' => 'text/plain');

                if (in_array($file_type['type'], $allowed_types) && strtolower(pathinfo($_FILES['upload_csv']['name'], PATHINFO_EXTENSION)) == 'csv') {
                    $this->csv_process_file($_FILES['upload_csv']['tmp_name']);
                } else {
                    $this->error= 'Please upload a valid CSV file.';
                }
            } else {
                $this->error = 'Please upload a valid CSV file.';
            }
        }
    }

    public function csv_process_file($csv_file) {
        global $wpdb;
    
        // Increase time and memory limits to handle large CSV files
        // set_time_limit(300); // 5 minutes
        // ini_set('memory_limit', '512M'); 
    
        $table_name = $wpdb->prefix . 'sandsbrokerage';
        $chunk_size = 200; // Reduced chunk size for safer inserts
        $rows = [];
        $row_count = 0;
    
        // Open the CSV file
        $handle = fopen($csv_file, 'r');
        if ($handle === false) {
            $this->error = "Failed to open the file.";
            return;
        }
    
        // Read the header row
        $header = fgetcsv($handle);
        $expected_column_count = 14;
    
        if (count($header) !== $expected_column_count) {
            $this->error = "The CSV file must have exactly $expected_column_count columns.";
            fclose($handle);
            return;
        }
    
        try {
            // Start transaction
            $wpdb->query('START TRANSACTION');
            $wpdb->query("TRUNCATE TABLE $table_name");
            $wpdb->query("SET NAMES 'utf8mb4'"); // Ensure proper encoding
    
            while (($data = fgetcsv($handle)) !== false) {
                if (count($data) !== $expected_column_count) {
                    throw new Exception("Row $row_count has incorrect column count.");
                }
    
                // Convert each field to UTF-8, with better encoding detection.
                $data = array_map(function($value) {
                    // Attempt to convert from common encodings, with fallback to UTF-8.
                    $encoded_value = @mb_convert_encoding($value, 'UTF-8', ['ISO-8859-1', 'Windows-1252', 'UTF-8']);
                    
                    // If encoding detection fails, fallback to UTF-8 manually.
                    if ($encoded_value === false) {
                        $encoded_value = utf8_encode($value); // Fallback method.
                    }
                    
                    return $encoded_value;
                }, $data);


                // Prepare the query with the sanitized data
                $rows[] = $wpdb->prepare(
                    "(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                    $data[0], $data[1], $data[2], $data[3], $data[4],
                    $data[5], $data[6], $data[7], $data[8], $data[9],
                    $data[10], $data[11], $data[12], $data[13]
                );
                $row_count++;
    
                // Insert in chunks
                if ($row_count % $chunk_size == 0) {
                    $this->insert_rows($table_name, $rows);
                    $rows = [];
                }
            }
    
            // Insert remaining rows
            if (!empty($rows)) {
                $this->insert_rows($table_name, $rows);
            }
    
            // Commit transaction
            $wpdb->query('COMMIT');
            fclose($handle);
    
            $this->success = 'CSV file processed successfully!';
        } catch (Exception $e) {
            $wpdb->query('ROLLBACK');
            $this->error = "Error: " . $e->getMessage();
            fclose($handle);
        }
    }
    
    private function insert_rows($table_name, $rows) {
        global $wpdb;
        $wpdb->query("SET NAMES 'utf8mb4'");  // Ensure correct encoding
        $values = implode(',', $rows);
    
        $query = "INSERT INTO $table_name 
            (customer_profile_name, customer_status, customer_status_as_per_policy, last_load_date, 
            customer_contact_name, customer_city, customer_state, customer_zip, customer_phone, 
            billing_phone, customer_email, customer_website_url, sales_rep_name, region) 
            VALUES $values";
    
        $result = $wpdb->query($query);
    
        if ($result === false) {
            error_log("Database error: " . $wpdb->last_error . " | Query: " . $query);
            throw new Exception("Database error: " . $wpdb->last_error);
        }
    }

     //Add Plugin Scripts
     public function addSBMPluginScripts() {
        //css file
        wp_enqueue_style('sbm-style', PLUGIN_URL . 'css/style.css', array(), '1.0', 'all');
    }
}