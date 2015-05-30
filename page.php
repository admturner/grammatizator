<?php get_header(); ?>

			<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('article-layout cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

	                <header class="article-header">
		                
		                <?php // <div class="category-titles"><?php printf( __( '', 'bonestheme' ).'%1$s', get_the_category_list(', ') ); </div> ?>
		                <h1 class="entry-title page-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

		                <?php /*<p class="entry-details entry-meta">
		                	<?php printf( __( '<span class="amp">By</span>', 'bonestheme' ).' %1$s &#9830; %2$s',
		                       '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_meta( 'display_name' ) . '</a>',
		                       '<time class="pubdate updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'                       
		                	); 
		                </p> */ ?>
	                </header><?php // end article header ?>

	                <section class="article-content entry-content cf" itemprop="articleBody">
	                
	                  <?php the_content(); ?>

	                </section><?php // end article section ?>

	                <?php /* <footer class="article-footer">
	                </footer><?php // end article footer */ ?>

	                <?php comments_template(); ?>

	            </article> <?php // end article ?>

			<?php endwhile; endif; ?>

			<?php // get_sidebar(); ?>

			</main>

<?php get_footer(); ?>