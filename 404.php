<?php get_header(); ?>

			<div id="content" class="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<article id="post-not-found" class="hentry cf">

							<header class="article-header">

								<h1><?php _e( '404 (Page Not Found)', 'bonestheme' ); ?></h1>

							</header>

							<section class="entry-content">

								<?php // @see https://support.google.com/webmasters/answer/93641?hl=en ?>

								<p><?php _e( 'Oh dear. The page you\'re looking for doesn\'t seem to exist.', 'bonestheme'); ?></p>

								<?php // picture ?>

								<p><?php _e( 'We looked and looked, but couldn\'t find it. Maybe it moved, maybe we had to delete it, maybe it never existed. Maybe try searching below.', 'bonestheme' ); ?></p>

							</section>

							<section class="search">

									<p><?php get_search_form(); ?></p>

							</section>

							<footer class="article-footer">
							</footer>

						</article>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
