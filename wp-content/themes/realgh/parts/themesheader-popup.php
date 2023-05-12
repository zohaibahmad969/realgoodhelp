<div id="themes_popup_header" class="popup themes-popup-wellbeing-homepage themes_popup_header">
    <div class="popup__body themes__popup-body">
        <h2 class="title themes_popup_header_title">What do you need help with?</h2>
        <div class="popup__theme-cards-header tutorial__item second">

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
                class="card theme__card theme__card-header">
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