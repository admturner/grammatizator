<?php
/**
 * Global site header.
 *
 * @package Grammatizator
 */
?>

<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title( '' ); ?></title>

	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/library/images/apple-touch-icon.png">
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.png">
	<link rel="icon" sizes="192x192" href="<?php echo esc_url( get_template_directory_uri() ); ?>/library/images/icon-highres.png">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.ico">
	<![endif]-->

	<meta name="msapplication-TileColor" content="#fcfcfc">
	<meta name="msapplication-TileImage" content="<?php echo esc_url( get_template_directory_uri() ); ?>/library/images/win8-tile-icon.png">
	<meta name="theme-color" content="#fcfcfc">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<header class="header cf" role="banner" itemscope itemtype="http://schema.org/WPHeader">
		<h1 id="logo" class="site-title" itemscope itemtype="http://schema.org/Organization">
			<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<?php
		/*
		 * Main navigation is in footer.php following the
		 * footer-anchor method (@see http://webdesign.tutsplus.com/tutorials/a-simple-responsive-mobile-first-navigation--webdesign-6074)
		 * Here we add a "jump to menu" link, (which will be
		 * hidden and replaced with a toggle menu via a JavaScript
		 * class for those who have JavaScript enabled.
		 */
		?>
		<a class="nav-jump" href="#main-nav" title="Skip to navigation">Menu</a>
	</header>
