<?php 
/**
 * Question Main Class
 * */
 
class WQT_Questions {
	
	var $Question_paper_id;
	
	private static $ins = null;

	function __construct( $Question_post_id ){
		
		$this->Question_paper_id = $Question_post_id;
	}

	public static function get_instance() {
        // create a new object if it doesn't exist.
        is_null(self::$ins) && self::$ins = new self;
        return self::$ins;
    }

    /* ==== get saved quiz ==== */
	function get_quiz_saved_field(){
		$quiz_saved_field = get_post_meta($this->Question_paper_id, 'question_meta_fields', true);
		
		return apply_filters('quiz_saved_field', $quiz_saved_field);	
	}

	/* ==== get the total quiz marks ==== */
    function wqt_get_total_marks(){
        $total_quiz_marks = get_post_meta($this->Question_paper_id ,'total_marks' , true );
        if( ! $total_quiz_marks ) return 0;

        return $total_quiz_marks;
    }

    /* ==== get the obtain quiz marks ==== */
    function wqt_get_obtain_marks(){
        $obtain_quiz_marks = get_post_meta($this->Question_paper_id ,'marks_obtains' , true );
        if( ! $obtain_quiz_marks ) return 0;

        return $obtain_quiz_marks;
    }

    /* ==== get the quiz marks percentage ==== */
    function wqt_get_quiz_marks_percentage(){
        $quiz_percentage = get_post_meta($this->Question_paper_id ,'overall_percentage' , true );
        if( ! $quiz_percentage ) return 0;

        return $quiz_percentage . '%';
    }

    /* ==== get the quiz marks in wqt cpt id before submit quiz  ==== */
    function wqt_cpt_total_marks_before_sumbit(){
        $total_marks = 0;
        $quiz_meta   = $this->get_quiz_saved_field();
        
        if (is_array($quiz_meta)) {
            
            foreach ($quiz_meta as $index => $meta) {
                if (isset($meta['mark']) && !empty($meta['mark']) ) {
                    $total_marks += $meta['mark']; 
                }
            }
        }

        return $total_marks; 
    }

    /* ==== total question of quiz ==== */
    function wqt_total_question_of_quiz(){
        $all_quiz_meta  = $this->get_quiz_saved_field();

        return count($all_quiz_meta);
    }


    /* ==== get the user overall quiz time after submit quiz ==== */
    function wqt_get_overall_time(){
        $time_elapsed = get_post_meta($this->Question_paper_id , 'overall_time' , true);

        if( ! $time_elapsed ) return 0;

        return $time_elapsed;
    }

    /* ==== get correct question out of total question ==== */
    function wqt_get_correct_question(){
        
        $total_question   = $this->get_total_question();
        $correct_question = $this->get_total_correct_question();

        $show_state       = $correct_question . '/' . $total_question;

       if( ! $show_state ) return 0;

        return $show_state;    
    }

    /* ==== get result show in pai chart ==== */
    function pai_chart_stat(){

        $total_question   = $this->get_total_question();
        $correct_question = $this->get_total_correct_question();


        $wrong_question   = $total_question - $correct_question;

        $Q_counter        = array(
                            'correct'=>$correct_question,
                            'wrong'=>$wrong_question,
                        );

        return $Q_counter;
    }

	/* ==== get total question of quiz ==== */
	function get_total_question(){
		$total_question = get_post_meta($this->Question_paper_id, 'wqt_total_question', true);
		return apply_filters('total_question', $total_question);	
	}

	/* ==== get total correct question of quiz ==== */
	function get_total_correct_question(){
		$total_correct_answers = get_post_meta($this->Question_paper_id,'wqt_user_correct_answers', true);
		return apply_filters('total_correct_answers', $total_correct_answers);	
	}

	/*  ==== Get quizz form options ==== */
	function get_option( $key ) {
		$question_option = get_post_meta($this->Question_paper_id, $key, true);
		return apply_filters('question_option' , $question_option, $key);
	}
}