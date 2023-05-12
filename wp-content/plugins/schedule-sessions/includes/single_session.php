<?php

$payment_key = $_GET['payment_key'];
global $wpdb;
$table_name = $wpdb->prefix . "sessions";
$session_data = $wpdb->get_row("SELECT * FROM $table_name WHERE ID = $payment_key");
$client_data = get_userdata($session_data->client_id);
$therapist_data = get_userdata($session_data->therapist_id);

?>
<section class="single-Client-therapist-session">
    <div class="client-therapist-main-wrapper">
        <div class="table-wrapper single-left-wrapper">
            <div class="top-content">
                <h2>Client</h2>
            </div>

            <div class="single-right-info">
                <h4>Client ID : <span><?php echo $client_data->ID; ?></span></h4>
                <h4>Client Name : <span><?php echo $client_data->first_name . " " . $client_data->last_name; ?></span></h4>
                <h4>Client Email : <span><?php echo $client_data->user_email; ?></span></h4>
            </div>
            <a href="<?php echo home_url() ?>/wp-admin/user-edit.php?user_id=<?php echo $client_data->ID; ?>" target="_blank" class="view-btn">View Account</a>

        </div>

        <div class="table-wrapper single-left-wrapper single-therap-sec">
            <div class="top-content">
                <h2>Therapist</h2>
            </div>

            <div class="single-right-info">
                <h4>Therapist ID : <span><?php echo $therapist_data->ID; ?></span></h4>
                <h4>Therapist Name : <span><?php echo $therapist_data->first_name . " " . $therapist_data->last_name; ?></span></h4>
                <h4>Therapist Email : <span><?php echo $therapist_data->user_email; ?></span></h4>
            </div>
            <a href="<?php echo home_url() ?>/wp-admin/user-edit.php?user_id=<?php echo $therapist_data->ID; ?>" target="_blank" class="view-btn">View Account</a>

        </div>
    </div>

    <div class="single-right-sec">
        <div class="single-right-info">
            <h4>Session Date : <span><?php echo $session_data->session_date; ?></span></h4>
            <h4>Session Time : <span><?php echo $session_data->session_start. " - " .$session_data->session_end; ?></span></h4>
            <h4>Session Status : <span><?php echo $session_data->session_status; ?></span></h4>
            <?php if($session_data->session_status == 'cancelled'){ ?>
                <h4>Session Cancelled By : <span><?php echo $session_data->cancelled_by; ?></span></h4>
            <?php } ?>
            <h4>Total Balance : <span><?php echo $session_data->amount_total; ?></span></h4>
            <h4>Therapist Balance : <span><?php echo $session_data->therapist_balance; ?></span></h4>
           <?php if($session_data->discount_price){ ?> <h4>Discount Price : <span><?php echo $session_data->discount_price; ?></span></h4> <?php } ?>
           <?php if($session_data->total_price_discount){ ?> <h4>Total Price After Discount : <span><?php echo $session_data->total_price_discount; ?></span></h4> <?php } ?>
            <h4>Transaction ID : <span><?php echo $session_data->transaction_id; ?></span></h4>
            <h4>Session Link : <span><a href=""><?php echo $session_data->video_call_link; ?></a></span></h4>
        </div>

        <div class="single-right-btns">
            <button class="single-button" data-status="refund" data-session-id="<?php echo $payment_key; ?>" onclick="changes_session_status(this)">Refund</button>
            <button data-session-id="<?php echo $payment_key; ?>" data-client-id="<?php echo $client_data->ID; ?>" data-therapist-id="<?php echo $therapist_data->ID; ?>" data-cancelled-by="admin" class="single-button cancle-btn" id="cancel_session-<?php echo $payment_key; ?>">Cancel</button>
            <button class="single-button" data-status="paid" data-session-id="<?php echo $payment_key; ?>" onclick="changes_session_status(this)">Paid</button>
        </div>

    </div>
</section>

<script>
jQuery("[id^='cancel_session-']").click(function(){
	if (confirm("Do you really want to cancel your consultation?") == true) {
		var cancel_payment_key = jQuery(this).attr('id');
		var client_id = jQuery('#' + cancel_payment_key).attr('data-client-id');
		var therapist_id = jQuery('#' + cancel_payment_key).attr('data-therapist-id');
		var cancelled_by = jQuery('#' + cancel_payment_key).attr('data-cancelled-by');
		var payment_key = jQuery('#' + cancel_payment_key).attr('data-session-id');

		jQuery.ajax({
			method: "POST",
			url: ajaxurl, 
			data: { action: "session_cancel", payment_key: payment_key, client_id: client_id, therapist_id: therapist_id, cancelled_by: cancelled_by},
			dataType: "JSON",
			success: function(response) {
				console.log(response);
				if(response.success == 'Successfully Cancelled'){
					window.location.reload();
				}
			}
		});

	} else {
		console.log("cancel");
	}
});

function changes_session_status(ev){
    var session_status = jQuery(ev).attr('data-status');
    var payment_key = jQuery(ev).attr('data-session-id');

    if (confirm("Do you really want to " + session_status + " for consultation?") == true) {

        jQuery.ajax({
            method: "POST",
            url: ajaxurl, 
            data: { action: "change_session_status", payment_key: payment_key, session_status: session_status},
            dataType: "JSON",
            success: function(response) {
                console.log(response);
                if(response.success == 'Successfully'){
                    window.location.reload();
                } else{
                    alert(response.success);
                }
            }
        });

    } else {
        console.log(session_status);
    }
}
</script>