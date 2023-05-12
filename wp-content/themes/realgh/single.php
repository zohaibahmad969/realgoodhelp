<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package realgh
 */

get_header();
get_template_part('parts/success', 'popup');
get_template_part('parts/video', 'popup');
global $rlgh_data;


if (get_post_meta(get_the_ID(), 'wellbeing_lesson_question', true)):
    $wellbeing_exercise_title = '';
    $wellbeing_exercise_text = '';
    $wellbeing_exercise_youtube_link = '';
    $wellbeing_exercise_youtube_thumb = '';
    $other_list = '';
    $tabs_content = get_post_meta(get_the_ID(), 'wellbeing_re_strategy_list', true);
    foreach ($tabs_content as $content) {
        $youtube_thumb = 'https://i.ytimg.com/vi/' . get_youtube_id($content['wellbeing_exercise_youtube_link']) . '/maxresdefault.jpg';
        $youtube_video = apply_filters('youtube_url', $content['wellbeing_exercise_youtube_link']);
        $strategy_content .= nl2br($content['wellbeing_exercise_text']);
        $p++;
    }


    $wellbeing_exercise_title = '';
    $wellbeing_exercise_text = '';
    $wellbeing_exercise_youtube_link = '';
    $wellbeing_exercise_youtube_thumb = '';
    $other_list = '';
    $tabs_content = get_post_meta(get_the_ID(), 'wellbeing_re_other_list', true);
    foreach ($tabs_content as $content) {
        $youtube_thumb_other = 'https://i.ytimg.com/vi/' . get_youtube_id($content['wellbeing_exercise_youtube_link']) . '/maxresdefault.jpg';
        $youtube_video_other = apply_filters('youtube_url', $content['wellbeing_exercise_youtube_link']);

        $other_list .= '<li class="other-resource-data js-show-other-resourse" title="' . $content['wellbeing_exercise_title'] . '">';
        $other_list .= '<div class="other-resource-img" dataid="' . get_the_ID() . '" datayoutube="' . $youtube_video_other . '" >';
        $other_list .= '<figure>';
        $other_list .= '<img class="other_resource_video" src="' . $youtube_thumb_other . '" dataindex="' . $p . '" dataid="' . get_the_ID() . '" datayoutube="' . $youtube_video_other . '" title="' . $content['wellbeing_exercise_title'] . '" width="110" height="110">';
        $other_list .= '</figure>';
        $other_list .= '</div>';

        $other_list .= '<div style="display: none;" class="data_resource_description">';
        $other_list .= nl2br($content['wellbeing_exercise_text']);
        $other_list .= '</div>';

        $other_list .= '</li>';

        $p++;
    }
endif;
?>

<main class="main welbbeing-single">
    <div class="que-popup-video-text d-flex single-template-video-poup">
        <div class="que-popup-video-left">
            <div class="iframe-placeholder">
                <iframe width="680" height="390" class="video" id="popup_category_video_link"
                    src="<?php echo $youtube_video; ?>" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen style="height: 490px;"></iframe>
            </div>
            <h2 class="other-resource title text-center">
                Additional Rescources
            </h2>
            <ul id="data_other">
                <?php echo $other_list; ?>
            </ul>
            <div class="tips-list-suggestion text-center">
                <div class="tips-list">
                    <h2>Something else is bothering you?</h2>
                    <ul id="cond_list">
                    </ul>
                </div>
                <div class="suggestion welbbeing-single">
                    <form action="" class="suggestion__form2">
                        <label for="suggest" class="label form__label text text--fw-500 text--c-black">
                            <?php echo ($rlgh_data['suggest_label'] == "") ? "Suggest a topic we have not covered yet" : $rlgh_data['suggest_label']; ?>
                        </label>
                        <div class="input-block suggestion-form__input-block">
                            <input type="text" id="suggest" name="suggestion"
                                class="input input-text text suggest__input">
                            <button class="button suggest__button" type="submit">
                                <span class="button-text button-text--lighter">
                                    <?php echo ($rlgh_data['suggest_btn'] == "") ? "Submit" : $rlgh_data['suggest_btn']; ?>
                                </span>
                            </button>
                        </div>
                        <div class="form-success-message">
                            <p class="text">Thank you! We will look into it.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="que-popup-video-right">
            <div class="desc-text">
                <h2 id="popup_category_title">
                    <?php echo get_post_meta(get_the_ID(), 'wellbeing_lesson_title', true) ?>
                </h2>
                <p id="popup_category_text">
                    <?php echo $strategy_content ?>
                </p>
            </div>

            <div id="other-resources" class="other-resources">
                <div class="other-resource-btn">
                    <?php
                    if (get_post_meta(get_the_ID(), 'wellbeing_exercise_text', true) !== '') {
                        ?>
                        <a href="#" class="za-blue-btn js-show-start-exercise-screen-on-singlepost">
                            <span class="button-text">Start the Exercise</span>
                        </a>
                        <?php
                    }
                    ?>
                    <a href="<?php echo get_home_url() . '/reminder/?post_id=' . get_the_ID(); ?>"
                        class="link za-blue-btn js-show-reminderpage-btn">
                        <span class="button-text">Reminder</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- Exercises Design starts here -->
<?php get_template_part('partials/single-page-exercises-design'); ?>
<!-- Exercises Design ends here -->
<?php


get_sidebar();
get_footer();