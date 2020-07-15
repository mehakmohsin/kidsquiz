/*
Control Frontend side
*/
"use strict";
jQuery(function($){


    var wqt_form_modified = 0;
    $('.input_check').click(function(e){
        wqt_form_modified = 1;
    });

    // on click start instruction box hide and quizz show
    $('#wqt_instruction_box').click(function(e) {
        $(".wqt-instruction-wrapper").hide();
        $(".container-fluid").show();

    });

    var time_taken = 0;
    var time_sep = 0;
    
    if( wqt_vars.show_timer === 'yes' ) {
        var quiz_time = [] ;
    }else{
        quiz_time = 0;
    }
    
    $('.input_check').click(function(e) {
        e.preventDefault();
        var titleIcon = "square-o";

        if( wqt_vars.multiple_answers === 'multiple_ans' ) {

            var $this = $(this);
            var $parent = $this.closest('.wqt_next_question');
            $this.toggleClass("checked");
            var max_ans_allowed = parseInt($parent.attr('dat-maxans'));
            var checked_answers = $parent.find(".input_check.checked").length;

            if( checked_answers > max_ans_allowed ) {
                $this.removeClass("checked");
                swal({title: '<span class="swt-title">Max '+max_ans_allowed+ ' Answers Allowed</span>' , confirmButtonColor: '#217ac8', html:true});
                return ;
            }


            if( checked_answers == max_ans_allowed ) {
                $parent.find('.quiz-btn').removeClass('next-btn-hide');
            }else{
                $parent.find('.quiz-btn').addClass('next-btn-hide');
            }

            $(this).toggleClass('btn-info');
            $(this).find('i').toggleClass('fa-' + titleIcon).toggleClass('fa-check-' + titleIcon);
            $(this).find('.togglecheck').prop('checked', function(_, checked) {
                return !checked;
            });
        }else{

            var $this = $(this);
            var $parent = $this.closest('.wqt_next_question');

            $parent.find('.quiz-btn').removeClass('next-btn-hide');
            
            $parent.find(".togglecheck").each(function(index, item) {
                $(item).prop('checked', false);
            });
            $(this).find(".togglecheck").each(function(index, item) {
                $(item).prop('checked', true);
            });

            $(".input_check").each(function(index, item) {
                $(item).removeClass('btn-info');
                $(item).find('i').removeClass('fa-check-' + titleIcon);
                $(item).find('i').addClass('fa-square-o');
            });

            $(this).addClass('btn-info');
            $(this).find('i').addClass('fa-check-' + titleIcon);
            $(this).find('i').removeClass('fa-square-o');
        }
        
    });


    // launch stopwatch plugin to set time
    if( wqt_vars.show_timer === 'yes' ) {

        var stopwatch = $('.timer').stopwatch().bind('tick.stopwatch', function(e, elapsed){
            if (elapsed == 0) {
                var end_time = millisToMinutesAndSeconds(wqt_vars.time_limit);
                time_taken += wqt_vars.time_limit;
                quiz_time.push(end_time);
                get_next_mcqs();
                $('.timer').stopwatch('reset');
            }
        }).stopwatch('start');
    } 

    // Prevent browser window from close is quiz is being taken
    $(window).on( 'beforeunload', function() {

        if (wqt_form_modified == 1) {
            return wqt_vars.onclose_msg;
        }
     });


    $("input[name='commit']").click(function() {
        wqt_form_modified = 0;
    });

    
    // Submitting quiz 
    $("#mcqs-front-quizz").submit(function(e){
        e.preventDefault();
        var wqt_url = $("#wqt_url").val();
        var quiz_id = $("#quiz_id").val();
         $("#form_submit").show(); 
         
        var total_quiz_time = millisToMinutesAndSeconds(time_taken);
        
        var data = $(this).serialize() + "&total_quiz_time=" + total_quiz_time + "&quiz_time="+ quiz_time +"&quiz_id="+ quiz_id;
        $.post(wqt_vars.ajax_url, data, function(data){
            $("#form_submit").hide();
    
            swal({title:data, type: "success", confirmButtonColor: '#217ac8', html:true},
            function(){ 
                if (wqt_url != '') {
                    window.location.href = wqt_url;
                    
                }else{
                    $('.register_form').hide();
                    $('.end_quiz').show();
                }
            });
        });
    });
    

    // function that click contineu button to check next question render
    function get_next_mcqs(){
        var next_question = $(".wqt_next_question:visible").next(".wqt_next_question");
        if ( next_question.length == 0 ) {
            if( wqt_vars.show_timer === 'yes' ) {
                $('.timer').stopwatch('destroy');
            }
            $('.register_card').removeClass('register_hide');
            $('.modal_hide').hide();
        }
        $(".wqt_next_question").hide();
        next_question.show();
    }


    // contineu button for next question
    $(".nextQuestion").click(function(e) {
       e.preventDefault();
            if( wqt_vars.show_timer === 'yes' ) { 

                var timer2 = stopwatch.stopwatch('getTime');
                var given_time = 60000;
                time_sep = given_time - timer2;
                time_taken += time_sep;
                var the_time = millisToMinutesAndSeconds(time_sep);
                quiz_time.push(the_time);
                $('.timer').stopwatch('reset');
            }
        get_next_mcqs();
    });


    // calculate total time after all question is checked
    function millisToMinutesAndSeconds(millis) {
        var minutes = Math.floor(millis / 60000);
        var seconds = ((millis % 60000) / 1000).toFixed(0);
        return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
    }

});