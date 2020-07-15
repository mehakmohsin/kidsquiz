"use strict";
jQuery(function($) {

    var post_id = $('input[name="post_ID"]').val();

    $(".wp-color").wpColorPicker();

    $('body').find('.wqt-selecter').select2({
        placeholder: 'Select',
        width: "100%",
    });

    $('.wqt-multple-selecter2').select2({
        placeholder: 'Select',
        width: "100%",
        multiple: true
    });


    /**
        check edit fields yes or no for basic setting
    **/
    if ($('.edit_ok:input[type=radio]:checked')) {

        $(".wqt-quiz-settings-wrapper").each(function(index, item) {
            var edit_field = $(item).find('.edit_ok:input[type=radio]:checked');
            if (edit_field && edit_field.val() == 'yes') {
                edit_field.parent().addClass('btn-default active');
            }
            else {
                edit_field.parent().addClass('btn-default active');
            }
        });
    }


    if ($('.edit_ok:input[type=radio]:checked')) {

        $(".wqt-student-wrapper").each(function(index, item) {
            var edit_field = $(item).find('.edit_ok:input[type=radio]:checked');
            if (edit_field && edit_field.val() == 'yes') {
                edit_field.parent().addClass('btn-default active');
            }
            else {
                edit_field.parent().addClass('btn-default active');
            }
        });
    }

    /* ====== Questions sortable ====== */
    $(".wqt-questions-wrapper ul").sortable();


    /* ====== No Multiple answer selected ====== */
    $(document).on('click', 'input.wqt-meta-ans-check', function() {

        var div = $(this).closest('.wqt-questions-section');
        div.find('input.wqt-meta-ans-check').not(this).prop('checked', false);
    });

    var multiple_class = $(".wqt-check-ans-list").val();

    if (multiple_class != 'multiple_ans') {
        $('.wqt-rm-ad-class').addClass('wqt-meta-ans-check');
    }

    $(document).on('change', '.wqt-check-ans-list', function(e) {

        e.preventDefault();
        var val = $(this).val();
        if (val == 'multiple_ans') {
            $('.wqt-rm-ad-class').removeClass('wqt-meta-ans-check');
        }
        else {
            $('.wqt-rm-ad-class').addClass('wqt-meta-ans-check');
        }
    });

    /* ====== Remove Questions ======= */
    $('.wqt-questions-wrapper').on('click', '.wqt-question-rm', function(e) {
        e.preventDefault();
        var $this = $(this);
        var li = $('.wqt-questions-section').length;
        if (li > 1) {
            swal({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55 ",
                cancelButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true
            }, function(isConfirm) {
                if (!isConfirm) return;
                var question_remove = $this.closest('li').remove();
            });
        }
        else {
            swal("sorry! you can not remove more question", "", "error");
        }
    });

    /* ====== All Saved Answer Of Questions Remove (Not Last) ===== */
    $('.wqt-answers-clone').each(function(i, meta_field) {

        var selector_btn = $(this).closest('.wqt-questions-section');
        selector_btn.find('.wqt-add-rm-controle button').not(':last').removeClass('wqt-add-answers').addClass('wqt-remove-answer')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus" aria-hidden="true"></i>');

    });

    var field_no = 1;

    /* ====== Add new questions ====== */

    var new_id = 0;
    $(document).on('click', '.wqt-add-question', function(e) {
        e.preventDefault();

        var $this = $(this);
        var selector = $this.closest('wqt-questions-section');
        $('.wqt-questions-section').find('.wqt-multple-selecter2').select2('destroy');
        // last question clone
        var question = $('.wqt-questions-section:last').clone();



        question.find('.wqt-rm-ad-class').prop('checked', false);
        question.find('input[type="text"]').val('');

        question.find('.wqt_answer_id0').val(0);
        var last_ans_id = parseInt(question.find('.wqt-answers-section').attr('data-answer-id'));
        field_no = last_ans_id + 1;
        question.find('.wqt-answers-section').attr('data-answer-id', field_no);
        $('.wqt_question_id0').val(field_no);

        var box_input_id = 'wqt-upload-img-' + field_no;
        question.find('.wqt-img-box-js').attr('id', box_input_id);

        question.find("#" + box_input_id).val('');
        question.find(".wqt-add-question-img").removeClass('hidden');
        question.find(".wqt-dialog-img").addClass('hidden');
        question.find(".wqt-del-question-img").addClass('hidden');

        question.find('.wqt-answers-clone').not(':last').remove();

        question.find('.wqt-handle-ans-val').val('q_' + field_no + '_ans_' + new_id + '');
        // handle questions name meta
        question.find('.wqt-meta-field').each(function(i, meta_field) {

            var field_name = 'wqt[' + field_no + '][' + $(meta_field).attr('data-metatype') + ']';
            $(meta_field).attr('name', field_name);
        });

        // handle answers name meta
        question.find('.wqt-meta-ans').each(function(i, meta_field) {

            var field_name = 'wqt[' + field_no + '][answer_meta][' + new_id + '][' + $(meta_field).attr('data-metatype') + ']';
            $(meta_field).attr('name', field_name);
        });

        var $append = $('.wqt-questions-wrapper .wqt-question-append-js')

        // append new question
        question.find($append).end().appendTo($append);

        field_no++;

        $('.wqt-multple-selecter2').select2({
            placeholder: 'Select',
            width: "100%",
            multiple: true
        });
    });


    /* ====== Duplicate Questions ======= */
    $('.wqt-questions-wrapper').on('click', '.wqt-question-duplicate', function(e) {
        e.preventDefault();
        var $this = $(this);
        var selector = $this.closest('.wqt-questions-section');
        $('.wqt-questions-section').find('.wqt-multple-selecter2').select2('destroy');

        // last question clone
        var question = selector.clone();

        question.find('.wqt_answer_id0').val(0);

        var last_ans_id = parseInt($('.wqt_question_id0').val());

        field_no = last_ans_id + 1;

        question.find('.wqt-questions-section:last').attr('data-index', field_no);
        question.find('.wqt-answers-section').attr('data-answer-id', field_no);

        $('.wqt_question_id0').val(field_no);

        var box_input_id = 'wqt-upload-img-' + field_no;
        question.find('.wqt-img-box-js').attr('id', box_input_id);

        question.find("#" + box_input_id).val('');
        question.find(".wqt-add-question-img").removeClass('hidden');
        question.find(".wqt-dialog-img").addClass('hidden');
        question.find(".wqt-del-question-img").addClass('hidden');

        question.find('.wqt-answers-clone').not(':last').remove();

        question.find('.wqt-handle-ans-val').val('q_' + field_no + '_ans_' + new_id + '');

        // handle questions name meta
        question.find('.wqt-meta-field').each(function(i, meta_field) {

            var field_name = 'wqt[' + field_no + '][' + $(meta_field).attr('data-metatype') + ']';
            $(meta_field).attr('name', field_name);
        });

        // handle answers name meta
        question.find('.wqt-meta-ans').each(function(i, meta_field) {

            var field_name = 'wqt[' + field_no + '][answer_meta][' + new_id + '][' + $(meta_field).attr('data-metatype') + ']';
            $(meta_field).attr('name', field_name);
        });

        var $append = $('.wqt-questions-wrapper .wqt-question-append-js')

        // append new question
        question.find($append).end().appendTo($append);

        field_no++;

        $('.wqt-multple-selecter2').select2({
            placeholder: 'Select',
            width: "100%",
            multiple: true
        });

    });


    /* ====== Add new answers of questions ======= */
    var answer_id = 1;
    $('.wqt-questions-wrapper').on('click', '.wqt-add-answers', function(e) {

        e.preventDefault();
        var $this_select = $(this).closest('.wqt-answers-section');
        var last_id = parseInt($this_select.find('.wqt_answer_id0').val());
        last_id += answer_id;
        $this_select.find('.wqt_answer_id0').val(last_id);
        var index = $this_select.attr('data-answer-id');
        var answers = $('.wqt-answers-clone:last').clone();

        answers.find('input[type="checkbox"]').prop('checked', false);
        answers.find('input[type="text"]').val('');
        answers.find('.wqt-meta-ans').each(function(i, meta_field) {

            var field_name = 'wqt[' + index + '][answer_meta][' + last_id + '][' + $(meta_field).attr('data-metatype') + ']';
            $(meta_field).attr('name', field_name);
        });

        answers.find('.wqt-handle-ans-val').val('q_' + index + '_ans_' + last_id + '');

        answers.find('.wqt-answers-section').end().appendTo($this_select);

        last_id++;

        $('.wqt-answers-section').find('.wqt-answers-clone:not(:last) .wqt-add-answers')
            .removeClass('wqt-add-answers').addClass('wqt-remove-answer')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<i class="fa fa-minus" aria-hidden="true"></i>');
    }).on('click', '.wqt-remove-answer', function(e) {
        $(this).parents('.wqt-answers-clone:first').remove();
        e.preventDefault();
        return false;
    });


    /* ===== send result and message email ==== */
    $(".wqt_email_btn").on('click', function(e) {
        e.preventDefault();

        var this_load = $(this);
        this_load.button('loading');

        var message = $("#wqt_emails_message").val();
        var subject = $("#wqt_email_subject").val();
        var emails = $("#wqt_user_email").val();
        var post_id = $("#result_id").val();

        var data = {
            'action': 'wqt_result_send',
            'message': message,
            'subject': subject,
            'email': emails,
            'post_id': post_id,
        }

        jQuery.post(ajaxurl, data, function(resp) {

            if (resp.success) {
                $('.wqt_result_message_submit').find('.wqt_result_form_alert').show().html(resp.message).css({
                    "background": '#8BC34A',
                    "border-left": '4px solid #4CAF50',
                    "border-right": '4px solid #4CAF50'
                });
            }
            else {
                $('.wqt_result_message_submit').find('.wqt_result_form_alert').show().html(resp.message).css({
                    "background": '#8BC34A',
                    "border-left": '4px solid #4CAF50',
                    "border-right": '4px solid #4CAF50'
                });
            }

            this_load.button('reset');
            setTimeout(function() {
                $('.wqt_result_form_alert').hide();
            }, 3000);
        });
    });
});
