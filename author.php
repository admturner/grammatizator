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

				if (have_posts()) :

					// Only displays author info if author has posts
					// Make sure author exists
					if ( is_author( get_the_author_meta( 'ID' ) ) ) {
						?><div class="the-team-container">
							<?php gramm_list_authors( 'include=' . get_the_author_meta( 'ID' ) . '&layout=byline&biolength=9999&avatarsize=180' ); ?>
						</div><?php
					}

					while (have_posts()) : the_post();

						gramm_archive_content( 'medium' );

					endwhile;

					bones_page_navi();

				else : ?>

					<article id="post-not-found" class="article-layout hentry cf">
						<header class="article-header">
							<h1><?php _e( 'No posts by this author (yet)', 'bonestheme' ); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e( 'This author doesn\'t seem to have any published posts yet. Perhaps try searching for something related.', 'bonestheme' ); ?></p>
						</section>
					</article>

				<?php endif; ?>

			</main>

<?php get_footer(); ?>
