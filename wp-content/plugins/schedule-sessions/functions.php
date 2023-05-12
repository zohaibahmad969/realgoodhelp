<?php
session_start();

require_once(dirname(__FILE__) . '/vendor/autoload.php');

use \Firebase\JWT\JWT;
use GuzzleHttp\Client;

define('ZOOM_API_KEY', 'iDcBw2oARA60Ifku0cnRJQ');
define('ZOOM_SECRET_KEY', 'W7oUKnGDX3Y17scUaieElU4MOomIdlR76gho');

function createSessionStripe()
{
    global $wpdb;

    $params = $_POST['data'];
    $promo_code = explode('#', $params['promo_amount']);
    $price = explode('#', $params['type_price']);
    $discount_price = 0;
    $coupon_id = "";
    if(isset($promo_code[0]) && isset($promo_code[1])){
        $discount_price = $promo_code[0];
        $amount_paid = $price[0] - $promo_code[0];
        $coupon_id = $promo_code[1];
    } else{
        $amount_paid = $price[0];
    }
    
    $stripe_api_secret = get_option('stripe_api_secret');
    $current_user = wp_get_current_user();

    $_SESSION['order'] = [
        "price" => $amount_paid,
        "therapist_ID" => $params['therapist_ID'],
        "therapist_Name" => $params['therapist_Name'],
        "avtar" =>  $params['avtarUrl'],
        "duration" => $params['session_duration'],
        "session_date" => $params['session_date'],
        "session_start" => $params['session_start'],
        "session_end" => $params['session_end'],
        "consultation_type" =>  $price[1],
        "communication_method" => $params['communication_method'],
        "payment_method" => $params['payment_method'],
        "discount_price" => $discount_price,
        "coupon_id" => $coupon_id
    ];

    if($amount_paid > 0){
        $session_data = array(
            "mode"              => "payment",
            "success_url"       =>  home_url() . "/thank-you/?payment_key={CHECKOUT_SESSION_ID}",
            "cancel_url"        =>  home_url() . "/cancel/",
            "currency"          => "usd",
            "customer_email"    => $current_user->user_email,
            "line_items"        => array(
                array(
                    "price_data" => array(
                        "unit_amount"   => $amount_paid * 100,
                        "currency"      => "usd",
                        "product_data"  => array(
                            "name"          => $params['therapist_Name'] . " Session Payment",
                            "description"   => "This is " . $price[1] . " " . $price[2] . " session scheduled for " . $params['session_date'] . " with " . $params['therapist_Name'],
                            "images"        => array($params['avtarUrl'])
                        )
                    ),
                    "quantity" => 1
                ),
            ),
            "payment_method_types" => array("card"),
        );


        $url_encode_data = http_build_query($session_data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.stripe.com/v1/checkout/sessions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $url_encode_data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $stripe_api_secret
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    } else{
        $rand_sesion_id = rand();
        $rand_sesion_id = md5($rand_sesion_id);
        $response = json_encode(array("url" => home_url() . "/thank-you/?payment_key=" . $rand_sesion_id . "&rand=" . $rand_sesion_id));
    }

    if ($response) {
        $json_decode_response = json_decode($response);
        if (isset($json_decode_response->error)) {
            echo json_encode(array("success" => false, "message" => $json_decode_response->error->message));
        } else {
            echo json_encode(array("success" => true, "message" => $json_decode_response->url));
        }
    }

    die;
}

add_action('wp_ajax_createSessionStripe', 'createSessionStripe');
add_action('wp_ajax_createSessionStripe', 'createSessionStripe');


// Function to get the access token
function getZoomAccessToken() {
    
    $key = ZOOM_SECRET_KEY;
    $payload = array(
        "iss" => ZOOM_API_KEY,
        'exp' => time() + 3600,
    );
    return JWT::encode($payload, $key, 'HS256'); 

}

//  Function to create the zoom meeting link
function createZoomMeeting() {
    global $wpdb;
    if(isset($_POST['data'])){
        $data = $_POST['data'];
        $start_time = $data['order']['session_date'].'T'.$data['order']['session_start'].':00Z';
        $topic = $data['order']['consultation_type'].' with '. $data['order']['therapist_Name'];
        $duration = $data['order']['duration'];
        $insertId = $data['insertID'];
        $client_id = $data['client_id'];
        $therapist_id = $data['order']['therapist_ID'];
        $therapist_email = $data['therapist_email'];
        $client_email = $data['client_email'];

        $client = new Client([
            'base_uri' => 'https://api.zoom.us',
        ]);

        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer " . getZoomAccessToken()
            ],
            'json' => [
                "topic" => $topic,
                "type" => 2,
                "start_time" => $start_time,
                "duration" => $duration,
                "password" => "123456"
            ],
        ]);

        if($response){
            $data = json_decode($response->getBody());
            $table_name = $wpdb->prefix . "sessions";
            $wpdb->update($table_name, array('video_call_link' => $data->join_url), array('id' => $insertId));

            //send email to therapist and client

            global $rlgh_data;

            $headers = array(
                'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
                'content-type: text/html'
            );

            $client_message = str_replace(
                'tar_id=""',
                'id="' . $client_id . '"',
                $rlgh_data['client_booked_text']
            );  

            $client_message = str_replace(
                'cur_id=""',
                'id="' . $therapist_id . '"',
                $client_message
            ); 

            $client_message = str_replace(
                'ses_id=""',
                'ses_id="' . $insertId . '"',
                $client_message
            ); 
             

            $mailBody = email_template(
                $rlgh_data['client_booked_title'],
                $client_message,
                $rlgh_data['client_booked_image']['url']
            );
        
            wp_mail( $client_email, $rlgh_data['client_booked_title'], $mailBody, $headers );

            $therapist_message = str_replace(
                'tar_id=""',
                'id="' . $therapist_id . '"',
                $rlgh_data['therapist_booked_text']
            );  

            $therapist_message = str_replace(
                'cur_id=""',
                'id="' . $client_id . '"',
                $therapist_message
            );  

            $therapist_message = str_replace(
                'ses_id=""',
                'ses_id="' . $insertId . '"',
                $therapist_message
            );

            $mailBody = email_template(
                $rlgh_data['therapist_booked_title'],
                $therapist_message,
                $rlgh_data['therapist_booked_image']['url']
            );
        
            wp_mail( $therapist_email, $rlgh_data['therapist_booked_title'], $mailBody, $headers );

        } else {
                echo "Getting error!";
            }
    }  else {
        echo "No Data Found!";
    }
    die;
}


add_action('wp_ajax_createZoomMeeting', 'createZoomMeeting');
add_action('wp_ajax_createZoomMeeting', 'createZoomMeeting');