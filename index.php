<?php
/**
 * The default template.
 *
 * @package Grammatizator
 */
get_header();
?>

<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-layout cf' ); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
				<header class="article-header">
					<?php grammatizator_post_thumbnail( 'large' ); ?>

					<div class="category-titles">
						<?php the_category( ', ' ); ?>
					</div>

					<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

					<p class="entry-details entry-meta">
						<?php
						/* translators: 1: the author page URL, 2: main author name, 3: potential additional author names, 4: the post publish time in Y-m-d format, 5: the post publish time in default format  */
						printf( __( '<span class="amp">By</span> <a href="%1$s" class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">%2$s</a> %3$s &bull; <time class="pubdate updated entry-time" datetime="%4$s" itemprop="datePublished">%5$s</time>', 'bonestheme' ), // wpcs: XSS ok.
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_html( get_the_author_meta( 'display_name' ) ),
							gramm_has_multiple_authors(),
							esc_attr( get_the_time( 'Y-m-d' ) ),
							esc_html( get_the_time( get_option( 'date_format' ) ) )
						);
						?>
					</p>

					<div class="sharing-container">
						<p>Sharing</p>
						<?php
						if ( function_exists( 'sharing_display' ) ) {
							sharing_display( '', true );
						}
						?>
					</div>
				</header>

				<section class="article-content entry-content cf" itemprop="articleBody">
					<?php the_content(); ?>
				</section>

				<aside class="article-supplement">
					<?php grammatizator_post_thumbnail_caption(); ?>
					<?php the_tags( '<p class="tag-titles"><span>' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
				</aside>

				<footer class="article-footer">
					<h4>About the Author</h4>
					<?php // @todo Move this to /library/inc/template-tags.php
					$multiauthor_values = get_post_custom_values( 'Additional author username' );
					if ( ! $multiauthor_values ) {
						gramm_list_authors( 'include=' . get_the_author_meta( 'ID' ) . '&layout=byline&heading_tag=h5&show_grammtitle=0&avatarsize=128' );
					} else {
						// First create array with standard post author ID
						$authors = get_the_author_meta( 'ID' );

						// Now loop through custom meta values
						foreach ( $multiauthor_values as $key => $value ) {
							// Get each additional author's metadata
							$addauthor = get_user_by( 'login', $value );

							// Push additional author's user ID to the array
							$authors .= ', ' . $addauthor->ID;
						}

						// Feed array to custom list authors function
						gramm_list_authors( 'include=' . $authors . '&layout=byline&heading_tag=h5&show_grammtitle=0&avatarsize=128' );
					}
					?>
				</footer>

				<?php comments_template(); ?>
			</article>

			<?php
		endwhile;

		bones_page_navi();
	else :
		?>
		<article id="post-not-found" class="hentry cf">
			<header class="article-header">
				<h1><?php esc_html_e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
			</header>
			<section class="entry-content">
				<p><?php esc_html_e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
			</section>
		</article>
		<?php
	endif;

	get_sidebar();
	?>

</main>

<?php
get_footer();
