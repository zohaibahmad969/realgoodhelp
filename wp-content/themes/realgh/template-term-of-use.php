<?php 
/*
* Template name: Template term of use
*/

get_header();
?>

<main class="main js-padding">
    <section>
        <div class="wrapper wrapper--small privacy-wrapper">
        <h1 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_termsuse_main_title', true); ?></h1>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_termsuse_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_termsuse_description_text_2', true); ?> </p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_health_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_health_description_text', true); ?></p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_purpose_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_purpose_description_text', true); ?></p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_account_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_account_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_account_description_text_2', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_account_description_text_3', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_account_description_text_4', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_account_description_text_5', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_account_description_text_6', true); ?></p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_acceptable_main_title', true); ?> </h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_acceptable_description_text_1', true); ?></p>
        <?php
            $uploadLinkArr = get_post_meta(get_the_ID(), 'realgh_acceptable_list_repeter', true);
            if (!empty($uploadLinkArr)) {
                echo '<ul>';
                foreach ($uploadLinkArr as $key => $value) {
                    echo '<li class="text fz-18 cus-pri-lists">' . $value['realgh_acceptable_list_item'] . '</li>';
                }
                echo '</ul>';
            }
        ?>

        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_acceptable_description_text_2', true); ?></p>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_acceptable_description_text_3', true); ?></p>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_acceptable_description_text_4', true); ?></p>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_acceptable_description_text_5', true); ?></p>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_acceptable_description_text_6', true); ?></p>
        <?php
            $uploadLinkArr = get_post_meta(get_the_ID(), 'realgh_acceptable_list_repeter_2', true);
            if (!empty($uploadLinkArr)) {
                echo '<ul>';
                foreach ($uploadLinkArr as $key => $value) {
                    echo '<li class="text fz-18 cus-pri-lists">' . $value['realgh_acceptable_list_item_2'] . '</li>';
                }
                echo '</ul>';
            }
        ?>
        
            <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_acceptable_description_text_7', true); ?></p>

    

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_payment_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_payment_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_payment_description_text_2', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_payment_description_text_3', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_payment_description_text_4', true); ?> </p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_money_back_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_money_back_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_money_back_description_text_2', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_money_back_description_text_3', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_money_back_description_text_4', true); ?> </p>


        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_description_text_2', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_description_text_3', true); ?></p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_privacy_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_privacy_description_text', true); ?></a>.</p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_third_party_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_third_party_description_text', true); ?></p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_linked_website_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_linked_website_description_text', true); ?></p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_visitplatform_main_title', true); ?></h2>
                <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_visitplatform_description_text_1', true); ?></p>

                <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_visitplatform_description_text_2', true); ?></p>
        <?php
            $uploadLinkArr = get_post_meta(get_the_ID(), 'realgh_visitplatform_list_repeter', true);
            if (!empty($uploadLinkArr)) {
                echo '<ul>';
                foreach ($uploadLinkArr as $key => $value) {
                    echo '<li class="text fz-18 cus-pri-lists cus-pri-lists">' . $value['realgh_visitplatform_list_item'] . '</li>';
                }
                echo '</ul>';
            }
        ?>


        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_visitplatform_description_text_3', true); ?></p>
       
        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_socialmedia_main_title', true); ?></h2>

        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_socialmedia_description_text', true); ?>
        
        </p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_disclaimer_main_title', true); ?></h2>
         

        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_disclaimer_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_disclaimer_description_text_2', true); ?></p>

        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_disclaimer_description_text_3', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_disclaimer_description_text_4', true); ?></p>
        

        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_disclaimer_description_text_5', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_disclaimer_description_text_6', true); ?>
        
        </p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_copyright_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_copyright_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_copyright_description_text_2', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_copyright_description_text_3', true); ?> </p>


        <?php
            $uploadLinkArr = get_post_meta(get_the_ID(), 'realgh_copyright_list_repeter', true);
            if (!empty($uploadLinkArr)) {
                echo '<ul>';
                foreach ($uploadLinkArr as $key => $value) {
                    echo '<li class="text fz-18 cus-pri-lists">' . $value['realgh_copyright_list_item'] . '</li>';
                }
                echo '</ul>';
            }
        ?>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_trademark_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_trademark_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_trademark_description_text_2', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_trademark_description_text_3', true); ?>
        </p>
      

        <?php
            $uploadLinkArr = get_post_meta(get_the_ID(), 'realgh_trademark_list_repeter', true);
            if (!empty($uploadLinkArr)) {
                echo '<ul>';
                foreach ($uploadLinkArr as $key => $value) {
                    echo '<li class="text fz-18 cus-pri-lists">' . $value['realgh_trademark_list_item'] . '</li>';
                }
                echo '</ul>';
            }
        ?>        

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_modification_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_modification_description_text_1', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_modification_description_text_2', true); ?>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_modification_description_text_3', true); ?>
        </p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_notice_main_title', true); ?></h2>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_notice_description_text', true); ?></p>

        <h2 class="title psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_main_title', true); ?></h2>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_1', true); ?></p>

        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_2', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_3', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_4', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_5', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_6', true); ?></p>
        
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_7', true); ?></p>

        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_8', true); ?></p>
        <p class="text fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_imp_notes_description_text_9', true); ?></p>
                </div>
        </section>
        </main>

<?php get_footer(); ?>