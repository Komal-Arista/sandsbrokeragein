<?php

if(!class_exists('SandsListTable')){
    include_once PLUGIN_PATH . 'class/SandsListTable.php';
}

$sandsListTableObject = new SandsListTable();

//To run all logics
$sandsListTableObject->prepare_items();
?>
<div class='wrap'>
    <h2>Customer's List</h2>
    <hr class="wp-header-end">    

    <!-- Search form -->
    <form method="get" id="frm-search">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
        <?php $sandsListTableObject->search_box("Search Carrier's", "search_sand"); ?>
    </form>

    <!-- Display List Table -->
    <form method="post">
        <?php $sandsListTableObject->display(); ?>
    </form>
</div>
