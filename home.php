<?php get_header(); ?>

			<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php 
				/** 
				 * This page is at /articles and linked to from the 
				 * homepage of the site at the end of the post list
				 * there.
				 * 
				 * It should simply display recent posts as usual (with
				 * a longer excerpt than on the home page maybe?)
				 * 	
				 * Would be ideal if it were offset from those 
				 * shown on the front page, but that may not be 
				 * possible while preserving pagination w/out a
				 * lot of hassle.
				 */
				?>

				<?php gramm_archive_content( 'medium' ); ?>

			<?php endwhile; ?>

			<?php bones_page_navi(); ?>

			<?php else : ?>

					<article id="post-not-found" class="article-layout hentry cf">
						<header class="article-header">
							<h1><?php _e( 'Oops! No Posts Found', 'bonestheme' ); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e( 'We can\'t seem to find any articles that match what you\'re looking for. Perhaps try searching for it.', 'bonestheme' ); ?></p>
						</section>
					</article>

				<?php endif; ?>

			</main>

<?php get_footer(); ?>