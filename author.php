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

				<?php $theauthor = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
				_e( '<h1 class="page-title">' . $theauthor->display_name . '</h1>', 'bonestheme' );

				// Make sure author exists
				if ( is_author( get_the_author_meta( '$theauthor->ID' ) ) ) {
					?><div class="the-team-container">
						<?php gramm_list_authors( 'include=' . $theauthor->ID . '&layout=byline&biolength=9999&avatarsize=180' ); ?>
					</div><?php
				}

				if (have_posts()) :
					while (have_posts()) : the_post();
						gramm_archive_content( 'medium' );
					endwhile;
					bones_page_navi();
				endif; ?>

			</main>

<?php get_footer(); ?>
