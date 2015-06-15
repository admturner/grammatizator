              <?php
                /**
                 * This is the default post format.
                 * 
                 * In the Loop
                 * 
                 * @since Grammatizator 0.4
                 */
              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('article-layout cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                  <?php if ( has_post_thumbnail() ) {
                      $id = get_post_thumbnail_id();
                      $img = wp_prepare_attachment_for_js( $id );
                      echo '<figure id="attachment_' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-feature" itemscope itemtype="http://schema.org/ImageObject">';
                        the_post_thumbnail( 'large' );
                      echo '</figure>';
                  } ?>
                  
                  <div class="category-titles"><?php printf( __( '', 'bonestheme' ).'%1$s', get_the_category_list(', ') ); ?></div>

                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

                  <p class="entry-details entry-meta">

                    <?php printf( __( '<span class="amp">By</span>', 'bonestheme' ).' %1$s &#9830; %2$s',
                       '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_meta( 'display_name' ) . '</a>',
                       '<time class="pubdate updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'                       
                    ); ?>

                  </p>

                </header><?php // end article header ?>

                <section class="article-content entry-content cf" itemprop="articleBody">
                  
                  <?php the_content(); ?>
                  <?php // @todo Add Like buttons back in. ?>

                </section> <?php // end article section ?>

                <aside class="article-supplement">
                  <?php echo '<figcaption id="figcaption_' . $id . '" class="wp-caption-text" itemprop="description">Headline image: ' . $img['caption'] .'</figcaption></figure>'; ?>
                  <p><a href="#comments-title"><?php comments_number( 'No comments yet', 'One comment', '% comments' ); ?></a></p>
                  <?php the_tags( '<p class="tag-titles"><span>' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
                  <p class="sharing">Share on:</p> <?php if ( function_exists( 'sharing_display' ) ) { sharing_display( '', true ); } ?>
                </aside>

                <footer class="article-footer">

                  <h4>About the Author</h4>

                  <?php gramm_list_authors( 'include='.get_the_author_meta( 'ID' ).'&layout=byline&heading_tag=h5&show_grammtitle=0&avatarsize=128' ); ?>

                </footer> <?php // end article footer ?>

              </article> <?php // end article ?>

              <?php comments_template(); ?>
