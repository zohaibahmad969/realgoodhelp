<?php
/*
 * Add custom fields for categories
 */

/*
 * --------------------------------Add page-----------------------------------------
 */

add_action('category_add_form_fields', 'wellbeing_add_custom_category_fields', 10, 2);

function wellbeing_add_custom_category_fields($taxonomy)
{ ?>
    <!--------------------Short Name for category (usage is in sub category)----------------------->
<div class="form-field">
    <label for="cat-short-name" style="font-weight: 500;">
        <?php echo esc_html__('Category Short Name', 'realgh'); ?>
    </label>
    <input type="text" id="cat-short-name" name="cat_meta[cat_short_name]">
    <p>
        <?php
        echo esc_html__(
            'Enter the short name of category if longer. This short name will appear on cards.',
            'realgh'
        );
        ?>
    </p>
</div>


<!--------------------IMAGE----------------------->
<div class="form-field">
    <label style="font-weight: 500;">
        <?php echo esc_html__('Category Image Url', 'realgh'); ?>
    </label>
    <a href="#" class="button upload-img">
        <?php echo esc_html__('Upload image', 'realgh'); ?>
    </a>
    <a href="#" class="remove-img" style="display:none">
        <?php echo esc_html__('Remove image', 'realgh'); ?>
    </a>
    <input type="hidden" class="img-url" name="cat_meta[img]" value="">
    <p>
        <?php
        echo esc_html__(
            'Upload the image that will be the cover for this category.',
            'realgh'
        );
        ?>
    </p>
</div>

<!--------------------YOUTUBE----------------------->
<div class="form-field">
    <label for="youtube-link" style="font-weight: 500;">
        <?php echo esc_html__('Theme link to YouTube video', 'realgh'); ?>
    </label>
    <input type="text" id="youtube-link" name="cat_meta[youtube]">
    <p>
        <?php
        echo esc_html__(
            'Enter the link to the YouTube video to be opened in the tunnel pop-up page.',
            'realgh'
        );
        ?>
    </p>
</div>

<!--------------------MAIN QUESTION----------------------->
<div class="form-field">
    <label for="question" style="font-weight: 500;">
        <?php echo esc_html__('Main theme question', 'realgh'); ?>
    </label>
    <input type="text" id="question" name="cat_meta[question]">
    <p>
        <?php echo esc_html__('Enter a question to be linked to this topic.', 'realgh'); ?>
    </p>
    <label>
        <?php echo esc_html__('The correct answer is:', 'realgh'); ?>
    </label>
    <div style="display: flex; align-items: center; column-gap: 8px;">
        <div style="display: flex; align-items: center;">
            <input type="radio" id="yes-answer" name="cat_meta[answer]" value="yes">
            <label for="yes-answer">
                <?php echo esc_html__('Yes', 'realgh'); ?>
            </label>
        </div>
        <div style="display: flex; align-items: center;">
            <input type="radio" id="no-answer" name="cat_meta[answer]" value="no">
            <label for="no-answer">
                <?php echo esc_html__('No', 'realgh'); ?>
            </label>
        </div>
    </div>
</div>

<!--------------------THEMES----------------------->
<?php $cats = get_categories(); ?>
<div class="form-field">
    <label for="questions" style="font-weight: 500;">
        <?php echo esc_html__('Questions on the tunnel page', 'realgh'); ?>
    </label>
    <select name="cat_meta[themes][]" id="questions" multiple>
        <option value="none">None</option>
        <?php
        foreach ($cats as $cat):

            if ($cat->term_id == 1)
                continue; ?>

        <option value="<?php echo $cat->term_id; ?>">
            <?php echo $cat->name; ?>
        </option>

        <?php endforeach; ?>
    </select>
    <p>
        <?php
        echo esc_html__(
            'Which topic\'s questions will be displayed on the tunnel page?',
            'realgh'
        );
        ?>
    </p>
</div>

<!--------------------Questionaire Test Questions----------------------->
<div class="form-field">
    <h2 style="font-size: 20px;margin-top: 80px;">
        <?php echo esc_html__('Questionaire Test Details', 'realgh'); ?>
    </h2>
    <label for="questionaire_title">
        <?php echo esc_html__('Questionaire Title', 'realgh'); ?>
    </label>
    <input type="text" name="cat_meta[questionaire_title]" id="questionaire_title">
    <br><br>
    <label for="questionaire_description">
        <?php echo esc_html__('Questionaire Description', 'realgh'); ?>
    </label>
    <textarea name="cat_meta[questionaire_description]" id="questionaire_description" rows="6"></textarea>
    <label for="questionaire_description">
        <?php echo esc_html__('Questionaire Test Image', 'realgh'); ?>
    </label>
    <a href="#" class="button upload-img">
        <?php echo esc_html__('Upload image', 'realgh'); ?>
    </a>
    <a href="#" class="remove-img" style="display:none">
        <?php echo esc_html__('Remove image', 'realgh'); ?>
    </a>
    <input type="hidden" class="img-url" name="cat_meta[questionaire_test_image]" value="">

    <br>
    <br>

    <label style="font-size:16px;font-weight: 500;cursor: default;">
        <?php echo esc_html__('Questions on the Questionaire Test', 'realgh'); ?>
        <button type="button" class="button" id="add_questionaire_question_div" data-question="1">
            <?php echo esc_html__('Add Question', 'realgh'); ?>
        </button>
    </label>
    <div class="questionaire_questions" id="questionaire_questions">
    </div>
    <p>
        <?php echo esc_html__('These questions will be displayed on the questionaire for this tunnel', 'realgh'); ?>
    </p>

    <br>
    <br>

    <label style="font-size:16px;font-weight: 500;cursor: default;">
        <?php echo esc_html__('Answers on the Questionaire Test', 'realgh'); ?>
        <button type="button" class="button" id="add_questionaire_answer_div" data-answer="1">
            <?php echo esc_html__('Add Answer', 'realgh'); ?>
        </button>
    </label>
    <div class="questionaire_answers" id="questionaire_answers">
    </div>

    <label style="font-size:16px;font-weight: 500;cursor: default;margin-top:20px">
        <?php echo esc_html__('Results for the Questionaire Test', 'realgh'); ?>
        <button type="button" class="button" id="add_questionaire_result_div" data-result="1">
            <?php echo esc_html__('Add Result', 'realgh'); ?>
        </button>
        <button type="button" class="button" id="add_questionaire_single_result_div">
            <?php echo esc_html__('Add Single Result', 'realgh'); ?>
        </button>
    </label>
    <div class="questionaire_results" id="questionaire_results">
    </div>

</div>
<?php

}

/*
 * --------------------------------Edit page-----------------------------------------
 */

add_action('category_edit_form_fields', 'wellbeing_edit_custom_category_fields', 10, 2);

function wellbeing_edit_custom_category_fields($tag)
{
    $cat_meta = get_option("category_$tag->term_id");
    ?>

<!--------------------Short Name for category (usage is in sub category)----------------------->
<tr class="form-field">
    <th scope="row" valign="top">
        <label>
            <?php echo esc_html__('Category Short Name', 'realgh'); ?>
        </label>
    </th>
    <td>
        <input type="text" id="cat-short-name" name="cat_meta[cat_short_name]"
            value="<?php echo $cat_meta['cat_short_name']; ?>">
        <p>
            <?php
            echo esc_html__(
                'Enter the short name of category if longer. This short name will appear on cards.',
                'realgh'
            );
            ?>
        </p>
    </td>
</tr>

<!--------------------IMAGE----------------------->
<tr class="form-field">
    <th scope="row" valign="top">
        <label>
            <?php echo esc_html__('Category Image Url', 'realgh'); ?>
        </label>
    </th>
    <td>
        <?php if ($cat_meta['img']): ?>
        <a href="#" class="button upload-img">
            <img src="<?php echo $cat_meta['img']; ?>" style="width: 100%;" />
        </a>
        <a href="#" class="remove-img">
            <?php echo esc_html__('Remove image', 'realgh'); ?>
        </a>
        <input type="text" class="img-url" name="cat_meta[img]" value="<?php echo $cat_meta['img']; ?>">
        <?php else: ?>
        <a href="#" class="button upload-img">
            <?php echo esc_html__('Upload image', 'realgh'); ?>
        </a>
        <a href="#" class="remove-img" style="display:none">
            <?php echo esc_html__('Remove image', 'realgh'); ?>
        </a>
        <input type="hidden" class="img-url" name="cat_meta[img]" value="">
        <?php endif; ?>
        <p>
            <?php
            echo esc_html__(
                'Upload the image that will be the cover for this category.',
                'realgh'
            );
            ?>
        </p>
    </td>
</tr>

<!--------------------YOUTUBE----------------------->
<tr class="form-field">
    <th scope="row" valign="top">
        <label>
            <?php echo esc_html__('Theme link to YouTube video', 'realgh'); ?>
        </label>
    </th>
    <td>
        <input type="text" id="youtube-link" name="cat_meta[youtube]" value="<?php echo $cat_meta['youtube']; ?>">
        <p>
            <?php
            echo esc_html__(
                'Enter the link to the YouTube video to be opened in the tunnel pop-up page.',
                'realgh'
            );
            ?>
        </p>
    </td>
</tr>

<!--------------------MAIN QUESTION----------------------->
<tr class="form-field">
    <th scope="row" valign="top">
        <label>
            <?php echo esc_html__('Main theme question', 'realgh'); ?>
        </label>
    </th>
    <td>
        <input type="text" id="question" name="cat_meta[question]" value="<?php echo $cat_meta['question']; ?>">
        <p style="margin-bottom: 8px;">
            <?php echo esc_html__('Enter a question to be linked to this topic.', 'realgh'); ?>
        </p>
        <label>
            <?php echo esc_html__('The correct answer is:', 'realgh'); ?>
        </label>
        <div style="display: flex; align-items: center; column-gap: 8px; margin: 4px 0;">
            <div style="display: flex; align-items: center;">
                <input type="radio" id="yes-answer" name="cat_meta[answer]" value="yes"
                    <?php echo $cat_meta['answer'] == 'yes' ? 'checked' : '' ?>>
                <label for="yes-answer">
                    <?php echo esc_html__('Yes', 'realgh'); ?>
                </label>
            </div>
            <div style="display: flex; align-items: center;">
                <input type="radio" id="no-answer" name="cat_meta[answer]" value="no"
                    <?php echo $cat_meta['answer'] == 'no' ? 'checked' : '' ?>>
                <label for="no-answer">
                    <?php echo esc_html__('No', 'realgh'); ?>
                </label>
            </div>
        </div>
    </td>
</tr>

<!--------------------THEMES----------------------->
<?php $cats = get_categories(); ?>
<tr>
    <th>
        <label for="questions">
            <?php echo esc_html__('Questions on the tunnel page', 'realgh'); ?>
        </label>
    </th>
    <td>
        <select name="cat_meta[themes][]" id="questions" multiple>
            <option value="none" <?php echo $cat_meta['themes'][0] == 'none' ? 'selected' : ''; ?>>
                None
            </option>

            <?php
            foreach ($cats as $cat):

                if ($cat->term_id == 1)
                    continue; ?>

            <option value="<?php echo $cat->term_id; ?>" <?php
               if (!empty($cat_meta['themes'])):
                   echo array_search($cat->term_id, $cat_meta['themes']) !== false ?
                       'selected' :
                       '';
               endif;
               ?>>
                <?php echo $cat->name; ?>
            </option>

            <?php endforeach; ?>

        </select>
        <p>
            <?php
            echo esc_html__(
                'Which topic\'s questions will be displayed on the tunnel page?',
                'realgh'
            );
            ?>
        </p>
    </td>
</tr>




<!--------------------Questionaire Test Questions Details----------------------->
<tr>
    <th colspan="2">
        <h2 style="font-size: 20px;margin-top: 20px;margin-bottom:0;">
            <?php echo esc_html__('Questionaire Test Details', 'realgh'); ?>
        </h2>
    </th>
</tr>
<tr>
    <th>
        <label for="questionaire_title">
            <?php echo esc_html__('Questionaire Title', 'realgh'); ?>
        </label>
    </th>
    <td>
        <input type="text" name="cat_meta[questionaire_title]"
            value="<?php echo (isset($cat_meta['questionaire_title'])) ? $cat_meta['questionaire_title'] : ""; ?>"
            id="questionaire_title">
    </td>
</tr>
<tr>
    <th>
        <label for="questionaire_description">
            <?php echo esc_html__('Questionaire Description', 'realgh'); ?>
        </label>
    </th>
    <td>
        <textarea rows="7" style="width: 100%;" name="cat_meta[questionaire_description]"
            id="questionaire_description"><?php echo (isset($cat_meta['questionaire_description'])) ? $cat_meta['questionaire_description'] : ""; ?></textarea>
    </td>
</tr>
<tr class="form-field">
    <th scope="row" valign="top">
        <label>
            <?php echo esc_html__('Questionaire Test Image', 'realgh'); ?>
        </label>
    </th>
    <td>
        <?php if ($cat_meta['questionaire_test_image']): ?>
        <a href="#" class="button upload-img">
            <img src="<?php echo $cat_meta['questionaire_test_image']; ?>" style="width: 100%;" />
        </a>
        <a href="#" class="remove-img">
            <?php echo esc_html__('Remove image', 'realgh'); ?>
        </a>
        <input type="text" class="img-url" name="cat_meta[questionaire_test_image]"
            value="<?php echo $cat_meta['questionaire_test_image']; ?>">
        <?php else: ?>
        <a href="#" class="button upload-img">
            <?php echo esc_html__('Upload image', 'realgh'); ?>
        </a>
        <a href="#" class="remove-img" style="display:none">
            <?php echo esc_html__('Remove image', 'realgh'); ?>
        </a>
        <input type="hidden" class="img-url" name="cat_meta[questionaire_test_image]" value="">
        <?php endif; ?>
    </td>
</tr>
<tr>
    <th colspan="2" style="padding: 0;">
        <h2 style="font-size: 17px;margin-bottom:10;">
            <?php echo esc_html__('Questionaire Test Questions', 'realgh'); ?>
            <button type="button" class="button" id="add_questionaire_question_tr">Add Question</button>
        </h2>
    </th>
</tr>
<tr>
    <td colspan="2">
        <table id="questionaire_questions" width="100%">
            <?php
            if (!empty($cat_meta['questions'])): foreach ($cat_meta['questions'] as $question) {
                    ?>

            <tr class="questionaire_question">
                <th style="padding: 0;">
                    <label>
                        <?php echo esc_html__('Question ', 'realgh'); ?>
                        <span style="cursor:pointer;"
                            class="dashicons dashicons-trash del_questionaire_question"></span>
                    </label>
                </th>
                <td style="padding: 0;">
                    <input type="text" style="width:100%;margin-bottom:3px;" name="cat_meta[questions][]"
                        value="<?php echo $question; ?>">
                </td>
            </tr>
            <?php
                }
            endif;
            ?>
        </table>
    </td>
</tr>
<tr>
    <th colspan="2" style="padding: 0;">
        <h2 style="font-size: 17px;margin-bottom:10;">
            <?php echo esc_html__('Questionaire Test Answers', 'realgh'); ?>
            <button type="button" class="button" id="add_questionaire_answer_tr">Add Answer</button>
        </h2>
    </th>
</tr>
<tr>
    <td colspan="2">
        <table id="questionaire_answers" width="100%">
            <?php
            if (!empty($cat_meta['answers'])):
                foreach ($cat_meta['answers'] as $answer) {
                    ?>
            <tr class="questionaire_answer">
                <th style="padding: 0;">
                    <label>
                        <?php echo esc_html__('Answer ', 'realgh'); ?>
                        <span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_answer"></span>
                    </label>
                </th>
                <td style="padding: 0;">
                    <input type="text" style="width:100%;margin-bottom:3px;" name="cat_meta[answers][]"
                        value="<?php echo $answer; ?>">
                </td>
            </tr>
            <?php
                }
            endif;
            ?>
        </table>
    </td>
</tr>

<tr>
    <th colspan="2" style="padding: 0;">
        <h2 style="font-size: 17px;margin-bottom:10;">
            <?php echo esc_html__('Questionaire Test Results', 'realgh'); ?>
            <button type="button" class="button" id="add_questionaire_result_tr">Add Result</button>
            <button type="button" class="button" id="add_questionaire_single_result_tr">Add Single Result</button>
        </h2>
    </th>
</tr>
<tr>
    <td colspan="2">
        <table id="questionaire_results" width="100%">
            <?php
            if (!empty($cat_meta['single_short_result'])) {
                ?>
            <tr class="questionaire_result">
                <th style="padding: 0;">
                    <label>
                        <?php echo esc_html__('Single Short Result ', 'realgh'); ?>
                        <span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>
                    </label>
                </th>
                <td style="padding: 0;">
                    <input type="text" style="width:100%;margin-bottom:3px;" name="cat_meta[single_short_result]"
                        value="<?php echo $cat_meta['single_short_result']; ?>">
                </td>
            </tr>
            <tr class="questionaire_result">
                <th style="padding: 0;">
                    <label>
                        <?php echo esc_html__('Single Long Result ', 'realgh'); ?>
                        <span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>
                    </label>
                </th>
                <td style="padding: 0;">
                    <textarea name="cat_meta[single_long_result]" rows="8"
                        style="width:100%;"><?php echo $cat_meta['single_long_result'] ?></textarea>
                </td>
            </tr>
            <tr class="questionaire_result">
                <th style="padding: 0;">
                    <label>
                        <?php echo esc_html__('Single Result Image', 'realgh'); ?>
                        <span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>
                    </label>
                </th>
                <td style="padding: 0;">
                    <div class="form-field">
                        <a href="#" class="button upload-img">
                            <img src="<?php echo $cat_meta['single_result_img']; ?>" style="max-width: 250px;">
                        </a>
                        <a href="#" class="remove-img">
                            Remove image
                        </a>
                        <input type="hidden" class="img-url" name="cat_meta[single_result_img]"
                            value="<?php echo $cat_meta['single_result_img']; ?>">
                    </div>
                </td>
            </tr>
            <?php
            } else if (!empty($cat_meta['results'])) {
                $count = 1;
                foreach ($cat_meta['results'] as $result) {
                    ?>
            <tr class="questionaire_result">
                <th style="padding: 0;">
                    <label>
                        <?php echo esc_html__('Result ', 'realgh') . '#' . $count; ?>
                        <span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>
                    </label>
                </th>
                <td style="padding: 0;">
                    <input type="text" style="width:100%;margin-bottom:3px;" name="cat_meta[results][]"
                        value="<?php echo $result; ?>">
                </td>
            </tr>
            <?php
            $count++;
                }
                $count = 1;
                foreach ($cat_meta['results_long_description'] as $results_long_description) {
                    ?>
            <tr class="questionaire_result">
                <th style="padding: 0;">
                    <label>
                        <?php echo esc_html__('Result Description ', 'realgh') . '#' . $count; ?>
                        <span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>
                    </label>
                </th>
                <td style="padding: 0;">
                    <textarea class="result_long_description" style="width:100%;"
                        name="cat_meta[results_long_description][]"
                        rows="7"><?php echo $results_long_description; ?></textarea>
                </td>
            </tr>
            <?php
            $count++;
                }
                $count = 1;
                foreach ($cat_meta['results_images'] as $results_image) {
                    ?>
            <tr class="questionaire_result">
                <th style="padding: 0;">
                    <label>
                        <?php echo esc_html__('Result Image ', 'realgh') . '#' . $count; ?>
                        <span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>
                    </label>
                </th>
                <td style="padding: 0;">
                    <div class="form-field">
                        <a href="#" class="button upload-img">
                            <img src="<?php echo $results_image; ?>" style="max-width: 250px;">
                        </a>
                        <a href="#" class="remove-img">
                            Remove image
                        </a>
                        <input type="hidden" class="img-url" name="cat_meta[results_images][]"
                            value="<?php echo $results_image; ?>">
                    </div>
                </td>
            </tr>
            <?php
            $count++;
                }
            }
            ?>
        </table>
    </td>
</tr>


<!--------------------Tunnel New Design Flow----------------------->
<style>
    .tunnel_add_card_form,
    .subtunnel_add_form{
        background-color: white; 
        border-radius: 10px; 
        width: 100%;
        transition: all 0.3s ease-in-out;
    }
    .saved_subtunnels .tunnel_add_card_form{
        background-color: #d9cbcb;
    }
    .saved_tunnel_cards .tunnel_add_card_form{
        max-height: 65px;
        overflow: hidden;
    }
    .max-height-auto{
        max-height: max-content!important;
        cursor: default!important;
    }
    .tunnel_add_card_form table * ,
    .subtunnel_add_form table *{
        padding: 5px;
    }
    .saved_tunnel_cards{
        display: flex;
        flex-direction: column;
        gap: 20px;
        border-radius: 10px;
    }
    .subtunnel-data{
        background-color: white;
        border-radius: 10px;
        width: 100%;
        transition: all 0.3s ease-in-out;
        padding: 15px;
    }

    .tunnel_add_card_form table .js-tunnel-card-header{
        font-size: 20px;margin-top: 0px;margin-bottom:0;padding: 15px 5px;cursor: pointer;
    }
    .saved_tunnel_cards .tunnel_add_card_form{
        background-color: #d9cbcb;
    }

    .subtunnel_template{
        margin-bottom: 15px;
    }
</style>
<tr class="tunnel-add-form-btn-container">
    <th colspan="2">
        <h2 style="font-size: 20px;margin-top: 20px;margin-bottom:0;">
            <?php echo esc_html__('Main Tunnel Cards', 'realgh'); ?>
            <button type="button" class="button add_tunnel_flow_card_tr" data-tunnel="main">Add Card</button>
        </h2>
    </th>
</tr>
<tr class="tunnel_cards_wrapper">
    <td colspan="2">
        <div class="tunnel_card_template">
            <div class="tunnel_add_card_form" style="display: none;">
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <th colspan="2" style="padding-top:0;">
                                <h2 class="js-tunnel-card-header">Add Tunnel Card Form</h2>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <label for="tunnel_card_position">Card Position</label>
                            </th>
                            <td>
                                <input type="text" value="234" class="tunnel_card_position js-on-form-reset-value-empty">
                            </td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row" valign="top">
                                <label>Card Image</label>
                            </th>
                            <td>
                                <a href="#" class="button upload-img"> <img src="https://self-help-dev-test.realgoodhelp.com/wp-content/uploads/2023/04/questionaire-bg.png" style="width: 100%;max-width:100px;"></a>
                                <a href="#" class="remove-img">Remove image</a>
                                <input type="hidden" class="img-url tunnel_card_image" value="https://self-help-dev-test.realgoodhelp.com/wp-content/uploads/2023/04/questionaire-bg.png">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="tunnel_card_text">Card Text</label>
                            </th>
                            <td>
                                <textarea rows="7" style="width: 100%;" class="tunnel_card_text js-on-form-reset-value-empty"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="tunnel_card_text">Add Text Box in Card Content</label>
                            </th>
                            <td>
                                <input type="text" placeholder="Type Yes or No" class="tunnel_card_istextboxadd js-on-form-reset-value-empty">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="tunnel_card_button1_text">Card Button 1 Text</label>
                                <br>
                                <input type="text" value="" class="tunnel_card_button1_text js-on-form-reset-value-empty">
                            </th>
                            <th>
                                <label for="tunnel_card_button1_action">Card Button 1 Action</label>
                                <br>
                                <select class="tunnel_card_button1_action tunnel_card_button_action ">
                                    <option value="">None</option>
                                    <option value="next_card_in_tunnel">Next Card in current tunnel</option>
                                    <option value="registration_page">Registration Page</option>
                                    <option value="payment_page">Payment Page</option>
                                    <option value="choose_sub_tunnel">Choose Sub Tunnel</option>
                                    <option value="set_reminder">Set Reminder to Come Back</option>
                                    <option value="link_to_another_website">Link to another website</option>
                                    <option value="next_card_in_last_prior_tunnel">Next Card in Last Prior Tunnel</option>
                                </select>
                                <input type="hidden" class="btn_action1_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                <input type="hidden" class="btn_action1_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                <input type="hidden" class="btn_action1_link_to_other_website link_to_other_website_input js-on-form-reset-value-empty" placeholder="link to Another Website" style="width: 100%;">
                                <input type="hidden" class="btn_action1_link_open_in_new_tab btn_action_link_open_in_new_tab js-on-form-reset-value-empty" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                <!-- Sub Tunnels  -->
                                    <select hidden class="tunnel_card_button1_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                        <option value="">None</option>
                                        <?php
                                        if (!empty($cat_meta['tunnel_data'])) {
                                            foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                    // for option value, making it lowercase and replacing space with _
                                                    ?>  
                                                                    <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>"><?php echo $tunnel_data['tunnel_name']; ?></option>
                                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="number" hidden class="btn_action1_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="tunnel_card_button2_text">Card Button 2 Text</label>
                                    <br>
                                    <input type="text" value="" class="tunnel_card_button2_text js-on-form-reset-value-empty">
                                </th>
                                <th>
                                    <label for="tunnel_card_button2_action">Card Button 2 Action</label>
                                    <br>
                                    <select class="tunnel_card_button2_action tunnel_card_button_action ">
                                        <option value="">None</option>
                                        <option value="next_card_in_tunnel">Next Card in current tunnel</option>
                                        <option value="registration_page">Registration Page</option>
                                        <option value="payment_page">Payment Page</option>
                                        <option value="choose_sub_tunnel">Choose Sub Tunnel</option>
                                        <option value="set_reminder">Set Reminder to Come Back</option>
                                        <option value="link_to_another_website">Link to another website</option>
                                        <option value="next_card_in_last_prior_tunnel">Next Card in Last Prior Tunnel</option>
                                    </select>
                                    <input type="hidden" class="btn_action2_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                    <input type="hidden" class="btn_action2_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                    <input type="hidden" class="btn_action2_link_to_other_website link_to_other_website_input js-on-form-reset-value-empty" placeholder="link to Another Website" style="width: 100%;">
                                    <input type="hidden" class="btn_action2_link_open_in_new_tab btn_action_link_open_in_new_tab js-on-form-reset-value-empty" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                    <!-- Sub Tunnels  -->
                                    <select hidden class="tunnel_card_button2_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                        <option value="">None</option>
                                        <?php
                                        if (!empty($cat_meta['tunnel_data'])) {
                                            foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                    // for option value, making it lowercase and replacing space with _
                                                    ?>  
                                                                    <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>"><?php echo $tunnel_data['tunnel_name']; ?></option>
                                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="number" hidden class="btn_action2_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="tunnel_card_button3_text">Card Button 3 Text</label>
                                    <br>
                                    <input type="text" value="" class="tunnel_card_button3_text js-on-form-reset-value-empty">
                                </th>
                                <th>
                                    <label for="tunnel_card_button3_action">Card Button 3 Action</label>
                                    <br>
                                    <select class="tunnel_card_button3_action tunnel_card_button_action ">
                                        <option value="">None</option>
                                        <option value="next_card_in_tunnel">Next Card in current tunnel</option>
                                        <option value="registration_page">Registration Page</option>
                                        <option value="payment_page">Payment Page</option>
                                        <option value="choose_sub_tunnel">Choose Sub Tunnel</option>
                                        <option value="set_reminder">Set Reminder to Come Back</option>
                                        <option value="link_to_another_website">Link to another website</option>
                                        <option value="next_card_in_last_prior_tunnel">Next Card in Last Prior Tunnel</option>
                                    </select>
                                    <input type="hidden" class="btn_action3_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                    <input type="hidden" class="btn_action3_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                    <input type="hidden" class="btn_action3_link_to_other_website link_to_other_website_input js-on-form-reset-value-empty" placeholder="link to Another Website" style="width: 100%;">
                                    <input type="hidden" class="btn_action3_link_open_in_new_tab btn_action_link_open_in_new_tab js-on-form-reset-value-empty" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                    <!-- Sub Tunnels  -->
                                    <select hidden class="tunnel_card_button3_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                        <option value="">None</option>
                                        <?php
                                        if (!empty($cat_meta['tunnel_data'])) {
                                            foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                    // for option value, making it lowercase and replacing space with _
                                                    ?>  
                                                                    <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>"><?php echo $tunnel_data['tunnel_name']; ?></option>
                                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="number" hidden class="btn_action3_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                </th>
                            </tr>
                            <tr>
                                <th colspaan="2" style="padding-bottom:0;">
                                    <button type="button" class="button button-secondary js-save-tunnel-card" data-tunnel="">Save Card</button>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
            <div class="saved_tunnel_cards main_saved_tunnel_cards">
                <input type="text" hidden name="tunnel_meta[tunnel_data][0][tunnel_name]" value="main">
                <?php
                if (!empty($cat_meta['tunnel_data'])) {
                    foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                        if (!empty($tunnel_data['tunnel_name']) && !empty($tunnel_data['tunnel_cards'])) {
                            if ($tunnel_data['tunnel_name'] === "main") {
                                ?>
                                                    <h2 class="js-tunnel-card-header" style="display:none;"><?php echo $tunnel_data['tunnel_name'] ?></h2>
                                                    <?php
                                                    $count_main_card = 0;
                                                    usort($tunnel_data['tunnel_cards'], function ($a, $b) {
                                                        return $a['tc_pos'] - $b['tc_pos'];
                                                    });
                                                    foreach ($tunnel_data['tunnel_cards'] as $key => $tunnel_card) {
                                                        $fieldname_main_card = 'tunnel_meta[tunnel_data][0][tunnel_cards][' . $count_main_card . ']';
                                                        ?>
                                                            <div class="tunnel_add_card_form" data-formCount="<?php echo $count_main_card; ?>">
                                                                <input type="hidden" name="tunnel_meta[tunnel_data][0][tunnel_name]" value="main">
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th colspan="2" style="padding-top:0;">
                                                                                <button class="btn btn-secondary js-delete-tunnel-card" type="button" style="float:right;margin-top:12px;">&times;</button>
                                                                                <div style="display: flex;align-items: flex-start;">
                                                                                    <input type="number" required placeholder="Card position no." name="<?php echo $fieldname_main_card; ?>[tc_pos]" value="<?php echo $tunnel_card['tc_pos'] ?>">
                                                                                    <h2 class="js-tunnel-card-header"><?php echo $tunnel_card['tc_txt'] ?></h2>
                                                                                </div>
                                                                            </th>
                                                                        </tr>
                                                                        <tr class="form-field">
                                                                            <th scope="row" valign="top">
                                                                                <label>Card Image</label>
                                                                            </th>
                                                                            <td>
                                                                                <a href="#" class="button upload-img"> <img src="<?php echo $tunnel_card['tc_img'] ?>" style="width: 100%;max-width:100px;"></a>
                                                                                <a href="#" class="remove-img">Remove image</a>
                                                                                <input type="hidden" class="img-url tunnel_card_image" name="<?php echo $fieldname_main_card; ?>[tc_img]" value="<?php echo $tunnel_card['tc_img'] ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <label for="tunnel_card_text">Card Text</label>
                                                                            </th>
                                                                            <td>
                                                                                <textarea rows="3" style="width: 100%;" class="tunnel_card_text" name="<?php echo $fieldname_main_card; ?>[tc_txt]"><?php echo $tunnel_card['tc_txt'] ?></textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <label for="tunnel_card_text">Add Text Box in Card Content</label>
                                                                            </th>
                                                                            <td>
                                                                                <input type="text" placeholder="Type Yes or No" class="tunnel_card_istextboxadd" name="<?php echo $fieldname_main_card; ?>[tc_itba]" value="<?php echo $tunnel_card['tc_itba'] ?>">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <label for="tunnel_card_button1_text">Card Button 1 Text</label>
                                                                                <br>
                                                                                <input type="text" name="<?php echo $fieldname_main_card; ?>[tc_btn1_txt]" value="<?php echo $tunnel_card['tc_btn1_txt'] ?>" class="tunnel_card_button1_text">
                                                                            </th>
                                                                            <th>
                                                                                <label for="tunnel_card_button1_action">Card Button 1 Action</label>
                                                                                <br>
                                                                                <?php
                                                                                $selected_value = $tunnel_card['tc_btn1_act']; // set the value you want to select
                                                                                $options = ['None', 'Next Card in current tunnel', 'Registration Page', 'Payment Page', 'Choose Sub Tunnel', 'Set Reminder to Come Back', 'Link to another website', 'Next Card in Last Prior Tunnel'];
                                                                                $values = ['', 'next_card_in_tunnel', 'registration_page', 'payment_page', 'choose_sub_tunnel', 'set_reminder', 'link_to_another_website', 'next_card_in_last_prior_tunnel'];
                                                                                echo '<select name="' . $fieldname_main_card . '[tc_btn1_act]" class="tunnel_card_button1_action tunnel_card_button_action ">';
                                                                                // loop through each option and check if its value is equal to the selected value
                                                                                $count_s = 0;
                                                                                foreach ($values as $value) {
                                                                                    $selected = ($selected_value == $value) ? 'selected' : '';
                                                                                    echo "<option value='$value' $selected>$options[$count_s]</option>";
                                                                                    $count_s++;
                                                                                }
                                                                                echo '</select>';
                                                                                ?>
                                                                                <input type="<?php echo ($tunnel_card['tc_btn1_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn1_pt]" value="<?php echo $tunnel_card['tc_btn1_pt'] ?>" class="btn_action1_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn1_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn1_pa]"  value="<?php echo $tunnel_card['tc_btn1_pa'] ?>" class="btn_action1_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn1_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn1_link]"  value="<?php echo $tunnel_card['tc_btn1_link'] ?>" class="btn_action1_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn1_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn1_open]"  value="<?php echo $tunnel_card['tc_btn1_open'] ?>" class="btn_action1_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                                                                <!-- Sub Tunnels  -->
                                                                                <select <?php echo ($tunnel_card['tc_btn1_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn1_st]" class="tunnel_card_button1_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                                                                    <option value="">None</option>
                                                                                    <?php
                                                                                    if (!empty($cat_meta['tunnel_data'])) {
                                                                                        foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                                                            if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                                                                // for option value, making it lowercase and replacing space with _
                                                                                                ?>  
                                                                                                                <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>" <?php echo (str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])) === $tunnel_card['tc_btn1_st']) ? 'selected' : '' ?>>
                                                                                                                    <?php echo $tunnel_data['tunnel_name']; ?>
                                                                                                                </option>
                                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <input type="number" <?php echo ($tunnel_card['tc_btn1_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn1_act_st]"  value="<?php echo $tunnel_card['tc_btn1_act_st'] ?>" class="btn_action1_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                                                            </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <label for="tunnel_card_button2_text">Card Button 2 Text</label>
                                                                                <br>
                                                                                <input type="text" name="<?php echo $fieldname_main_card; ?>[tc_btn2_txt]" value="<?php echo $tunnel_card['tc_btn2_txt'] ?>" class="tunnel_card_button2_text">
                                                                            </th>
                                                                            <th>
                                                                                <label for="tunnel_card_button2_action">Card Button 2 Action</label>
                                                                                <br>
                                                                                <?php
                                                                                $selected_value = $tunnel_card['tc_btn2_act']; // set the value you want to select
                                                                                $options = ['None', 'Next Card in current tunnel', 'Registration Page', 'Payment Page', 'Choose Sub Tunnel', 'Set Reminder to Come Back', 'Link to another website', 'Next Card in Last Prior Tunnel'];
                                                                                $values = ['', 'next_card_in_tunnel', 'registration_page', 'payment_page', 'choose_sub_tunnel', 'set_reminder', 'link_to_another_website', 'next_card_in_last_prior_tunnel'];
                                                                                echo '<select name="' . $fieldname_main_card . '[tc_btn2_act]" class="tunnel_card_button2_action tunnel_card_button_action ">';
                                                                                // loop through each option and check if its value is equal to the selected value
                                                                                $count_s = 0;
                                                                                foreach ($values as $value) {
                                                                                    $selected = ($selected_value == $value) ? 'selected' : '';
                                                                                    echo "<option value='$value' $selected>$options[$count_s]</option>";
                                                                                    $count_s++;
                                                                                }
                                                                                echo '</select>';
                                                                                ?>
                                                                                <input type="<?php echo ($tunnel_card['tc_btn2_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn2_pt]" value="<?php echo $tunnel_card['tc_btn2_pt'] ?>" class="btn_action2_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn2_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn2_pa]"  value="<?php echo $tunnel_card['tc_btn2_pa'] ?>" class="btn_action2_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn2_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn2_link]" value="<?php echo $tunnel_card['tc_btn2_link'] ?>" class="btn_action2_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn2_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn2_open]"  value="<?php echo $tunnel_card['tc_btn2_open'] ?>" class="btn_action2_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                                                                <!-- Sub Tunnels  -->
                                                                                <select <?php echo ($tunnel_card['tc_btn2_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn2_st]" class="tunnel_card_button2_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                                                                    <option value="">None</option>
                                                                                    <?php
                                                                                    if (!empty($cat_meta['tunnel_data'])) {
                                                                                        foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                                                            if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                                                                // for option value, making it lowercase and replacing space with _
                                                                                                ?>  
                                                                                                                <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>" <?php echo (str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])) === $tunnel_card['tc_btn2_st']) ? 'selected' : '' ?>>
                                                                                                                    <?php echo $tunnel_data['tunnel_name']; ?>
                                                                                                                </option>
                                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <input type="number" <?php echo ($tunnel_card['tc_btn2_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn2_act_st]"  value="<?php echo $tunnel_card['tc_btn2_act_st'] ?>" class="btn_action2_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                                                            </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <label for="tunnel_card_button3_text">Card Button 3 Text</label>
                                                                                <br>
                                                                                <input type="text" name="<?php echo $fieldname_main_card; ?>[tc_btn3_txt]" value="<?php echo $tunnel_card['tc_btn3_txt'] ?>" class="tunnel_card_button3_text">
                                                                            </th>
                                                                            <th>
                                                                                <label for="tunnel_card_button3_action">Card Button 3 Action</label>
                                                                                <br>
                                                                                <?php
                                                                                $selected_value = $tunnel_card['tc_btn3_act']; // set the value you want to select
                                                                                $options = ['None', 'Next Card in current tunnel', 'Registration Page', 'Payment Page', 'Choose Sub Tunnel', 'Set Reminder to Come Back', 'Link to another website', 'Next Card in Last Prior Tunnel'];
                                                                                $values = ['', 'next_card_in_tunnel', 'registration_page', 'payment_page', 'choose_sub_tunnel', 'set_reminder', 'link_to_another_website', 'next_card_in_last_prior_tunnel'];
                                                                                echo '<select name="' . $fieldname_main_card . '[tc_btn3_act]" class="tunnel_card_button3_action tunnel_card_button_action ">';
                                                                                // loop through each option and check if its value is equal to the selected value
                                                                                $count_s = 0;
                                                                                foreach ($values as $value) {
                                                                                    $selected = ($selected_value == $value) ? 'selected' : '';
                                                                                    echo "<option value='$value' $selected>$options[$count_s]</option>";
                                                                                    $count_s++;
                                                                                }
                                                                                echo '</select>';
                                                                                ?>
                                                                                <input type="<?php echo ($tunnel_card['tc_btn3_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn3_pt]" value="<?php echo $tunnel_card['tc_btn3_pt'] ?>" class="btn_action3_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn3_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn3_pa]"  value="<?php echo $tunnel_card['tc_btn3_pa'] ?>" class="btn_action3_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn3_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn3_link]" value="<?php echo $tunnel_card['tc_btn3_link'] ?>" class="btn_action3_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;">
                                                                                <input type="<?php echo ($tunnel_card['tc_btn3_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn3_open]"  value="<?php echo $tunnel_card['tc_btn3_open'] ?>" class="btn_action3_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                                                                <!-- Sub Tunnels  -->
                                                                                <select <?php echo ($tunnel_card['tc_btn3_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn3_st]" class="tunnel_card_button3_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                                                                    <option value="">None</option>
                                                                                    <?php
                                                                                    if (!empty($cat_meta['tunnel_data'])) {
                                                                                        foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                                                            if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                                                                // for option value, making it lowercase and replacing space with _
                                                                                                ?>  
                                                                                                                <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>" <?php echo (str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])) === $tunnel_card['tc_btn3_st']) ? 'selected' : '' ?>>
                                                                                                                    <?php echo $tunnel_data['tunnel_name']; ?>
                                                                                                                </option>
                                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <input type="number" <?php echo ($tunnel_card['tc_btn3_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn3_act_st]"  value="<?php echo $tunnel_card['tc_btn3_act_st'] ?>" class="btn_action3_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                                                            </th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <?php
                                                            $count_main_card++;
                                                    }
                            }
                        }
                    }
                }
                ?>
            </div>
        </td>
    </tr>


    <tr class="main-subtunnel-tr">
        <th colspan="2">
            <h2 style="font-size: 20px;margin-top: 20px;margin-bottom:0;">
                <?php echo esc_html__('Sub Tunnels', 'realgh'); ?>
                <button type="button" class="button add_subtunnel_tr">Add Sub Tunnel</button>
            </h2>
        </th>
    </tr>
    <tr class="main-subtunnel-tr">
        <th colspan="2">
            <div class="subtunnel_template">
                <div class="subtunnel_add_form" style="display: none;">
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <th colspan="2" style="padding-top:0;">
                                    <h2 class="js-tunnel-card-header">Add Sub Tunnel Form</h2>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="sub_tunnels">Sub Tunnel Name</label>
                                </th>
                                <th>
                                    <input type="text" name="cat_meta[sub_tunnels]" value="" class="sub_tunnel">
                                </th>
                            </tr>
                            <tr>
                                <th colspaan="2" style="padding-bottom:0;">
                                    <input type="button" class="button button-secondary js-save-subtunnel" value="Save Tunnel">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="saved_tunnel_cards sub_saved_tunnel_cards">
                <?php
                if (!empty($cat_meta['tunnel_data'])) {
                    $sub_tunnel_count = 0;
                    $subTunnelformcount = 1;
                    foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                        if (!empty($tunnel_data['tunnel_name'])) {
                            if ($tunnel_data['tunnel_name'] !== "main") {
                                $sub_tunnel_count++;
                                ?>
                                                    <div class="subtunnel_add_form subtunnel-data" data-subtunnelcount="<?php echo $sub_tunnel_count; ?>">
                                                        <table style="width:100%;">
                                                            <tbody>
                                                                <tr class="tunnel-add-form-btn-container">
                                                                    <th colspan="2" style="padding-top:0;">
                                                                        <h2 class="js-tunnel-card-header"><?php echo $tunnel_data['tunnel_name'] ?> <button class="button add_tunnel_flow_card_tr" data-tunnel="subtunnel" type="button">Add Card</button><button class="btn btn-secondary js-delete-subtunnel" type="button" style="float:right;">&times;</button></h2> <br>
                                                                        <label for="sub_tunnels" style="margin-right: 10px;">Sub Tunnel Name</label> <input type="text" name="tunnel_meta[tunnel_data][<?php echo $sub_tunnel_count; ?>][tunnel_name]" value="<?php echo $tunnel_data['tunnel_name'] ?>" class="sub_tunnel" >
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="tunnel_card_template"></div>
                                                                        <div class="saved_tunnel_cards subTunnels_saved_tunnel_cards">
                                                                        <?php
                                                                        $count_main_card = 0;
                                                                        if (!empty($tunnel_data['tunnel_cards'])) {
                                                                            usort($tunnel_data['tunnel_cards'], function ($a, $b) {
                                                                                return $a['tc_pos'] - $b['tc_pos'];
                                                                            });
                                                                            foreach ($tunnel_data['tunnel_cards'] as $key => $tunnel_card) {
                                                                                $fieldname_main_card = 'tunnel_meta[tunnel_data][' . $subTunnelformcount . '][tunnel_cards][' . $count_main_card . ']';
                                                                                ?>
                                                                                            <div class="tunnel_add_card_form" data-formCount="<?php echo $count_main_card; ?>">
                                                                                                <table style="width: 100%;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <th colspan="2" style="padding-top:0;">
                                                                                                                <button class="btn btn-secondary js-delete-tunnel-card" type="button" style="float:right;margin-top:12px;">&times;</button>
                                                                                                                <div style="display: flex;align-items: flex-start;">
                                                                                                                    <input required type="number" placeholder="Card position no." name="<?php echo $fieldname_main_card; ?>[tc_pos]" value="<?php echo $tunnel_card['tc_pos'] ?>">
                                                                                                                    <h2 class="js-tunnel-card-header"><?php echo $tunnel_card['tc_txt'] ?></h2>
                                                                                                                </div>
                                                                                                            </th>
                                                                                                        </tr>
                                                                                                        <tr class="form-field">
                                                                                                            <th scope="row" valign="top">
                                                                                                                <label>Card Image</label>
                                                                                                            </th>
                                                                                                            <td>
                                                                                                                <a href="#" class="button upload-img"> <img src="<?php echo $tunnel_card['tc_img'] ?>" style="width: 100%;max-width:100px;"></a>
                                                                                                                <a href="#" class="remove-img">Remove image</a>
                                                                                                                <input type="hidden" class="img-url tunnel_card_image" name="<?php echo $fieldname_main_card; ?>[tc_img]" value="<?php echo $tunnel_card['tc_img'] ?>">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                <label for="tunnel_card_text">Card Text</label>
                                                                                                            </th>
                                                                                                            <td>
                                                                                                                <textarea rows="3" style="width: 100%;" class="tunnel_card_text" name="<?php echo $fieldname_main_card; ?>[tc_txt]"><?php echo $tunnel_card['tc_txt'] ?></textarea>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                <label for="tunnel_card_text">Add Text Box in Card Content</label>
                                                                                                            </th>
                                                                                                            <td>
                                                                                                                <input type="text" placeholder="Type Yes or No" class="tunnel_card_istextboxadd" name="<?php echo $fieldname_main_card; ?>[tc_itba]" value="<?php echo $tunnel_card['tc_itba'] ?>">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                <label for="tunnel_card_button1_text">Card Button 1 Text</label>
                                                                                                                <br>
                                                                                                                <input type="text" name="<?php echo $fieldname_main_card; ?>[tc_btn1_txt]" value="<?php echo $tunnel_card['tc_btn1_txt'] ?>" class="tunnel_card_button1_text">
                                                                                                            </th>
                                                                                                            <th>
                                                                                                                <label for="tunnel_card_button1_action">Card Button 1 Action</label>
                                                                                                                <br>
                                                                                                                <?php
                                                                                                                $selected_value = $tunnel_card['tc_btn1_act']; // set the value you want to select
                                                                                                                $options = ['None', 'Next Card in current tunnel', 'Registration Page', 'Payment Page', 'Choose Sub Tunnel', 'Set Reminder to Come Back', 'Link to another website', 'Next Card in Last Prior Tunnel'];
                                                                                                                $values = ['', 'next_card_in_tunnel', 'registration_page', 'payment_page', 'choose_sub_tunnel', 'set_reminder', 'link_to_another_website', 'next_card_in_last_prior_tunnel'];
                                                                                                                echo '<select name="' . $fieldname_main_card . '[tc_btn1_act]" class="tunnel_card_button1_action tunnel_card_button_action ">';
                                                                                                                // loop through each option and check if its value is equal to the selected value
                                                                                                                $count_s = 0;
                                                                                                                foreach ($values as $value) {
                                                                                                                    $selected = ($selected_value == $value) ? 'selected' : '';
                                                                                                                    echo "<option value='$value' $selected>$options[$count_s]</option>";
                                                                                                                    $count_s++;
                                                                                                                }
                                                                                                                echo '</select>';
                                                                                                                ?>
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn1_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn1_pt]" value="<?php echo $tunnel_card['tc_btn1_pt'] ?>" class="btn_action1_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn1_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn1_pa]"  value="<?php echo $tunnel_card['tc_btn1_pa'] ?>" class="btn_action1_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn1_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn1_link]"  value="<?php echo $tunnel_card['tc_btn1_link'] ?>" class="btn_action1_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn1_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn1_open]"  value="<?php echo $tunnel_card['tc_btn1_open'] ?>" class="btn_action1_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                                                                                                <!-- Sub Tunnels  -->
                                                                                                                <select <?php echo ($tunnel_card['tc_btn1_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn1_st]" class="tunnel_card_button1_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                                                                                                    <option value="">None</option>
                                                                                                                    <?php
                                                                                                                    if (!empty($cat_meta['tunnel_data'])) {
                                                                                                                        foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                                                                                            if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                                                                                                // for option value, making it lowercase and replacing space with _
                                                                                                                                ?>  
                                                                                                                                                <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>" <?php echo (str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])) === $tunnel_card['tc_btn1_st']) ? 'selected' : '' ?>>
                                                                                                                                                    <?php echo $tunnel_data['tunnel_name']; ?>
                                                                                                                                                </option>
                                                                                                                                                <?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </select>
                                                                                                                <input type="number" <?php echo ($tunnel_card['tc_btn1_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn1_act_st]"  value="<?php echo $tunnel_card['tc_btn1_act_st'] ?>" class="btn_action1_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                                                                                            </th>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                <label for="tunnel_card_button2_text">Card Button 2 Text</label>
                                                                                                                <br>
                                                                                                                <input type="text" name="<?php echo $fieldname_main_card; ?>[tc_btn2_txt]" value="<?php echo $tunnel_card['tc_btn2_txt'] ?>" class="tunnel_card_button2_text">
                                                                                                            </th>
                                                                                                            <th>
                                                                                                                <label for="tunnel_card_button2_action">Card Button 2 Action</label>
                                                                                                                <br>
                                                                                                                <?php
                                                                                                                $selected_value = $tunnel_card['tc_btn2_act']; // set the value you want to select
                                                                                                                $options = ['None', 'Next Card in current tunnel', 'Registration Page', 'Payment Page', 'Choose Sub Tunnel', 'Set Reminder to Come Back', 'Link to another website', 'Next Card in Last Prior Tunnel'];
                                                                                                                $values = ['', 'next_card_in_tunnel', 'registration_page', 'payment_page' , 'choose_sub_tunnel', 'set_reminder', 'link_to_another_website', 'next_card_in_last_prior_tunnel'];
                                                                                                                echo '<select name="' . $fieldname_main_card . '[tc_btn2_act]" class="tunnel_card_button2_action tunnel_card_button_action ">';
                                                                                                                // loop through each option and check if its value is equal to the selected value
                                                                                                                $count_s = 0;
                                                                                                                foreach ($values as $value) {
                                                                                                                    $selected = ($selected_value == $value) ? 'selected' : '';
                                                                                                                    echo "<option value='$value' $selected>$options[$count_s]</option>";
                                                                                                                    $count_s++;
                                                                                                                }
                                                                                                                echo '</select>';
                                                                                                                ?>
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn2_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn2_pt]" value="<?php echo $tunnel_card['tc_btn2_pt'] ?>" class="btn_action2_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn2_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn2_pa]"  value="<?php echo $tunnel_card['tc_btn2_pa'] ?>" class="btn_action2_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn2_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn2_link]" value="<?php echo $tunnel_card['tc_btn2_link'] ?>" class="btn_action2_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn2_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn2_open]"  value="<?php echo $tunnel_card['tc_btn2_open'] ?>" class="btn_action2_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                                                                                                <!-- Sub Tunnels  -->
                                                                                                                <select <?php echo ($tunnel_card['tc_btn2_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn2_st]" class="tunnel_card_button2_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                                                                                                    <option value="">None</option>
                                                                                                                    <?php
                                                                                                                    if (!empty($cat_meta['tunnel_data'])) {
                                                                                                                        foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                                                                                            if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                                                                                                // for option value, making it lowercase and replacing space with _
                                                                                                                                ?>  
                                                                                                                                                <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>" <?php echo (str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])) === $tunnel_card['tc_btn2_st']) ? 'selected' : '' ?>>
                                                                                                                                                    <?php echo $tunnel_data['tunnel_name']; ?>
                                                                                                                                                </option>
                                                                                                                                                <?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </select>
                                                                                                                <input type="number" <?php echo ($tunnel_card['tc_btn2_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn2_act_st]"  value="<?php echo $tunnel_card['tc_btn2_act_st'] ?>" class="btn_action2_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                                                                                            </th>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <th>
                                                                                                                <label for="tunnel_card_button3_text">Card Button 3 Text</label>
                                                                                                                <br>
                                                                                                                <input type="text" name="<?php echo $fieldname_main_card; ?>[tc_btn3_txt]" value="<?php echo $tunnel_card['tc_btn3_txt'] ?>" class="tunnel_card_button3_text">
                                                                                                            </th>
                                                                                                            <th>
                                                                                                                <label for="tunnel_card_button3_action">Card Button 3 Action</label>
                                                                                                                <br>
                                                                                                                <?php
                                                                                                                $selected_value = $tunnel_card['tc_btn3_act']; // set the value you want to select
                                                                                                                $options = ['None', 'Next Card in current tunnel', 'Registration Page', 'Payment Page', 'Choose Sub Tunnel', 'Set Reminder to Come Back', 'Link to another website', 'Next Card in Last Prior Tunnel'];
                                                                                                                $values = ['', 'next_card_in_tunnel', 'registration_page', 'payment_page' , 'choose_sub_tunnel', 'set_reminder', 'link_to_another_website', 'next_card_in_last_prior_tunnel'];
                                                                                                                echo '<select name="' . $fieldname_main_card . '[tc_btn3_act]" class="tunnel_card_button3_action tunnel_card_button_action ">';
                                                                                                                // loop through each option and check if its value is equal to the selected value
                                                                                                                $count_s = 0;
                                                                                                                foreach ($values as $value) {
                                                                                                                    $selected = ($selected_value == $value) ? 'selected' : '';
                                                                                                                    echo "<option value='$value' $selected>$options[$count_s]</option>";
                                                                                                                    $count_s++;
                                                                                                                }
                                                                                                                echo '</select>';
                                                                                                                ?>
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn3_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn3_pt]" value="<?php echo $tunnel_card['tc_btn3_pt'] ?>" class="btn_action3_payment_text btn_action_payment_text btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment page text" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn3_act'] === "payment_page") ? 'text' : 'hidden' ?>"  name="<?php echo $fieldname_main_card; ?>[tc_btn3_pa]"  value="<?php echo $tunnel_card['tc_btn3_pa'] ?>" class="btn_action3_payment_amount btn_action_payment_amount btn_action_payment_details js-on-form-reset-value-empty" placeholder="Payment Amount" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn3_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn3_link]" value="<?php echo $tunnel_card['tc_btn3_link'] ?>" class="btn_action3_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;">
                                                                                                                <input type="<?php echo ($tunnel_card['tc_btn3_act'] === "link_to_another_website") ? 'text' : 'hidden' ?>" name="<?php echo $fieldname_main_card; ?>[tc_btn3_open]"  value="<?php echo $tunnel_card['tc_btn3_open'] ?>" class="btn_action3_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type 'Yes' or 'No'" style="width: 100%;">
                                                                                                                <!-- Sub Tunnels  -->
                                                                                                                <select <?php echo ($tunnel_card['tc_btn3_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn3_st]" class="tunnel_card_button3_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;">
                                                                                                                    <option value="">None</option>
                                                                                                                    <?php
                                                                                                                    if (!empty($cat_meta['tunnel_data'])) {
                                                                                                                        foreach ($cat_meta['tunnel_data'] as $key => $tunnel_data) {
                                                                                                                            if (!empty($tunnel_data['tunnel_name']) && $tunnel_data['tunnel_name'] !== "main") {
                                                                                                                                // for option value, making it lowercase and replacing space with _
                                                                                                                                ?>  
                                                                                                                                                <option value="<?php echo str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])); ?>" <?php echo (str_replace(' ', '_', strtolower($tunnel_data['tunnel_name'])) === $tunnel_card['tc_btn3_st']) ? 'selected' : '' ?>>
                                                                                                                                                    <?php echo $tunnel_data['tunnel_name']; ?>
                                                                                                                                                </option>
                                                                                                                                                <?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </select>
                                                                                                                <input type="number" <?php echo ($tunnel_card['tc_btn3_act'] === "choose_sub_tunnel") ? '' : 'hidden' ?> name="<?php echo $fieldname_main_card; ?>[tc_btn3_act_st]"  value="<?php echo $tunnel_card['tc_btn3_act_st'] ?>" class="btn_action3_subtunnel_card tunnel_card_button_action_subtunnel_card js-on-form-reset-value-empty" placeholder="Mention card number" style="width: 100%;">
                                                                                                            </th>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                            <?php
                                                                                            $count_main_card++;
                                                                            }
                                                                        }
                                                                        ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <?php
                                                    $subTunnelformcount++;
                            }
                        }
                    }
                }
                ?>
            </div>
        </th>
    </tr>

    <?php
}



// save extra category extra fields hook
add_action('created_category', 'wellbeing_save_custom_category_fileds');
add_action('edited_category', 'wellbeing_save_custom_category_fileds');

function wellbeing_save_custom_category_fileds($term_id)
{
    $cat_meta = get_option("category_$term_id");
    if (isset($_POST['cat_meta'])) {
        $cat_keys = array_keys($_POST['cat_meta']);

        foreach ($cat_keys as $key) {
            if (isset($_POST['cat_meta'][$key])) {
                $cat_meta[$key] = $_POST['cat_meta'][$key];
            }
        }
    }

    if (isset($_POST['tunnel_meta'])) {
        $tunnel_keys = array_keys($_POST['tunnel_meta']);

        foreach ($tunnel_keys as $key) {
            if (isset($_POST['tunnel_meta'][$key])) {
                $cat_meta[$key] = $_POST['tunnel_meta'][$key];
            }
        }
    }
    
    //save the option array
    update_option("category_$term_id", $cat_meta);
}

// script registration
add_action('admin_enqueue_scripts', 'wellbeing_include_js');

function wellbeing_include_js()
{
    global $current_screen;
    if ($current_screen->id != 'edit-category') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script(
        'wellbeing_admin_script',
        get_template_directory_uri() . '/inc/assets/wellbeing-custom-category-field-script.js'
    );
}