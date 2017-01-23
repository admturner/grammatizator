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

                  <?php grammatizator_post_thumbnail( 'gramm-feature' ); ?>

                  <div class="category-titles"><?php printf( __( '', 'bonestheme' ).'%1$s', get_the_category_list(', ') ); ?></div>

                  <h2 class="entry-title single-title h1" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

                  <p class="entry-details entry-meta">

                    <?php printf( __( '<span class="amp">By</span>', 'bonestheme' ).' %1$s &bull; %2$s',
                       '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_meta( 'display_name' ) . '</a>' . gramm_has_multiple_authors(),
                       '<time class="pubdate updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'
                    ); ?>

                  </p>

                  <div class="sharing-container">
                    <p>Sharing</p> <?php if ( function_exists( 'sharing_display' ) ) { sharing_display( '', true ); } ?>
                  </div>

                </header><?php // end article header ?>

                <section class="article-content entry-content cf" itemprop="articleBody">

                  <?php the_content(); ?>
                  <?php // @todo Add Like buttons back in. ?>

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

                  <?php // @todo Move this to /library/inc/template-tags.php
                    $multiauthor_values = get_post_custom_values( 'Additional author username' );
                    if ( !$multiauthor_values ) {
                      gramm_list_authors( 'include=' . get_the_author_meta( 'ID' ) . '&layout=byline&heading_tag=h5&show_grammtitle=0&avatarsize=128' );
                    } else {
                      // First create array with standard post author ID
                      $authors = get_the_author_meta( 'ID' );
                      // Now loop through custom meta values
                      foreach ( $multiauthor_values as $key => $value ) {
                        // Get each additional author's metadata
                        $addauthor = get_user_by( 'login', $value );
                        // Push additional author's user ID to the array
                        $authors .= ', ' . $addauthor->ID;
                      }
                      // Feed array to custom list authors function
                      gramm_list_authors( 'include=' . $authors . '&layout=byline&heading_tag=h5&show_grammtitle=0&avatarsize=128' );
                    }
                  ?>

                </footer> <?php // end article footer ?>

              </article> <?php // end article ?>

              <?php comments_template(); ?>
