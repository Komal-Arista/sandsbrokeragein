<?php

if ( ! defined('WP_UNINSTALL_PLUGIN')) {
    die('Access denied');
}

global $wpdb;

$tableNames = array('sandsbrokerage', 'search_data', 'agent_manager_relationships');

foreach($tableNames as $tableName) {
$tableNameTmp =  $wpdb->prefix . $tableName;
$q = "DROP TABLE IF EXISTS `$tableNameTmp`";
$wpdb->query($q);
}

// Delete the meta key from all users 
$meta_key = 'assigned_manager';  
$wpdb->query(
    $wpdb->prepare(
        "DELETE FROM $wpdb->usermeta WHERE meta_key = %s",
        $meta_key
    )
);