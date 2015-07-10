<?php 
/**
 * Author Archive Page
 * 
 * Defines display of all posts by an individual author, as well as
 * that author's bio and avatar if they are set.
 * 
 * @since Grammatizator 0.7
 */
get_header(); ?>
		
			<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<?php
				the_archive_title( '<h1 class="page-title">Posts by ', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				
				<div class="the-team-container">
					<?php gramm_list_authors( 'include=' . get_the_author_meta( 'ID' ) . '&layout=byline&biolength=9999&avatarsize=180' ); ?>
				</div>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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