<?php
/**
 * The comments page template.
 *
 * @package Grammatizator
 */

// Don't load if commenting isn't allowed.
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-container">

	<?php if ( have_comments() ) : ?>

		<section class="commentlist">
			<h3 id="comments-title"><?php comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), __( '<span>%</span> Comments', 'bonestheme' ) ); ?></h3>

			<?php
			wp_list_comments( array(
				'style'             => 'div',
				'short_ping'        => true,
				'avatar_size'       => 40,
				'callback'          => 'bones_comments',
				'type'              => 'all',
				'reply_text'        => __( 'Reply', 'bonestheme' ),
				'page'              => '',
				'per_page'          => '',
				'reverse_top_level' => null,
				'reverse_children'  => '',
			) );
			?>
		</section>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'bonestheme' ) ); ?></div>
				<div class="comment-nav-next"><?php next_comments_link( __( 'More Comments &rarr;', 'bonestheme' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bonestheme' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php comment_form(); ?>

</div>
