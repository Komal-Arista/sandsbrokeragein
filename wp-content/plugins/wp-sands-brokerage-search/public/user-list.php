<?php

if(!class_exists('UsersListTable')){
    include_once PLUGIN_PATH . 'class/UsersListTable.php';
}

$usersListTableObject = new UsersListTable();

//To run all logics
$usersListTableObject->prepare_items();
?>
<div class='wrap'>
    <h2>User Analytics</h2>
    <hr class="wp-header-end">    

    <!-- Search form -->
    <form method="get" id="frm-search">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
        <?php $usersListTableObject->search_box("Search", "search_user"); ?>
    </form>

    <!-- Display List Table -->
    <form method="post">
        <?php $usersListTableObject->display(); ?>
    </form>
</div>
