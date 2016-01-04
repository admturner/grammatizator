<?php
/**
 * Custom Grammatizator template tags
 *
 * @package WordPress
 * @subpackage Grammatizator
 * @since Grammatizator 0.8.1
 */

if ( ! function_exists( 'grammatizator_post_thumbnail' ) ) :
/**
 * Displays the optional post thumbnail (feature)
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views. Borrowed this from Twenty Sixteen.
 *
 * Create your own grammatizator_post_thumbnail() function to override in a child theme.
 *
 * @since Grammatizator 0.8.1
 */
function grammatizator_post_thumbnail( $featuresize = '' ) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	$thumb_id = get_post_thumbnail_id();

	if ( is_singular() ) : 

		echo '<figure id="attachment_' . $thumb_id . '" aria-describedby="figcaption_' . $thumb_id . '" class="wp-feature" itemscope itemtype="http://schema.org/ImageObject">';
        	the_post_thumbnail( $featuresize );
        echo '</figure><!-- .wp-feature -->';

	else : 
		
		echo '<figure id="attachment_' . $thumb_id . '" aria-describedby="figcaption_' . $thumb_id . '" class="wp-feature" itemscope itemtype="http://schema.org/ImageObject">';
        ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( $featuresize, array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
			</a>
		<?php echo '</figure><!-- .wp-feature -->';

	endif; // End is_singular()
}
endif;

if ( ! function_exists( 'grammatizator_post_thumbnail_caption' ) ) :
/**
 * Displays the caption of the optional post thumbnail (feature)
 *
 * Create your own grammatizator_post_thumbnail_caption() function to 
 * override in a child theme.
 *
 * @since Grammatizator 0.8.1
 */
function grammatizator_post_thumbnail_caption() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	$id = get_post_thumbnail_id();
    $img = wp_prepare_attachment_for_js( $id );
    echo '<p id="figcaption_' . $id . '" class="wp-caption-text" itemprop="description">Headline image: ' . $img['caption'] .'</figcaption></figure>'; 
}
endif;

