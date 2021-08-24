<?php
$opening_time_image = get_sub_field('image');
$opening_time_title = get_sub_field('title');
$opening_time_text = get_sub_field('text');
$opening_time_id = get_sub_field('id');
?>
<section class="opening-time" id="<?php echo $opening_time_id; ?>">
	<div class="container">
		<div class="opening-time__wrap">
			<div class="opening-time__content">
				<h2 class="opening-time__title"><?php echo $opening_time_title; ?></h2>
				<div class="opening-time__text"><?php echo $opening_time_text; ?></div>
			</div>

			<div class="opening-time__image">
				<?php echo wp_get_attachment_image( $opening_time_image, 'opening_time' ); ?>
			</div>
		</div>
	</div>
</section>