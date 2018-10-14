<?php
/**
 * Archive template
 *
 * @package Grammatizator
 */
get_header();
?>

<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
	<?php

	the_archive_title( '<h1 class="page-title">', '</h1>' );
	the_archive_description( '<div class="taxonomy-description">', '</div>' );

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
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
				<p><?php esc_html_e( 'We can&rsquo;t seem to find any articles that match what you&rsquo;re looking for. Perhaps try searching for it.', 'bonestheme' ); ?></p>
			</section>
		</article>
		<?php

	endif;

	?>
</main>

<?php
get_footer();
