<?php
/**
 * 404 Page Template
 *
 * @package Grammatizator
 */
get_header();
?>

<div id="content" class="content">
	<div id="inner-content" class="wrap cf">
		<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
			<article id="post-not-found" class="hentry cf">
				<header class="article-header">
					<h1><?php esc_html_e( '404 (Page Not Found)', 'bonestheme' ); ?></h1>
				</header>

				<section class="entry-content">
					<p><?php esc_html_e( 'Oh dear. The page you&rsquo;re looking for doesn&rsquo;t seem to exist. Maybe try searching for what you&rsquo;re looking for?', 'bonestheme' ); ?></p>
				</section>

				<section class="search">
					<p><?php get_search_form(); ?></p>
				</section>
			</article>
		</main>
	</div>
</div>

<?php
get_footer();
