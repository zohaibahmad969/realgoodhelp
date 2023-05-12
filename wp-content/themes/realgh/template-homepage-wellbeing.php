<?php
/*
 * Template name: Template homepage Wellbeing
 */

get_header();
// get_template_part('parts/top', 'page');
get_template_part('parts/themes', 'popup');
// get_template_part('parts/menuwellbeing', 'popup');
$prefix = 'wellbeing_';
?>

<main class="main homepage main--with-header main--with-top js-padding wellbeing-homepage">
    <div class="wellbeing-header wellbeing-homepage__header" style="display:none;">
        <a href="#" class="link logo">
            <img src="<?php echo $rlgh_data['logo']['url'] ?>" alt="Logo" class="svg">
        </a>
        <nav id="site-navigation" class="nav">
            <ul id="menu-main-menu" class="menu">
                <li id="menu-item-24" class="menu__item">
                    <a href="<?php echo get_site_url(); ?>" class="link text menu__link"><i
                            class="icon realgh-home"></i>Home</a>
                </li>
                <li id="menu-item-25" class="menu__item"><a href="#" class="link text menu__link"><i
                            class="icon realgh-strategies"></i>My strategies</a></li>
                <li id="menu-item-26" class="menu__item"><a href="#" class="link text menu__link"><i
                            class="icon realgh-past"></i>Past sessions</a></li>
                <li id="menu-item-27" class="menu__item"><a href="#" class="link text menu__link"><i
                            class="icon realgh-help"></i>Get help</a></li>
            </ul>
        </nav>
    </div>
    <div class="top-page js-padding ">
        <button data-step="second" data-popup="themes"
            class="button js-popup tutorial__item first animate tutorial--bd-bg js-show-theme-popup">
            <i class="icon realgh-plus"></i>
        </button>
    </div>
    <div class="bg-block ps-fx">
        <video class="video" autoplay loop muted>
            <source src="<?php echo get_template_directory_uri(); ?>/assets/video/mainscreen--desktop.mp4"
                type="video/mp4">
        </video>
    </div>
    <div class="bg-block ps-fx dark-tint"></div>

    <!-- START TUTORIAL -->
    <div class="tutorial__hint first">
        <p class="text tutorial-hint__text text--c-bg">Choose your subjects here</p>
    </div>

    <div class="tutotial__text-block">
        <p class="title tutorial__title">Our platform was designed to help you fight your daily fears</p>
        <p class="text tutorial__text">Start by selecting subject you are struggling with</p>
        <button data-step="first" class="button tutorial__button">
            <span class="button-text">Get started</span>
        </button>
    </div>
    <!-- END TUTORIAL -->

    <template id="theme-temp">
        <div class="readmore theme__readmore">
            <div class="card theme__cover">
                <img src="" alt="theme" class="img bg-block">
                <div class="tint bg-block"></div>
                <h5 class="subtitle text--c-light theme__name"></h5>
                <button class="button transp-button readmore__button">
                    <i class="icon realgh-chevron-down"></i>
                </button>
            </div>
            <div class="card theme__more">
                <?php realgh_print_meta_img($prefix . 'more_image', 'svg theme-more__img') ?>
                <div class="theme-more__content">
                    <p class="text text--c-blue">
                        <?php echo get_post_meta(get_the_ID(), $prefix . 'more_title', true); ?>
                    </p>
                    <a href="" class="link button blue-button">
                        <span class="button-text button-text--lighter">
                            <?php echo get_post_meta(get_the_ID(), $prefix . 'more_link_text', true); ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </template>

    <section class="section current block--hidden">
        <h2 class="title text--c-bg text--head">
            <?php echo get_post_meta(get_the_ID(), $prefix . 'current_title', true); ?>
        </h2>
        <div class="theme__cards"></div>
    </section>
    <section class="section suggestion block--hidden">
        <h2 class="title text--c-bg text--head">
            <?php echo get_post_meta(get_the_ID(), $prefix . 'suggest_title', true); ?>
        </h2>
        <div class="theme__cards"></div>
    </section>

</main>
<?php get_footer(); ?>