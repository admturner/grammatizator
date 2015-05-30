		<footer class="footer cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

			<div class="footer-wrap cf">

				<nav role="navigation" aria-label="<?php esc_html_e( 'Footer Navigation', 'bonestheme' ); ?>">
					<?php /* Admin stuff */
						if ( current_user_can( 'delete-posts' ) )
							$adminlinks = '<li class="admin"><a href="' . esc_url( get_admin_url() ) . '">Backend</a></li><li class="admin"><a href="' . get_edit_post_link() . '">Edit this page</a></li>';
					?>
					<?php wp_nav_menu(array(
						'container' => false,                          // Remove the defaul <div> container, since we're using <nav>
						'menu' => __( 'Footer Links', 'bonestheme' ),  // Menu name (for calling in the Admin area)
						'theme_location' => 'footer-links',            // Where it's located in the theme
						'items_wrap' => '<ul class="nav footer-nav cf">' . $adminlinks . '%3$s</ul>', // Customize the sprint() for the actual nav list to cut out the ID cruft
						'fallback_cb' => 'bones_footer_links_fallback' // fallback function
					)); ?>
				</nav>

				<div class="bloginfo about">
					<h3>What is Nursing Clio?</h3>
					<p>Nursing Clio is a collaborative blog project that ties historical scholarship to present-day political, social, and cultural issues surrounding gender and medicine. Learn more about Nursing Clio and our fabulous writers on our <a href="<?php echo esc_url( home_url( '/' ) ); ?>about">About page &rarr;</a></p>
				</div>

				<div class="bloginfo follow">
					<h3>Subscribe</h3>
					<p>Want regular updates sent right to your digital door?</p>
					<ul>
						<li class="email"><a href="<?php echo esc_url( home_url( '/' ) ); ?>subscribe/">Subscribe to email updates</a></li>
						<li class="rss"><a href="<?php echo esc_url( home_url( '/' ) ); ?>feed/">Subscribe using RSS</a></li>
					</ul>

					<h3>Socializing</h3>
					<p>Find, follow, and connect with us on these other platforms.</p>
					<ul>
						<li><a class="facebook" href="<?php echo esc_url( 'https://www.facebook.com/NursingClio' ); ?>">Facebook</a></li>
						<li><a class="twitter" href="<?php echo esc_url( 'https://twitter.com/nursingclio' ); ?>">Twitter</a></li>
					</ul>
				</div>

				<div class="bloginfo last-col">
					<h3>Write for Nursing Clio</h3>
					<p>Do you have work that would be a good fit for Nursing Clio?</p>
					<a class="btn-blue" href="<?php echo esc_url( home_url( '/' ) ); ?>write-for-us">Write for Us</a>
				</div>

				<p class="source-org copyright cf">Except where otherwise noted, all content is licensed by the credited writer under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons BY-SA License</a>. <?php bloginfo( 'name' ); ?> is powered by <a href="http://wordpress.org/" rel="generator">WordPress</a>, coffee, and community. Please consider <a href="<?php echo esc_url( home_url( '/' ) ); ?>donate">donating</a> to help keep us going. <a href="https://github.com/admturner/grammatizator">Grammatizator</a> theme by Adam Turner, built on <a href="http://themble.com/bones/">Bones</a>.</p>

			</div>

		</footer>

		<?php 
			/**
			 * Global navigation using the footer-anchor method
			 * 
			 * @todo Create a fallback function (in functions.php) just in case
			 */
		?>
		<nav id="main-nav" class="global-nav cf" role="navigation" aria-label="<?php esc_html_e( 'Main Navigation', 'bonestheme' ); ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<?php wp_nav_menu(array(
				'container' => false,                    			// remove nav container
				'menu' => __( 'Global Nav Menu', 'bonestheme' ),  	// nav name
				'theme_location' => 'main-nav',                 	// where it's located in the theme
    			'items_wrap' => '<ul class="nav"><li class="homeward"><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>%3$s<li class="nav-to-top"><a href="#logo">Top</a></li><li class="search">' . get_search_form( false ) . '</li></ul>', // Customize the sprint() for the actual nav list to cut out the ID cruft and add a "to top" link
    			'depth' => 0,                                   	// limit the depth of the nav
				'fallback_cb' => ''                             	// fallback function (if there is one)
			)); ?>
		</nav>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- End of site. Go thank a librarian! -->