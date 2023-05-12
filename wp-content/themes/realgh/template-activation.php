<?php
/*
* Template name: Template Email Verification
*/

get_header();


if(isset($_GET['key']) && isset($_GET['user']) && !is_user_logged_in()){
    $user_id = $_GET['user'];
    $code = get_user_meta( $user_id, 'has_to_be_activated', true );
    if ( $code == filter_input( INPUT_GET, 'key' ) ) {
        delete_user_meta( $user_id, 'has_to_be_activated' );
    } else {
        wp_redirect(home_url());
        //exit;
    }
} else {
    wp_redirect(home_url());
    //exit;
}

?>

<main class="main js-padding">
    <div class="wrapper wrapper--small">
        <section class="section-alt thank-you">
            <div class="thank-you__content">
                <?php realgh_print_meta_img('realgh_activation_icon_image', 'img thank-you__img') ?>
                <h1 class="title"><?php echo get_post_meta(get_the_ID(), 'realgh_activation_main_title', true); ?></h1>
                <p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_activation_main_text', true ); ?></p>
                <button data-popup="login" class="link button main-button button--big js-popup">
                    <span class="button-text">
                    <?php echo get_post_meta( get_the_ID(), 'realgh_activationcontent_link_text', true ); ?>
                    </span>
                </button>
            </div>

            <div class="thank-you__social-block">
                <p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_activation_social_text', true ); ?></p>
                <div class="d-flex thank-you__social">
                    <?php for ($i = 0; $i < count($rlgh_data['social_icon']); $i++): ?>
                        <a
                            href="<?php echo $rlgh_data['social_link'][$i]; ?>"
                            class="link button border-button social-button <?php echo 'c-' . $rlgh_data['social_icon'][$i]; ?>"
                        >
                            <i class="icon realgh-<?php echo $rlgh_data['social_icon'][$i]; ?>"></i>
                            <span class="button-text">
                                <?php echo $rlgh_data['social_icon'][$i]; ?>
                            </span>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
