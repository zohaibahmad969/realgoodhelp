<div class="popup menu__popup">
    <div class="popup__body menu__popup-body">
        <button class="button grey-button close-button">
            <i class="icon wellbeing-close"></i>
        </button>
        <?php
        global $wellbeing;
        if (is_user_logged_in()) :
        ?>
            <a href="<?php echo admin_url(); ?>" class="link button button--big">
                <span class="button-text">
                    <?php echo $wellbeing['admin_btn']; ?>
                </span>
            </a>
            <a href="<?php echo wp_logout_url(home_url()); ?>" class="link button button--big">
                <span class="button-text">
                    <?php echo $wellbeing['logout_btn']; ?>
                </span>
            </a>
        <?php else : ?>
            <a href="<?php echo wp_login_url(); ?>" class="link button button--big">
                <span class="button-text">
                    <?php echo $wellbeing['login_btn']; ?>
                </span>
            </a>
        <?php endif; ?>
    </div>
</div>