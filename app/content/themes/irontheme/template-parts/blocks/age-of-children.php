<?php
$age_of_children_title = get_sub_field('title');
$age_of_children_text = get_sub_field('text');
$age_of_children_image = get_sub_field('image');
$age_of_children_id = get_sub_field('id');
?>
<section class="age-of-children" id="<?php echo $age_of_children_id; ?>">
	<div class="container">
		<div class="age-of-children__wrap">
			<div class="age-of-children__left">
				<?php echo wp_get_attachment_image( $age_of_children_image, 'age_of_children' ); ?>
			</div>

			<div class="age-of-children__right">
				<h2 class="age-of-children__title section-title"><?php echo $age_of_children_title; ?></h2>
				<div class="age-of-children__text"><?php echo $age_of_children_text; ?></div>
			</div>
		</div>
	</div>
</section>