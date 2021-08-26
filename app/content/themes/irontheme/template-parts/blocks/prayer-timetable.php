<section class="prayer-timetable">
	<div class="container">
		<?php echo do_shortcode( '[monthlytable]' ); ?>

		<?php if ( $bottom_text = get_sub_field( 'bottom_text' ) ): ?>
			<div class="prayer-timetable__text"><?php echo $bottom_text; ?></div>
		<?php endif; ?>

		<?php if ( $pdf_timetable = get_sub_field( 'pdf_timetable' ) ): ?>
			<div class="prayer-timetable__bottom text-center">
				<a href="<?php echo $pdf_timetable; ?>" target="_blank" class="btn">Download</a>
			</div>
		<?php endif; ?>
	</div>
</section>