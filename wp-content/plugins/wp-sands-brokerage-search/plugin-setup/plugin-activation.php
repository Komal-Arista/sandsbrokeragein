<?php 
// create table wp_sandsbrokerage
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();

// Include the WordPress upgrade script to use dbDelta function
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

// Create table wp_sandsbrokerage
$sandsbrokerage_table_name = $wpdb->prefix . 'sandsbrokerage';

// SQL query to create the wp_sandsbrokerage table
$sql_sandsbrokerage = "CREATE TABLE IF NOT EXISTS $sandsbrokerage_table_name (
    id INT(11) NOT NULL AUTO_INCREMENT,
    `customer_profile_name` VARCHAR(80) DEFAULT NULL,
    `customer_status` varchar(120) DEFAULT NULL,
    `customer_status_as_per_policy` varchar(120) DEFAULT NULL,
    `last_load_date` varchar(20) DEFAULT NULL,
    `customer_contact_name` varchar(120) DEFAULT NULL,
    `customer_city` varchar(100) DEFAULT NULL,
    `customer_state` varchar(10) DEFAULT NULL,
    `customer_zip` INT(50) DEFAULT NULL,
    `customer_phone` varchar(120) DEFAULT NULL,
    `billing_phone` varchar(120) DEFAULT NULL,
    `customer_email` varchar(120) DEFAULT NULL,
    `customer_website_url` varchar(120) DEFAULT NULL,
    `sales_rep_name` varchar(80) DEFAULT NULL,
    `region` varchar(80) DEFAULT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) $charset_collate;";

// Execute the SQL queries to create the tables
dbDelta($sql_sandsbrokerage);

// Create table wp_search_data
$search_data_table_name = $wpdb->prefix . 'search_data';
$users_table = $wpdb->prefix . 'users'; // WordPress users table

// SQL query to create the wp_sandsbrokerage table
$sql_search_data = "CREATE TABLE IF NOT EXISTS $search_data_table_name (
     id INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT(20) UNSIGNED NOT NULL,
    `display_name` varchar(250) NOT NULL,
    `user_email` varchar(100) NOT NULL,
    `user_role` varchar(100) NOT NULL,
    `search_term` varchar(120) NOT NULL,
    `selected_term` varchar(255) NULL,
    `search_page` varchar(20) NOT NULL,
    `date` varchar(30) NOT NULL,
    PRIMARY KEY (id),

    -- Foreign key constraint for user_id
    CONSTRAINT fk_user_id 
    FOREIGN KEY (user_id) REFERENCES $users_table(ID) 
    ON DELETE CASCADE
) $charset_collate;";

// Execute the SQL queries to create the tables
dbDelta($sql_search_data);

$agent_manager_relationships_table_name = $wpdb->prefix . 'agent_manager_relationships';

$sql_agent_manager_relationships = "CREATE TABLE IF NOT EXISTS $agent_manager_relationships_table_name (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    agent_id BIGINT(20) UNSIGNED NOT NULL,
    manager_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY  (id),
    UNIQUE KEY agent_manager (agent_id, manager_id),

    -- Foreign key constraint for agent_id
    CONSTRAINT fk_agent_user
    FOREIGN KEY (agent_id) REFERENCES {$wpdb->prefix}users(ID)
    ON DELETE CASCADE,
    
    -- Foreign key constraint for manager_id
    CONSTRAINT fk_manager_user
    FOREIGN KEY (manager_id) REFERENCES {$wpdb->prefix}users(ID)
    ON DELETE CASCADE
) $charset_collate;";

// Execute the SQL queries to create the tables
dbDelta($sql_agent_manager_relationships);
