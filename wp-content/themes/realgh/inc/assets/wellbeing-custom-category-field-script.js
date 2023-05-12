jQuery(document).ready(function($) {

    $("#add_questionaire_question_div").click(function() {
        var crnt = $(this);
        let question_no = crnt.attr('data-question');
        $("#questionaire_questions").append('\
			<div class="questionaire_question">\
				<label style="cursor: default;">\
					Question # ' + question_no + ' \
					<span style="cursor:pointer;float:right;" class="dashicons dashicons-trash del_questionaire_question"></span>\
				</label>\
				<input type="text" name="cat_meta[questions][]">\
			</div>\
		');
        crnt.attr('data-question', (parseInt(question_no) + 1));
    });

    $("#add_questionaire_question_tr").click(function() {
        $("#questionaire_questions").append('\
			<tr class="questionaire_question">\
				<th style="padding: 0;">\
					<label>\
						Question\
						<span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_question"></span>\
					</label>\
				</th>\
				<td style="padding: 0;">\
					<input type="text" style="width:100%;margin-bottom:3px;" name="cat_meta[questions][]">	\
				</td>\
			</tr>\
		');
    });
    $(document).on("click", ".del_questionaire_question", function() {
        var crnt = $(this);
        crnt.parents(".questionaire_question").remove();
    });

    $("#add_questionaire_answer_div").click(function() {
        var crnt = $(this);
        let answer_no = crnt.attr('data-answer');
        $("#questionaire_answers").append('\
			<div class="questionaire_answer" style="margin-bottom:8px">\
				<label style="cursor: default;">\
					Answer # ' + answer_no + ' \
					<span style="cursor:pointer;float:right;" class="dashicons dashicons-trash del_questionaire_answer"></span>\
				</label>\
				<input type="text" name="cat_meta[answers][]" placeholder="Answer, Scale">\
			</div>\
		');
        crnt.attr('data-answer', (parseInt(answer_no) + 1));
    });

    $("#add_questionaire_answer_tr").click(function() {
        $("#questionaire_answers").append('\
			<tr class="questionaire_answer">\
				<th style="padding: 0;">\
					<label>\
						Answer\
						<span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_answer"></span>\
					</label>\
				</th>\
				<td style="padding: 0;">\
					<input type="text" style="width:100%;margin-bottom:3px;" placeholder="Answer, Scale" name="cat_meta[answers][]">	\
				</td>\
			</tr>\
		');
    });
    $(document).on("click", ".del_questionaire_answer", function() {
        var crnt = $(this);
        crnt.parents(".questionaire_answer").remove();
    });

    $("#add_questionaire_result_div").click(function() {
        var crnt = $(this);
        let result_no = crnt.attr('data-result');
        $("#questionaire_results").append('\
			<div class="questionaire_result" style="margin-bottom:8px">\
				<label style="cursor: default;">\
					Result # ' + result_no + ' \
					<span style="cursor:pointer;float:right;" class="dashicons dashicons-trash del_questionaire_result"></span>\
				</label>\
				<input type="text" name="cat_meta[results][]" placeholder="From-To , Result (e.g. 0-9 , Basic Result )">\
			</div>\
			<div class="questionaire_result" style="margin-bottom:8px">\
					<label style="cursor: default;">\
						Result Long Description \
						<span style="cursor:pointer;float:right;" class="dashicons dashicons-trash del_questionaire_result"></span>\
					</label>\
					<textarea style="width:100%;" name="cat_meta[results_long_description][]" rows="7"></textarea>\
				</div>\
			<div class="questionaire_result" style="margin-bottom:8px">\
					<label style="font-weight: 500;">\
						Result Image Url\
					</label>\
					<div class="form-field">\
						<a href="#" class="button upload-img">\
							Upload image\
						</a>\
						<a href="#" class="remove-img" style="display:none">\
							Remove image\
						</a>\
						<input type="hidden" class="img-url" name="cat_meta[results_images][]" value="">\
					</div>\
			</div>\
		');
        crnt.attr('data-result', (parseInt(result_no) + 1));
    });

    $("#add_questionaire_result_tr").click(function() {
        $("#questionaire_results").append('\
			<tr class="questionaire_result">\
				<th style="padding: 0;">\
					<label>\
						Result\
						<span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>\
					</label>\
				</th>\
				<td style="padding: 0;">\
					<input type="text" style="width:100%;margin-bottom:3px;" placeholder="From-To , Result (e.g. 0-9 , Basic Result )" name="cat_meta[results][]">	\
				</td>\
			</tr>\
			<tr class="questionaire_result">\
					<th style="padding: 0;">\
						<label>\
							Result Long Description\
							<span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>\
						</label>\
					</th>\
					<td style="padding: 0;">\
						<textarea style="width:100%;" name="cat_meta[results_long_description][]" rows="7"></textarea>\
					</td>\
			</tr>\
			<tr>\
				<td>\
					<label style="font-weight: 500;">\
						Result Image Url\
					</label>\
				</td>\
				<td>\
					<div class="form-field">\
						<a href="#" class="button upload-img">\
							Upload image\
						</a>\
						<a href="#" class="remove-img" style="display:none">\
							Remove image\
						</a>\
						<input type="hidden" class="img-url" name="cat_meta[results_images][]" value="">\
					</div>\
				</td>\
			</tr>\
		');
    });
    $(document).on("click", ".del_questionaire_result", function() {
        var crnt = $(this);
        crnt.parents(".questionaire_result").remove();
    });

    $("#add_questionaire_single_result_div").click(function() {
        var crnt = $(this);
        $("#questionaire_results").html('\
			<div class="questionaire_result" style="margin-bottom:8px">\
				<label style="cursor: default;">\
					Single Short Result\
					<span style="cursor:pointer;float:right;" class="dashicons dashicons-trash del_questionaire_result"></span>\
				</label>\
				<input type="text" style="width:100%;margin-bottom:3px;" name="cat_meta[single_short_result]" value="">\
			</div>\
			<div class="questionaire_result" style="margin-bottom:8px">\
				<label style="cursor: default;">\
					Single Long Result\
					<span style="cursor:pointer;float:right;" class="dashicons dashicons-trash del_questionaire_result"></span>\
				</label>\
				<textarea name="cat_meta[single_long_result]" rows="8"></textarea>\
			</div>\
			<div class="form-field">\
				<label style="font-weight: 500;">\
					Result Image Url\
				</label>\
				<a href="#" class="button upload-img">\
					Upload image\
				</a>\
				<a href="#" class="remove-img" style="display:none">\
					Remove image\
				</a>\
				<input type="hidden" class="img-url" name="cat_meta[single_result_img]" value="">\
			</div>\
		');
    });

    $("#add_questionaire_single_result_tr").click(function() {
        $("#questionaire_results").html('\
			<tr class="questionaire_result">\
				<th style="padding: 0;">\
					<label>\
						Single Short Result\
						<span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>\
					</label>\
				</th>\
				<td style="padding: 0;">\
					<input type="text" style="width:100%;margin-bottom:3px;" name="cat_meta[single_short_result]" value="">\
				</td>\
			</tr>\
			<tr class="questionaire_result">\
				<th style="padding: 0;">\
					<label>\
						Single Long Result\
						<span style="cursor:pointer;" class="dashicons dashicons-trash del_questionaire_result"></span>\
					</label>\
				</th>\
				<td style="padding: 0;">\
					<textarea name="cat_meta[single_result]" rows="8" style="width:100%;"></textarea>\
				</td>\
			</tr>\
			<tr>\
				<td>\
					<label style="font-weight: 500;">\
						Result Image Url\
					</label>\
				</td>\
				<td>\
					<div class="form-field">\
						<a href="#" class="button upload-img">\
							Upload image\
						</a>\
						<a href="#" class="remove-img" style="display:none">\
							Remove image\
						</a>\
						<input type="hidden" class="img-url" name="cat_meta[single_result_img]" value="">\
					</div>\
				</td>\
			</tr>\
		');
    });


    $(document).on("click", ".add_tunnel_flow_card_tr", function() {
        let crnt = $(this);

        // if request is coming from subtunnel form then add AddTunnelCardForm first
        if (crnt.parents(".sub_saved_tunnel_cards")) {
            let tunnel_card_default_template = $(".tunnel_card_template").html();
            tunnel_card_template = $(tunnel_card_default_template);
            tunnel_card_template.find(".tunnel_add_card_form").css("display", "block");
            crnt.parents(".tunnel-add-form-btn-container").next("tr").find(".tunnel_card_template .tunnel_add_card_form .js-on-form-reset-value-empty").val('');
            tunnel_card_template.find(".tunnel_add_card_form").addClass("max-height-auto");
            crnt.parents(".tunnel-add-form-btn-container").next("tr").find(".tunnel_card_template").html(tunnel_card_template);
        }


        // reset the form
        crnt.parents(".tunnel-add-form-btn-container").next("tr").find(".tunnel_card_template .tunnel_add_card_form .js-on-form-reset-value-empty").val('');

        crnt.parents(".tunnel-add-form-btn-container").next("tr").find(".tunnel_add_card_form .js-save-tunnel-card").attr("data-tunnel", crnt.attr("data-tunnel"));
        crnt.parents(".tunnel-add-form-btn-container").next("tr").find(".tunnel_add_card_form").css("display", "block");

    });


    $(document).on("click", ".js-save-tunnel-card", function() {

        let crnt = $(this);
        crnt_form = crnt.parents('.tunnel_add_card_form');
        let fieldname = '';
        let fieldtunnelname = '';
        let formcount;
        if (crnt.attr("data-tunnel") === "main") {
            formcount = $(".main_saved_tunnel_cards .tunnel_add_card_form:last-child").attr("data-formcount");
            if (formcount === undefined) {
                // No card exists
                fieldname = 'tunnel_meta[tunnel_data][0][tunnel_cards][0]';
                formcount = 0;
            } else {
                formcount = parseInt(formcount) + 1;
                fieldname = 'tunnel_meta[tunnel_data][0][tunnel_cards][' + formcount + ']';
            }
        } else {
            let tunnel_count = crnt.parents(".subtunnel-data").attr("data-subtunnelcount");
            formcount = crnt.parents(".subtunnel-data").find(".subTunnels_saved_tunnel_cards .tunnel_add_card_form:last-child").attr("data-formcount");
            if (formcount === undefined) {
                // No card exists
                fieldname = 'tunnel_meta[tunnel_data][' + tunnel_count + '][tunnel_cards][0]';
                formcount = 0;
            } else {
                formcount = parseInt(formcount) + 1;
                fieldname = 'tunnel_meta[tunnel_data][' + tunnel_count + '][tunnel_cards][' + formcount + ']';
            }
        }
        let new_html = $('\
			<div class="tunnel_add_card_form" data-formcount="' + formcount + '">\
				<table style="width:100%;">\
					<tbody>\
						<tr>\
							<th colspan="2" style="padding-top:0;">\
								<button class="btn btn-secondary js-delete-tunnel-card" type="button" style="float:right;margin-top:12px;">&times;</button>\
								<div style="display: flex;align-items: start;">\
                                    <input type="number" required placeholder="Card position no." name="' + fieldname + '[tc_pos]" value="' + crnt_form.find('.tunnel_card_position').val() + '">\
                                    <h2 class="js-tunnel-card-header">' + crnt_form.find('.tunnel_card_text').val() + '</h2>\
                                </div>\
							</th>\
						</tr>\
						<tr class="form-field">\
							<th scope="row" valign="top">\
								<label>Card Image</label>\
							</th>\
							<td>\
								<a href="#" class="button upload-img"> <img src="' + crnt_form.find('.tunnel_card_image').val() + '" style="width: 100%;max-width:100px;"></a>\
								<a href="#" class="remove-img">Remove image</a>\
								<input type="hidden" class="img-url tunnel_card_image" name="' + fieldname + '[tc_img]" value="' + crnt_form.find('.tunnel_card_image').val() + '">\
							</td>\
						</tr>\
						<tr>\
							<th>\
								<label for="tunnel_card_text">Card Text</label>\
							</th>\
							<td>\
								<textarea rows="3" style="width: 100%;" class="tunnel_card_text" name="' + fieldname + '[tc_txt]">' + crnt_form.find('.tunnel_card_text').val() + '</textarea>\
							</td>\
						</tr>\
						<tr>\
							<th>\
								<label for="tunnel_card_text">Add Text Box in Card Content</label>\
							</th>\
							<td>\
								<input type="text" placeholder="Type Yes or No" name="' + fieldname + '[tc_itba]" value="' + crnt_form.find('.tunnel_card_istextboxadd').val() + '" class="tunnel_card_istextboxadd">\
							</td>\
						</tr>\
						<tr>\
							<th>\
								<label for="tunnel_card_button1_text">Card Button 1 Text</label>\
								<br>\
								<input type="text" name="' + fieldname + '[tc_btn1_txt]" value="' + crnt_form.find('.tunnel_card_button1_text').val() + '" class="tunnel_card_button1_text">\
							</th>\
							<th>\
								<label for="tunnel_card_button1_action">Card Button 1 Action</label>\
								<br>\
								<select name="' + fieldname + '[tc_btn1_act]" class="tunnel_card_button1_action tunnel_card_button_action">\
									' + $(".tunnel_card_template .tunnel_card_button_action").html() + '\
								</select>\
								<input type="text" class="btn_action1_payment_text btn_action_payment_text btn_action_payment_details" placeholder="Payment page text" style="width: 100%;" name="' + fieldname + '[tc_btn1_pt]" value="' + crnt_form.find('.btn_action1_payment_text').val() + '">\
								<input type="text" class="btn_action1_payment_amount btn_action_payment_amount btn_action_payment_details" placeholder="Payment Amount" style="width: 100%;" name="' + fieldname + '[tc_btn1_pa]" value="' + crnt_form.find('.btn_action1_payment_amount').val() + '">\
								<input type="text" class="btn_action1_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;" name="' + fieldname + '[tc_btn1_link]" value="' + crnt_form.find('.btn_action1_link_to_other_website').val() + '">\
								<input type="text" class="btn_action1_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type Yes or No" style="width: 100%;" name="' + fieldname + '[tc_btn1_open]" value="' + crnt_form.find('.btn_action1_link_open_in_new_tab').val() + '">\
								<select hidden class="tunnel_card_button1_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;" name="' + fieldname + '[tc_btn1_st]">\
									' + crnt_form.find(".tunnel_card_button_action_subtunnel").html() + '\
								</select>\
								<input type="number" hidden class="btn_action1_subtunnel_card tunnel_card_button_action_subtunnel_card" placeholder="Mention card number" style="width: 100%;" name="' + fieldname + '[tc_btn1_act_st]" value="' + crnt_form.find('.btn_action1_subtunnel_card').val() + '">\
							</th>\
						</tr>\
						<tr>\
							<th>\
								<label for="tunnel_card_button2_text">Card Button 2 Text</label>\
								<br>\
								<input type="text" name="' + fieldname + '[tc_btn2_txt]" value="' + crnt_form.find('.tunnel_card_button2_text').val() + '" class="tunnel_card_button2_text">\
							</th>\
							<th>\
								<label for="tunnel_card_button2_action">Card Button 2 Action</label>\
								<br>\
								<select name="' + fieldname + '[tc_btn2_act]" class="tunnel_card_button2_action tunnel_card_button_action">\
									' + $(".tunnel_card_template .tunnel_card_button_action").html() + '\
								</select>\
								<input type="text" class="btn_action2_payment_text btn_action_payment_text btn_action_payment_details" placeholder="Payment page text" style="width: 100%;" name="' + fieldname + '[tc_btn2_pt]" value="' + crnt_form.find('.btn_action2_payment_text').val() + '">\
								<input type="text" class="btn_action2_payment_amount btn_action_payment_amount btn_action_payment_details" placeholder="Payment Amount" style="width: 100%;" name="' + fieldname + '[tc_btn2_pa]" value="' + crnt_form.find('.btn_action2_payment_amount').val() + '">\
								<input type="text" class="btn_action2_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;" name="' + fieldname + '[tc_btn1_link]" value="' + crnt_form.find('.btn_action2_link_to_other_website').val() + '">\
								<input type="text" class="btn_action2_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type Yes or No" style="width: 100%;" name="' + fieldname + '[tc_btn2_open]" value="' + crnt_form.find('.btn_action2_link_open_in_new_tab').val() + '">\
								<select hidden class="tunnel_card_button2_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;" name="' + fieldname + '[tc_btn2_st]">\
									' + crnt_form.find(".tunnel_card_button_action_subtunnel").html() + '\
								</select>\
								<input type="number" hidden class="btn_action2_subtunnel_card tunnel_card_button_action_subtunnel_card" placeholder="Mention card number" style="width: 100%;" name="' + fieldname + '[tc_btn2_act_st]" value="' + crnt_form.find('.btn_action2_subtunnel_card').val() + '">\
							</th>\
						</tr>\
						<tr>\
							<th>\
								<label for="tunnel_card_button3_text">Card Button 3 Text</label>\
								<br>\
								<input type="text" name="' + fieldname + '[tc_btn3_txt]" value="' + crnt_form.find('.tunnel_card_button3_text').val() + '" class="tunnel_card_button3_text">\
							</th>\
							<th>\
								<label for="tunnel_card_button3_action">Card Button 3 Action</label>\
								<br>\
								<select name="' + fieldname + '[tc_btn3_act]" class="tunnel_card_button3_action tunnel_card_button_action">\
									' + $(".tunnel_card_template .tunnel_card_button_action").html() + '\
								</select>\
								<input type="text" class="btn_action3_payment_text btn_action_payment_text btn_action_payment_details" placeholder="Payment page text" style="width: 100%;" name="' + fieldname + '[tc_btn3_pt]" value="' + crnt_form.find('.btn_action3_payment_text').val() + '">\
								<input type="text" class="btn_action3_payment_amount btn_action_payment_amount btn_action_payment_details" placeholder="Payment Amount" style="width: 100%;" name="' + fieldname + '[tc_btn3_pa]" value="' + crnt_form.find('.btn_action3_payment_amount').val() + '">\
								<input type="text" class="btn_action3_link_to_other_website link_to_other_website_input" placeholder="link to Another Website" style="width: 100%;" name="' + fieldname + '[tc_btn3_link]" value="' + crnt_form.find('.btn_action3_link_to_other_website').val() + '">\
								<input type="text" class="btn_action3_link_open_in_new_tab btn_action_link_open_in_new_tab" placeholder="Open page in New tab? Type Yes or No" style="width: 100%;" name="' + fieldname + '[tc_btn3_open]" value="' + crnt_form.find('.btn_action3_link_open_in_new_tab').val() + '">\
								<select hidden class="tunnel_card_button3_action_subtunnel tunnel_card_button_action_subtunnel" style="width: 100%;" name="' + fieldname + '[tc_btn3_st]">\
									' + crnt_form.find(".tunnel_card_button_action_subtunnel").html() + '\
								</select>\
								<input type="number" hidden class="btn_action3_subtunnel_card tunnel_card_button_action_subtunnel_card" placeholder="Mention card number" style="width: 100%;" name="' + fieldname + '[tc_btn3_act_st]" value="' + crnt_form.find('.btn_action3_subtunnel_card').val() + '">\
							</th>\
						</tr>\
					</tbody>\
				</table>\
			</div>');
        // setting select values in new html
        $(new_html).find('.tunnel_card_button1_action').val(crnt_form.find('.tunnel_card_button1_action').val())
        $(new_html).find('.tunnel_card_button2_action').val(crnt_form.find('.tunnel_card_button2_action').val())
        $(new_html).find('.tunnel_card_button3_action').val(crnt_form.find('.tunnel_card_button3_action').val())

        // setting the visiblity of input field "LinkToOtherWebsiteImputVlaue"
        let btn1type = crnt_form.find('.tunnel_card_button1_action').val() === "link_to_another_website" ? "text" : "hidden";
        let btn2type = crnt_form.find('.tunnel_card_button2_action').val() === "link_to_another_website" ? "text" : "hidden";
        let btn3type = crnt_form.find('.tunnel_card_button3_action').val() === "link_to_another_website" ? "text" : "hidden";
        $(new_html).find('.btn_action1_link_to_other_website').attr("type", btn1type);
        $(new_html).find('.btn_action1_link_open_in_new_tab').attr("type", btn1type);
        $(new_html).find('.btn_action2_link_to_other_website').attr("type", btn2type);
        $(new_html).find('.btn_action2_link_open_in_new_tab').attr("type", btn2type);
        $(new_html).find('.btn_action3_link_to_other_website').attr("type", btn3type);
        $(new_html).find('.btn_action3_link_open_in_new_tab').attr("type", btn3type);

        // setting the visiblity of input fields "Payment Text and Amount"
        let btnpayment1type = crnt_form.find('.tunnel_card_button1_action').val() === "payment_page" ? "text" : "hidden";
        let btnpayment2type = crnt_form.find('.tunnel_card_button2_action').val() === "payment_page" ? "text" : "hidden";
        let btnpayment3type = crnt_form.find('.tunnel_card_button3_action').val() === "payment_page" ? "text" : "hidden";
        $(new_html).find('.btn_action1_payment_text').attr("type", btnpayment1type);
        $(new_html).find('.btn_action1_payment_amount').attr("type", btnpayment1type);
        $(new_html).find('.btn_action2_payment_text').attr("type", btnpayment2type);
        $(new_html).find('.btn_action2_payment_amount').attr("type", btnpayment2type);
        $(new_html).find('.btn_action3_payment_text').attr("type", btnpayment3type);
        $(new_html).find('.btn_action3_payment_amount').attr("type", btnpayment3type);

        // setting the visibilty of select choose subtunnel
        if (crnt_form.find('.tunnel_card_button1_action_subtunnel').val() !== "") {
            $(new_html).find('.tunnel_card_button1_action_subtunnel').removeAttr('hidden');
            $(new_html).find('.tunnel_card_button1_action_subtunnel').val(crnt_form.find('.tunnel_card_button1_action_subtunnel').val())
            $(new_html).find('.btn_action1_subtunnel_card ').removeAttr('hidden');
        }
        if (crnt_form.find('.tunnel_card_button2_action_subtunnel').val() !== "") {
            $(new_html).find('.tunnel_card_button2_action_subtunnel').removeAttr('hidden');
            $(new_html).find('.tunnel_card_button2_action_subtunnel').val(crnt_form.find('.tunnel_card_button2_action_subtunnel').val());
            $(new_html).find('.btn_action2_subtunnel_card ').removeAttr('hidden');
        }
        if (crnt_form.find('.tunnel_card_button3_action_subtunnel').val() !== "") {
            $(new_html).find('.tunnel_card_button3_action_subtunnel').removeAttr('hidden');
            $(new_html).find('.tunnel_card_button3_action_subtunnel').val(crnt_form.find('.tunnel_card_button3_action_subtunnel').val());
            $(new_html).find('.btn_action3_subtunnel_card ').removeAttr('hidden');
        }

        // Finally appending the new card html
        crnt.parents(".tunnel_card_template").next(".saved_tunnel_cards").append(new_html);

        crnt.parents('.tunnel_add_card_form').find('input,textarea').val('');
        crnt.parents('.tunnel_add_card_form').css('display', 'none');
    });


    $(document).on("click", ".js-delete-tunnel-card", function() {
        let crnt = $(this);
        crnt.parents("div.tunnel_add_card_form").remove();
    });

    $(document).on("click", ".js-tunnel-card-header", function() {
        let crnt = $(this);
        crnt.parents("div.tunnel_add_card_form").toggleClass('max-height-auto');
    });


    $(document).on("click", ".add_subtunnel_tr", function() {
        let crnt = $(this);
        crnt.parents(".main-subtunnel-tr").next("tr").find(".subtunnel_template .subtunnel_add_form").css("display", "block");
    });


    $(document).on("click", ".js-save-subtunnel", function() {
        let crnt = $(this);
        crnt_form = crnt.parents('.subtunnel_add_form');
        let fieldtunnelname = '';
        let subtunnelcount = $(".sub_saved_tunnel_cards .subtunnel-data:last-child").attr("data-subtunnelcount");
        if (subtunnelcount === undefined) {
            subtunnelcount = 1;
            fieldtunnelname = 'tunnel_meta[tunnel_data][1][tunnel_name]';
        } else {
            subtunnelcount = parseInt(subtunnelcount) + 1;
            fieldtunnelname = 'tunnel_meta[tunnel_data][' + subtunnelcount + '][tunnel_name]';
        }

        let new_html = $('\
			<div class="subtunnel_add_form subtunnel-data" data-subtunnelcount="' + subtunnelcount + '">\
				<table style="width:100%;">\
					<tbody>\
						<tr class="tunnel-add-form-btn-container">\
							<th colspan="2" style="padding-top:0;">\
								<h2 class="js-tunnel-card-header">' + crnt_form.find('.sub_tunnel').val() + ' <button class="button add_tunnel_flow_card_tr" data-tunnel="subtunnel" type="button">Add Card</button><button class="btn btn-secondary js-delete-subtunnel" type="button" style="float:right;">&times;</button></h2>\
								<br>\
								<label for="sub_tunnels" style="margin-right: 10px;">Sub Tunnel Name</label> <input type="text" name="' + fieldtunnelname + '" value="' + crnt_form.find('.sub_tunnel').val() + '" class="sub_tunnel">\
							</th>\
						</tr>\
						<tr>\
							<td>\
								<div class="tunnel_card_template"></div>\
								<div class="saved_tunnel_cards subTunnels_saved_tunnel_cards"></div>\
							</td>\
						</tr>\
					</tbody>\
				</table>\
			</div>');

        // Finally appending the new card html
        crnt.parents(".main-subtunnel-tr").find(".sub_saved_tunnel_cards").append(new_html);

        crnt.parents('.subtunnel_add_form').find('.sub_tunnel').val('');
        crnt.parents('.subtunnel_add_form').css('display', 'none');
    });

    $(document).on("click", ".js-delete-subtunnel", function() {
        let crnt = $(this);
        crnt.parents("div.subtunnel-data").remove();
    });


    $(document).on("change", ".tunnel_card_button_action", function() {

        let crnt = $(this);
        if (crnt.val() === "payment_page") {
            crnt.parent("th").find("input.btn_action_payment_details").attr("type", "text");
        } else {
            crnt.parent("th").find("input.btn_action_payment_details").attr("type", "hidden");
        }

        if (crnt.val() === "link_to_another_website") {
            crnt.parent("th").find("input.link_to_other_website_input").attr("type", "text");
            crnt.parent("th").find("input.btn_action_link_open_in_new_tab").attr("type", "text");
        } else {
            crnt.parent("th").find("input.link_to_other_website_input").attr("type", "hidden");
            crnt.parent("th").find("input.btn_action_link_open_in_new_tab").attr("type", "hidden");
        }

        if (crnt.val() === "choose_sub_tunnel") {
            crnt.parent("th").find("select.tunnel_card_button_action_subtunnel, .tunnel_card_button_action_subtunnel_card").removeAttr("hidden");
        } else {
            crnt.parent("th").find("select.tunnel_card_button_action_subtunnel, .tunnel_card_button_action_subtunnel_card").attr("hidden", "");
        }
    });

});


/*
 * ---------------------------Upload image-------------------------------
 */
window.addEventListener('click', (e) => {
    if (!e.target.closest('.upload-img')) return;

    e.preventDefault()

    const addBtn = e.target.closest('.upload-img')
    const container = addBtn.closest('.form-field')
    const removeBtn = container.querySelector('.remove-img')
    const imgUrl = container.querySelector('.img-url')

    const customUploader = wp.media({
        title: 'Insert image',
        button: {
            text: 'Select this image'
        },
        multiple: false
    }).open()

    customUploader.on('select', () => {
        const data = customUploader.state().get('selection').first().toJSON()

        const node = document.createElement('img')
        node.src = data.url
        node.style.width = '100%'
        addBtn.replaceChildren(node)

        imgUrl.value = data.url
        imgUrl.type = 'text'

        removeBtn.style.display = ''
    })
})
window.addEventListener('click', (e) => {
    if (!e.target.closest('.remove-img')) return;

    e.preventDefault()

    const removeBtn = e.target.closest('.remove-img')
    const container = removeBtn.closest('.form-field')
    const addBtn = container.querySelector('.upload-img')
    const imgUrl = container.querySelector('.img-url')

    addBtn.innerHTML = 'Upload image'
    imgUrl.value = ''
    imgUrl.type = 'hidden'
    removeBtn.style.display = 'none'
})


/*
 * ---------------------------Add secondary question-------------------------------
 */
// window.addEventListener('click', (e) => {
// 	if ( !e.target.closest('.add-button') ) return;

// 	const addBtn = e.target.closest('.add-button')
// 	const mainBlock = addBtn.closest('.form-field')
// 	const temp = mainBlock.querySelector('#quest-temp')
// 	const container = mainBlock.querySelector('.sec-quest__container')
// 	const content = temp.content.cloneNode(true)

// 	const existQuests = container.querySelectorAll('input')
// 	const lastQuest = existQuests[existQuests.length - 1]

// 	const inputQuest = content.querySelector('input[name="cat_meta[sec_question][]"]')
// 	const inputYes = content.querySelector('#yes-sec-answer')
// 	const inputNo = content.querySelector('#no-sec-answer')

// 	if (lastQuest) {
// 		const lastNumb = +lastQuest.id.split('_')[1]

// 		inputYes.id = `yes-sec-answer_${lastNumb + 1}`
// 		inputYes.nextElementSibling.htmlFor = `yes-sec-answer_${lastNumb + 1}`
// 		inputNo.id = `no-sec-answer_${lastNumb + 1}`
// 		inputNo.nextElementSibling.htmlFor = `no-sec-answer_${lastNumb + 1}`

// 		inputQuest.name = `cat_meta[sec_question][${lastNumb + 1}]`
// 		inputYes.name = `cat_meta[sec_answer][${lastNumb + 1}]`
// 		inputNo.name = `cat_meta[sec_answer][${lastNumb + 1}]`
// 	}
// 	else {
// 		inputYes.id = 'yes-sec-answer_0'
// 		inputYes.nextElementSibling.htmlFor = 'yes-sec-answer_0'
// 		inputNo.id = 'no-sec-answer_0'
// 		inputNo.nextElementSibling.htmlFor = 'no-sec-answer_0'

// 		inputQuest.name = 'cat_meta[sec_question][0]'
// 		inputYes.name = 'cat_meta[sec_answer][0]'
// 		inputNo.name = 'cat_meta[sec_answer][0]'
// 	}

// 	container.append(content)
// })
// window.addEventListener('click', (e) => {
// 	if ( !e.target.closest('.remove-btn') ) return;

// 	const removeBtn = e.target.closest('.remove-btn')
// 	const questBlock = removeBtn.closest('.sec-quest__content')

// 	questBlock.remove()
// })