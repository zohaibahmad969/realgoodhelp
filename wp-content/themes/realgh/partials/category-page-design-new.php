<?php
$cat_data = get_queried_object();
$cat_meta = get_option('category_' . $cat_data->term_id);
$cat_name = $cat_data->name;

get_template_part('parts/other-website', 'popup');
get_template_part('parts/reminder', 'popup');
get_template_part('parts/payment', 'popup');

?>

<div class="wrapper category-page-design-one-video-atm">
    <div id="loader" class="loader-wrap is-active" style="display:none;">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader"
            alt="blue_spinner">
    </div>
    <?php
    if (!empty($cat_meta['tunnel_data'])) {
        foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
            if (!empty($tunnel_data['tunnel_name']) && !empty($tunnel_data['tunnel_cards'])) {
                if ($tunnel_data['tunnel_name'] === "main") {
                    ?>
                    <h2 class="js-tunnel-card-header" style="display:none;">
                        <?php echo $tunnel_data['tunnel_name'] ?>
                    </h2>
                    <?php
                    $count_main_card = 0;
                    $card_all_count = 1;
                    usort($tunnel_data['tunnel_cards'], function ($a, $b) {
                        return $a['tc_pos'] - $b['tc_pos'];
                    });
                    foreach ($tunnel_data['tunnel_cards'] as $key => $tunnel_card) {
                        if (($tunnel_card['tc_btn1_act'] === "registration_page" || $tunnel_card['tc_btn2_act'] === "registration_page" || $tunnel_card['tc_btn3_act'] === "registration_page") && is_user_logged_in()) {

                        }else{
                            ?>
                            <div class="sc-ui-design" data-cardIdentifier="<?php echo 'sc_ui_design'.$card_all_count ?>" <?php echo ($count_main_card == 0) ? 'style="display: block;"' : ''; ?>>
                                <div class="sc-ui-screen">
                                    <div class="sc-image-wrap">
                                        <img class="sc-que-image" src="<?php echo $tunnel_card['tc_img'] ?>" width="100%">
                                    </div>
                                    <div class="sc-content">
                                        <?php
                                        if ($key !== 0) {
                                            ?>
                                            <button class="button blue-button js-back-tunnel-card">
                                                <span class="button-text">Back</span>
                                            </button>
                                            <?php
                                        }
                                        ?>
                                        <div class="sc-content-inner">
                                            <h2 class="sc-content-main-title title col-black m-b-15">
                                                <?php echo $tunnel_card['tc_txt'] ?>
                                            </h2>
                                            <?php
                                            if ($tunnel_card['tc_itba'] === "Yes" || $tunnel_card['tc_itba'] === "yes") {
                                                ?>
                                                <textarea class="input input-text" style="min-height: 90px;padding: 5px;"
                                                    placeholder="Your Thoughts ...."></textarea><br><br>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if ($tunnel_card['tc_btn1_act'] === "registration_page" && is_user_logged_in()) {
                                                // if action is to show registration page but user is already logged in then skip this button
                                            } else if ($tunnel_card['tc_btn1_txt'] !== "") {
                                                if (strpos($tunnel_card['tc_btn1_link'], 'youtube') !== false || strpos($tunnel_card['tc_btn1_link'], 'youtu.be') !== false) {
                                                    $tunnel_card['tc_btn1_link'] = apply_filters('youtube_url', $tunnel_card['tc_btn1_link']);
                                                }
                                                ?>
                                                    <a <?php echo ($tunnel_card['tc_btn1_act'] === 'link_to_another_website') ? 'data-openInNewtab="'.$tunnel_card['tc_btn1_open'].'" href="'. $tunnel_card['tc_btn1_link'].'"' : 'href=#' ?>
                                                        class="button button--big blue-button js-sc-ui-next-screen-btn"
                                                        data-btnAction="<?php echo $tunnel_card['tc_btn1_act'] ?>" <?php echo ($tunnel_card['tc_btn1_act'] === 'choose_sub_tunnel') ? 'data-subtunnel="' . $tunnel_card['tc_btn1_st'] . '" data-subtunnelcard=' . $tunnel_card['tc_btn1_act_st']  : '' ?>
                                                        <?php echo ($tunnel_card['tc_btn1_act'] === 'payment_page') ? 'data-paymentPageText="'. $tunnel_card['tc_btn1_pt'] .'" data-paymentPageAmount=' . $tunnel_card['tc_btn1_pa'] : '' ?>>
                                                        <span class="button-text">
                                                        <?php echo $tunnel_card['tc_btn1_txt'] ?>
                                                        </span>
                                                    </a>
                                                <?php
                                            }
                                            ?>
                                            <br>
                                            <?php
                                            if ($tunnel_card['tc_btn2_act'] === "registration_page" && is_user_logged_in()) {
                                                // if action is to show registration page but user is already logged in then skip this button
                                            } else if ($tunnel_card['tc_btn2_txt'] !== "") {
                                                if (strpos($tunnel_card['tc_btn2_link'], 'youtube') !== false || strpos($tunnel_card['tc_btn2_link'], 'youtu.be') !== false) {
                                                    $tunnel_card['tc_btn2_link'] = apply_filters('youtube_url', $tunnel_card['tc_btn2_link']);
                                                }
                                                ?>
                                                    <a <?php echo ($tunnel_card['tc_btn2_act'] === 'link_to_another_website') ? 'data-openInNewtab="'.$tunnel_card['tc_btn1_open'].'" href="'.  $tunnel_card['tc_btn2_link'].'"' : 'href=#' ?>
                                                        class="button button--big blue-button js-sc-ui-next-screen-btn"
                                                        data-btnAction="<?php echo $tunnel_card['tc_btn2_act'] ?>" <?php echo ($tunnel_card['tc_btn2_act'] === 'choose_sub_tunnel') ? 'data-subtunnel="' . $tunnel_card['tc_btn2_st'] . '" data-subtunnelcard=' . $tunnel_card['tc_btn2_act_st'] : '' ?>
                                                        <?php echo ($tunnel_card['tc_btn2_act'] === 'payment_page') ? 'data-paymentPageText="'. $tunnel_card['tc_btn2_pt'].'" data-paymentPageAmount=' . $tunnel_card['tc_btn2_pa'] : '' ?>>
                                                        <span class="button-text">
                                                        <?php echo $tunnel_card['tc_btn2_txt'] ?>
                                                        </span>
                                                    </a>
                                                <?php
                                            }
                                            ?>
                                            <br>
                                            <?php
                                            if ($tunnel_card['tc_btn3_act'] === "registration_page" && is_user_logged_in()) {
                                                // if action is to show registration page but user is already logged in then skip this button
                                            } else if ($tunnel_card['tc_btn3_txt'] !== "") {
                                                if (strpos($tunnel_card['tc_btn3_link'], 'youtube') !== false || strpos($tunnel_card['tc_btn3_link'], 'youtu.be') !== false) {
                                                    $tunnel_card['tc_btn3_link'] = apply_filters('youtube_url', $tunnel_card['tc_btn3_link']);
                                                }
                                                ?>
                                                    <a <?php echo ($tunnel_card['tc_btn3_act'] === 'link_to_another_website') ? 'data-openInNewtab="'.$tunnel_card['tc_btn3_open'].'" href="'. $tunnel_card['tc_btn3_link'].'"' : 'href=#' ?>
                                                        class="button button--big blue-button js-sc-ui-next-screen-btn"
                                                        data-btnAction="<?php echo $tunnel_card['tc_btn3_act'] ?>" <?php echo ($tunnel_card['tc_btn3_act'] === 'choose_sub_tunnel') ? 'data-subtunnel="' . $tunnel_card['tc_btn3_st'] . '" data-subtunnelcard=' . $tunnel_card['tc_btn3_act_st'] : '' ?>
                                                        <?php echo ($tunnel_card['tc_btn3_act'] === 'payment_page') ? 'data-paymentPageText="'. $tunnel_card['tc_btn3_pt'].'" data-paymentPageAmount=' . $tunnel_card['tc_btn3_pa'] : '' ?>>
                                                        <span class="button-text">
                                                        <?php echo $tunnel_card['tc_btn3_txt'] ?>
                                                        </span>
                                                    </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $count_main_card++;
                        }
                        $card_all_count++;
                    }
                }
            }
        }

        $subtunnel_count = 1;
        foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
            if (!empty($tunnel_data['tunnel_name']) && !empty($tunnel_data['tunnel_cards'])) {
                if ($tunnel_data['tunnel_name'] !== "main") {
                    $count_main_card = 1;
                    $card_all_count = 1;
                    usort($tunnel_data['tunnel_cards'], function ($a, $b) {
                        return $a['tc_pos'] - $b['tc_pos'];
                    });
                    ?>
                    <div class="sc-ui-design subtunnel <?php echo 'subtunnel_' . $subtunnel_count; ?>" id="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>">
                        <?php
                        foreach ($tunnel_data['tunnel_cards'] as $key => $tunnel_card) {
                            if (($tunnel_card['tc_btn1_act'] === "registration_page" || $tunnel_card['tc_btn2_act'] === "registration_page" || $tunnel_card['tc_btn3_act'] === "registration_page") && is_user_logged_in()) {

                            }else{
                                ?>
                                <div class="sc-ui-design <?php echo "subtunnelcard_" . $count_main_card; ?>" data-cardIdentifier="<?php echo 'subtunnelcard'.$subtunnel_count.'_sc_ui_design'.$card_all_count ?>" <?php echo ($count_main_card == 0) ? 'style="display: block;"' : ''; ?>>
                                    <div class="sc-ui-screen">
                                        <div class="sc-image-wrap">
                                            <img class="sc-que-image" src="<?php echo $tunnel_card['tc_img'] ?>" width="100%">
                                        </div>
                                        <div class="sc-content">
                                        <?php
                                            if ($key !== 0) {
                                                ?>
                                                <button class="button blue-button js-back-tunnel-card">
                                                    <span class="button-text">Back</span>
                                                </button>
                                                <?php
                                            }
                                        ?>
                                            <div class="sc-content-inner">
                                                <h2 class="title js-tunnel-card-header">
                                                    <?php echo $tunnel_data['tunnel_name'] ?>
                                                </h2>
                                                <h2 class="sc-content-main-title title col-black m-b-15">
                                                    <?php echo $tunnel_card['tc_txt'] ?>
                                                </h2>
                                                <?php
                                                if ($tunnel_card['tc_itba'] === "Yes" || $tunnel_card['tc_itba'] === "yes") {
                                                    ?>
                                                    <textarea class="input input-text" style="min-height: 90px;padding: 5px;"
                                                    placeholder="Your Thoughts ...."></textarea><br><br>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if ($tunnel_card['tc_btn1_act'] === "registration_page" && is_user_logged_in()) {
                                                    // if action is to show registration page but user is already logged in then skip this button
                                                } else if ($tunnel_card['tc_btn1_txt'] !== "") {
                                                    if (strpos($tunnel_card['tc_btn1_link'], 'youtube') !== false || strpos($tunnel_card['tc_btn1_link'], 'youtu.be') !== false) {
                                                        $tunnel_card['tc_btn1_link'] = apply_filters('youtube_url', $tunnel_card['tc_btn1_link']);
                                                    }
                                                    ?>
                                                        <a <?php echo ($tunnel_card['tc_btn1_act'] === 'link_to_another_website') ? 'data-openInNewtab="'.$tunnel_card['tc_btn1_open'].'" href=' . $tunnel_card['tc_btn1_link'] : 'href=#' ?>
                                                            class="button button--big blue-button js-sc-ui-next-screen-btn"
                                                            data-btnAction="<?php echo $tunnel_card['tc_btn1_act'] ?>" <?php echo ($tunnel_card['tc_btn1_act'] === 'choose_sub_tunnel') ? 'data-subtunnel="' . $tunnel_card['tc_btn1_st'] . '" data-subtunnelcard=' . $tunnel_card['tc_btn1_act_st'] : '' ?>
                                                            <?php echo ($tunnel_card['tc_btn1_act'] === 'payment_page') ? 'data-paymentPageText="'. $tunnel_card['tc_btn1_pt'].'" data-paymentPageAmount=' . $tunnel_card['tc_btn1_pa'] : '' ?>>
                                                            <span class="button-text">
                                                            <?php echo $tunnel_card['tc_btn1_txt'] ?>
                                                            </span>
                                                        </a>
                                                    <?php
                                                }
                                                ?>
                                                <br>
                                                <?php
                                                if ($tunnel_card['tc_btn2_act'] === "registration_page" && is_user_logged_in()) {
                                                    // if action is to show registration page but user is already logged in then skip this button
                                                } else if ($tunnel_card['tc_btn2_txt'] !== "") {
                                                    if (strpos($tunnel_card['tc_btn2_link'], 'youtube') !== false || strpos($tunnel_card['tc_btn2_link'], 'youtu.be') !== false) {
                                                        $tunnel_card['tc_btn2_link'] = apply_filters('youtube_url', $tunnel_card['tc_btn2_link']);
                                                    }
                                                    ?>
                                                        <a <?php echo ($tunnel_card['tc_btn2_act'] === 'link_to_another_website') ? 'data-openInNewtab="'.$tunnel_card['tc_btn2_open'].'" href=' .  $tunnel_card['tc_btn2_link'] : 'href=#' ?>
                                                            class="button button--big blue-button js-sc-ui-next-screen-btn"
                                                            data-btnAction="<?php echo $tunnel_card['tc_btn2_act'] ?>" <?php echo ($tunnel_card['tc_btn2_act'] === 'choose_sub_tunnel') ? 'data-subtunnel="' . $tunnel_card['tc_btn2_st'] . '" data-subtunnelcard=' . $tunnel_card['tc_btn2_act_st'] : '' ?>
                                                            <?php echo ($tunnel_card['tc_btn2_act'] === 'payment_page') ? 'data-paymentPageText="'. $tunnel_card['tc_btn2_pt'].'" data-paymentPageAmount=' . $tunnel_card['tc_btn2_pa'] : '' ?>>
                                                            <span class="button-text">
                                                            <?php echo $tunnel_card['tc_btn2_txt'] ?>
                                                            </span>
                                                        </a>
                                                    <?php
                                                }
                                                ?>
                                                <br>
                                                <?php
                                                if ($tunnel_card['tc_btn3_act'] === "registration_page" && is_user_logged_in()) {
                                                    // if action is to show registration page but user is already logged in then skip this button
                                                } else if ($tunnel_card['tc_btn3_txt'] !== "") {
                                                    if (strpos($tunnel_card['tc_btn3_link'], 'youtube') !== false || strpos($tunnel_card['tc_btn3_link'], 'youtu.be') !== false) {
                                                        $tunnel_card['tc_btn3_link'] = apply_filters('youtube_url', $tunnel_card['tc_btn3_link']);
                                                    }
                                                    ?>
                                                        <a <?php echo ($tunnel_card['tc_btn3_act'] === 'link_to_another_website') ? 'data-openInNewtab="'.$tunnel_card['tc_btn3_open'].'" href=' . $tunnel_card['tc_btn3_link'] : 'href=#' ?>
                                                            class="button button--big blue-button js-sc-ui-next-screen-btn"
                                                            data-btnAction="<?php echo $tunnel_card['tc_btn3_act'] ?>" <?php echo ($tunnel_card['tc_btn3_act'] === 'choose_sub_tunnel') ? 'data-subtunnel="' . $tunnel_card['tc_btn3_st'] . '" data-subtunnelcard=' . $tunnel_card['tc_btn3_act_st'] : '' ?>
                                                            <?php echo ($tunnel_card['tc_btn3_act'] === 'payment_page') ? 'data-paymentPageText="'. $tunnel_card['tc_btn3_pt'].'" data-paymentPageAmount=' . $tunnel_card['tc_btn3_pa'] : '' ?>>
                                                            <span class="button-text">
                                                            <?php echo $tunnel_card['tc_btn3_txt'] ?>
                                                            </span>
                                                        </a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $count_main_card++;
                            }
                            $card_all_count++;
                        }
                        ?>
                    </div>
                    <?php
                    $subtunnel_count++;
                }
            }
        }
    }
    ?>

</div>