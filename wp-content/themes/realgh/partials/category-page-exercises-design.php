<?php
    $cat_data = get_queried_object();
    $cat_meta = get_option('category_' . $cat_data->term_id);
    $cat_name = $cat_data->name;
?>

<div id="sc-exercies-wrap" class="sc-exercies-wrap"
        style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/Exercisesheet_bg.png'; ?>);display:none;">
        <div class="sc-exerice-template">
            <div class="sc-exercise-box">
                <div class="sc-exercise-header">
                    <h2 class="sc-exercise-header title text-center">
                        Hey, Friend!
                        <br>
                        Let's work on your <span class="col-blue sc-exercise-category">Category</span>
                    </h2>
                    <button class="button js-hide-exercise-sheet-and-show-cards blue-cross-btn">
                        <i class="icon realgh-close"></i>
                    </button>
                </div>
            </div>
            <div class="sc-exercise-box">
                <div class="sc-exercise-details">
                    <div class="sc-exercise-layout-50-50">
                        <div class="sc-exercise-layout-50-50-col w-70">
                            <div class="sc-exercise-layout-30-70 m-b-15">
                                <div>
                                    <h2 class="title col-blue fw-700">Strategy</h2>
                                </div>
                                <div>
                                    <a href="#" class="sc-exercise-strategy text col-blue">Lorem</a>
                                </div>
                            </div>
                            <div class="sc-exercise-layout-30-70 m-b-15">
                                <div>
                                    <h2 class="title col-blue fw-700">Exerscise</h2>
                                </div>
                                <div>
                                    <p class="sc-exercise-title text">Lorem Impsum</p>
                                </div>
                            </div>
                            <div class="sc-exercise-layout-30-70">
                                <div>
                                    <h2 class="title col-blue fw-700">
                                        Description
                                    </h2>
                                </div>
                                <div>
                                    <p class="sc-exercise-description text">Lorem ipsum</p>
                                </div>
                            </div>
                        </div>
                        <div class="sc-exercise-layout-50-50-col w-30">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/category-page-icons/exercises-ui-img.png'; ?>"
                                class="max-width-100">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exercise Template1 -- Situation Description -->
            <div class="sc-exercise-box sc-exercise-template" data-template="sc-et-situtaiondescription"
                id="sd_template">
                <h2 class="title col-blue fw-700">List</h2>
                <form class="sc-exercise-sd-form" method="GET" data-sdcount="1"
                    data-postid='<?php echo get_the_ID(); ?>'
                    data-posttitle='<?php echo get_the_title(get_the_ID()); ?>'
                    data-postlink="<?php echo get_permalink(get_the_ID()) . '?show_exercise_screen=true' ?>">
                    <div class="form__cell req-field m-b-10">
                        <input type="text" placeholder="Situation"
                            class="input input-text input--req exercise_situation" name="exercise_situation" required>
                    </div>
                    <div class="form__cell req-field m-b-10">
                        <input type="text" placeholder="Description"
                            class="input input-text input--req exercise_description" name="exercise_description"
                            required>
                    </div>
                    <div class="form__bot">
                        <button type="submit" class="button button--big blue-button">
                            <span class="button-text">
                                Save Situation
                            </span>
                            </a>
                    </div>
                </form>
                <div class="sc-exercise-situations-wrap">
                    <!-- Data will come from javascript -->
                </div>
            </div>

            <!-- Exercise Template2 -- Plan -->
            <div class="sc-exercise-box sc-exercise-template" data-template="sc-et-plan" id="plan_template">
                <h2 class="title col-blue fw-700 m-b-20">Plan</h2>
                <form class="sc-exercise-plan-form" method="GET" data-sdcount="1"
                    data-postid='<?php echo get_the_ID(); ?>'
                    data-posttitle='<?php echo get_the_title(get_the_ID()); ?>'
                    data-postlink='<?php echo get_permalink(get_the_ID()) . '?show_exercise_screen=true' ?>'>
                    <div class="form__cell req-field m-b-10 sc-exercise-t2-plan-details-form-wrap">
                        <select name="sc_exercise_t2_day" class="input input-text sc_exercise_t2_day w-auto" required>
                            <option value="">Day</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="fridy">Friday</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                        </select>
                        <div class="sc-exercise-t2-plan-details-form-area" data-sdcount="1">
                            <div class="sc-exercise-t2-plan-details-form m-b-10 sc-exercise-plan-default">
                                <input type="time"
                                    class="input input-text input--req sc_exercise_t2_time sc_exercise_t2_stime"
                                    name="sc_exercise_t2_stime" required>
                                <span>to</span>
                                <input type="time"
                                    class="input input-text input--req sc_exercise_t2_time sc_exercise_t2_etime"
                                    name="sc_exercise_t2_etime" required>
                                <span class="sc-spacer-5"></span>
                                <input type="text" placeholder="Cleaning, working, relaxing etc."
                                    class="input input-text input--req sc_exercise_t2_plan" name="sc_exercise_t2_plan"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="form__cell req-field">
                        <a href="#" class="sc-add-exercise-t2-time-btn no-text-decore"><i
                                class="icon realgh-plus--circle"></i>&nbsp;&nbsp;<span class="text">Add time</span></a>
                    </div>
                    <div class="form__bot">
                        <button type="submit" class="button button--big blue-button">
                            <span class="button-text">
                                Save Plan
                            </span>
                            </a>
                    </div>
                </form>
                <div class="sc-exercise-plans-wrap">
                    <!-- Data will come from javascript -->
                </div>
            </div>


            <!-- Exercise Template3 -- Journal -->
            <div class="sc-exercise-box sc-exercise-template" data-template="sc-et-journal" id="journal_template">
                <h2 class="title col-blue fw-700 m-b-20">Journal</h2>
                <form class="sc-exercise-journal-form" method="GET" data-sdcount="1"
                    data-postid='<?php echo get_the_ID(); ?>'
                    data-posttitle='<?php echo get_the_title(get_the_ID()); ?>'
                    data-postlink='<?php echo get_permalink(get_the_ID()) . '?show_exercise_screen=true' ?>'>
                    <div class="form__cell req-field m-b-10">
                        <input type="date" class="input input-text input--req sc_exercise_journal_date w-auto"
                            name="sc_exercise_journal_date" required>
                    </div>
                    <div class="form__cell req-field m-b-10">
                        <textarea class="input input-text input--req sc_exercise_journal_thoughts"
                            name="sc_exercise_journal_thoughts" required></textarea>
                    </div>
                    <div class="form__bot">
                        <button type="submit" class="button button--big blue-button">
                            <span class="button-text">
                                Save Journal
                            </span>
                            </a>
                    </div>
                </form>
                <div class="sc-journal-details-wrap">
                    <!-- Data will come from javascript -->
                </div>
            </div>


            <!-- Exercise Template4 -- Situation Reflection -->
            <div class="sc-exercise-box sc-exercise-template" data-template="sc-et-situtaionreflection"
                id="sr_template">
                <h2 class="title col-blue fw-700 m-b-20">Situations and Reflections</h2>
                <form class="sc-exercise-sr-form" method="GET" data-sdcount="1"
                    data-postid='<?php echo get_the_ID(); ?>'
                    data-posttitle='<?php echo get_the_title(get_the_ID()); ?>'
                    data-postlink='<?php echo get_permalink(get_the_ID()) . '?show_exercise_screen=true' ?>'>
                    <div class="form__cell req-field m-b-10">
                        <input type="text" placeholder="Situation"
                            class="input input-text input--req exercise_t4_situation" name="exercise_t4__situation"
                            required>
                    </div>
                    <div class="form__cell req-field m-b-10">
                        <input type="text" placeholder="Reflection"
                            class="input input-text input--req exercise_t4_reflection" name="exercise_reflection"
                            required>
                    </div>
                    <div class="form__bot">
                        <button type="submit" class="button button--big blue-button">
                            <span class="button-text">
                                Add Situation
                            </span>
                            </a>
                    </div>
                </form>
                <div class="sc-exercise-situationsreflections-wrap">
                    <!-- Data will come from javascript -->
                </div>
            </div>

        </div>
    </div>