<?php
$cat_data = get_queried_object();
$cat_meta = get_option('category_' . $cat_data->term_id);
$cat_name = $cat_data->name;
?>

<div id="sc-current-cards-info" class="sub-category-ui-design" data-cards-wrap="sc">
    <div class="sc-ui-design sc-ui-screen sc-ui-screen-first" style="display: flex;">
        <div class="sc-image-wrap">
            <img class="sc-que-image"
                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/ui_questions.png'; ?>"
                width="100%">
        </div>
        <div class="sc-content">
            <div class="sc-content-inner">
                <h2 class="sc-content-main-title title col-black m-b-15">
                    We will be asking you some questions to determine effective strategies to help you.
                </h2>
                <h2 class="sc-content-main-title title col-blue">
                    Are you ready?
                </h2>
                <a href="#" class="button button--big blue-button sc-ui-first-cont-btn">
                    <span class="button-text">
                        Lets Get Started
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="sc-ui-design sc-ui-screen-second" id="sc-ui-quests-all-wrap">
        <div class="tq-progress-bar-wrap sc-cards-progress-bar">
            <div class="tq-progress-bar">
                <?php
                $args = array('child_of' => $cat_data->term_id);
                $categories = get_categories($args);
                $numItemsofSCCards = count($categories);
                ?>
                <div class="tq-progress-bar-inner tq-progress-bar-blue"
                    style="width: <?php echo (1 / $numItemsofSCCards) * 100 . '%' ?>;"></div>
            </div>
            <div class="tq-progress-bar-content">
                <h2 class="title">
                    <span class="tq-progress-card-no col-blue">1</span> / <span class="tq-progress-total-cards">
                        <?php echo $numItemsofSCCards; ?>
                    </span>
                </h2>
            </div>
            <div class="skip-btn-container" style="display: none;">
                <a class="title no-text-decore js-skip-cards" href="#">
                    <span class="col-blue">Skip All</span>
                </a>
            </div>
        </div>
        <div class="sc-ui-quests-cards-wrap" id="sc-ui-quests-cards-wrap">
            <?php
            $args = array('child_of' => $cat_data->term_id);
            $categories = get_categories($args);
            $real_key = -1;
            foreach ($categories as $category) {
                $real_key++;
                $current_card = ($real_key == 0) ? 'sc-current-card' : '';
                $real_cards = $real_key < 3 ? ' sc-show-cards' : ' sc-hide-cards';
                $subcat_meta = get_option('category_' . $category->cat_ID);
                ?>
                <div class="sc-ui-quests-card <?php echo $current_card . ' ' . $real_cards ?>"
                    dataid="<?php echo $real_key; ?>" data-postid="<?php echo $category->cat_ID; ?>">
                    <div class="is-like"></div>
                    <div class="sc-ui-card-img-wrap">
                        <img class="sc-ui-card-image" src="<?php echo $subcat_meta['img']; ?>"
                            alt="<?php echo $subcat_meta['img']; ?>" width="100%">
                    </div>
                    <div class="sc-ui-card-quest-content">
                        <h2 class="sc-ui-card-quest">
                            <?php echo $category->name ?>
                        </h2>
                        <p class="sc-ui-card-quest-desc">
                            <?php echo $category->description ?>
                        </p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="multi-btn">
            <ul>
                <li id="sc_current_back_btn" class="sc-back-btn">
                    <div class="multi-btn-list">
                        <figure>
                            <img
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/back-btn.png'; ?>">
                        </figure>
                    </div>
                </li>
                <li class="sc-no-swipe-left">
                    <div class="multi-btn-list box-shadow-btn">
                        <h2 class="title">NO</h2>
                    </div>
                </li>
                <li class="sc-idk-swipe-up">
                    <div class="multi-btn-list box-shadow-btn">
                        <figure>
                            <img
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/idk-btn.svg'; ?>">
                        </figure>
                    </div>
                </li>
                <li class="sc-yes-swipe-right">
                    <div class="multi-btn-list box-shadow-btn">
                        <h2 class="title">YES</h2>
                    </div>
                </li>
                <li id="sc_current_save_profile" data-lesson="" class="save-btn sc_current_save_profile"
                    title="Strategy will be saved in My Progress">
                    <div class="multi-btn-list">
                        <figure>
                            <img id="sc_current_save_profile_btn"
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/save-btn.svg'; ?>">
                        </figure>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="sc-ui-design sc-ui-screen sc-ui-screen-third" style="display: none;">
        <div class="sc-image-wrap">
            <img class="sc-que-image"
                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/ui-show-strategies.png'; ?>"
                width="100%">
        </div>
        <div class="sc-content">
            <div class="sc-content-inner">
                <h2 class="sc-content-main-title title col-black m-b-15">
                    Based on your answers we recommend you work on
                </h2>
                <?php
                $args = array('child_of' => $cat_data->term_id);
                $categories = get_categories($args);
                foreach ($categories as $category) {
                    $subcat_meta = get_option('category_' . $category->cat_ID);
                    ?>
                    <a href="#"
                        class="button button--big blue-button sc-ui-sub-cat-btn cat-subpostbtn-<?php echo $category->cat_ID ?>"
                        data-subcat="<?php echo $subcat_meta['cat_short_name'] ?>"
                        data-subpostid="<?php echo $category->cat_ID ?>">
                        <span class="button-text">
                            <?php echo $subcat_meta['cat_short_name'] ?>
                        </span>
                    </a>
                    <?php
                }
                ?>
                <h2 class="sc-content-main-title title col-blue">
                    Please choose one to continue with
                </h2>
            </div>
        </div>
    </div>
    <div class="sc-ui-design sc-ui-screen sc-ui-screen-fourth" style="display: none;">
        <div class="sc-image-wrap">
            <img class="sc-que-image"
                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/ui_questions.png'; ?>"
                width="100%">
        </div>
        <div class="sc-content">
            <div class="sc-content-inner">
                <h2 class="sc-content-main-title title col-black m-b-15">
                    Here are some
                    <span class="sc-new-sub-category-strategies">___</span> strategies.
                </h2>
                <h2 class="sc-content-main-title title col-blue">
                    Please swipe <b>yes</b> to <br> the ones you want to <b>save.</b>
                </h2>
                <a href="#" class="button button--big blue-button sc-show-sub-cat-strategies">
                    <span class="button-text">
                        Continue
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="sc-ui-design sc-ui-screen-fifth" id="scs-ui-quests-all-wrap">
        <div class="tq-progress-bar-wrap sc-cards-progress-bar">
            <div class="tq-progress-bar">
                <div class="tq-progress-bar-inner tq-progress-bar-blue" style="width:100%"></div>
            </div>
            <div class="tq-progress-bar-content">
                <h2 class="title">
                    <span class="tq-progress-card-no col-blue">1</span> / <span class="tq-progress-total-cards">1</span>
                </h2>
            </div>
            <div class="skip-btn-container">
                <a class="title no-text-decore js-skip-cards" href="#" data-target="show_all_subcategory_btns"
                    data-type='section_redirect'>
                    <span class="col-blue">Skip All</span>
                </a>
            </div>
        </div>
        <div class="sc-ui-quests-cards-wrap scs-ui-quests-cards-wrap" id="scs-ui-quests-cards-wrap">
            <?php
            $args = array('child_of' => $cat_data->term_id);
            $subcats = get_categories($args);
            $real_key = -1;
            foreach ($subcats as $subcat) {
                $post_count = 0;
                $sub_args = array(
                    'posts_per_page' => -1,
                    'category' => $subcat->cat_ID,
                );
                $subcat_posts = get_posts($sub_args);
                foreach ($subcat_posts as $subcat_post) {
                    if (get_post_meta($subcat_post->ID, 'wellbeing_lesson_question', true)):
                        $wellbeing_exercise_title = '';
                        $wellbeing_exercise_text = '';
                        $wellbeing_exercise_youtube_link = '';
                        $wellbeing_exercise_youtube_thumb = '';
                        $tabs_arr = ['strategy', 'other'];
                        $p = 0;
                        $other_list = '';
                        foreach ($tabs_arr as $tab) {
                            $p++;

                            $tabs_content = get_post_meta($subcat_post->ID, 'wellbeing_re_' . $tab . '_list', true);
                            if (!$tabs_content) {
                                continue;
                            }
    
                            foreach ($tabs_content as $content) {
    
                                if ($p == 1) {
                                    $wellbeing_exercise_title = $content['wellbeing_exercise_title'];
                                    $wellbeing_exercise_text = nl2br($content['wellbeing_exercise_text']);
                                    $wellbeing_exercise_youtube_link = apply_filters('youtube_url', $content['wellbeing_exercise_youtube_link']);
                                    $wellbeing_exercise_youtube_thumb = $content['wellbeing_exercise_youtube_link'];
                                    $youtube_thumb = 'https://i.ytimg.com/vi/' . get_youtube_id($content['wellbeing_exercise_youtube_link']) . '/maxresdefault.jpg';
                                    $youtube_video = apply_filters('youtube_url', $content['wellbeing_exercise_youtube_link']);
                                }else{
                                    $youtube_thumb_other = 'https://i.ytimg.com/vi/' . get_youtube_id($content['wellbeing_exercise_youtube_link']) . '/maxresdefault.jpg';
                                    $youtube_video_other = apply_filters('youtube_url', $content['wellbeing_exercise_youtube_link']);
        
                                    $other_list .= '<li class="other-resource-data js-show-other-resourse" title="' . $content['wellbeing_exercise_title'] . '">';
                                    $other_list .= '<div class="other-resource-img" dataid="' . $subcat_post->ID . '" datayoutube="' . $youtube_video_other . '" >';
                                    $other_list .= '<figure>';
                                    $other_list .= '<img class="other_resource_video" src="' . $youtube_thumb_other . '" dataindex="' . $p . '" dataid="' . $subcat_post->ID . '" datayoutube="' . $youtube_video_other . '" title="' . $content['wellbeing_exercise_title'] . '" width="110" height="110">';
                                    $other_list .= '</figure>';
                                    $other_list .= '</div>';
        
                                    $other_list .= '<div style="display: none;" class="data_resource_description">';
                                    $other_list .= nl2br($content['wellbeing_exercise_text']);
                                    $other_list .= '</div>';
        
                                    $other_list .= '</li>';
                                }
    
                                $p++;
                            }
                        }
                    endif;
                    $post_count++;
                    $real_key++;
                    // $current_card = ($real_key == 0) ? 'sc-current-card' : '';
                    $real_cards = $real_key < 3 ? ' sc-show-cards' : ' sc-hide-cards';
                    ?>
                    <div class="sc-ui-quests-card <?php echo $real_cards ?>" dataid="<?php echo $real_key; ?>"
                        data-postid="<?php echo $subcat_post->ID ?>" data-mainpostid="<?php echo $subcat->cat_ID ?>"
                        data-postforthis_subcat="<?php echo $post_count ?>"
                        data-ytvideo="<?php echo $youtube_video; ?>">
                        <div class="is-like"></div>
                        <div class="sc-ui-card-img-wrap sc-ui-jsplay-video">
                            <img class="sc-ui-card-image" src="<?php echo $youtube_thumb; ?>" width="100%">
                            <div class="sc-ui-play-btn-wrap">
                                <figure><img
                                        src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/small-play-btn.png' ?>">
                                </figure>
                            </div>
                        </div>
                        <div class="sc-ui-card-video">
                            <div class="sc-ui-card-video-close-btn sc-ui-jsclose-video">
                                <i class="icon realgh-close"></i>
                            </div>
                            <iframe defer class="sc-ui-card-video-player video" src=""
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="" style="height: 100%;width:100%;" data-ga-disable></iframe>
                        </div>
                        <div class="sc-ui-card-quest-content">
                            <h2 class="sc-ui-card-quest"
                                data-permalink="<?php echo esc_url(get_permalink($subcat_post->ID)); ?>">
                                <?php echo get_post_meta($subcat_post->ID, 'wellbeing_lesson_title', true) ?>
                            </h2>
                            <img class="info-vector"
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/info-vector.svg'; ?>" />
                            <p class="sc-ui-card-quest-desc" style="display: none;">
                                <?php echo $wellbeing_exercise_text; ?>
                            </p>
                            <div style="display: none;" class="sc-ui-other-resources">
                                <?php echo $other_list; ?>
                            </div>
                            <?php
                            if (get_post_meta($subcat_post->ID, 'wellbeing_exercise_text', true) !== "") {
                                ?>
                                <div style="display: none;" class="sc-ui-post-exerices-content">
                                    <h2 class="sc-ui-post-exerices-title title">
                                        <?php echo get_post_meta($subcat_post->ID, 'wellbeing_exercise_text', true) ?>
                                    </h2>
                                    <p class="sc-ui-post-exerices-description text">
                                        <?php echo get_post_meta($subcat_post->ID, 'wellbeing_exercise_description', true) ?>
                                    </p>
                                    <p class="sc-ui-post-exerices-template text">
                                        <?php echo get_post_meta($subcat_post->ID, 'wellbeing_exercise_template', true) ?>
                                    </p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="multi-btn">
            <ul>
                <li id="sc_current_back_btn" class="sc-back-btn">
                    <div class="multi-btn-list">
                        <figure>
                            <img
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/back-btn.png'; ?>">
                        </figure>
                    </div>
                </li>
                <li class="sc-no-swipe-left">
                    <div class="multi-btn-list box-shadow-btn">
                        <h2 class="title">NO</h2>
                    </div>
                </li>
                <li class="sc-idk-swipe-up">
                    <div class="multi-btn-list box-shadow-btn">
                        <figure>
                            <img
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/idk-btn.svg'; ?>">
                        </figure>
                    </div>
                </li>
                <li class="sc-yes-swipe-right">
                    <div class="multi-btn-list box-shadow-btn">
                        <h2 class="title">YES</h2>
                    </div>
                </li>
                <li id="sc_current_save_profile" data-lesson="" class="save-btn sc_current_save_profile"
                    title="Strategy will be saved in My Progress">
                    <div class="multi-btn-list">
                        <figure>
                            <img id="sc_current_save_profile_btn" class="sc_current_save_profile_btn"
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/save-btn.svg'; ?>">
                        </figure>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="sc-ui-design sc-ui-screen-fifth-exercise-info">
        <div class="xp-exercise-invite-screen sc-ui-screen">

            <div class="sc-image-wrap">
                <img class="sc-que-image"
                    src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/exercise.png'; ?>"
                    width="100%">
            </div>
            <div class="sc-content">
                <div class="sc-content-inner">
                    <h2 class="sc-content-main-title title col-black m-b-15">
                        Please complete the exercises for your saved strategies
                    </h2>
                    <div class="sc-ui-strategies-btns">
                        <!-- Buttons will come from JS if user save some strategy -->
                    </div>
                    <button type="button"
                        class="button button--big yellow-button za-blue-transparent-btn cp-exercise-skip-btn"
                        id="cp-exercise-skip-btn">
                        <span class="button-text">
                            Skip
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Remider screen for saved strategies starts here-->
    <?php
    get_template_part('partials/reminder-buttons-for-saved-strategies-template');
    ?>
    <!-- Remider screen for saved strategies ends here-->

    <div class="sc-ui-design sc-ui-screen sc-ui-screen-sixth" style="display: none;">
        <div class="sc-image-wrap">
            <img class="sc-que-image"
                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/ui_questions.png'; ?>"
                width="100%">
        </div>
        <div class="sc-content">
            <div class="sc-content-inner">
                <h2 class="sc-content-main-title title col-black m-b-15">
                    Sometimes there might be a different issues that can help you with your goal.
                </h2>
                <h2 class="sc-content-main-title title col-blue">
                    Would you like to look at other areas that could help you with this?
                </h2>
                <a href="#" class="button button--big blue-button scs-show-tunnelquestions">
                    <span class="button-text">
                        Yes, take me there
                    </span>
                </a>
                <br>
                <a href="#" class="button button--big blue-button scs-finish-category">
                    <span class="button-text">
                        Finish category
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="sc-ui-design sc-ui-screen-seventh" id="sc-ui-tunnelquests-all-wrap">
        <div class="tq-progress-bar-wrap sc-cards-progress-bar">
            <div class="tq-progress-bar">
                <?php
                $numItemsofSCCards = count($cat_meta['themes']);
                ?>
                <div class="tq-progress-bar-inner tq-progress-bar-blue"
                    style="width: <?php echo (1 / $numItemsofSCCards) * 100 . '%' ?>;"></div>
            </div>
            <div class="tq-progress-bar-content">
                <h2 class="title">
                    <span class="tq-progress-card-no col-blue">1</span> / <span class="tq-progress-total-cards">
                        <?php echo $numItemsofSCCards; ?>
                    </span>
                </h2>
            </div>
            <div class="skip-btn-container" style="display: none;">
                <a class="title no-text-decore js-skip-cards" href="#" data-target="show_finished_category_info"
                    data-type='section_redirect'>
                    <span class="col-blue">Skip All</span>
                </a>
            </div>
        </div>
        <div class="sc-ui-quests-cards-wrap scs-ui-quests-cards-wrap" id="sc-ui-tunnelquests-cards-wrap">
            <?php
            if (!empty($cat_meta['themes'])):
                $temp_data = "";

                $real_key = -1;
                $post_count = 0;
                foreach ($cat_meta['themes'] as $theme) {
                    if ($theme == 'none') {
                        continue;
                    }

                    $theme_data = get_category($theme);
                    $theme_meta = get_option('category_' . $theme);

                    $post_count++;
                    $real_key++;

                    ?>
                    <div class="sc-ui-quests-card" dataid="<?php echo $real_key; ?>"
                        data-mainpostid="<?php echo $theme_data->term_id ?>" data-postforthis_subcat="<?php echo $post_count ?>"
                        data-category="<?php echo $theme_data->slug ?>"
                        data-ytvideo="<?php echo apply_filters('youtube_url', $theme_meta['youtube']); ?>">
                        <div class="is-like"></div>
                        <div class="sc-ui-card-img-wrap sc-ui-jsplay-video">
                            <img class="sc-ui-card-image" src="<?php echo $theme_meta['img']; ?>" width="100%">
                            <div class="sc-ui-play-btn-wrap">
                                <figure>
                                    <img
                                        src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/small-play-btn.png' ?>">
                                </figure>
                            </div>
                        </div>
                        <div class="sc-ui-card-video">
                            <div class="sc-ui-card-video-close-btn sc-ui-jsclose-video">
                                <i class="icon realgh-close"></i>
                            </div>
                            <iframe defer class="sc-ui-card-video-player"
                                src=""
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="" style="height: 100%;width:100%;" data-ga-disable></iframe>
                        </div>
                        <div class="sc-ui-card-quest-content">
                            <h2 class="sc-ui-card-quest">
                                <?php echo $theme_meta['question'] ?>
                            </h2>
                            <img class="info-vector"
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/info-vector.svg'; ?>" />
                            <div class="sc-ui-card-quest-desc" style="display:none">
                                <?php echo category_description($theme_data->term_id); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            endif;
            ?>
        </div>
        <div class="multi-btn">
            <ul>
                <li id="sc_current_back_btn" class="sc-back-btn">
                    <div class="multi-btn-list">
                        <figure>
                            <img
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/back-btn.png'; ?>">
                        </figure>
                    </div>
                </li>
                <li class="sc-no-swipe-left">
                    <div class="multi-btn-list box-shadow-btn">
                        <h2 class="title">NO</h2>
                    </div>
                </li>
                <li class="sc-idk-swipe-up">
                    <div class="multi-btn-list box-shadow-btn">
                        <figure>
                            <img
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/idk-btn.svg'; ?>">
                        </figure>
                    </div>
                </li>
                <li class="sc-yes-swipe-right">
                    <div class="multi-btn-list box-shadow-btn">
                        <h2 class="title">YES</h2>
                    </div>
                </li>
                <li id="sc_current_save_profile" data-lesson="" class="save-btn sc_current_save_profile"
                    title="Strategy will be saved in My Progress">
                    <div class="multi-btn-list">
                        <figure>
                            <img id="sc_current_save_profile_btn"
                                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/save-btn.svg'; ?>">
                        </figure>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="sc-ui-design sc-ui-screen sct-tunnel-all-buttons" id="sct-tunnel-all-buttons" style="display: none;">
        <div class="sc-image-wrap">
            <img class="sc-que-image"
                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/ui-show-strategies.png'; ?>"
                width="100%">
        </div>
        <div class="sc-content">
            <div class="sc-content-inner">
                <h2 class="sc-content-main-title title col-black m-b-15">
                    Based on your answers we recommend you work on
                </h2>
                <?php
                if (!empty($cat_meta['themes'])):
                    foreach ($cat_meta['themes'] as $theme) {
                        $theme_data = get_category($theme);
                        $theme_meta = get_option('category_' . $theme);
                        ?>
                        <a href="<?php echo get_category_link($theme_data->term_id) ?>"
                            class="button button--big blue-button sc-ui-tunnel-btn cat-tunnelbtn-<?php echo $theme_data->term_id ?>"
                            data-subpostid="<?php echo $theme_data->term_id ?>">
                            <span class="button-text">
                                <?php echo get_cat_name($theme_data->term_id) ?>
                            </span>
                        </a>
                        <?php
                    }
                endif;
                ?>
                <h2 class="sc-content-main-title title col-blue">
                    Please choose one to continue with
                </h2>
            </div>
        </div>
    </div>
    <div id="sct-category-test-wrap" class="cp-category-suggestion-wrap">
        <div class="cp-logo-wrap">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/questionaire-bg.png'; ?>"
                width="100%">
        </div>
        <div class="cp-category-suggestion">
            <div class="cp-category-suggestion-inner">
                <h2 class="cp-category-suggetion-title">
                    Would you like to complete a questionaire to determine if <span id="sct-test-new-category-text"
                        class="blue-block-text">New category Text</span>
                </h2>
                <a href="#" type="button" class="button button--big yellow-button" id="sct-test-new-category-button">
                    <span class="button-text" id="sct-category-test-button-text">
                        Take The Test
                    </span>
                </a>
                <h5 class="cp-category-suggetion-subtitle">
                    <span>or</span>
                    Continue with
                </h5>
                <button type="button" class="button button--big yellow-button" id="sct-test-current-category-button">
                    <span class="button-text" id="sct-sugeestion-current-category-button-text">
                        <?php echo $cat_name; ?>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div id="sc_finished_info" class="finished_info" style="display: none;">
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
                    <a href="<?php echo home_url('my-progress'); ?>" class="button yellow-button">
                        <span class="button-text button-text--lighter">Review Recomended Strategies</span>
                    </a>
                </p>
                <p class="text">
                    <a href="" class="button yellow-button">
                        <span class="button-text button-text--lighter">Complete <b>
                                <?php echo $cat_name; ?>
                            </b> Category One More Time</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>