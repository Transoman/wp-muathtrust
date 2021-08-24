<?php
$staff_title = get_sub_field('title');
$staff_list = get_sub_field('list');
$staff_image = get_sub_field('image');
$staff_id = get_sub_field('id');
?>

<section class="staff" id="<?php echo $staff_id; ?>">
	<div class="container">
		<div class="staff__wrap">
			<div class="staff__left">
				<?php echo wp_get_attachment_image( $staff_image, 'staff' ); ?>
			</div>

			<div class="staff__right">
				<h2 class="staff__title section-title"><?php echo $staff_title; ?></h2>

				<?php if ( $staff_list ): ?>
					<div class="staff-list">
						<?php $i = 1; foreach ( $staff_list as $item ): ?>
							<div class="staff-list__item">
								<span class="staff-list__counter"><?php echo zeroise( $i++, 2 ); ?></span>
								<div class="staff-list__text"><?php echo $item['text']; ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>