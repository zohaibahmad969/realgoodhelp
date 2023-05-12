<?php
    $cat_data = get_queried_object();
    $cat_meta = get_option('category_' . $cat_data->term_id);
    $cat_name = $cat_data->name;
?>
<div class="tunnel-questionaire-tq">
    <div class="tq-first-screen">
        <div class="tq-image-wrap">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/questionaire-start.png'; ?>"
                width="100%">
        </div>
        <div class="tq-content">
            <div class="tq-content-inner">
                <h2 class="tq-content-main-title">
                    <?php echo (isset($cat_meta['questionaire_title'])) ? $cat_meta['questionaire_title'] : "Questionaire Title"; ?>
                </h2>
                <div class="tq-content-desc">
                    <p>
                        <?php echo preg_replace( '/\\\\/', '',  (isset($cat_meta['questionaire_description'])) ? $cat_meta['questionaire_description'] : "Questionaire Description" ); ?>
                    </p>
                </div>
                <button type="button" class="button button--big blue-button" id="tq-start-test">
                    <span class="button-text">
                        Start
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="tq-second-screen__questions">
        <div class="tq-questions-image-wrap ">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/questionaire-bg.png'; ?>"
                width="100%">
        </div>
        <div class="tq-questions-wrap">
            <?php
            if (!empty($cat_meta['questions'])):
                $numItems = count($cat_meta['questions']);
                ?>
                <div class="tq-progress-bar-wrap">
                    <div class="tq-progress-bar">
                        <div class="tq-progress-bar-inner tq-progress-bar-blue"
                            style="width: <?php echo (1 / $numItems) * 100 . '%' ?>;"></div>
                    </div>
                    <div class="tq-progress-bar-content">
                        <h2 class="title">
                            <span class="tq-progress-quest-no col-blue">1</span> / <span
                                class="tq-progress-total-questions">
                                <?php echo $numItems; ?>
                            </span>
                        </h2>
                    </div>
                </div>
                <?php
                $i = 0;
                $count = 1;
                foreach ($cat_meta['questions'] as $question) {
                    ?>
                    <div class="tq-questions-inner" <?php echo ($count == 1) ? 'style="display:block;"' : '' ?>>
                        <div class="tq-questions-question" data-question="<?php echo $count; ?>"
                            data-totalQuestions="<?php echo $numItems; ?>" data-category="<?php echo $cat_data->term_id ?>">
                            <h2 class="tq-question-label">
                                <span class="tq-question-count">
                                    <?php echo $count; ?>.
                                </span>
                                <?php echo $question; ?>
                            </h2>
                            <div class="tq-answers-wrap">
                                <?php
                                foreach ($cat_meta['answers'] as $answer) {
                                    $answer_scale = explode(",", $answer);
                                    echo '<div class="tq-question-answer" data-scale="' . $answer_scale[1] . '">' . $answer_scale[0] . '</div>';
                                }
                                ?>
                            </div>
                            <div class="tq-questions-btns <?php echo ($count == 1) ? 'tq-no-back-btn' : '' ?>">
                                <button type="button" class="button transparent-button tq-back-question">
                                    <span class="button-text">
                                        Back
                                    </span>
                                </button>
                                <span class="tq-btns-spacer"></span>
                                <?php
                                if (++$i !== $numItems) {
                                    ?>
                                    <button type="button" class="button blue-button tq-next-question">
                                        <span class="button-text">
                                            Next question
                                        </span>
                                    </button>
                                    <?php
                                } else {
                                    ?>
                                    <button type="button" class="button blue-button tq-view-results" id="tq-view-results">
                                        <span class="button-text">
                                            View Results
                                        </span>
                                    </button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                }
                $total_score = ($count - 1) * (count($cat_meta['answers']) - 1);
            endif;
            if (strlen($cat_meta['single_short_result']) > 0) {
                ?>
                <div class="title js-tq-all-results" data-resultType="single" style="display: none;">
                    <p>
                        <?php echo stripslashes($cat_meta['single_short_result']); ?>
                    </p>
                    <?php echo $cat_meta['single_long_result']; ?>
                </div>
                <img style="display: none;" class="js-tq-all-results-img"
                    src="<?php echo $cat_meta['single_result_img']; ?>">
                <?php
            } else {
                ?>
                <h2 class="title js-tq-all-results" data-resultType="multple" style="display: none;">
                    <?php
                    if (!empty($cat_meta['results'])):
                        $count = 1;
                        foreach ($cat_meta['results'] as $result) {
                            echo ($count == 1) ? "" : "/";
                            $count++;
                            echo stripslashes($result);
                        }
                    endif;
                    ?>
                </h2>
                <h2 class="title js-tq-all-results-desc" style="display: none;">
                    <?php
                    if (!empty($cat_meta['results_long_description'])):
                        $count = 1;
                        foreach ($cat_meta['results_long_description'] as $result_desc) {
                            echo ($count == 1) ? "" : "/new_result_break";
                            $count++;
                            echo stripslashes($result_desc);
                        }
                    endif;
                    ?>
                </h2>
                <h2 class="title js-tq-all-results-images" style="display: none;">
                    <?php
                    if (!empty($cat_meta['results_images'])):
                        $count = 1;
                        foreach ($cat_meta['results_images'] as $results_image) {
                            echo ($count == 1) ? "" : "/new_result_break";
                            $count++;
                            echo $results_image;
                        }
                    endif;
                    ?>
                </h2>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="tq-third-score-screen layout-50-50">
        <div class="tq-image-wrap">
            <img class="tq-score-image"
                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/score0-9.png'; ?>"
                width="100%">
        </div>
        <div class="tq-content">
            <div class="tq-content-inner">
                <div class="tq-content-top-header">
                    <h3 class="tq-content-score">Your Score: <span class="tq-js-score"><span
                                class="tq-score-acheived">0</span>/
                            <?php echo $total_score; ?>
                        </span></h3>
                    <h2 class="title q-tr-item-date text-right"><span class="tq-js-date">00/00/0000</span></h2>
                </div>
                <h2 class="tq-content-main-title tq-test-result-title">
                    Result Name
                </h2>
                <div class="tq-content-desc tq-test-result-desc">
                    <p>
                        Test Result Description
                    </p>
                </div>
                <button type="button" class="button button--big blue-button" id="tq-finish-test">
                    <span class="button-text">
                        FINISH
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="tq-fourth-congrats-screen layout-50-50">
        <div class="tq-image-wrap">
            <img class="tq-congrats-image"
                src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/last-screen.png'; ?>"
                width="100%">
        </div>
        <div class="tq-content">
            <div class="tq-content-inner">
                <h2 class="tq-content-main-title col-black m-b-15">
                    Congratulation, you have finished the questions for
                </h2>
                <h2 class="tq-content-main-title">
                    <span class="tq-congrats-category-name">
                        <?php echo $cat_data->name; ?>
                    </span> questionnaire
                </h2>
                <div class="tq-congrats-btns">
                    <a href="<?php echo home_url("/therapy-and-coaching"); ?>" class="button button--big blue-button">
                        <span class="button-text">
                            Ask For Help
                        </span>
                    </a>
                    <a href="<?php echo home_url("my-progress"); ?>" class="button button--big blue-button">
                        <span class="button-text">
                            See Strategies for
                            <?php echo $cat_data->name; ?>
                        </span>
                    </a>
                    <a href="" class="button button--big blue-button tq-prev-cat-url">
                        <span class="button-text">
                            continue with <span class="tq-prev-cat-name"></span>
                        </span>
                    </a>
                    <a href="?questionaire=true" class="button button--big blue-button tq-complete-test-again">
                        <span class="button-text">
                            complete this test one more time
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>