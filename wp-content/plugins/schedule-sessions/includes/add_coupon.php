<?php
global $wpdb;

if(isset($_POST['coupon_name'])){
    $coupon_name = $_POST['coupon_name'];
    $percentage_amount = $_POST['percentage_amount'];
    $coupon_code = $_POST['coupon_code'];


    $table_name = $wpdb->prefix . "coupons";
    $coupons = $wpdb->get_row("SELECT * FROM $table_name WHERE coupon_code = '$coupon_code'");

    if(!empty($coupons)){
        $error_msg = "Coupon Code already exist";
    } else{
        $insert_data = $wpdb->insert($table_name, array('coupon_name' => $coupon_name, 'percentage_amount' => $percentage_amount, 'coupon_code' => $coupon_code));

        if($insert_data){
            $sucess_msg = "Sucessfully added coupon";
        }
        else{
            $error_msg = "Error";
        }
    }
}   

?>

<section>
    <div class="setting-wrapper">
        <form action="" method="POST">
            <div class="">
                <div class="stripe-wrapper list-sec-box">
                    <div class="setting-list-content">
                    <?php if($sucess_msg) { ?>
                             <p class="subtitle coupon-sec-msg"><?php echo $sucess_msg; ?></p>    
                            <?php } else { ?>
                             <p class="subtitle coupon-error-msg"><?php echo $error_msg; ?></p>   
                            <?php }
                            ?>
                        <div class="form-field-wrap form-wrap-sec">
                            
                            <div class="form-blog">
                                <div class="form-wrap">
                                    <h2>Coupon Name</h2>
                                    <input type="text"  name="coupon_name" value="" class="setting-field" placeholder="Name" required>
                                </div>

                                <div class="form-wrap">
                                    <h2>Percentage Amount</h2>
                                    <input type="number" name="percentage_amount" value="" class="setting-field" placeholder="Percentage Amount" min=0 max=100 required>
                                </div>
                            </div>
                            <div class="form-blog">
                                <div class="form-wrap">
                                    <h2>Coupon Code</h2>
                                    <input type="text" name="coupon_code" value="" class="setting-field" placeholder="Coupon code" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="coupon-submit-btn">
                            <button class="add-new-btn" type="submit">Submit</button>
                        </div>
                        
                    </div>
                </div>
        </form>
        
    </div>

    </div>
</section>