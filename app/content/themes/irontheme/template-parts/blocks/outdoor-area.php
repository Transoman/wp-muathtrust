<?php
$outdoor_area_title = get_sub_field( 'title' );
$outdoor_area_text_left = get_sub_field('text_left');
$outdoor_area_text_right = get_sub_field('text_right');
$outdoor_area_bottom_text = get_sub_field('bottom_text');
$outdoor_area_bg_image = get_sub_field('background_image');
$outdoor_area_id = get_sub_field('id');
?>
<section class="outdoor" style="background-image: url(<?php echo $outdoor_area_bg_image; ?>)" id="<?php echo $outdoor_area_id; ?>">
	<div class="container">
		<h2 class="outdoor__title section-title"><?php echo $outdoor_area_title; ?></h2>
		<div class="outdoor__wrap">
			<div class="outdoor__left"><?php echo $outdoor_area_text_left; ?></div>
			<div class="outdoor__right"><?php echo $outdoor_area_text_right; ?></div>
		</div>

		<?php if ( $outdoor_area_bottom_text ): ?>
			<div class="outdoor__bottom">
				<div class="outdoor__bottom-text"><?php echo $outdoor_area_bottom_text; ?></div>
			</div>
		<?php endif; ?>
	</div>
</section>