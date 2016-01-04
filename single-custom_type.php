<?php
/*
 * CUSTOM POST TYPE TEMPLATE
 *
 * This is the custom post type post template. If you edit the post type name, you've got
 * to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is "register_post_type( 'bookmarks')",
 * then your single template should be single-bookmarks.php
 *
 * Be aware that you should rename 'custom_cat' and 'custom_tag' to the appropiate custom
 * category and taxonomy slugs, or this template will not finish to load properly.
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<main id="main" class="content-wrap cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('article-layout cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                  <?php grammatizator_post_thumbnail( 'large' ); ?>
                  
                  <div class="category-titles"><?php printf( __( '', 'bonestheme' ).'%1$s', get_the_category_list(', ') ); ?></div>

                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

                  <p class="entry-details entry-meta">

                    <?php printf( __( '<span class="amp">By</span>', 'bonestheme' ).' %1$s &#9830; %2$s',
                       '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_meta( 'display_name' ) . '</a>',
                       '<time class="pubdate updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'                       
                    ); ?>

                  </p>

                  <div class="sharing-container">
                    <p>Sharing</p> <?php if ( function_exists( 'sharing_display' ) ) { sharing_display( '', true ); } ?>
                  </div>

                </header><?php // end article header ?>

                <section class="article-content entry-content cf" itemprop="articleBody">
                  
                  <?php the_content(); ?>

                </section> <?php // end article section ?>

                <aside class="article-supplement">
                  <?php 
                    grammatizator_post_thumbnail_caption();

                    the_tags( '<p class="tag-titles"><span>' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' );
                    /* Adds Jetpack "Like" button iframe back in.
                    // @todo Uncomment if we need this crufty crap (don't forget to activate the JP likes module)
                    if ( class_exists( 'Jetpack_Likes' ) ) {
                      $gramm_likes = new Jetpack_Likes;
                      echo $gramm_likes->post_likes( '' );
                    } */
                  ?>
                </aside>

                <footer class="article-footer">

                  <h4>About the Author</h4>
                  <div class="byline author vcard">
                    <div class="avatar-wrap">
                      <?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
                    </div>
                    <div class="bio-wrap">
                      <h5><a class="fn" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></h5>
                      <p class="author-bio">
                        <?php $str = get_the_author_meta( 'description' );
                        if ( strlen($str) > 320 ) {
                          $len = 320 - strlen($str);
                          $str = substr($str, 0, strrpos($str, ' ', $len)) . ' &hellip; <a href="' . esc_url( get_bloginfo( 'url' ) ) . '/about">More &rarr;</a>';
                        }
                        echo $str; ?>
                      </p>
                    </div>
                  </div>

                </footer> <?php // end article footer ?>

                <?php comments_template(); ?>

              </article> <?php // end article ?>

			<?php endwhile; ?>

			<?php else : ?>

				<article id="post-not-found" class="hentry cf">
					<header class="article-header">
						<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
					</section>
					<footer class="article-footer">
						<p><?php _e( '<!-- This is the error message in the single-custom_type.php template. -->', 'bonestheme' ); ?></p>
					</footer>
				</article>

			<?php endif; ?>

      <?php get_sidebar(); ?>

			</main>

<?php get_footer(); ?>
