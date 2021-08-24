<?php
$policies_and_forms_title = get_sub_field('title');
$policies_and_forms_policies = get_sub_field('policies_list');
$policies_and_forms_forms = get_sub_field('forms_list');
$policies_and_forms_id = get_sub_field('id');
?>

<section class="policies-and-forms" id="<?php echo $policies_and_forms_id; ?>">
	<div class="container">
		<h2 class="policies-and-forms__title section-title"><?php echo $policies_and_forms_title; ?></h2>

		<?php if ( $policies_and_forms_policies ): ?>
			<div class="policies-and-forms-policies widget-acc">
				<?php foreach ( $policies_and_forms_policies as $item ): ?>
					<div class="widget-acc__item">
						<div class="widget-acc__head"><?php echo $item['title']; ?></div>
						<div class="widget-acc__content"><?php echo $item['text']; ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $policies_and_forms_forms ): ?>
			<div class="policies-and-forms-forms">
				<?php foreach ( $policies_and_forms_forms as $item ): ?>
					<div class="policies-and-forms-forms__item">
						<span class="policies-and-forms-forms__title"><?php echo $item['title']; ?></span>
						<a href="<?php echo $item['file']; ?>" class="policies-and-forms-forms__link" download>Download</a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>