<?php
/*
 * Category page
 */
$cat_data = get_queried_object();
$cat_meta = get_option('category_' . $cat_data->term_id);
$cat_name = $cat_data->name;
$subcategories = get_term_children($cat_data->term_id, 'category');

get_header();

get_template_part('parts/success', 'popup');

get_template_part(
    'parts/video',
    'popup',
    array(
        'classes' => 'tunnel-video__popup',
        'video' => $cat_meta['youtube'],
    )
);
?>

<div class="frame">

</div>
<main class="main--with-header js-padding wellbeing-category-page <?php echo (isset($_GET['questionaire']) && $_GET['questionaire'] == "true") ? "show-questionaire-test" : "";
echo (isset($_GET['show_results']) && $_GET['show_results'] !== "") ? " show-test-results" : ""; ?>"
    id="za_category_page" data-categoryId="<?php echo $cat_data->term_id ?>" data-category="<?php single_cat_title() ?>"
    data-categorySlug="<?php echo $cat_data->slug; ?>">
    <div id="za_cards_tutorial" class="za-cards-tutorial">
        <div class="za-cards-tutorial-overlay">

        </div>
        <div class="za-cards-tutorial-inner">
            <div class="za-cards-tutorial-item">
                <img
                    src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/hint-no.png'; ?>" />
            </div>
            <div class="za-cards-tutorial-item">
                <img
                    src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/hint-line1.png'; ?>" />
            </div>
            <div class="za-cards-tutorial-item">
                <img
                    src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/hint-yes.png'; ?>" />
            </div>
        </div>
    </div>
    <div class="tunnel <?php if (isset($_GET['tutorial'])) {
        echo $_GET['tutorial'] ? 'tutorial' : '';
    } ?>">
        <div class="tunnel__header">
            <?php
            if (isset($_GET['questionaire']) && $_GET['questionaire'] !== "") {
                ?>
            <img src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/test-header-img.png'; ?>"
                class="img bg-block" />
            <?php
            } else {
                ?>
            <img src="<?php echo $cat_meta['img']; ?>" alt="<?php echo $cat_data->slug; ?>" class="img bg-block">
            <?php
            }
            ?>
            <div class="tint bg-block"></div>
            <div class="tunnel-header__left">
                <h4 class="title tunnel__title">
                    <?php echo $cat_data->name; ?>
                    <?php if (isset($_GET['questionaire']) && $_GET['questionaire'] == "true") {
                        echo 'Test';
                    } ?>
                </h4>
            </div>
            <div class="tunnel-header__right">
                <button data-popup="tunnel-video"
                    class="button transp-button tunnel__play-button js-popup js-video-play">
                    <i class="icon realgh-play"></i>
                </button>
                <button class="button grey-button tunnel__back-button js-back">
                    <i class="icon realgh-close"></i>
                </button>
                <button data-popup="menu" class="button menu-button js-popup cp-menu-button">
                    <span class="menu-button__h-line"></span>
                    <span class="menu-button__h-line"></span>
                    <span class="menu-button__h-line"></span>
                </button>
            </div>
        </div>

        <?php
        if(isset( $_GET['new_design']) && $_GET['new_design'] === 'true'){

            //  New Category Page Design starts here
            get_template_part('partials/category-page-design-new');
            //  New Category Page Design ends here

        }else{
            if (empty($subcategories)) {

                // Default Category Page Cards Design and old radio questions design starts here
                get_template_part('partials/category-page-cards-design-default');
                // Default Category Page Cards Design and old radio questions design starts here
    
            }else if (isset($_GET['questionaire']) && $_GET['questionaire'] === 'true') {
    
                // Category Test Questionaire Design starts here
                get_template_part('partials/category-test-questionaire');
                // Category Test Questionaire Design ends here
            }
        }
        ?>

    </div>


    <?php
    if (isset($_GET['new_design']) && $_GET['new_design'] === 'true') {

    } else {
        if (!empty($subcategories) && !isset($_GET['questionaire'])) {

            //  New Category With sub-category Design starts here
            get_template_part('partials/subcategory-cards-template');
            //  New Category With sub-category Design ends here
    
        }
    }
    ?>




    <!-- Exercises Design starts here -->
    <?php get_template_part('partials/category-page-exercises-design'); ?>
    <!-- Exercises Design ends here -->




</main>



<?php get_footer(); ?>

<div id="first_video" class="first_video">
    <div class="inner_body">
        <div class="first_profile_close"><i class="icon wellbeing-close"></i></div>
        <div class="inner_content">
            <iframe width="440" height="785" id="first_video_link" src="" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
</div>

<div id="finished_profile" class="finished_profile">
    <div class="inner_body">
        <div class="inner_content">
            Thank you
        </div>
        <div class="inner_content_text">
            Your network has been saved successfully.
            <br>
            <button class="finished_profile_close">OK</button>
        </div>
    </div>
</div>

<section class="popup_profile video-popup-new que-modal-popup">
    <div class="popup_profile__body">
        <div class="container">
            <div class="close-btn close-video-popup-new">
                <i class="icon realgh-close"></i>
            </div>
            <div class="que-popup-video-text d-flex">
                <div class="que-popup-video-left">
                    <div class="iframe-placeholder">
                        <iframe width="680" height="390" class="video" id="popup_category_video_link" src=""
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>

                    <h2 class="other-resource title desc-text">
                        Additional Rescources
                    </h2>
                    <ul id="data_other">

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
                        <h2 id="popup_category_title"></h2>
                        <p id="popup_category_text"></p>
                    </div>

                    <div id="other-resources" class="other-resources">
                        <div class="other-resource-btn">
                            <a href="#" class="za-blue-btn js-show-start-exercise-screen">
                                <span class="button-text">Start Exercise</span>
                            </a>
                            <a href="<?php echo get_home_url() . '/reminder/?post_id='; ?>"
                                class="link za-blue-btn js-start-reminder-btn js-show-reminderpage-btn">
                                <span class="button-text">Reminder</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>