<?php

// Truncate tables on plugin deactivation
global $wpdb;

$tableNames = array('sandsbrokerage', 'search_data', 'agent_manager_relationships');

foreach($tableNames as $tableName) {
$tableNameTmp =  $wpdb->prefix . $tableName;
$q = "TRUNCATE `$tableNameTmp`";
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