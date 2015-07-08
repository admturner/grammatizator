<?php
/**
 * Grammatizator functions and definitions
 * 
 * Set up the theme and provide some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality (such as adding or removing
 * or changing widgets, image sizes, header images, etc.).
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Author: Adam Turner
 * @link https://github.com/admturner/grammatizator
 * Built on Bones by Eddie Machado {@link http://themble.com/bones/}
 * 
 * CONTENTS
 *  - Load Dependencies
 *  - Launch Bones
 *  - Enqueue Styles And Scripts
 *  - Theme Support
 *  - Oembed Size Options
 *  - Image Options
 *  - Custom Search Form
 *  - Active Sidebars
 *  - Comment Layout
 *  - Archive Page Layout
 *  - Author List Functions
 *  - Donate Module
 *  - Theme Customize
 *  - User Profile Fields
 *  - Jetpack Adjustments
 *
 * @package WordPress
 * @subpackage Grammatizator
 * @since Grammatizator 0.4
 * 
 * @todo Add function_exists() wrappers to allow use of Grammatizator as a parent theme
 */

/************** LOAD DEPENDENCIES **************/
/**
 * Load Bones Core (if you remove this, the theme will break)
 *
 * @since Bones 1.71
 */
require_once( 'library/bones.php' );

// Customize The Wordpress Admin. Edit the file library/admin.php if you'd like.
require_once( 'library/admin.php' );

/** 
 * Load Grammatizator shortcodes
 *
 * @since Grammatizator 0.4
 */
include_once( 'library/shortcodes.php' );

/***************** LAUNCH BONES ***************/
/**
 * Author: Eddie Machado
 * URL: http://themble.com/bones/
 * 
 * Gets the Bones framework up and running. Eddie Machado's base theme
 * includes these lovely functions that clean up some the messier bits
 * of the WordPress core functions (like the bloated <head> section).
 *
 * @since Bones 1.71
*/
function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // Get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // Launching Bones operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

  // Enable support for HTML5 markup.
  add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );

} // end bones ahoy

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/********** ENQUEUE STYLES AND SCRIPTS ***********/
/**
 * Enqueue Google Fonts
 *
 * Bones modification of Twenty Thirteen theme function to declare 
 * some external fonts. If using Google Fonts, replace these fonts,
 * change it in your scss files and be up and running in seconds.
 *
 * @since Grammatizator 0.4
 */
function gramm_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Merriweather:400,400italic,700,700italic|Open+Sans:400italic,700italic,400,700');
}

add_action('wp_enqueue_scripts', 'gramm_fonts');

/************* OEMBED SIZE OPTIONS *************/
/**
 * Set default media width for if it's missing
 * 
 * @todo Move this inside action hook
 */
if ( ! isset( $content_width ) ) {
	$content_width = 723;
}

/*************** IMAGE OPTIONS *****************/

/**
 * Add Cumstom Image Sizes
 * 
 * Sizes for builtin WP image sizes should be:
 *   - full = full
 *   - large = 723
 *   - medium = 405
 *   - thumbnail = 181 (square, cropped)
 * 
 * @todo Move inside action hook? Add more sizes?
 * @since Grammatizator 0.4
 */
add_image_size( 'gramm-small', 362 );
add_image_size( 'gramm-xl', 1030 );
add_image_size( 'gramm-feature', 1030, 400, true );

/**
 * Add image sizes to media manager dropdown
 * 
 * Adds the ability to use the dropdown menu to select images sizes
 * added with add_image_size() from within the media manager when you
 * add media to your content blocks.
 * 
 * @since Grammatizator 0.4
 *
 * @todo Adjust to match the above sizes
 */
function gramm_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'gramm-small' => __('Small (362px)'),
        'gramm-xl' => __('Extra large (1030px)'),
        'gramm-feature' => __('1030 by 400'),
    ) );
}
add_filter( 'image_size_names_choose', 'gramm_custom_image_sizes' );

/**
 * Use HTML5 figure and figcaption for captioned images
 *
 * Improves the WordPress caption shortcode with HTML5 figure & 
 * figcaption, microdata & wai-aria attributes. Adapted from solution
 * by Justin Tadlock (@see http://justintadlock.com/archives/2011/07/01/captions-in-wordpress)
 * and @joostkiens (@see https://gist.github.com/JoostKiens/4477366).
 * Licensed under the MIT license
 *
 * @param  string $val     Empty
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Shortcode content
 * @return string          Shortcode output
 *
 * @since Grammatizator 0.4
 */
function gramm_image_caption_filter( $val, $attr, $content = null ) {
  
  // Not worried abut captions in feeds, so just return the output immediately.
  if ( is_feed() )
    return $val;

  extract( shortcode_atts( array(
    'id'      => '',
    'align'   => 'aligncenter',
    'width'   => '',
    'caption' => ''
  ), $attr ) );
  
  if ( 1 > (int) $width || empty( $caption ) )
    return $val;
 
  if ( $id )
    $id = esc_attr( $id );
  
  return '<figure id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '" itemscope itemtype="http://schema.org/ImageObject" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption id="figcaption_'. $id . '" class="wp-caption-text" itemprop="description">' . $caption . '</figcaption></figure>';
}
add_filter( 'img_caption_shortcode', 'gramm_image_caption_filter', 10, 3 );

/**
 * Add custom default avatar
 * 
 * @todo Move inside action hook or filter?
 * @since Grammatizator 0.4
 */
add_filter( 'avatar_defaults', 'nc_default_avatar' );

function nc_default_avatar ( $avatar_defaults ) {
    // Set URL where the image for the new avatar is located
    $nc_avatar_url = get_template_directory_uri() . '/library/images/default-avatar.png';
    // Set the label for the field on the Settings >> Discussion page
    $avatar_defaults[$nc_avatar_url] = "Nursing Clio";
    return $avatar_defaults;
}

/************* ACTIVE SIDEBARS *****************/
/**
 * Register sidebars & widgetizes areas
 * 
 * To add more sidebars or widgetized areas, just copy and edit the 
 * above sidebar code. Change the name to whatever your new sidebar's 
 * id is.
 * 
 * @since Bones 1.71
 * 
 * @todo Set these to sidebars desired for Grammatizator
 */
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
  // You can put as many sidebars here as you want, just use register_sidebar()
} // don't remove this bracket!

/************* COMMENT LAYOUT ******************/
/**
 * Bones comment layout template
 * 
 * The comment template by the Bones starter theme.
 *
 * @since Bones 1.71
 */
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class( 'cf' ); ?>>
    <article class="cf">
      <header class="comment-author vcard">
        <?php
        /**
         * Bone's JS-optimized gravatar loading
         * 
         * Uses the new HTML5 data-attribute combined with some
         * javascript (in library/js/scripts.js) to display comment
         * gravatars on larger screens only. This means that mobile
         * sites load a default avatar, and then larger screens (hacky
         * equivalent to higher bandwidth) swap out the "real" one.
         */
        ?>
        <?php $bgauthemail = get_comment_author_email(); ?>
        <div class="grav">
          <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=64" class="load-gravatar avatar avatar-64 photo" height="64" width="64" src="<?php echo get_template_directory_uri(); ?>/library/images/default-avatar.png" />
        </div>
        <?php printf(__( '<cite class="fn">%1$s</cite>', 'bonestheme' ), get_comment_author_link() ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Thanks for sharing! Your comment awaits moderation. Please check back soon.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php edit_comment_link(__( '(Edit comment.)', 'bonestheme' ), '', ''); ?>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************ ARCHIVE PAGE LAYOUT **************/
/**
 * Grammatizator archive page layout template
 * 
 * The template for displaying post content on archive pages.
 * Moved here in order to allow for handling images differently
 * in different places. It should occur in a WordPress Loop.
 *
 * @since Grammatizator 0.4
 */
function gramm_archive_content( $featuresize = '', $caption = FALSE ) { ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('archive-layout cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
    <header class="article-header">
      <?php if ( has_post_thumbnail() && !empty( $featuresize ) ) {
        $id = get_post_thumbnail_id();
        echo '<figure id="attachment_' . $id . '" class="wp-feature" itemscope itemtype="http://schema.org/ImageObject">';
          the_post_thumbnail( $featuresize );
        echo '</figure>';
      } ?>
      <div class="category-titles"><?php printf( __( '', 'bonestheme' ).'%1$s', get_the_category_list(', ') ); ?></div>
      <h2 class="entry-title single-title" itemprop="headline" rel="bookmark"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <p class="entry-details entry-meta">
        <?php printf( __( '<span class="amp">By</span>', 'bonestheme' ).' %1$s &#9830; %2$s',
           '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_meta( 'display_name' ) . '</a>',
           '<time class="pubdate updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'                       
        ); ?>
      </p>
    </header><?php // end article header ?>
    <section class="article-content excerpt entry-content cf" itemprop="articleBody">
      <?php the_excerpt(); ?>
    </section>
    <aside class="article-supplement">
      <?php the_tags( '<p class="tag-titles"><span>' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
    </aside>
    <footer class="article-footer">
    </footer>
  </article><?php // end archive page excerpt format
}

/*********** AUTHOR LIST FUNCTIONS *************/
/**
 * Custom List Users
 * 
 * Custom function to generate a list of blog authors,
 * built based on WordPress' native wp_list_users function,
 * but this returns more user info and uses the built in "role" 
 * parameter for the get_users() WordPress wrapper function
 * instead of a manual "exclude admin" setting. Roles should
 * be specified as: Admins = 'administrator'; Editors = 'editor';
 * Authors = 'author'; Contributors = 'contributor'; Subscribers =
 * 'subscriber'. Bio length is in words, and if you want the whole
 * bio (user description field) then enter 9999.
 *
 * @uses get_users();
 * @uses wp_trim_words();
 * @since Grammatizator 0.6
 */
function gramm_list_authors( $args = '' ) {
  global $wpdb;

  $defaults = array(
      'orderby' => 'name',
      'order' => 'ASC',
      'role' => '',
      'include' => array(),
      'show_fullname' => true,
      'show_grammtitle' => true,
      'social_links' => true,
      'biolength' => 55,
      'avatarsize' => 90,
      'layout' => '',
      'heading_tag' => 'h3',
      'echo' => true
  );
  $args = wp_parse_args( $args, $defaults );

  $return = '';

  // Use this to get the paramenters we need for get_users() out of the default $args
  $query_args = wp_array_slice_assoc( $args, array( 'orderby', 'order', 'role', 'include' ) );
  // Used to request only an array of user IDs from get_users()
  $query_args['fields'] = 'ids';
  $authors = get_users( $query_args );

  foreach ( $authors as $authorid ) {
    $author = get_userdata( $authorid );

    // Show full name by default, but has option for display name instead, and defaults there if first or last is empty
    if ( $args['show_fullname'] && $author->first_name && $author->last_name ) {
      $name = "$author->first_name $author->last_name";
    } else {
      $name = $author->display_name;
    }

    // If the user has a bio save it, otherwise overwrite the previous one in the loop with null
    if ( get_the_author_meta( 'description', $author->ID ) ) {
      $bio = get_the_author_meta( 'description', $author->ID );
    } else {
      $bio = '';
    }
    
    // If the user has Nursing Clio title filled in, otherwise set it to Contributor as default
    if ( $args['show_grammtitle'] ) {
      if ( get_the_author_meta( 'grammtitle', $author->ID ) ) {
        $nctitle = '<p class="nc-title">' . get_the_author_meta( 'grammtitle', $author->ID ) . '</p>';
      } else {
        $nctitle = '<p class="nc-title">Contributor</p>';
      }
    }

    // If user has Twitter field filled in prep it, otherwise reset
    if ( $args['social_links'] && get_the_author_meta( 'twitter', $author->ID ) ) {
      $twit = '<p class="social-links"><a class="twitter" href="https://twitter.com/' . get_the_author_meta( 'twitter', $author->ID ) . '" title="' . esc_attr( sprintf(__("%s on Twitter"), $author->display_name) ) . '">@' . get_the_author_meta( 'twitter', $author->ID ) . '</a></p>';
    } else {
      $twit = '';
    }

    $authorlink = '<a class="fn" href="' . get_author_posts_url( $author->ID, $author->user_nicename ) . '" title="' . esc_attr( sprintf(__("Posts by %s"), $author->display_name) ) . '">' . $name . '</a>';

    // Start output
    $return .= '<section id="author-id-' . $author->ID . '" class="author ' . $args['layout'] . ' vcard">';
      if ( $args['avatarsize'] > 0 ) {
        // Do if avatarsize is greater than 0
        $return .= '<div class="avatar-wrap avatar-size-' . $args['avatarsize'] . 'px">';
        $return .= get_avatar( $author->ID, $args['avatarsize'] );
        $return .= '</div>';
      }

      $return .= '<div class="bio-wrap">';
      $return .= '<' . $args['heading_tag'] . '>' . $authorlink . '</' . $args['heading_tag'] . '>';
      $return .= $nctitle;
      $return .= $twit;
      
      if ( $args['biolength'] > 0 && $bio ) {
        $return .= '<p class="author-bio">';
        // Trim if desired
        if ( $args['biolength'] < 9995 ) {
          $authrole = get_the_author_meta( 'roles', $author->ID );
          if ( in_array('contributor', $authrole) ) {
            $morelink = get_author_posts_url( $author->ID, $author->user_nicename );
          } else {
            $morelink = esc_url( get_site_url() . '/about/meet-the-team/#author-id-' . $author->ID );
          }

          $more = '&hellip; <a href="' . $morelink . '" title="' . esc_attr( 'Read ' . $author->display_name . '&rsquo;s full bio' ) . '">' . ( !empty($author->first_name) ? $author->first_name : $author->display_name) . '&rsquo;s full bio &rarr;';
          $bio = wp_trim_words( $bio, $args['biolength'], $more );
        }
        $return .= wptexturize( $bio );
        $return .= '</p>';
      }

      $return .= '</div>';
    $return .= '</section>'; // End output
  } /* End foreach loop */

  if ( ! $args['echo'] ) {
    return $return;
  }

  echo $return;
}

/************** DONATE MODULE ******************/
/**
 * A Donate Module
 * 
 * A reusable call-to-action section to display a
 * request for donations.
 * 
 * @since Grammatizator 0.4
 */
function gramm_donate_module() { ?>
  <div class="call-to-action">
    <h5>Like what we do?</h5>
    <h4 class="widgettitle">Want to help us keep the typewriters humming?</h4>
    <a class="btn-blue" href="donate">Donate</a>
    <p><a href="donate">How we use donations &rarr;</a></p>
    <p><small><em>And thanks!</em></small></p>
  </div>
  <?php /*
    $asks = array(
      Want to buy us a cup of coffee?
      Want to help us power the Internet?
      Want to help us keep the lights on?
    );
    <button link:paypal?>Donate</button>
  */
}

/************* THEME CUSTOMIZE *****************/
/**
 * A good tutorial for creating your own Sections, Controls and Settings:
 * http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
 *
 * Good articles on modifying the default options:
 * http://natko.com/changing-default-wordpress-theme-customization-api-sections/
 * http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
 * 
 * Bones To do:
 * - Create a js for the postmessage transport method
 * - Create some sanitize functions to sanitize inputs
 * - Create some boilerplate Sections, Controls and Settings
 * 
 * @since Bones 1.71
 */
function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}
add_action( 'customize_register', 'bones_theme_customizer' );

/************* USER PROFILE FIELDS *************/
/**
 * Add new user profile fields
 *
 * The following two functions add new fields to the user profile page
 * in the admin area, and then saves those new fields into the database
 * usermeta data. Copied from Justin Tadlock's tutorial on this topic: 
 * {@link http://justintadlock.com/archives/2009/09/10/adding-and-using-custom-user-profile-fields}
 *
 * @since Grammatizator 0.4
 */
function gramm_add_profile_fields( $user ) { 
  
  // Check to see if user already has a User Title
  $value = get_the_author_meta('grammtitle', $user->ID);

  // If not, assign default User Titles depending on user role
  if ( !empty($value) ) {
    $value = get_the_author_meta('grammtitle', $user->ID);
  } else {
    if ( !current_user_can( 'delete_posts' ) ) {
      // subscriber = nursing clio guest author
      $value = 'Guest Author';
    } elseif ( !current_user_can( 'publish_posts' ) ) {
      // contributor = nursing clio regular author
      $value = 'Author';
    } elseif ( !current_user_can( 'remove_users' ) ) {
      // editor = nursing clio editor
      $value = 'Editor, Author';
    } else {
      // admins can take care of themselves
      $value = '';
    }
  } ?>
  <h3>Additional Info</h3>
  <table class="form-table">
    <tbody>
      <tr class="user-gravatar-wrap">
        <th>
          Your Picture<br>
          <?php echo get_avatar( get_the_author_meta( 'user_email', $user->ID ), 80 ); ?>
        </th>
        <td>WordPress uses Gravatar for its profile pictures ("avatars"). Please visit <a href="http://en.gravatar.com/" target="_blank">the Gravatar website</a> to upload your picture. Make sure you set up your gravatar to link with the same email address you use here (<?php the_author_meta( 'user_email', $user->ID ); ?>).</td>
      </tr>
      <tr class="user-grammtitle-wrap">
        <th><label for="grammtitle">User Title</label></th>
          <td>
            <input type="text" name="grammtitle" id="grammtitle" value="<?php echo esc_attr( $value ); ?>" <?php if ( !current_user_can( 'delete_others_posts' ) ) { echo ' disabled="disabled" '; } ?> class="regular-text" />
            <?php if ( current_user_can( 'delete_others_posts' ) ) { echo '<span class="description">' . bloginfo( 'name' ) . ' role (Guest Author, for example). <strong>Separate with commas.</strong></span>'; } ?>
          </td>
        </tr>
      <tr class="user-twitter-wrap">
        <th><label for="twitter">Twitter</label></th>
        <td>
          <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" />
          <span class="description">Your Twitter username (without the "@" symbol).</span>
        </td>
      </tr>
    </tbody>
  </table>
<?php }

add_action( 'show_user_profile', 'gramm_add_profile_fields' );
add_action( 'edit_user_profile', 'gramm_add_profile_fields' );

// Save the new user data
function gramm_save_profile_fields( $user_id ) {
  // first check permissions
  if ( !current_user_can( 'edit_user', $user_id ) )
    return false;
  // Copy and paste this line for additional fields. Make sure to change the field ID.
  update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
  update_usermeta( $user_id, 'grammtitle', $_POST['grammtitle'] );
}

add_action( 'personal_options_update', 'gramm_save_profile_fields' );
add_action( 'edit_user_profile_update', 'gramm_save_profile_fields' );

/************* JETPACK ADJUSTMENTS *************/

/**
 * Remove Jetpack Share Insert
 * 
 * Prevents auto display of Jetpack sharing links and
 * "like" button, to allow for manual insertion
 * 
 * @since Grammatizator 0.7
 */
function gram_remove_jpshare() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'gram_remove_jpshare' );

/**
 * Add post author twitter handle to OG meta
 *
 */
function gramm_jpog_add_twitter_creator( $og_tags ) {
  global $post;
  $p = $post;

  if ( is_single() ) {
    if ( get_the_author_meta( 'twitter', $p->post_author ) ) {
      $og_tags['twitter:creator'] = esc_attr( '@' . get_the_author_meta( 'twitter', $p->post_author ) );
    }
  }
  
  return $og_tags;
}
add_filter( 'jetpack_open_graph_tags', 'gramm_jpog_add_twitter_creator', 11 );

function gramm_jpog_add_related( $related, $post_ID ) {
  global $post;
  $p = $post;

  if ( is_single() ) {
    if ( get_the_author_meta( 'twitter', $p->post_author ) ) {
      $related[ get_the_author_meta( 'twitter', $p->post_author ) ] = '';
    }
  }
  
  return $related;
}
add_filter( 'jetpack_sharing_twitter_related', 'gramm_jpog_add_related', 10, 2 );

/* DON'T DELETE THIS CLOSING TAG */ ?>