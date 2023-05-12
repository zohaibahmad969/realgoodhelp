<?php
/*
 * Template name: Template homepage Self-Help v2
 */

get_header();
// get_template_part('parts/top', 'page');
// get_template_part('parts/themes', 'popup');
// get_template_part('parts/menuwellbeing', 'popup');
?>


<?php
$prefix = 'realgh_';
?>
<main class="realgh-self-help-lp-bg-page"
    style="background-image: url(<?php echo wp_get_attachment_image_url(get_post_meta( get_the_ID(), $prefix.'main_top_image', true )['id'], "full"); ?>);">
    <div class="wrapper main-content-box">
        <div class="main-lp-header">
            <h2 class="title main-lp-heading">
                <?php echo get_post_meta(get_the_ID(), $prefix . 'mainheading', true); ?>
            </h2>
        </div>
        <div class="main-lp-categories">
            <h2 class="title main-lp-subheading">
                <?php echo get_post_meta(get_the_ID(), $prefix . 'subheading', true); ?>
            </h2>
            <div class="main-lp-categories">
                <?php
                // $cat_ids = array(5, 6, 8, 15, 7);
                // $cats = get_categories(
                //     array(
                //         'include' => $cat_ids,
                //         'parent' => '0',
                //     )
                // );
                // foreach ($cats as $cat):
                //     if ($cat->term_id == 1)
                //         continue;
                //     $cat_meta = get_option("category_$cat->term_id");
                ?>

                <!-- <div data-theme="<?php echo $cat->term_id; ?>"
                        data-cat-url="<?php echo get_category_link($cat->term_id) ?>"
                        class="main-lp-blur-box main-lp-theme-box">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/realgh-anxiety.png'; ?>">
                        <p class="text main-lp-blur-box-title">
                            <?php echo $cat->name; ?>
                        </p>
                    </div> -->

                <?php // endforeach; ?>

                <div data-theme="135" data-cat-url="<?php echo home_url("/category/reduce-anxiety/?new_design=true#") ?>"
                    class="main-lp-blur-box main-lp-theme-box">
                    <img src="http://www.realgoodhelp.com/wp-content/uploads/2023/04/realgh-anxiety.png">
                    <p class="text main-lp-blur-box-title">
                        Reduce Anxiety </p>
                </div>
                <?php
                    if( 1 !== 1){
                        // Hiding some content for now
                ?>
                <div data-theme="5" data-cat-url="<?php echo home_url("/category/anxiety/?new_design=true#") ?>"
                    class="main-lp-blur-box main-lp-theme-box">
                    <img src="http://www.realgoodhelp.com/wp-content/uploads/2023/04/realgh-anxiety.png">
                    <p class="text main-lp-blur-box-title">
                        Anxiety </p>
                </div>
                <div data-theme="6" data-cat-url="<?php echo home_url("/category/depression/") ?>"
                    class="main-lp-blur-box main-lp-theme-box">
                    <img src="http://www.realgoodhelp.com/wp-content/uploads/2023/04/realgh-depression.png">
                    <p class="text main-lp-blur-box-title">
                        Depression </p>
                </div>
                <div data-theme="8" data-cat-url="<?php echo home_url("/category/sleep-better/") ?>"
                    class="main-lp-blur-box main-lp-theme-box">
                    <img src="http://www.realgoodhelp.com/wp-content/uploads/2023/04/realgh-sleepbetter.png">
                    <p class="text main-lp-blur-box-title">
                        Sleep Better </p>
                </div>
                <div data-theme="15" data-cat-url="<?php echo home_url("/category/manage-negative-emotion/") ?>"
                    class="main-lp-blur-box main-lp-theme-box">
                    <img src="http://www.realgoodhelp.com/wp-content/uploads/2023/04/realgh-managenegativemotions.png">
                    <p class="text main-lp-blur-box-title">
                        Manage Negative Emotion </p>
                </div>
                <div data-theme="7" data-cat-url="<?php echo home_url("/category/motivation/") ?>"
                    class="main-lp-blur-box main-lp-theme-box">
                    <img src="http://www.realgoodhelp.com/wp-content/uploads/2023/04/realgh-motivation.png">
                    <p class="text main-lp-blur-box-title">
                        Motivation </p>
                </div>

                <div type="button" class="main-lp-blur-box"
                    onclick='window.location.href = "<?php echo home_url("/my-progress") ?>" '>
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/icons/realgh-anxiety.png'; ?>">
                    <p class="text main-lp-blur-box-title">
                        Something Else
                    </p>
                </div>
                
                <?php
                    }
                ?>
                
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>