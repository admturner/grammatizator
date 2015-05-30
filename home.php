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
							<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
						</section>
						<footer class="article-footer">
							<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
						</footer>
					</article>

				<?php endif; ?>

			</main>

<?php get_footer(); ?>