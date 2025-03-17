<?php

if(!class_exists('WP_List_Table')){
    include_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class SandsListTable extends WP_List_Table {

    public function prepare_items() {

        global $wpdb;
        $table_prefix = $wpdb->prefix;

        $per_page = $this->get_items_per_page( 'items_per_page', 20 ); // Default value 20
        
        // Handle user input and update user meta
        if ( isset( $_REQUEST['items_per_page'] ) && is_numeric( $_REQUEST['items_per_page'] ) ) {
            $items_per_page = intval( $_REQUEST['items_per_page'] );
            update_user_meta( get_current_user_id(), 'items_per_page', $items_per_page );
        }

        //Order By
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

        //Search Keyword
        $search = isset($_GET['s']) ? wp_unslash(trim($_GET['s'])) : false;

        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

       //To Show table headers/columns
       $this->_column_headers = array($this->get_columns(), [], $this->get_sortable_columns());

       //If search available
       if($search) {

        //Total number of records
        $totalSandsBrokerage = $wpdb->get_results("SELECT * FROM {$table_prefix}sandsbrokerage WHERE
            customer_profile_name LIKE '%{$search}%' OR 
            customer_status LIKE '%{$search}%' OR 
            customer_status_as_per_policy LIKE '%{$search}%' OR 
            last_load_date LIKE '%{$search}%' OR 
            customer_contact_name LIKE '%{$search}%' OR 
            customer_city LIKE '%{$search}%' OR 
            customer_state LIKE '%{$search}%' OR 
            customer_zip LIKE '%{$search}%' OR 
            customer_phone LIKE '%{$search}%' OR
            billing_phone LIKE '%{$search}%' OR
            customer_email LIKE '%{$search}%' OR
            customer_website_url LIKE '%{$search}%' OR
            sales_rep_name LIKE '%{$search}%' OR
            region LIKE '%{$search}%'", ARRAY_A);

        //records on Limit
        $sandsBrokerage = $wpdb->get_results("SELECT * FROM {$table_prefix}sandsbrokerage WHERE
            customer_profile_name LIKE '%{$search}%' OR 
            customer_status LIKE '%{$search}%' OR 
            customer_status_as_per_policy LIKE '%{$search}%' OR 
            last_load_date LIKE '%{$search}%' OR 
            customer_contact_name LIKE '%{$search}%' OR 
            customer_city LIKE '%{$search}%' OR 
            customer_state LIKE '%{$search}%' OR 
            customer_zip LIKE '%{$search}%' OR 
            customer_phone LIKE '%{$search}%' OR
            billing_phone LIKE '%{$search}%' OR
            customer_email LIKE '%{$search}%' OR
            customer_website_url LIKE '%{$search}%' OR
            sales_rep_name LIKE '%{$search}%' OR
            region LIKE '%{$search}%'
            ORDER BY {$orderby} {$order} 
            LIMIT {$offset}, {$per_page}", ARRAY_A);

        $totalSandsItems = count($totalSandsBrokerage);

       } else {

        //Total number of records
        $totalSandsBrokerage = $wpdb->get_results("SELECT * FROM {$table_prefix}sandsbrokerage", ARRAY_A);

        //records on Limit
        $sandsBrokerage = $wpdb->get_results("SELECT * FROM {$table_prefix}sandsbrokerage ORDER BY {$orderby} {$order} LIMIT {$offset}, {$per_page}", ARRAY_A);

        $totalSandsItems = count($totalSandsBrokerage);

       }

       $this->set_pagination_args(array(
        "total_items" => $totalSandsItems,
        "per_page" => $per_page,
        "total_pages" => ceil($totalSandsItems/$per_page),
       ));

       $this->items = $sandsBrokerage;
    }

    //Return Column Name
    function get_columns() {
        $columns = [
            //"cb" => '<input type="checkbox" />',
            "id" => "ID",
            "customer_profile_name" => "Customer Profile Name",
            "customer_status" => "Customer Status",
            "customer_status_as_per_policy" => "Customer Status As Per Policy",
            "last_load_date" => "Last Load Date",
            "customer_contact_name" => "Customer Contact Name",
            "customer_city" => "Customer City",
            "customer_state" => "Customer State",
            "customer_zip" => "Customer Zip",
            "customer_phone" => "Customer Phone",
            "billing_phone" => "Billing Phone",
            "customer_email" => "Customer Email",
            "sales_rep_name" => "Sales Rep Name",
            "region" => "Region",
            "customer_website_url" => "Customer Website Url",
        ];
    
        return $columns;
    }

    // No Data found
    public function no_items() {
        echo "No Carrier's List Found";
    }

    //To display default data
    public function column_default($item, $col_name) {
        // Check if the column data exists and is not empty
        return !empty($item[$col_name]) ? $item[$col_name] : '--';
    }

    // Display the index column set indexing instead of DB ID column
    // function column_id( $item ) {
    //     static $index = 0; 
    //     $page_number = $this->get_pagenum();
    //     $per_page = $this->get_items_per_page( 'items_per_page', 20 );
    //     $index++;
    //     return ( ( $page_number - 1 ) * $per_page ) + $index;
    // }

    //Add Sorting Icons
    public function get_sortable_columns() {
        $columns = array(
            "id" => array("id" , false), //asc
            "customer_profile_name" => array("customer_profile_name", true), //desc
            //"customer_status" => array("customer_status", true) //desc
        );

        return $columns;
    }

    //To Add Pagination
    function extra_tablenav( $which ) {
        if ( 'top' === $which ) {
            
            // Get the current items per page value
            $items_per_page = $this->get_items_per_page( 'items_per_page', 20 ); // Default value 20
            $current_url = esc_url( add_query_arg( array() ) ); // Get the current URL
            ?>
            <div class="alignleft actions">
                <form method="GET" action="">
                    <label for="items_per_page"><?php _e('Items per page:', 'textdomain'); ?></label>
                    <select name="items_per_page" id="items_per_page" onchange="this.form.submit()">
                        <option value="5" <?php selected( $items_per_page, 5 ); ?>>5</option>
                        <option value="10" <?php selected( $items_per_page, 10 ); ?>>10</option>
                        <option value="20" <?php selected( $items_per_page, 20 ); ?>>20</option>
                        <option value="50" <?php selected( $items_per_page, 50 ); ?>>50</option>
                    </select>
                    <!-- <noscript><input type="submit" value="<?php _e('Apply', 'textdomain'); ?>"></noscript> -->
                </form>
            </div>
            <?php
        }
    }

    //Override get_items_per_page method to reflect selected items per page
    function get_items_per_page( $option, $default = 20 ) {
        // Check the URL parameter first
        if ( isset( $_REQUEST['items_per_page'] ) && is_numeric( $_REQUEST['items_per_page'] ) ) {
            return intval( $_REQUEST['items_per_page'] );
        }

        // Then check the user meta (persistent setting)
        $items_per_page = get_user_meta( get_current_user_id(), $option, true );
        if ( empty( $items_per_page ) || !is_numeric( $items_per_page ) ) {
            $items_per_page = $default;
        }
        return $items_per_page;
    }
}