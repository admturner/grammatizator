<?php
/**
 * Grammatizator shortcodes
 *
 * Set up the shortcodes used to add some more complex markup
 * to things like blockquotes in the theme. This is called via
 * include in the main functions.php file.
 *
 * Author: Adam Turner
 * @link https://github.com/admturner/grammatizator
 * Built on Bones by Eddie Machado {@link http://themble.com/bones/}
 *
 * @todo Clean up formatting of PHP comments.
 * @todo Generalize: Add if (!function_exists()) check to prevent clashes
 *
 * @package Grammatizator
 *
 * @since 0.4
 */

add_shortcode( 'gblockquote', 'shortcode_gram_blockquote' );
add_shortcode( 'gpullquote', 'shortcode_gram_pullquote' );
add_shortcode( 'grammusers', 'gramm_list_authors_shortcode' );
add_shortcode( 'grammcats', 'gramm_list_cats_shortcode' );

/**
 * Blockquote figure shortcode, optional attribution
 *
 * Shortcode to generate blockquote markup wrapped in <figure> tags
 * and optionally in include the source in <figcaption> tags after
 * the blockquote. Uses wptexturize() on the source info to parse
 * things like special characters, and do_shortcode() on the content
 * so you can embed shortcodes inside the blockquote if needed.
 *
 * Default usage (no <p> tags):
 *
 *    [gblockquote]Format for single-line blockquote, with no attribution.[/gblockquote]
 *
 * Multiline usage (wraps content in <p> tags):
 *
 *    [gblockquote]
 *
 *    Multiline blockquote, with no attribution, paragraph one.
 *
 *    Multiline blockquote, paragraph two.
 *
 *    [/gblockquote]
 *
 * Attribution usage
 *
 *    [gblockquote source='Any standard HTML content']
 */
function shortcode_gram_blockquote( $atts, $content = null ) {
	$defaults = array(
		'type'   => 'quote',
		'source' => '',
	);

	$args = shortcode_atts( $defaults, $atts, 'gblockquote' );

	if ( ! empty( $source ) ) {
		$quote = sprintf( '<figure class="%1$s"><blockquote>%2$s</blockquote><figcaption>%3$s</figcaption></figure>',
			esc_attr( $args['type'] ),
			do_shortcode( $content ),
			wptexturize( $args['source'] )
		);
	} else {
		$quote = sprintf( '<figure class="%1$s"><blockquote>%2$s</blockquote></figure>',
			esc_attr( $args['type'] ),
			do_shortcode( $content )
		);
	}

	return $quote;
}

/**
 * Pull quote shortcode
 *
 * Shortcode to generate pull quote markup wrapped in <aside> tags.
 * Pull quotes ought to be from the current piece, so attribution is
 * not needed. Uses do_shortcode() on the content so you can embed
 * shortcodes inside the blockquote if needed.
 *
 * Default usage (no <p> tags):
 *
 *    [gpullquote]Format for single-line blockquote, with no attribution.[/gpullquote]
 *
 * Multiline usage (wraps content in <p> tags):
 *
 *    [gpullquote]
 *
 *    Multiline blockquote, with no attribution, paragraph one.
 *
 *    Multiline blockquote, paragraph two.
 *
 *    [/gpullquote]
 *
 */
function shortcode_gram_pullquote( $atts, $content = null ) {
	$defaults = array(
		'type'  => 'quote',
		'class' => 'alignright',
	);

	$args = shortcode_atts( $defaults, $atts, 'gpullquote' );

	$quote = sprintf( '<aside class="%1$s %2$s"><blockquote>%3$2</blockquote></aside>',
		esc_attr( $args['type'] ),
		esc_attr( $args['class'] ),
		do_shortcode( $content )
	);

	return $quote;
}

/**
 * Shortcode for Custom List Users
 *
 * Shortcode calling the custom list of blog users, which can
 * be found in the theme's functions.php. That function is
 * built based on WordPress' native wp_list_users function,
 * but this one returns more user info and uses the built in "role"
 * parameter for the get_users() WordPress wrapper function
 * instead of a manual "exclude admin" setting. Roles should
 * be specified as: Admins = 'administrator'; Editors = 'editor';
 * Authors = 'author'; Contributors = 'contributor'; Subscribers =
 * 'subscriber'.
 *
 * Here's an example for showing only editors, with bios trimmed
 * to 55 words, and 40x40 pixel avatars:
 * [grammusers role='editor' biolength='340' avatarsize='40']
 *
 * @uses get_users();
 * @uses wp_trim_words();
 * @since Grammatizator 0.6
 */
function gramm_list_authors_shortcode( $atts ) {
	$defaults = array(
		'orderby'         => 'name',
		'order'           => 'ASC',
		'role'            => '',
		'include'         => array(),
		'show_fullname'   => true,
		'show_grammtitle' => true,
		'social_links'    => true,
		'biolength'       => 55,
		'avatarsize'      => 90,
		'layout'          => '',
		'heading_tag'     => 'h3',
		'echo'            => true,
	);

	$args = shortcode_atts( $defaults, $atts, 'grammusers' );

	ob_start();

	gramm_list_authors( $args );
	$output_string = ob_get_contents();

	ob_end_clean();

	return $output_string;
}

/**
 * Custom List Categories Shortcode
 *
 * This is a shortcode for fetching the category list.
 *
 * @todo Write custom function in functions.php to format in more useful way using get_category_list() and category_description()
 * @since Grammatizator 0.4
 */
function gramm_list_cats_shortcode( $atts ) {
	$defaults = array(
		'hide_empty'         => 0,
		'exclude'            => 1,
		'use_desc_for_title' => 0,
		'hierarchical'       => 0,
		'title_li'           => '',
		'echo'               => true,
	);

	$args = shortcode_atts( $defaults, $atts, 'grammcats' );

	$query = 'hide_empty=' . $args['hide_empty'] . '&exclude=' . $args['exclude'] . '&use_desc_for_title=' . $args['use_desc_for_title'] . '&hierarchical=' . $args['hierarchical'] . '&title_li=' . $args['title_li'] . '';

	ob_start();

	wp_list_categories( $query );
	$output_string = ob_get_contents();

	ob_end_clean();

	return $output_string;
}
