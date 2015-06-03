<?php
/**
 * The template for displaying attachments
 * 
 * This template displays post attachments (most often images).
 * 
 * @since Grammatizator 0.5
 */ 
 get_header(); ?>

			<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php
						/**
						 * This function will bring in the image template
						 * for use on this attachment page.
						 */
						get_template_part( 'post-formats/format-image', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php else : ?>

					<article id="post-not-found" class="article-layout hentry cf">
							<header class="article-header">
								<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
							</header>
							<section class="entry-content">
								<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
							</section>
							<footer class="article-footer">
									<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
							</footer>
					</article>

				<?php endif; ?>

			</main>

<?php get_footer(); ?>
