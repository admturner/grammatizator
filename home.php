<?php
/**
 * The posts home page template.
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
			/*
			 * This page is at /articles and linked to from the
			 * homepage of the site at the end of the post list
			 * there.
			 */
			gramm_archive_content( 'medium' );
		endwhile;

		bones_page_navi();
	else :
		?>
		<article id="post-not-found" class="article-layout hentry cf">
			<header class="article-header">
				<h1><?php esc_html_e( 'Oops! No Posts Found', 'bonestheme' ); ?></h1>
			</header>
			<section class="entry-content">
				<p><?php esc_html_e( 'We can\'t seem to find any articles that match what you\'re looking for. Perhaps try searching for it.', 'bonestheme' ); ?></p>
			</section>
		</article>
		<?php
	endif;
	?>

</main>

<?php
get_footer();
