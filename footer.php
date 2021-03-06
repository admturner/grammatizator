<?php
/**
 * Global site footer.
 *
 * @package Grammatizator
 */
?>

		<footer class="footer cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

			<h2 class="site-description">
				<?php bloginfo( 'description' ); ?>
			</h2>

			<div class="footer-wrap cf">
				<nav role="navigation" aria-label="<?php esc_html_e( 'Footer Navigation', 'bonestheme' ); ?>">
					<?php
					wp_nav_menu( array(
						'container'      => false,
						'menu'           => __( 'Footer Links', 'bonestheme' ),
						'theme_location' => 'footer-links',
						'items_wrap'     => '<ul class="nav footer-nav cf">%3$s</ul>',
						'fallback_cb'    => 'bones_footer_links_fallback',
					) );
					?>
				</nav>

				<div class="bloginfo about">
					<h3>What is Nursing Clio?</h3>
					<p>Nursing Clio is a collaborative blog project that ties historical scholarship to present-day political, social, and cultural issues surrounding gender and medicine. Learn more about Nursing Clio and our fabulous writers on our <a href="<?php echo esc_url( home_url( '/' ) ); ?>about">About page &rarr;</a></p>
				</div>

				<div class="bloginfo follow">
					<h3>Subscribe</h3>
					<p>Want regular updates sent right to your digital door?</p>
					<ul>
						<li class="email"><a rel="nofollow" href="<?php echo esc_url( home_url( '/' ) ); ?>subscribe/">Subscribe to email updates</a></li>
						<li class="rss"><a rel="nofollow" href="<?php echo esc_url( home_url( '/' ) ); ?>feed/">Subscribe using RSS</a></li>
					</ul>

					<h3>Socializing</h3>
					<p>Find, follow, and connect with us on these other platforms.</p>
					<ul class="sharing inline-items">
						<li><a class="share-facebook" rel="nofollow" href="<?php echo esc_url( 'https://www.facebook.com/NursingClio' ); ?>">Facebook</a></li>
						<li><a class="share-twitter" rel="nofollow" title="Nursing Clio on Twitter @nursingclio" href="<?php echo esc_url( 'https://twitter.com/nursingclio' ); ?>">Twitter</a></li>
						<li><a class="share-instagram" rel="nofollow" title="Nursing Clio on Instagram @nursingclio" href="<?php echo esc_url( 'https://www.instagram.com/nursingclio/' ); ?>">Instagram</a></li>
					</ul>
				</div>

				<div class="bloginfo last-col">
					<h3>Write for Nursing Clio</h3>
					<p>Do you have work that would be a good fit for Nursing Clio?</p>
					<a class="btn-blue" href="<?php echo esc_url( home_url( '/' ) ); ?>write-for-us">Write for Us</a>
				</div>

				<?php // @todo Move this (and other static content here) to a widget or custom module of some kind, and create a license or use page to specify that special cases can be negotiated ?>
				<p class="source-org copyright cf">Except where otherwise noted, all content is licensed by the credited writer under a <a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons BY-NC-SA License</a>. <?php bloginfo( 'name' ); ?> is powered by <a href="http://wordpress.org/" rel="generator">WordPress</a>, coffee, and community. Please consider <a href="<?php echo esc_url( home_url( '/' ) ); ?>how-we-use-donations/">donating</a> to help keep us going. <a href="https://github.com/admturner/grammatizator">Grammatizator</a> theme by Adam Turner.</p>
			</div>

		</footer>

		<?php
		/*
		 * Global navigation using the footer-anchor method
		 *
		 * @todo Create a fallback function (in functions.php) just in case
		 */
		?>
		<nav id="main-nav" class="global-nav cf" role="navigation" aria-label="<?php esc_html_e( 'Main Navigation', 'bonestheme' ); ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<?php
			wp_nav_menu( array(
				'container'      => false,
				'menu'           => __( 'Global Nav Menu', 'bonestheme' ),
				'theme_location' => 'global-nav',
				'items_wrap'     => '<ul class="nav"><li class="homeward"><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>%3$s<li class="nav-to-top"><a href="#logo">Top</a></li><li class="search">' . get_search_form( false ) . '</li></ul>',
				'depth'          => 0,
				'fallback_cb'    => '',
			) );
			?>
		</nav>

		<?php wp_footer(); ?>
	</body>
	<!-- End of site. Go thank a librarian! -->
</html>
