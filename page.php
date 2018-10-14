<?php
/**
 * The standard page template.
 *
 * @package Grammatizator
 */
get_header();
?>

<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-layout cf' ); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
				<header class="article-header">
					<h1 class="entry-title page-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
				</header>

				<section class="article-content entry-content cf" itemprop="articleBody">
					<?php the_content(); ?>
				</section>

				<?php comments_template(); ?>
			</article>

			<?php
		endwhile;
	endif;
	?>

</main>

<?php
get_footer();
