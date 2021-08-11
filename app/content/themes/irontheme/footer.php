	</div><!-- /.content -->

	<footer class="footer">
		<div class="container">
			<div class="footer__top">
				<div class="footer__top-left">
					<a href="<?php echo home_url( '/' ); ?>" class="logo footer__logo">
						<img src="<?php echo THEME_URL; ?>/images/general/logo-black.png" alt="<?php echo get_bloginfo( 'name' ); ?>" width="173">
					</a>
				</div>

				<div class="footer__top-right">
					<?php if ( is_active_sidebar( 'footer-1' ) ): ?>
						<div class="footer__col">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
					<?php endif ?>

					<?php if ( is_active_sidebar( 'footer-2' ) ): ?>
						<div class="footer__col">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
					<?php endif ?>

					<?php if ( is_active_sidebar( 'footer-3' ) ): ?>
						<div class="footer__col">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
					<?php endif ?>

					<?php if ( is_active_sidebar( 'footer-4' ) ): ?>
						<div class="footer__col">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div>
					<?php endif ?>

					<?php if ( is_active_sidebar( 'footer-5' ) ): ?>
						<div class="footer__col">
							<?php dynamic_sidebar( 'footer-5' ); ?>
						</div>
					<?php endif ?>
				</div>
			</div>

			<div class="footer__bottom">
				<div class="footer__info">The Muath Trust is a Charity No. 1100481 and a Company limited by guarantee No. 04805117. Registered in England & Wales <br>Registered Office: The Bordesley Centre, Stratford Road, Camp Hill, Birmingham, B11 1AR</div>

				<div class="footer__dev">Designed and Developed by <a href="https://www.arrenmarketing.com/" target="_blank">Arren Marketing</a></div>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- /.wrapper -->

<?php wp_footer(); ?>

</body>
</html>
