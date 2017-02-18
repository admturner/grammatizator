<?php get_header(); ?>

		<main id="main" class="content-wrap cf" role="main">

			<h1 class="archive-title"><span><?php _e( 'Search Results for:', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('article-layout cf'); ?> role="article">

					<header class="entry-header article-header">

						<h3 class="search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

  						<p class="entry-details entry-meta">
		                    <?php printf( __( '<span class="amp">By</span>', 'bonestheme' ).' %1$s &#9830; %2$s',
		                       '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_meta( 'display_name' ) . '</a>',
		                       '<time class="pubdate updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'
		                    ); ?>
		                </p>

					</header>

					<section class="entry-content">
						<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>
					</section>

					<footer class="article-footer">

						<?php if(get_the_category_list(', ') != ''): ?>
      					<?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>
      					<?php endif; ?>

     					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

					</footer> <!-- end article footer -->

				</article>

			<?php endwhile; ?>

					<?php bones_page_navi(); ?>

				<?php else : ?>

						<article id="post-not-found" class="article-layout hentry cf">
							<header class="article-header">
								<h2><?php _e( 'Sorry, Could\'t Find Any Results', 'bonestheme' ); ?></h2>
							</header>
							<section class="entry-content">
								<p>Try checking your spelling and searching again.</p>
								<p>If you're looking for posts by a specific author, visit the <a href="/about/meet-the-team/">Meet the Team</a> page to find that author.</p>
								<p>You can also browse posts by subject on the <a href="/topics/">Topics page</a>.</p>
							</section>
						</article>

				<?php endif; ?>

			</main>

<?php get_footer(); ?>
