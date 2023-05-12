<?php
$cat_data = get_queried_object();
$cat_meta = get_option('category_' . $cat_data->term_id);
$cat_name = $cat_data->name;
?>
<form action="/" class="tunnel__form">
    <div class="tunnel-form__container">
        <div class="show-tunnel-question-radio-blocks-btn-wrap">
            <button type="button" class="button show-tunnel-question-radio-blocks-btn"
                title="Click this to see questions old format">
                <i class="icon realgh-chevron-down"></i>
            </button>
        </div>
        <div class="tunnel-form-questions-radio-blocks">
            <p class="text block--mb-main">
                <?php echo ($rlgh_data['cat_subtitle'] == "") ? "Are any of the following an issue?" : $rlgh_data['cat_subtitle']; ?>
            </p>
            <div class="tunnel-form__content block--mb-main">

                <!-- START TUTORIAL -->
                <div class="tutorial-hints">
                    <div class="tutorial__hint tunnel__tutorial-hint second <?php if (isset($_GET['tutorial'])) {
                        echo $_GET['tutorial'] ? 'active' : '';
                    } ?>">
                        <div class="tutorial-hint__container">
                            <p class="text tunnel-tutorial__hint-text text--c-bg">To help you identify which
                                strategies might be useful for you, we have divided a list of questions</p>
                            <button data-step="third" type="button" class="button blue-button tutorial-hint__button">
                                <span class="button-text button-text--lighter">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="tutorial__hint tunnel__tutorial-hint third">
                        <div class="tutorial-hint__container">
                            <p class="text tunnel-tutorial__hint-text text--c-bg">Answer yes or no to each
                                question,
                                so that you can see different strategies that you might be able to use to
                                achieve
                                your goal</p>
                            <button data-step="fourth" type="button"
                                class="button blue-button tutorial-hint__button third">
                                <span class="button-text button-text--lighter">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="tutorial__hint tunnel__tutorial-hint fourth">
                        <div class="tutorial-hint__container">
                            <p class="text tunnel-tutorial__hint-text text--c-bg">Beside each question you have
                                the
                                option to</p>
                            <p class="text tunnel-tutorial__hint-text text--c-bg"><span class="text--c-main">Follow
                                    Tunnel:</span> which will lead you to a different category of questions, as
                                sometimes before you can work on this goal, you need to first work on something
                                else
                            </p>
                            <button data-step="fifth" type="button"
                                class="button blue-button tutorial-hint__button fourth">
                                <span class="button-text button-text--lighter">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="tutorial__hint tunnel__tutorial-hint fifth">
                        <div class="tutorial-hint__container">
                            <p class="text tunnel-tutorial__hint-text text--c-bg"><span class="text--c-main">Learn
                                    More:</span> where you can find out more about this strategy and how it
                                helps
                            </p>
                            <button type="button" class="button blue-button tutorial-hint__button fifth">
                                <span class="button-text button-text--lighter">Okay</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- END TUTORIAL -->

                <!-----------------------Main themes questions----------------------------->
                <?php
                $i = 0;
                if (!empty($cat_meta['themes'])):
                    $main_theme_tunnel_questions = array();
                    $temp_data = "";
                    foreach ($cat_meta['themes'] as $theme):
                        if ($theme == 'none') {
                            continue;
                        }

                        $theme_data = get_category($theme);
                        $theme_meta = get_option('category_' . $theme);

                        // Saving all tunnels form blocks in array
                        $temp_data = '<div class="tunnel-form__section">
								                                            <div class="tunnel-form__question ';
                        if (isset($_GET['tutorial'])) {
                            $temp_data .= $_GET['tutorial'] && !$i ? 'tutorial__item tutorial--bd-main active' : '';
                        }
                        $temp_data .= '">
								                                                <p class="title form-question__title">
								                                                    ' . $theme_meta['question'] . '
								                                                </p>
								                                                <div data-answer="' . $theme_meta['answer'] . '" class="form-question__variants2 form-questions js-main-quest ';
                        $temp_data .= !$i ? 'tutorial__item third tutorial--bd-main' : '';
                        $temp_data .= '">
								                                                    <div class="radio-block form-question__radio-block">
								                                                        <input type="radio" id="' . $theme_data->slug . '-yes"
								                                                            name="' . $theme . '" value="yes" class="input radio">
								                                                        <label for="' . $theme_data->slug . '-yes" class="label title">
								                                                            Yes
								                                                        </label>
								                                                    </div>
								                                                    <div class="radio-block form-question__radio-block">
								                                                        <input type="radio" id="' . $theme_data->slug . '-no"
								                                                            name="' . $theme . '" value="no" class="input radio">
								                                                        <label for="' . $theme_data->slug . '-no" class="label title">
								                                                            No
								                                                        </label>
								                                                    </div>
								                                                    <div class="radio-block form-question__radio-block">
								                                                        <input type="radio" id="' . $theme_data->slug . '-unknow"
								                                                            name="' . $theme . '" value="unknow" class="input radio">
								                                                        <label for="' . $theme_data->slug . '-unknow" class="label title">
								                                                            Dont know
								                                                        </label>
								                                                    </div>
								                                                </div>
								                                            </div>
								                                            <a href="' . get_category_link($theme_data->term_id) . '" class="link button blue-button ';
                        $temp_data .= !$i ? 'tutorial__item fourth tutorial--bd-main' : '';
                        $temp_data .= '">
								                                                <span class="button-text button-text--lighter">';

                        $temp_data .= ($rlgh_data['quest_btn_text'] == "") ? "Follow Tunnel" : $rlgh_data['quest_btn_text'];
                        $temp_data .= '</span>
								                                            </a>
								                                        </div>';

                        $i++;
                        array_push($main_theme_tunnel_questions, $temp_data);
                    endforeach;
                endif;
                ?>

                <!-----------------------Secondary questions of the theme----------------------------->
                <?php
                $posts = get_posts(array('category' => $cat_data->term_id, 'nopaging' => true));
                $posts = array_reverse($posts);
                $j = 0;
                $k = 0;
                foreach ($posts as $post):
                    if (get_post_meta($post->ID, 'wellbeing_lesson_question', true)):
                        ?>
                <div class="tunnel-form__section js-sec-quest">
                    <div class="tunnel-form__question <?php
                    if (isset($_GET['tutorial'])) {
                        echo
                            $_GET['tutorial'] && !$i ?
                            'tutorial__item tutorial--bd-main active' :
                            '';
                    }
                    ?>">
                        <p class="title form-question__title">
                                    <?php echo get_post_meta($post->ID, 'wellbeing_lesson_question', true); ?>
                        </p>
                        <div
                            class="form-question__variants form-questions <?php echo !$i ? 'tutorial__item third tutorial--bd-main' : ''; ?>">
                            <div class="radio-block form-question__radio-block">
                                <input type="radio" id="<?php echo $post->post_name; ?>-yes"
                                    name="<?php echo $post->ID; ?>" value="yes" class="input radio">
                                <label for="<?php echo $post->post_name; ?>-yes" class="label title">
                                    Yes
                                </label>
                            </div>
                            <div class="radio-block form-question__radio-block">
                                <input type="radio" id="<?php echo $post->post_name; ?>-no"
                                    name="<?php echo $post->ID; ?>" value="no" class="input radio">
                                <label for="<?php echo $post->post_name; ?>-no" class="label title">
                                    No
                                </label>
                            </div>
                            <div class="radio-block form-question__radio-block">
                                <input type="radio" id="<?php echo $post->post_name; ?>-unknow"
                                    name="<?php echo $post->ID; ?>" value="unknow" class="input radio">
                                <label for="<?php echo $post->post_name; ?>-unknow" class="label title">
                                    Don't know
                                </label>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo get_permalink($post->ID); ?>"
                        class="link button blue-button <?php echo !$j ? 'tutorial__item fifth tutorial--bd-main' : ''; ?>">
                        <span class="button-text button-text--lighter">
                                    <?php echo ($rlgh_data['quest_sec_btn_text'] == "") ? "🎥 Watch Video 🎥" : $rlgh_data['quest_sec_btn_text']; ?>
                        </span>
                    </a>
                </div>
                        <?php
                        $i++;
                        $j++;
                    endif;

                    // Showing Tunnel Form Blocks after each 5th strategy question
                    if ($j % 5 == 0) {
                        if (count($main_theme_tunnel_questions) > $k) {
                            echo $main_theme_tunnel_questions[$k];
                            $k++;
                        }
                    }
                endforeach;

                // Showing all remaining tunnel questions if there are any left
                
                for ($k; $k < count($main_theme_tunnel_questions); $k++) {
                    echo $main_theme_tunnel_questions[$k];
                }

                ?>
            </div>
        </div>
        <?php
        if (!empty($cat_meta['themes'])):
            $main_theme_tunnel_questions_cards = array();
            $temp_data = '';
            $j = 0;
            foreach ($cat_meta['themes'] as $theme):
                if ($theme == 'none') {
                    continue;
                }

                $theme_data = get_category($theme);
                $theme_meta = get_option('category_' . $theme);
                // Saving all tunnels form blocks in array
                $temp_data = '';
                $real_cards = ' hide_cards';
                $isQuestionaire = ($theme_meta["questionaire_title"] == "") ? "false" : "true";
                $youtube_thumb = $theme_meta['img'];

                $temp_data .= '<div class="que-list-box width-33 tunnel-card' . $real_cards . '" data-index="' . $j . '" data-id="' . $theme_data->term_id . '" data-post="' . $theme_data->slug . '" data-questionaire="' . $isQuestionaire . '" >';
                $temp_data .= '<div class="is-like"></div>';
                $temp_data .= '<div class="que-list-inner">';
                $temp_data .= '<div class="que-img-que">';

                $temp_data .= '<div id="que-img-' . $theme_data->term_id . '" class="que-img ' . $j . '" dataid="' . $theme_data->term_id . '" datayoutube="' . apply_filters('youtube_url', $theme_meta['youtube']) . '">';
                $temp_data .= '<figure>';
                $temp_data .= '<img src="' . $youtube_thumb . '">';
                $temp_data .= '</figure>';
                $temp_data .= '</div>';

                $temp_data .= '<div id="que-video-' . $theme_data->term_id . '" class="que-video iframe-placeholder" >';
                $temp_data .= '<div class="que-video-close" id="que-video-close-' . $theme_data->term_id . '" dataid="' . $theme_data->term_id . '"><i class="icon realgh-close"></i></div>';
                $temp_data .= '<iframe class="que-video-player" id="que-video-player-' . $theme_data->term_id . '" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                $temp_data .= '</div>';

                $temp_data .= '<div id="que-question-' . $theme_data->term_id . '" class="question questionClick" dataid="' . $theme_data->term_id . '" datatitle="' . get_cat_name($theme_data->term_id) . '" data-question="' . $theme_meta['question'] . '" datayoutube="' . apply_filters('youtube_url', $theme_meta['youtube']) . '" data-categoryUrl="' . get_category_link($theme_data->term_id) . '" >';
                $temp_data .= '<h2>';
                $temp_data .= $theme_meta['question'];
                $temp_data .= '</h2>';
                $temp_data .= '<img class="info-vector" src="' . get_template_directory_uri() . '/assets/img/category-page-icons/info-vector.svg' . '" />';
                $temp_data .= '<div style="display: none;" class="card-description" id="data_text_' . $theme_data->term_id . '">' . category_description($theme_data->term_id) . '</div>';
                $temp_data .= '</div>';
                $temp_data .= '<div id="que-play-' . $theme_data->term_id . '" class="play-btn" dataid="' . $theme_data->term_id . '" datayoutube="' . apply_filters('youtube_url', $theme_meta['youtube']) . '">';
                $temp_data .= '<figure>';
                $temp_data .= '<img src="' . get_template_directory_uri() . '/assets/img/category-page-icons/small-play-btn.png">';
                $temp_data .= '</figure>';
                $temp_data .= '</div>';
                $temp_data .= '</div>';
                $temp_data .= '</div>';
                $temp_data .= '</div>';

                $i++;
                array_push($main_theme_tunnel_questions_cards, $temp_data);
            endforeach;

            ?>


        <div id="cp-category-suggestion-wrap" class="cp-category-suggestion-wrap">
            <div class="cp-logo-wrap">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/yes-card-pic.png'; ?>"
                    width="100%">
            </div>
            <div class="cp-category-suggestion">
                <div class="cp-category-suggestion-inner">
                    <h2 class="cp-category-suggetion-title">
                        Based on your answer, we recomend that you look at the strategies for <span
                            id="cp-sugeestion-new-category">New category</span> as
                        this may help you with <span id="cp-sugeestion-current-category">current
                            category</span>
                    </h2>
                    <h5 class="cp-category-suggetion-subtitle">Would you like to review strategies for</h5>
                    <a href="#" type="button" class="button button--big yellow-button"
                        id="cp-sugeestion-new-category-button">
                        <span class="button-text" id="cp-sugeestion-new-category-button-text">
                            New Category
                        </span>
                    </a>
                    <h5 class="cp-category-suggetion-subtitle">
                        <span>or</span>
                        Continue with
                    </h5>
                    <button type="button" class="button button--big yellow-button"
                        id="cp-sugeestion-current-category-button">
                        <span class="button-text" id="cp-sugeestion-current-category-button-text">
                            Current Category
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div id="cp-category-test-wrap" class="cp-category-suggestion-wrap">
            <div class="cp-logo-wrap">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/questionaire-bg.png'; ?>"
                    width="100%">
            </div>
            <div class="cp-category-suggestion">
                <div class="cp-category-suggestion-inner">
                    <h2 class="cp-category-suggetion-title">
                        Would you like to complete a questionaire to determine if <span id="cp-test-new-category-text"
                            class="blue-block-text">New category Text</span>
                    </h2>
                    <a href="#" type="button" class="button button--big yellow-button" id="cp-test-new-category-button">
                        <span class="button-text" id="cp-category-test-button-text">
                            Take The Test
                        </span>
                    </a>
                    <h5 class="cp-category-suggetion-subtitle">
                        <span>or</span>
                        Continue with
                    </h5>
                    <button type="button" class="button button--big yellow-button" id="cp-test-current-category-button">
                        <span class="button-text" id="cp-sugeestion-current-category-button-text">
                                <?php echo $cat_name; ?>
                        </span>
                    </button>
                </div>
            </div>
        </div>
            <?php
        endif;

        $wellbeing_first_post_id = 0;
        $lesson_exist = true;
        if ($lesson_exist) {
            $numItemsofCards = count($cat_meta['themes']) + count(get_posts(array('category' => $cat_data->term_id, 'nopaging' => true)));
            ?>
        <section id="que_list_sec" class="que-list-sec" data-category="<?php single_cat_title() ?>">
            <div class="tq-progress-bar-wrap cards-progress-bar">
                <div class="tq-progress-bar">
                    <div class="tq-progress-bar-inner tq-progress-bar-blue"
                        style="width: <?php echo (1 / $numItemsofCards) * 100 . '%' ?>"></div>
                </div>
                <div class="tq-progress-bar-content">
                    <h2 class="title">
                        <span class="tq-progress-card-no col-blue">1</span> / <span class="tq-progress-total-cards">
                                <?php echo $numItemsofCards; ?>
                        </span>
                    </h2>
                </div>
                <div class="skip-btn-container">
                    <a class="title no-text-decore js-skip-cards" href="#"
                        data-target="show_finished_category_info_from_que_list_box" data-type='section_redirect'>
                        <span class="col-blue">Skip All</span>
                    </a>
                </div>
            </div>
            <div id="que-list-main" class="que-list-main d-flex flex-wrap">
                    <?php
                    $posts = get_posts(array('category' => $cat_data->term_id, 'nopaging' => true));
                    $posts = array_reverse($posts);
                    $j = 0;
                    $k = 0;
                    $real_key = -1;
                    foreach ($posts as $key => $post):
                        if (get_post_meta($post->ID, 'wellbeing_lesson_question', true)):
                            $real_key++;
                            $tabs_arr = ['strategy', 'other'];
                            $p = 0;
                            $wellbeing_exercise_title = '';
                            $wellbeing_exercise_text = '';
                            $wellbeing_exercise_youtube_link = '';
                            $wellbeing_exercise_youtube_thumb = '';

                            if ($real_key == 0) {
                                $wellbeing_first_post_id = $post->ID;
                            }

                            $other_list = '';
                            foreach ($tabs_arr as $tab) {
                                $p++;

                                $tabs_content = get_post_meta($post->ID, 'wellbeing_re_' . $tab . '_list', true);
                                if (!$tabs_content) {
                                    continue;
                                }

                                foreach ($tabs_content as $content) {
                                    if ($p == 1) {
                                        $wellbeing_exercise_title = $content['wellbeing_exercise_title'];
                                        $wellbeing_exercise_text = nl2br($content['wellbeing_exercise_text']);
                                        $wellbeing_exercise_youtube_link = apply_filters('youtube_url', $content['wellbeing_exercise_youtube_link']);
                                        $wellbeing_exercise_youtube_thumb = $content['wellbeing_exercise_youtube_link'];
                                    }else{
                                        $youtube_thumb = 'https://i.ytimg.com/vi/' . get_youtube_id($content['wellbeing_exercise_youtube_link']) . '/maxresdefault.jpg';
                                        $youtube_video = apply_filters('youtube_url', $content['wellbeing_exercise_youtube_link']);

                                        $other_list .= '<li>';
                                        $other_list .= '<div class="other-resource-img" dataindex="' . $p . '" dataid="' . $post->ID . '" datayoutube="' . $youtube_video . '" title="' . $content['wellbeing_exercise_title'] . '">';
                                        $other_list .= '<figure>';
                                        $other_list .= '<img class="other_resource_video" src="' . $youtube_thumb . '" dataindex="' . $p . '" dataid="' . $post->ID . '" datayoutube="' . $youtube_video . '" title="' . $content['wellbeing_exercise_title'] . '" width="110" height="110">';
                                        $other_list .= '</figure>';
                                        $other_list .= '</div>';

                                        $other_list .= '<div style="display: none;" id="data_other_resource_' . $p . '_' . $post->ID . '">';
                                        $other_list .= nl2br($content['wellbeing_exercise_text']);
                                        $other_list .= '</div>';

                                        $other_list .= '</li>';
                                    }

                                    $p++;
                                }

                            }

                            $cond_list = '';
                            $condition_list = get_post_meta($post->ID, 'wellbeing_re_links_list', true);
                            if ($condition_list) {
                                foreach ($condition_list as $condition) {
                                    foreach ($condition as $key_c => $value_c) {
                                        if ($value_c['enabled']) {
                                            if ($key_c == 'conditinal_posts') {
                                                $cond_list .= '<li>';
                                                $cond_list .= '<a href="' . get_permalink($value_c['wellbeing_link_post']) . '" class="link text text--fw-500 text--c-black">';
                                                $cond_list .= get_post_meta($value_c['wellbeing_link_post'], 'wellbeing_lesson_question', true);
                                                $cond_list .= '</a>';
                                                $cond_list .= '</li>';
                                            } else {
                                                $cat_data = get_category_by_slug($value_c['wellbeing_link_category']);
                                                $cat_meta = get_option('category_' . $cat_data->term_id);

                                                $cond_list .= '<li>';
                                                $cond_list .= '<a href="' . get_category_link($cat_data->term_id) . '" class="link text text--fw-500 text--c-black">';
                                                $cond_list .= $cat_meta['question'];
                                                $cond_list .= '</a>';
                                                $cond_list .= '</li>';
                                            }
                                        }
                                    }
                                }
                            }

                            $htmlque = '';
                            $real_key_p = $real_key == 0 ? 'current-que' : '';
                            $real_key_img = $real_key == 0 ? 'current-que-img' : '';
                            $real_key_play = $real_key == 0 ? 'current-que-play' : '';
                            $real_cards = $real_key < 3 ? ' show_cards' : ' hide_cards';

                            $img_thumb = get_the_post_thumbnail_url($post->ID);
                            $youtube_thumb = 'https://i.ytimg.com/vi/' . get_youtube_id($wellbeing_exercise_youtube_thumb) . '/maxresdefault.jpg';

                            $htmlque .= '<div class="que-list-box width-33 ' . $real_key_p . $real_cards . '" data-index="' . $j . '" data-id="' . $post->ID . '" data-post="' . $post->post_name . '">';
                            $htmlque .= '<div class="is-like"></div>';
                            $htmlque .= '<div class="que-list-inner">';
                            $htmlque .= '<div class="que-img-que">';

                            $htmlque .= '<div id="que-img-' . $post->ID . '" class="que-img ' . $real_key_img . '" dataid="' . $post->ID . '" datayoutube="' . $wellbeing_exercise_youtube_link . '">';
                            $htmlque .= '<figure>';
                            $htmlque .= '<img src="' . $youtube_thumb . '">';
                            $htmlque .= '</figure>';
                            $htmlque .= '</div>';

                            $htmlque .= '<div id="que-video-' . $post->ID . '" class="que-video iframe-placeholder" >';
                            $htmlque .= '<div class="que-video-close" id="que-video-close-' . $post->ID . '" dataid="' . $post->ID . '"><i class="icon realgh-close"></i></div>';
                            $htmlque .= '<iframe class="que-video-player" id="que-video-player-' . $post->ID . '" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                            $htmlque .= '</div>';

                            $htmlque .= '<div id="que-question-' . $post->ID . '" class="question questionclick" dataid="' . $post->ID . '" datatitle="' . $wellbeing_exercise_title . '" datayoutube="' . $wellbeing_exercise_youtube_link . '">';
                            $htmlque .= '<h2 data-postlink="' . get_permalink($post->ID) . '?show_exercise_screen=true' . '">';
                            $htmlque .= get_post_meta($post->ID, 'wellbeing_lesson_title', true);
                            $htmlque .= '</h2>';
                            $htmlque .= '<img class="info-vector" src="' . get_template_directory_uri() . '/assets/img/category-page-icons/info-vector.svg' . '" />';
                            $htmlque .= '<div style="display: none;" id="data_text_' . $post->ID . '">' . $wellbeing_exercise_text . '</div>';
                            $htmlque .= '<div style="display: none;" id="data_list_' . $post->ID . '">' . $cond_list . '</div>';
                            $htmlque .= '<div style="display: none;" id="data_other_' . $post->ID . '">' . $other_list . '</div>';

                            if (get_post_meta($post->ID, 'wellbeing_exercise_text', true) !== "") {
                                $htmlque .= '<div style="display: none;" class="sc-ui-post-exerices-content">
                                                            <h2 class="sc-ui-post-exerices-title title">
                                                                ' . get_post_meta($post->ID, 'wellbeing_exercise_text', true) . '
                                                            </h2>
                                                            <p class="sc-ui-post-exerices-description text">
                                                                ' . get_post_meta($post->ID, 'wellbeing_exercise_description', true) . '
                                                            </p>
                                                            <p class="sc-ui-post-exerices-template text">
                                                                ' . get_post_meta($post->ID, 'wellbeing_exercise_template', true) . '
                                                            </p>
                                                        </div>';
                            }

                            $htmlque .= '</div>';
                            $htmlque .= '<div id="que-play-' . $post->ID . '" class="play-btn ' . $real_key_play . '" dataid="' . $post->ID . '" datayoutube="' . $wellbeing_exercise_youtube_link . '">';
                            $htmlque .= '<figure>';
                            $htmlque .= '<img src="' . get_template_directory_uri() . '/assets/img/category-page-icons/small-play-btn.png">';
                            $htmlque .= '</figure>';
                            $htmlque .= '</div>';
                            $htmlque .= '</div>';
                            $htmlque .= '</div>';
                            $htmlque .= '</div>';

                            echo $htmlque;

                            $i++;
                            $j++;
                        endif;

                        // Showing Tunnel Form Blocks after each 5th strategy question
                        if ($j % 5 == 0) {
                            if (array_key_exists($k, $main_theme_tunnel_questions_cards)) {
                                echo $main_theme_tunnel_questions_cards[$k];
                                $k++;
                            }
                        }
                    endforeach;
                    // Showing all remaining tunnel questions if there are any left
                    if (count($main_theme_tunnel_questions_cards) >= $k) {
                        for ($k; $k < count($main_theme_tunnel_questions_cards); $k++) {
                            echo $main_theme_tunnel_questions_cards[$k];
                        }
                    }
                    ?>
            </div>
            <div class="multi-btn">
                <ul>
                    <li id="current_back_btn" class="back-btn">
                        <div class="multi-btn-list">
                            <figure>
                                <img
                                    src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/back-btn.png'; ?>">
                            </figure>
                        </div>
                    </li>
                    <li class="no-swipe-left">
                        <div class="multi-btn-list box-shadow-btn">
                            <h2 class="title">NO</h2>
                        </div>
                    </li>
                    <li class="idk-swipe-up">
                        <div class="multi-btn-list box-shadow-btn">
                            <figure>
                                <img
                                    src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/idk-btn.svg'; ?>">
                            </figure>
                        </div>
                    </li>
                    <li class="yes-swipe-right">
                        <div class="multi-btn-list box-shadow-btn">
                            <h2 class="title">YES</h2>
                        </div>
                    </li>
                    <li id="current_save_profile" data-lesson="" class="save-btn current_save_profile"
                        title="Strategy will be saved in My Progress">
                        <div class="multi-btn-list">
                            <figure>
                                <img id="current_save_profile_btn"
                                    src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/save-btn.svg'; ?>">
                            </figure>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
            <?php
        }
        ?>


        <div id="finished_info" class="finished_info" style="display:<?php if ($lesson_exist) {
            echo 'none';
        } else {
            echo '';
        } ?>;">
            <div class="finished-info-inner">
                <div class="cp-logo-wrap">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/congrats-pic.png'; ?>"
                        width="100%">
                </div>
                <div class="text block--mb-main my-strategies__content finished-info-inner-content">
                    <h2 class="finished-info-inner-content-title">
                        Congratulation, you have finished the questions for
                        <?php echo $cat_name; ?>
                    </h2>
                    <p class="finished-info-inner-content-subtitle">From here you can:</p>
                    <p class="text">
                        <a href="<?php echo home_url("my-progress"); ?>" class="button yellow-button">
                            <span class="button-text button-text--lighter">Choose A New Category</span>
                        </a>
                    </p>
                    <p class="text">
                        <a href="<?php echo home_url('my-progress'); ?>" class="button yellow-button">
                            <span class="button-text button-text--lighter">Check Out Your Saved
                                Strategies</span>
                        </a>
                    </p>
                    <p class="text">
                        <a href="#" class="button yellow-button js-hide-finished-and-show-set-reminder-screen">
                            <span class="button-text button-text--lighter">Set Reminders for your saved
                                Strategies</span>
                        </a>
                    </p>
                    <p class="text">
                        <a href="<?php echo home_url('my-progress'); ?>" class="button yellow-button">
                            <span class="button-text button-text--lighter">Review Recomended Strategies</span>
                        </a>
                    </p>
                    <p class="text">
                        <a href="#" class="button yellow-button js_clear_saved_lessons">
                            <span class="button-text button-text--lighter">Complete <b>
                                    <?php echo $cat_name; ?>
                                </b> Category One More Time</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>


        <button id="tunnel__button2" type="button" class="button tunnel__button tunnel__button2 button--big" style="display:<?php if ($lesson_exist) {
            echo '';
        } else {
            echo 'none';
        } ?>;" disabled>
            <span class="button-text">
                <?php echo ($rlgh_data['save_btn_text'] == "") ? "FINISH" : $rlgh_data['save_btn_text']; ?>

            </span>
        </button>
    </div>
</form>


<script>
    var htmlque_first_post_id = '<?php echo $wellbeing_first_post_id; ?>';
</script>

<!-- Remider screen for saved strategies starts here-->
<?php
get_template_part('partials/reminder-buttons-for-saved-strategies-template');
?>
<!-- Remider screen for saved strategies ends here-->