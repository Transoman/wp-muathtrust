<?php
$hero_type = get_sub_field( 'type' );
$hero_title = get_sub_field( 'title' );
$hero_text = get_sub_field( 'text' );
$hero_bg_image = get_sub_field( 'background_image' );
?>
<section class="hero<?php echo $hero_type == 'with_timetable' ? ' hero--timetable' : ''; ?>">
	<div class="container">
		<div class="hero__wrap"<?php echo $hero_bg_image ? ' style="background-image: url('.$hero_bg_image.')"' : ''; ?>>
			<?php if ( $hero_type == 'with_timetable' ): ?>
				<h3 class="hero__text"><?php echo $hero_text; ?></h3>
			<?php endif; ?>

			<div class="timetable-line hero__timetable-line">
				<div class="timetable-line__left">
					<div class="timetable-line__name">Prayer Times</div>
					<div class="timetable-line__time">Friday Prayers start at 1:30pm</div>
				</div>

				<div class="timetable-line__right">
					<a href="#" class="timetable-line__link">See full timetable</a>
					<a href="#" class="timetable-line__btn btn-round"><?php ith_the_icon( 'arrow-right' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>