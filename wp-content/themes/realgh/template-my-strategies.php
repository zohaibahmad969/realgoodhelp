<?php
/*
 * Template name: Template My Strategies
 */


get_header();

if( 1 !== 1){
    // Hiding some content for now
    get_template_part('parts/themes', 'popup');
}
$prefix = 'wellbeing_';
global $wpdb;
$user_id = get_current_user_id();

?>

<main class="main main--with-header wellbeing-homepage my-strategies wellbeing-my-strategies">
    <div class="single-main-content">
        <div class="wellbeing-homepage pos-relative">
        <?php
            if( 1 !== 1){
                // Hiding some content for now
        ?>
            <!-- START THEMES/CATEGORIES -->
            <template id="theme-temp">
                <div class="readmore theme__readmore">
                    <div class="card theme__cover">
                        <img src="" alt="theme" class="img bg-block">
                        <div class="tint bg-block show-readmore-content"></div>
                        <h5 class="subtitle text--c-light theme__name show-readmore-content"></h5>
                        <div class="theme-action-btns">
                            <button class="button transp-button remove_theme__button">
                                <i class="icon realgh-close"></i>
                            </button>
                            <button class="button transp-button readmore__button show-readmore-content">
                                <i class="icon realgh-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card theme__more">
                        <div class="za-theme-more-inner">
                            <div class="za-theme-more-inner-sub">
                                <h2 class="title za-theme-more-title">Set your goal</h2>
                                <div class="za-count-box-wrap">
                                    <div class="za-count-box">
                                        <div class="za-counter-minus"><img
                                                src="<?php echo get_template_directory_uri() . '/assets/img/icons/realgh-minus.png'; ?>">
                                        </div>
                                        <h2 class="title col-white za-counter-box-count">0</h2>
                                        <div class="za-counter-add"><img
                                                src="<?php echo get_template_directory_uri() . '/assets/img/icons/realgh-plus.png'; ?>">
                                        </div>
                                    </div>
                                    <div class="za-count-box-wrap">
                                        <div class="za-count-box">
                                            <div class="za-counter-minus"><img
                                                    src="<?php echo get_template_directory_uri() . '/assets/img/icons/realgh-minus.png'; ?>">
                                            </div>
                                            <h2 class="title col-white za-counter-box-count">0</h2>
                                            <div class="za-counter-add"><img
                                                    src="<?php echo get_template_directory_uri() . '/assets/img/icons/realgh-plus.png'; ?>">
                                            </div>
                                        </div>
                                        <h2 class="title col-blue">Strategies to save</h2>
                                    </div>
                                </div>
                                <h2 class="title za-flex-separator">and</h2>
                                <a href="" class="link button blue-button za-theme-more-btn">
                                    <span class="button-text button-text--lighter">
                                        <?php echo get_post_meta(get_the_ID(), $prefix . 'more_link_text', true); ?>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <section class="section current padd-20-20">
                <h2 class="title text--head">
                    <?php echo get_post_meta(get_the_ID(), $prefix . 'current_title', true); ?>
                    <button data-step="second" data-popup="themes"
                        class="button btn-add-theme js-popup tutorial__item first animate tutorial--bd-bg js-show-theme-popup">
                        <i class="icon realgh-plus"></i> Add Category
                    </button>
                </h2>
                <div class="za-goals-content block--hidden">
                    <div class="za-goals-content-inner">
                        <h2 class="title">
                            <?php echo get_post_meta(get_the_ID(), 'wellbeing_empty_goals_title', true); ?>
                        </h2>
                        <p class="text">
                            <?php echo get_post_meta(get_the_ID(), 'wellbeing_empty_goals_text', true); ?>
                        </p>
                    </div>
                </div>
                <div class="theme__cards"></div>
            </section>
            <!-- END THEMES/CATEGORIES -->

            <!-- START SUGGESSTIONS -->
            <section class="section suggestion block--hidden padd-20-20">
                <h2 class="title text--head">
                    <?php echo get_post_meta(get_the_ID(), $prefix . 'suggest_title', true); ?>
                </h2>
                <div class="theme__cards"></div>
            </section>
            <!-- END SUGGESSTIONS -->


            <!-- START STRATEGIES -->
            <div class="lesson__header p-t-20">
                <h1 class="title lesson__title">
                    <!-- <?php the_title(); ?> -->
                    Saved Strategies
                </h1>
            </div>
            <section data-page="<?php echo get_the_ID(); ?>" class="my-strategies__content padd-20-20"></section>
            <!-- END STRATEGIES -->
        
        <?php
            }
        ?>

            <!-- START TESTS -->
            <div class="lesson__header p-t-20">
                <h1 class="title lesson__title">
                    <span>Test Results</span>
                    <button class="button btn-take-test tutorial__item first animate tutorial--bd-bg">
                        <i class="icon realgh-plus"></i> Take a Test
                    </button>
                </h1>
            </div>
            <div data-page="<?php echo get_the_ID(); ?>" class="questionaire-test-results">
                <div class="za-flex-box-column q-tr-no-results">
                    <h2 class="title">No results. </h2>
                    <p class="text">Please take a test to see results. </p>
                </div>
                <div class="q-tr-items">
                    <template id="temp_testResult">
                        <div class="q-tr-item-wrap">
                            <h2 class="title q-tr-item-date text-center">00/00/0000</h2>
                            <div class="q-tr-item q-tr-id-6 js-show-results-screen">
                                <div class="q-tr-item-header">
                                    <img class="q-tr-image"
                                        src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/tr-header-image.png'; ?>"
                                        width="100%">
                                    <h2 class="title q-tr-title">Test</h2>
                                </div>
                                <div class="q-tr-item-content">
                                    <img class="q-tr-image q-tr-result-image" src="" width="140px">
                                    <h2 class="title q-tr-test-result-wrap">Your Score: <span
                                            class="q-tr-test-result">00/00</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <!-- END TESTS -->

            <!-- START EXERCISES -->
            <div class="lesson__header p-t-20">
                <h1 class="title lesson__title">
                    <span>Exercises</span>
                </h1>
            </div>
            <div data-page="<?php echo get_the_ID(); ?>" class="exercise-items-wrap">
                <div class="za-flex-box-column initial-default-text">
                    <h2 class="title">No saved exercise. </h2>
                    <p class="text">Please start an exercise from the strategies</p>
                </div>
                <div class="exercise-items">

                </div>
            </div>
            <!-- END EXERCISES -->

            <!-- START REMINDERS -->
            <?php $reminders = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reminders rm WHERE rm.user_id = $user_id ORDER BY rm.post_id"); ?>
            <div class="lesson__header p-t-20">
                <h2 class="title lesson__title">
                    Reminders
                </h2>
            </div>

            <?php if (!$reminders): ?>
                <div class="za-flex-box-column">
                    <p class="title">No reminders</p>
                    <p class="text">Go to one of the strategies and set a reminder for it</p>
                </div>
                <?php
            else:
                $user_data = $wpdb->get_row("SELECT ud.time_zone FROM {$wpdb->prefix}users_data ud WHERE ud.user_id = $user_id");
                $current_post = $reminders[0]->post_id;
                ?>
                <div class="theme__cards">
                    <a href="<?php echo get_home_url() . '/reminder/?post_id=' . $current_post; ?>"
                        class="link reminder__card js-show-reminderpage-btn">
                        <p class="title reminder-card__title">
                            <?php echo get_the_title($current_post); ?>
                        </p>
                        <div class="reminder-card__body">
                            <?php
                            foreach ($reminders as $reminder):

                                $rem_time = new DateTime($reminder->next_reminder . $reminder->reminder_time, new DateTimeZone(date_default_timezone_get()));
                                $rem_time->setTimezone(new DateTimeZone($user_data->time_zone));

                                if ($reminder->post_id != $current_post):
                                    $current_post = $reminder->post_id;
                                    ?>
                                </div>
                            </a>
                            <a href="<?php echo get_home_url() . '/reminder/?post_id=' . $current_post; ?>"
                                class="link reminder__card js-show-reminderpage-btn">
                                <p class="title reminder-card__title">
                                    <?php echo get_the_title($current_post); ?>
                                </p>
                                <div class="reminder-card__body">
                                <?php endif; ?>

                                <div class="reminder-card__row">
                                    <div class="reminder-card__cell">
                                        <i class="icon realgh-date c-main"></i>
                                        <p class="text">
                                            <?php echo $rem_time->format('Y-m-d'); ?>
                                        </p>
                                    </div>
                                    <div class="reminder-card__cell">
                                        <i class="icon realgh-time c-main"></i>
                                        <p class="text">
                                            <?php echo $rem_time->format('H:i'); ?>
                                        </p>
                                    </div>
                                    <div class="reminder-card__cell">
                                        <i class="icon realgh-repeat c-main"></i>
                                        <p class="text">
                                            <?php echo $reminder->days_interval; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <!-- END REMINDERS -->
        </div>
    </div>



    <!-- Test Cards Animation starts here -->
    <div class="sc-ui-design sc-ui-screen-second" id="sc-ui-testsquests-all-wrap">
        <div class="tq-progress-bar-wrap sc-cards-progress-bar">
            <div class="tq-progress-bar">
                <?php
                $categories = get_categories();
                $numItemsofSCCards = 0; foreach ($categories as $theme) {
                    $theme_meta = get_option('category_' . $theme->term_id);
                    if (!empty($theme_meta['questionaire_title'])) {
                        $numItemsofSCCards++;
                    }
                }
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
            <div class="skip-btn-container">
                <a class="title no-text-decore js-skip-cards" href="#" data-target="show_my_progress_main_page" data-type='section_redirect'>
                    <span class="col-blue">Skip All</span>
                </a>
            </div>
        </div>
        <div class="sc-ui-quests-cards-wrap" id="sc-ui-quests-cards-wrap">
            <?php
            $categories = get_categories();
            $temp_data = "";
            $real_key = -1;
            $post_count = 0;
            foreach ($categories as $category) {
                $theme_meta = get_option('category_' . $category->term_id);
                if (!empty($theme_meta['questionaire_title'])) {
                    // echo var_dump($category);
                    $real_key++;
                    $current_card = ($real_key == 0) ? 'sc-current-card' : '';
                    $real_cards = $real_key < 3 ? ' sc-show-cards' : ' sc-hide-cards';
                    $cat_meta = get_option('category_' . $category->cat_ID);
                    ?>
                    
                    <div class="sc-ui-quests-card <?php echo $current_card . ' ' . $real_cards ?>"
                        dataid="<?php echo $real_key; ?>" data-postid="<?php echo $category->cat_ID; ?>"
                        data-category="<?php echo $category->slug; ?>">
                        <div class="is-like"></div>
                        <div class="sc-ui-card-img-wrap">
                            <img class="sc-ui-card-image" src="<?php echo $theme_meta['questionaire_test_image']; ?>"
                                alt="<?php echo $theme_meta['questionaire_test_image']; ?>" width="100%">
                        </div>
                        <div class="sc-ui-card-quest-content">
                            <h2 class="sc-ui-card-quest">
                                <?php echo $category->name . ' Test' ?>
                            </h2>
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
    <!-- Test Cards Animation starts here -->


</main>


<?php get_footer(); ?>