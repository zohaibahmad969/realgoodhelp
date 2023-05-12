<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['stripe_submit'])) {
        $stripe_api_key = $_POST['stripe_api_key'];
        $stripe_api_secret = $_POST['stripe_api_secret'];
        update_option( 'stripe_api_key' , $stripe_api_key);
        update_option( 'stripe_api_secret' , $stripe_api_secret);
    }
    if (isset($_POST['paypal_submit'])){
        $paypal_api_key = $_POST['paypal_api_key'];
        $paypal_api_secret = $_POST['paypal_api_secret'];
        update_option( 'paypal_api_key' , $paypal_api_key);
        update_option( 'paypal_api_secret' , $paypal_api_secret);
    }
}

$stripe_api_key = get_option( 'stripe_api_key' );
$stripe_api_secret = get_option( 'stripe_api_secret' );
$paypal_api_key = get_option( 'paypal_api_key' );
$paypal_api_secret = get_option( 'paypal_api_secret' );

?>

<section>
    <div class="setting-wrapper">
        <form action="" method="POST">
            <div class="setting-list-sec">
                <div class="stripe-wrapper list-sec-box">
                    <div class="setting-list-content">
                        <label for="str_setting">Stripe Settings</label><br>
                        <div class="form-field-wrap">
                            <div class="form-wrap">
                                <input type="text"  name="stripe_api_key" value="<?php echo $stripe_api_key;?>" class="setting-field" placeholder="API Key">
                            </div>
                            <div class="form-wrap">
                                <input type="text" name="stripe_api_secret" value="<?php echo $stripe_api_secret; ?>" class="setting-field" placeholder="API Screct">
                                <input type="submit" name="stripe_submit" id="stripe_submit" class="setting-submit-btn string-btn" placeholder="Submit"/>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        <div class="stripe-wrapper list-sec-box cus-right-content">
        <form method="POST">
            <div class="paypal-wrapper list-sec-box">
                <div class="setting-list-content">
                    <label for="str_setting">PayPal Settings</label><br>
                    <div class="form-field-wrap">
                        <div class="form-wrap">
                            <input type="text" name="paypal_api_key" value="<?php echo $paypal_api_key; ?>" class="setting-field" placeholder="API Key ">
                        </div>
                        <div class="form-wrap">
                            <input type="text" name="paypal_api_secret" value="<?php echo $paypal_api_secret; ?>" class="setting-field" placeholder="Paypal Secret Key">
                            <input type="submit" name="paypal_submit" id="paypal_submit" class="setting-submit-btn paypal-btn" placeholder="Submit"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>

    </div>
</section>