<?php
    global $wp;
?>

<div class="table-wrapper">
    <div class="top-content">
        <h2>Schedule Sessions</h2>
    </div>

    <table id="exportdata" class="display">
        <thead>
            <tr class="table-head">
                <th class="column1">ID</th>
                <th class="column2">Client ID</th>
                <th class="column3">Therapist ID</th>
                <th class="column4">Session Status</th>
                <th class="column5">Session Date</th>
                <th class="column4">Session Time</th>
                <th class="column6">Payment Status</th>
                <th class="column7">Action</th>
            </tr>
        </thead>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "sessions";
        $results = $wpdb->get_results("SELECT * FROM $table_name");
        if (is_array($results) || is_object($results)) {
            foreach ($results as $sessions_data) {
        ?>
                <tbody>
                    <tr>
                        <td class="column1"><?php echo $sessions_data->id; ?></td>
                        <td class="column2"><a href="<?php echo home_url() ?>/wp-admin/user-edit.php?user_id=<?php echo $sessions_data->client_id; ?>"><?php echo $sessions_data->client_id; ?></a></td>
                        <td class="column3"><a href="<?php echo home_url() ?>/wp-admin/user-edit.php?user_id=<?php echo $sessions_data->therapist_id; ?>"><?php echo $sessions_data->therapist_id; ?></a></td>
                        <td class="column4"><?php echo $sessions_data->session_status; ?></td>
                        <td class="column5"><?php echo $sessions_data->session_date; ?></td>
                        <td class="column4"><?php echo $sessions_data->session_start. " - " .$sessions_data->session_end; ?></td>
                        <td class="column6"><?php echo $sessions_data->payment_status; ?></td>
                        <td class="column7">
                            <div class="cus-table-buttons">
                                <a href="<?php echo home_url() . '/wp-admin/admin.php?page=schedule-session&payment_key=' . $sessions_data->id; ?>">View</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>

    <!-- <div class="cus-pagination-wrapper">
        <div class="pagination" >
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">&raquo;</a>
        </div>
    </div> -->

</div>