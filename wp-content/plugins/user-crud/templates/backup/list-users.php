<div class="usertable-logs">
<div class="wrap">
    <h2>User Management</h2>
    <div class="list-loader">
        <a href="?action=add" class="button-primary">Add New User</a>

        <a href="<?php echo get_site_url();?>/account" class="button-primary">Back</a>
        
        <div id="loader" style="display:none;">
            <img src="<?php echo plugins_url( 'images/loading-gif.gif', __FILE__ ); ?>" alt="Loading..." />
        </div>
    </div>
    
    <div id="successMsg" style="display:none;"></div>

    <div class="tableusers-responsive">
        <table id="user-table" class="display">
        <thead>
            <tr>
                <th>Index</th>
                <th>UserName</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Assigned Manager</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here via DataTables -->
        </tbody>
        </table>
    </div>
</div>
</div>
