			<aside id="sidebar" class="sidebar cf" role="complementary">
				<?php bones_related_posts(); ?>
				<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar1' ); ?>
				<?php endif; ?>
			</aside>
