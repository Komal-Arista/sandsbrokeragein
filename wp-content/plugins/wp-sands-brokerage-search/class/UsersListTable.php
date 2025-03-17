<?php

if(!class_exists('WP_List_Table')){
    include_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class UsersListTable extends WP_List_Table {

    public function prepare_items() {

        global $wpdb;
        $table_prefix = $wpdb->prefix;

        $per_page = $this->get_items_per_page( 'items_per_page_user', 20 ); // Default value 20
        
        // Handle user input and update user meta
        if ( isset( $_REQUEST['items_per_page_user'] ) && is_numeric( $_REQUEST['items_per_page_user'] ) ) {
            $items_per_page = intval( $_REQUEST['items_per_page_user'] );
            update_user_meta( get_current_user_id(), 'items_per_page_user', $items_per_page );
        }

        //Order By
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'id';
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

        //Search Keyword
        $search = isset($_GET['s']) ? wp_unslash(trim($_GET['s'])) : false;

        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

       //To Show table headers/columns
       $this->_column_headers = array($this->get_columns(), [], $this->get_sortable_columns());

       //If search available
       if($search) {

        //Total number of records
        $totalUsers = $wpdb->get_results("SELECT * FROM {$table_prefix}search_data WHERE
            search_term LIKE '%{$search}%' OR 
            display_name LIKE '%{$search}%' OR 
            user_email LIKE '%{$search}%' OR 
            user_role LIKE '%{$search}%' OR 
            search_page LIKE '%{$search}%' OR 
            selected_term LIKE '%{$search}%' OR 
            location LIKE '%{$search}%' OR 
            date LIKE '%{$search}%'", ARRAY_A);

        //records on Limit
        $users = $wpdb->get_results("SELECT * FROM {$table_prefix}search_data WHERE
            search_term LIKE '%{$search}%' OR 
            display_name LIKE '%{$search}%' OR 
            user_email LIKE '%{$search}%' OR 
            user_role LIKE '%{$search}%' OR 
            search_page LIKE '%{$search}%' OR 
            selected_term LIKE '%{$search}%' OR 
            location LIKE '%{$search}%' OR 
            date LIKE '%{$search}%'
            ORDER BY {$orderby} {$order} 
            LIMIT {$offset}, {$per_page}", ARRAY_A);

        $totalUsersItems = count($totalUsers);

       } else {

        //Total number of records
        $totalUsers = $wpdb->get_results("SELECT * FROM {$table_prefix}search_data", ARRAY_A);

        //records on Limit
        $users = $wpdb->get_results("SELECT * FROM {$table_prefix}search_data ORDER BY {$orderby} {$order} LIMIT {$offset}, {$per_page}", ARRAY_A);

        $totalUsersItems = count($totalUsers);

       }

       $this->set_pagination_args(array(
        "total_items" => $totalUsersItems,
        "per_page" => $per_page,
        "total_pages" => ceil($totalUsersItems/$per_page),
       ));

       $this->items = $users;
    }

    //Return Column Name
    function get_columns() {
        $columns = [
            "id" => "ID",
            "display_name" => "Name",
            "user_email" => "User Email",
            "user_role" => "User Role",
            "search_term" => "Search Term",
            "selected_term" => "Selected Term",
            "search_page" => "Search Page",
            "location" => "Location",
            "date" => "Date"
        ];
    
        return $columns;
    }

    // No Data found
    public function no_items() {
        echo "No User's List Found";
    }

    //To display default data
    public function column_default($item, $col_name) {
        // Check if the column data exists and is not empty
        return !empty($item[$col_name]) ? '<span class="sbm-'.$col_name.'">'.$item[$col_name].'</span>' : "N/A";
    }

    // Display the index column set indexing instead of DB ID column
    // function column_id( $item ) {
    //     static $index = 0;
    //     $page_number = $this->get_pagenum();
    //     $per_page = $this->get_items_per_page( 'items_per_page_user', 20 );
    //     $index++;
    //     return ( ( $page_number - 1 ) * $per_page ) + $index;
    // }

    //Add Sorting Icons
    public function get_sortable_columns() {
        $columns = array(
            "id" => array("id" , false), //asc
            "display_name" => array("display_name", true), //desc
            "user_email" => array("user_email", true), //desc
            "user_role" => array("user_role", true), //desc
            "search_term" => array("search_term", true), //desc
            "selected_term" => array("selected_term", true), //desc
            "search_page" => array("search_page", true), //desc
            "location" => array("location", true), //asc
        );

        return $columns;
    }

    //To Add Pagination
    function extra_tablenav( $which ) {
        if ( 'top' === $which ) {
            
            // Get the current items per page value
            $items_per_page = $this->get_items_per_page( 'items_per_page_user', 20 ); // Default value 20
            $current_url = esc_url( add_query_arg( array() ) ); // Get the current URL
            ?>
            <div class="alignleft actions">
                <form method="GET" action="">
                    <label for="items_per_page_user"><?php _e('Items per page:', 'textdomain'); ?></label>
                    <select name="items_per_page_user" id="items_per_page_user" onchange="this.form.submit()">
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
        if ( isset( $_REQUEST['items_per_page_user'] ) && is_numeric( $_REQUEST['items_per_page_user'] ) ) {
            return intval( $_REQUEST['items_per_page_user'] );
        }

        // Then check the user meta (persistent setting)
        $items_per_page = get_user_meta( get_current_user_id(), $option, true );
        if ( empty( $items_per_page ) || !is_numeric( $items_per_page ) ) {
            $items_per_page = $default;
        }
        return $items_per_page;
    }
}