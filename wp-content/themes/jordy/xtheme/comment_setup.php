<?php

namespace Xtheme_Club;

class Comment_Setup {
	public $avatar_size;

	public function __construct() {
		$this->avatar_size = baseline( 4 );

		add_filter( 'wp_list_comments_args', [ $this, 'list_comments_args' ] );
		add_filter( 'comment_form_defaults', [ $this, 'comment_form' ] );
	}

	public function list_comments_args( $args ) {
		$args['walker']      = new Comment_Template();
		$args['avatar_size'] = $this->avatar_size;

		return $args;
	}

	public function comment_form() {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$mark_req  = $req ? '*' : '';
		$aria_req  = $req ? " aria-required='true'" : '';
		$html_req  = $req ? " required='required'" : '';

		$fields = [
			'author' => sprintf(
				'<input id="author" placeholder="%1$s %2$s" name="author" type="text" value="%3$s" size="30" maxlength="245" %4$s %5$s />',
				esc_attr__( 'Name', 'jordy' ),
				$mark_req,
				esc_attr( $commenter['comment_author'] ),
				$aria_req,
				$html_req
			),
			'email'  => sprintf(
				'<input id="email" placeholder="%1$s %2$s" name="email" type="email" value="%3$s" size="30" maxlength="100" aria-describedby="email-notes"  %4$s %5$s />',
				esc_attr__( 'Email', 'jordy' ),
				$mark_req,
				esc_attr( $commenter['comment_author_email'] ),
				$aria_req,
				$html_req
			),
		];

		$defaults = [
			'fields'             => $fields,
			'comment_field'      => sprintf(
				'<textarea id="comment" placeholder="%s" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>',
				esc_attr__( 'Comment', 'jordy' )
			),
			'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h4>',
		];

		return $defaults;
	}
}
