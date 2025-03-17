<div class="bms-container">
    <h1>Import Customer's Data</h1>
    <?php
    if (!empty($success)) { ?>
    <div class="success"><?php echo esc_html($success); ?></div>
    <?php } ?>
    <?php
    if (!empty($error)) { ?>
    <div class="error"><?php echo esc_html($error); ?></div>
    <?php } ?>
    <form action="<?php echo admin_url('admin.php?page=upload-csv');?>" id="frm-add-book" method="post" enctype="multipart/form-data">
        <div class="form-input custom-form">
            <lable for="upload_csv">Upload CSV</lable>
            <input type="file" name="upload_csv" id="upload_csv" class="form-group" required />
        </div>
        <input type="submit" name="upload_csv" value="Upload CSV" class="btn" />
        <p>
            <a href="<?php echo plugins_url('assets/sample.csv', __FILE__); ?>" download>Download Sample CSV File</a>
        </p>
    </form>
</div>