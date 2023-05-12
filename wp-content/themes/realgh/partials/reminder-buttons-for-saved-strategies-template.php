<div class="sc-ui-design sc-set-reminders-for-saved-strategies-screen">
    <div class="sc-ui-screen ">
        <div class="sc-image-wrap">
            <img class="sc-que-image" src="<?php echo get_template_directory_uri(); ?>/assets/img/reminder/reminder.svg"
                width=" 100%">
        </div>
        <div class="sc-content">
            <div class="sc-content-inner">
                <h2 class="sc-content-main-title title col-black m-b-10">
                    Would you like to set a reminder to practice the saved strategies?
                </h2>
                <form action="" method="POST" class="show-target-post-for-set-reminder m-b-15">
                    <div class="form__cell req-field m-b-15">
                        <select name="time_zone" class="input-text saved-strategies-dropdown-to-set-reminders" required>
                            <option value="" selected="" disabled="">Select Strategy</option>
                        </select>
                    </div>
                    <button href="#" class="button button--big blue-button">
                        <span class="button-text">
                            Set Reminder
                        </span>
                    </button>
                </form>
                <button type="button"
                    class="button button--big yellow-button za-blue-transparent-btn js-hide-reminder-screen-and-show-cards">
                    <span class="button-text">
                        Skip
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>