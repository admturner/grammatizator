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
			printf( '<figure id="attachment_%1$s" aria-describedby="figcaption_%1$s" class="wp-feature" itemscope itemtype="http://schema.org/ImageObject">%2$s</figure>', // wpcs: XSS ok.
				esc_attr( $thumb_id ),
				the_post_thumbnail( $featuresize )
			);
		else :
			?>
			<figure id="attachment_<?php echo esc_attr( $thumb_id ); ?>" aria-describedby="figcaption_<?php echo esc_attr( $thumb_id ); ?>" class="wp-feature" itemscope itemtype="http://schema.org/ImageObject">
				<a class="post-thumbnail" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
					<?php the_post_thumbnail( $featuresize, array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
				</a>
			</figure>
			<?php
		endif;
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

		$id  = get_post_thumbnail_id();
		$img = wp_prepare_attachment_for_js( $id );

		printf( '<p id="figcaption_%1$s" class="wp-caption-text" itemprop="description">Headline image: %2$s</figcaption></figure>',
			esc_attr( $id ),
			wp_kses_post( $img['caption'] )
		);
	}
endif;
