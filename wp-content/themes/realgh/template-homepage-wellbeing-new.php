<?php
/*
 * Template name: Template homepage Wellbeing New
 */

get_header();
// get_template_part('parts/top', 'page');
// get_template_part('parts/themes', 'popup');
// get_template_part('parts/menuwellbeing', 'popup');
?>


<?php
  $prefix = 'realgh_';
?>
<main class="za-main-wrap">
    <div class="za-main za-main-with-header">
        <div class="za-main-banner">
            <div class="za-main-banner-left-area">
                <div class="za-main-banner-left-area-inner">
                    <h1 class="za-main-banner-heading">
                        <?php echo get_post_meta( get_the_ID(), $prefix.'main_title', true ); ?>
                    </h1>
                    <p class="za-main-banner-desc">
                    <?php echo get_post_meta( get_the_ID(), $prefix.'main_text', true ); ?>
                    </p>
                    <a href="<?php echo get_permalink(get_post_meta( get_the_ID(), $prefix.'main_link_value', true )); ?>" class="link button main-button za-button">
						<span class="button-text"><?php echo get_post_meta( get_the_ID(), $prefix.'main_link_text', true ); ?></span>
					</a>
                </div>
            </div>
            <div class="za-col-60 za-main-banner-bg" style="background-image:url(<?php echo wp_get_attachment_image_url(get_post_meta( get_the_ID(), $prefix.'main_top_image', true )['id'], "full"); ?>)"></div>
        </div>
        <div class="za-features-wrap">
            <h2 class="za-fetaures-main-title"><?php echo get_post_meta( get_the_ID(), $prefix.'feature_title', true ); ?></h2>
            <div class="za-features">
                <div class="za-feature-item">
                    <div class="za-feature-item-inner">
                        <?php realgh_print_meta_img($prefix.'feature_card-1_img', 'za-feature-icon') ?>
                        <h3 class="za-feature-item-title max-w-177">
                            <?php echo get_post_meta( get_the_ID(), $prefix.'feature_card-1_title', true ); ?> 
                        </h3>
                        <p class="za-feature-item-desc">
                            <?php echo get_post_meta( get_the_ID(), $prefix.'feature_card-1_text', true ); ?>
                        </p>
                    </div>
                </div>
                <div class="za-feature-item">
                    <div class="za-feature-item-inner">
                            <?php realgh_print_meta_img($prefix.'feature_card-2_img', 'za-feature-icon') ?>
                        <h3 class="za-feature-item-title">
                            <?php echo get_post_meta( get_the_ID(), $prefix.'feature_card-2_title', true ); ?>
                        </h3>
                        <p class="za-feature-item-desc">
                            <?php echo get_post_meta( get_the_ID(), $prefix.'feature_card-2_text', true ); ?>
                        </p>
                    </div>
                </div>
                <div class="za-feature-item">
                    <div class="za-feature-item-inner">
                        <?php realgh_print_meta_img($prefix.'feature_card-3_img', 'za-feature-icon') ?>
                        <h3 class="za-feature-item-title">
                            <?php echo get_post_meta( get_the_ID(), $prefix.'feature_card-3_title', true ); ?>
                        </h3>
                        <p class="za-feature-item-desc">
                            <?php echo get_post_meta( get_the_ID(), $prefix.'feature_card-3_text', true ); ?>
                        </p>
                    </div>
                </div>
                <div class="za-feature-item">
                    <div class="za-feature-item-inner">
                        <?php realgh_print_meta_img($prefix.'feature_card-4_img', 'za-feature-icon') ?>
                        <h3 class="za-feature-item-title">
                            <?php echo get_post_meta( get_the_ID(), $prefix.'feature_card-4_title', true ); ?>
                        </h3>
                        <p class="za-feature-item-desc">
                            <?php echo get_post_meta( get_the_ID(), $prefix.'feature_card-4_text', true ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="za-column-banner za-banner-left">
            <div class="za-col-50 za-main-benefits-bg1" style="background-image:url(<?php echo wp_get_attachment_image_url(get_post_meta( get_the_ID(), $prefix.'benefits_top_image-1', true )['id'], "full"); ?>)"></div>
            <div class="za-col-50">
                <div class="za-column-banner-content">
                    <h2 class="za-column-banner-heading">
                        <?php echo get_post_meta( get_the_ID(), $prefix.'benefits_title', true ); ?>
                    </h2>
                    <ul class="za-column-banner-list">
                        <li class="za-column-banner-list-item">
                            <span class="za-column-banner-item-no">#1</span>
                            <div class="za-column-banner-item-content">
                                <h3 class="za-column-banner-item-content-title"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-1_title', true ); ?></h3>
                                <p class="za-column-banner-item-content-desc">
                                    <?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-1_text', true ); ?>
                                </p>
                            </div>
                        </li>
                        <li class="za-column-banner-list-item">
                            <span class="za-column-banner-item-no">#2</span>
                            <div class="za-column-banner-item-content">
                                <h3 class="za-column-banner-item-content-title"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-2_title', true ); ?></h3>
                                <p class="za-column-banner-item-content-desc">
                                    <?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-2_text', true ); ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                    <a href="<?php echo get_permalink(get_post_meta( get_the_ID(), $prefix.'benefits_link_value-1', true )); ?>" class="link button main-button za-button">
						<span class="button-text"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_link_text-1', true ); ?></span>
					</a>
                </div>
            </div>
        </div>
        <div class="za-column-banner za-banner-right za-three-list-items-wrap">
            <div class="za-col-50">
                <div class="za-column-banner-content">
                    <ul class="za-column-banner-list">
                        <li class="za-column-banner-list-item">
                            <span class="za-column-banner-item-no">#3</span>
                            <div class="za-column-banner-item-content">
                                <h3 class="za-column-banner-item-content-title"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-3_title', true ); ?></h3>
                                <p class="za-column-banner-item-content-desc">
                                    <?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-3_text', true ); ?>
                                </p>
                            </div>
                        </li>
                        <li class="za-column-banner-list-item">
                            <span class="za-column-banner-item-no">#4</span>
                            <div class="za-column-banner-item-content">
                                <h3 class="za-column-banner-item-content-title"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-4_title', true ); ?></h3>
                                <p class="za-column-banner-item-content-desc">
                                    <?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-4_text', true ); ?>
                                </p>
                            </div>
                        </li>
                        <li class="za-column-banner-list-item">
                            <span class="za-column-banner-item-no">#5</span>
                            <div class="za-column-banner-item-content">
                                <h3 class="za-column-banner-item-content-title"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-5_title', true ); ?></h3>
                                <p class="za-column-banner-item-content-desc">
                                    <?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-5_text', true ); ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                    <a href="<?php echo get_permalink(get_post_meta( get_the_ID(), $prefix.'benefits_link_value-2', true )); ?>" class="link button main-button za-button">
						<span class="button-text"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_link_text-2', true ); ?></span>
					</a>
                </div>
            </div>
            <div class="za-col-50 za-main-benefits-bg2" style="background-image:url(<?php echo wp_get_attachment_image_url(get_post_meta( get_the_ID(), $prefix.'benefits_mid_image-2', true )['id'], "full"); ?>)"></div>
        </div>
        <div class="za-column-banner  za-banner-left">
            <div class="za-col-50 za-main-benefits-bg3" style="background-image:url(<?php echo wp_get_attachment_image_url(get_post_meta( get_the_ID(), $prefix.'benefits_bot_image-3', true )['id'], "full"); ?>)"></div>
            <div class="za-col-50">
                <div class="za-column-banner-content">
                    <ul class="za-column-banner-list">
                        <li class="za-column-banner-list-item">
                            <span class="za-column-banner-item-no">#6</span>
                            <div class="za-column-banner-item-content">
                                <h3 class="za-column-banner-item-content-title"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-6_title', true ); ?></h3>
                                <p class="za-column-banner-item-content-desc">
                                    <?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-6_text', true ); ?>
                                </p>
                            </div>
                        </li>
                        <li class="za-column-banner-list-item">
                            <span class="za-column-banner-item-no">#7</span>
                            <div class="za-column-banner-item-content">
                                <h3 class="za-column-banner-item-content-title"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-7_title', true ); ?></h3>
                                <p class="za-column-banner-item-content-desc">
                                    <?php echo get_post_meta( get_the_ID(), $prefix.'benefits_item-7_text', true ); ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                    <a href="<?php echo get_permalink(get_post_meta( get_the_ID(), $prefix.'benefits_link_value-3', true )); ?>" class="link button main-button za-button">
						<span class="button-text"><?php echo get_post_meta( get_the_ID(), $prefix.'benefits_link_text-3', true ); ?></span>
					</a>
                </div>
            </div>
        </div>
    </div>
    <div class="za-footer-banner-full-bg" style="background-image:url(<?php echo wp_get_attachment_image_url(get_post_meta( get_the_ID(), $prefix.'guided_image', true )['id'], "full"); ?>)">
        <div class="za-main za-footer-banner">
            <div class="za-col-50 za-footer-left-area">
                <h2 class="za-footer-banner-heading">
                <?php echo get_post_meta( get_the_ID(), $prefix.'guided_title_left-section', true ); ?>
                </h2>
                <p class="za-footer-banner-desc">
                    <?php echo get_post_meta( get_the_ID(), $prefix.'guided_text_left-section', true ); ?>
                </p>
                <a href="<?php echo get_permalink(get_post_meta( get_the_ID(), $prefix.'guided_link_value', true )); ?>" class="link button main-button za-button">
					<span class="button-text"><?php echo get_post_meta( get_the_ID(), $prefix.'guided_link_text', true ); ?></span>
				</a>
            </div>
            <div class="za-col-50 pos-relative mob-padding">
                <div class="za-info-box">
                    <img src="<?php echo wp_get_attachment_image_url(get_post_meta( get_the_ID(), $prefix.'guided_image_right-section', true )['id'], "full"); ?>"
                        class="za-info-box-icon">
                    <div class="za-info-box-content">
                        <h3 class="za-info-box-heading"><?php echo get_post_meta( get_the_ID(), $prefix.'guided_title_right-section', true ); ?></h3>
                        <p class="za-info-box-desc"><?php echo get_post_meta( get_the_ID(), $prefix.'guided_text_right-section', true ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>