<div class="popup themes__popup themes-popup-wellbeing-homepage  full-hight-popup">
    <div class="popup__body themes__popup-body">
        <button class="button grey-button close-button js-close-popup js-close-theme-popup">
            <i class="icon realgh-close"></i>
        </button>
        <p class="subtitle">
            <?php echo get_post_meta(get_the_ID(), 'wellbeing_themes_title', true); ?>
        </p>
        <div class="popup__theme-cards tutorial__item second">

            <?php
            $cats = get_categories(array(
                'parent' => '0'
            ));
            foreach ($cats as $cat):
                if ($cat->term_id == 1)
                    continue;
                $cat_meta = get_option("category_$cat->term_id");
            ?>

            <div data-theme="<?php echo $cat->term_id; ?>" data-cat-url="<?php echo get_category_link($cat->term_id) ?>"
                class="card theme__card">
                <img src="<?php echo $cat_meta['img']; ?>" alt="<?php echo $cat->slug; ?>" class="img bg-block">
                <div class="tint theme__tint bg-block"></div>
                <img src="<?php
                echo get_template_directory_uri() . '/assets/img/icons/wellbeing-check--fill.svg';
                ?>" alt="check" class="svg theme__check-img">
                <p class="text theme__text">
                    <?php echo $cat->name; ?>
                </p>
            </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>