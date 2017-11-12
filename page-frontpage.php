<?php
/**
 * Template Name: Front Page
 *
 * To display the semi-static homepage of the site, with a check to
 * prevent using this template on any page that isn't actually the
 * front page of the site.
 *
 * @since Grammatizator 0.4
 */
get_header();
		if ( !is_front_page() ) :
			// If not the front page, just get the standard page.php template
			include( get_page_template() );
		else :
			// If it is the front page, then proceed with the template ?>
			<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					<?php // Check for sticky posts, display in top-of-page call-out
					$s = get_option( 'sticky_posts' );
					$sargs = array(
						'posts_per_page' => 1,
						'post__in'  => $s,
						'ignore_sticky_posts' => 1
					);
					$sticky = new WP_Query( $sargs );
					// The Sticky Loop
					while ( $sticky->have_posts() ) : $sticky->the_post();
						if ( isset($s[0]) ) { ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('sticky article-layout cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
								<?php grammatizator_post_thumbnail( 'gramm-feature' ); ?>
								<h3 itemprop="headline" rel="bookmark"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> &rarr;</a></h3>
							</article>
						<?php }
					endwhile;
					wp_reset_postdata();

				echo '<section class="latest-articles cf">';

					$cargs = array(
						'posts_per_page' => 3,
						'post__not_in' => get_option( 'sticky_posts' )
					);
					$clean = new WP_Query( $cargs );
					// The Clean Loop
					if ( $clean->have_posts() ) : while ( $clean->have_posts() ) : $clean->the_post();
						gramm_archive_content( 'large' );
						$no_duplicates[] = $post->ID;
					endwhile;
					else :
						// No posts found
					endif;
					wp_reset_postdata(); ?>
				</section>

				<?php // @todo Consider making front page nav modules into widget area; think about page speed vs. ease of updating ?>
				<aside class="info-modules cf">
					<?php // MODULES ?>
					<div class="bloginfo module-1">
						<h3>Articles</h3>
						<p><?php echo wptexturize( 'Visit the Articles page to explore all of the work produced by our wonderful writers and editorial team.' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>articles" class="btn-blue">Read more articles &rarr;</a>
					</div>
					<div class="bloginfo module-2">
						<h3>Topics</h3>
						<p><?php echo wptexturize( 'Peruse the many subjects Nursing Clio writers examine, from health, to race, to pop music.' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>topics" class="btn-blue">Browse article topics &rarr;</a>
					</div>
					<div class="bloginfo module-3">
						<?php // 3. Write for us ?>
						<h3>Write for Us</h3>
						<p><?php echo wptexturize( 'Consider writing for us. We\'re always looking for both regular writers and some-time contributors to join our team.' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>write-for-us" class="btn-blue">Write for Nursing Clio &rarr;</a>
					</div>
				</aside>

				<div class="offset-columns">
					<section class="recent-articles">
						<?php // Left, column 1: More recent posts ?>
						<h3>More Recent Articles</h3>
						<?php // The Loopy Loop
							$largs = array(
								'posts_per_page' => 5,
								'post__not_in' => $no_duplicates,
								'ignore_sticky_posts' => 1
							);
							$loopy = new WP_Query( $largs );
							if ( $loopy->have_posts() ) : while ( $loopy->have_posts() ) : $loopy->the_post();
								gramm_archive_content( 'gramm-small' );
							endwhile;

							echo '<p class="articles-read-more-link"><a href="' . esc_url( home_url( '/' ) ) . 'articles" class="btn-blue">Read more articles &rarr;</a></p>';

							else :
								echo '<!-- No posts found -->';
							endif;
						wp_reset_postdata(); ?>
					</section>

					<?php // Right, column 2: More info ?>
					<?php // @todo Consider making this a widget area as well ?>
					<?php // USING SIDEBAR MARKUP ?>
					<aside id="sidebar" class="info-modules sidebar cf" role="complementary">
						<?php // 1. About Us ; This is the Footer formatting ?>
						<div class="about widget">
							<h4 class="widgettitle">What is Nursing Clio?</h4>
							<ul>
								<li><?php echo wptexturize( '<li>Nursing Clio is an open access, peer-reviewed, collaborative blog project that ties historical scholarship to present-day issues related to gender and medicine. We believe the issues that dominate today\'s headlines and affect our daily lives reach far back into the past -- <strong>that the personal is historical</strong>. Learn more on the <a href="' . esc_url( home_url( '/' ) ) . 'about"><strong>About page</strong></a>.' ); ?></li>
							</ul>
						</div>
						<?php // 2. Donate ?>
						<div class="widget">
							<?php gramm_donate_module(); ?>
						</div>
						<?php // 3. Contact Us ?>
						<div class="contact widget">
							<h4 class="widgettitle">Contact Us</h4>
							<p><?php echo wptexturize( 'Comments? Questions? Feedback? Drop us a line with the <a href="' . esc_url( home_url( '/' ) ) . 'contact"><strong>Contact page</strong></a>.' ); ?></p>
							<p><?php echo wptexturize( 'Or message us on <a href="' . esc_url( 'https://www.facebook.com/NursingClio' ) . '">Facebook</a> or <a href="' . esc_url( 'https://twitter.com/nursingclio' ) . '">Twitter</a>.'); ?></p>
						</div>
					</aside><?php // end #sidebar ?>
				</div><?php // end .offset-columns ?>

			</main>

		<?php endif; /* End of is_front_page() check */?>

<?php get_footer(); ?>
