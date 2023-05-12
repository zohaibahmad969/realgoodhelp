<?php
    global $wpdb;
?>
<div class="table-wrapper">
    <div class="top-content">
        <a href="<?php echo home_url() . '/wp-admin/admin.php?page=coupons&coupon=add_new'; ?>" class="add-new-btn">+ Add New</a>
    </div>

    <div class="table-wrapper">
    <div class="top-content">
        <h2>All Coupons</h2>
    </div>

    <table id="exportdata" class="display">
        <thead>
            <tr class="table-head">
                <th class="column1">Coupon Name</th>
                <th class="column2">Coupon Code</th>
                <th class="column3">Percentage Amount</th>
                <th class="column7">Action</th>
            </tr>
        </thead>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "coupons";
        $results = $wpdb->get_results("SELECT * FROM $table_name");
        if (is_array($results) || is_object($results)) {
            foreach ($results as $coupon_data) {
        ?>
                <tbody>
                    <tr>
                        <td class="column1"><?php echo $coupon_data->coupon_name; ?></td>
                        <td class="column2"><?php echo $coupon_data->coupon_code; ?></td>
                        <td class="column3"><?php echo $coupon_data->percentage_amount; ?></td>
                        <td class="column7">
                            <div class="cus-table-buttons">
                                <a href="<?php echo home_url() . '/wp-admin/admin.php?page=coupons&coupon_id=' . $coupon_data->id; ?>">Edit</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>

</div>
</div>