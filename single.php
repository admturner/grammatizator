<?php
/**
 * The single post template.
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
			/**
			 * This function will bring in the needed template file depending on what the post
			 * format is. The different post formats are located in the /post-formats folder.
			 *
			 * REMEMBER TO ALWAYS HAVE A DEFAULT ONE NAMED "format.php" FOR POSTS THAT AREN'T
			 * A SPECIFIC POST FORMAT.
			 *
			 * If you want to remove post formats, just delete the post-formats folder and
			 * replace the function below with the contents of the "format.php" file.
			 */
			get_template_part( 'post-formats/format', get_post_format() );
		endwhile;
	else :
		?>

		<article id="post-not-found" class="article-layout hentry cf">
			<header class="article-header">
				<h1><?php esc_html_e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
			</header>
			<section class="entry-content">
				<p><?php esc_html_e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
			</section>
		</article>

		<?php
	endif;

	get_sidebar();
	?>

</main>

<?php
get_footer();
