<?php
/**
 * Template Name: Nursery Page
 */
get_header();
?>
<?php
$section_1 = get_field( 'section_1' );
$section_1_left_text = $section_1['left_text'];
$section_1_right_list = $section_1['right_list'];
?>
<section class="nursery-section-1">
	<div class="container">
		<div class="nursery-section-1__wrap">
			<div class="nursery-section-1__left">
				<h1 class="nursery-section-1__title"><?php the_title(); ?></h1>

				<?php if ( $section_1_left_text ): ?>
					<div class="nursery-section-1__left-text"><?php echo $section_1_left_text; ?></div>
				<?php endif; ?>

				<ul class="page-nav">
					<li class="page-nav__item">
						<a href="#outdoor-area" class="page-nav__link">Outdoor area</a>
					</li>
					<li class="page-nav__item">
						<a href="#age-of-children" class="page-nav__link">Age of children</a>
					</li>
					<li class="page-nav__item">
						<a href="#opening-time" class="page-nav__link">Opening time</a>
					</li>
					<li class="page-nav__item">
						<a href="#fees-and-payment" class="page-nav__link">Fees and payment</a>
					</li>
					<li class="page-nav__item">
						<a href="#staff" class="page-nav__link">Staff</a>
					</li>
					<li class="page-nav__item">
						<a href="#sign-up-child" class="page-nav__link">Sign UP child</a>
					</li>
					<li class="page-nav__item">
						<a href="#policies-and-forms" class="page-nav__link">Policies and forms</a>
					</li>
				</ul>
			</div>

			<div class="nursery-section-1__right">
				<?php if ( $section_1_right_list ): ?>
					<div class="nursery-section-1__list">
						<?php foreach ( $section_1_right_list as $item ): ?>
							<div class="nursery-section-1__list-item">
								<h2 class="nursery-section-1__list-title"><?php echo $item['title']; ?></h2>
								<div class="nursery-section-1__list-text"><?php echo $item['content']; ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php
$outdoor_area = get_field( 'outdoor_area' );
$outdoor_area_text_left = $outdoor_area['text_left'];
$outdoor_area_text_right = $outdoor_area['text_right'];
$outdoor_area_bottom_text = $outdoor_area['bottom_text'];
$outdoor_area_bg_image = $outdoor_area['background_image'];
?>
<section class="outdoor" id="outdoor-area" style="background-image: url(<?php echo $outdoor_area_bg_image; ?>)">
	<div class="container">
		<h2 class="outdoor__title section-title">Outdoor area</h2>
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

<?php
$age_of_children = get_field( 'age_of_children' );
$age_of_children_title = $age_of_children['title'];
$age_of_children_text = $age_of_children['text'];
$age_of_children_image = $age_of_children['image'];
?>
<section class="age-of-children" id="age-of-children">
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

<?php
$opening_time = get_field( 'opening_time' );
$opening_time_image = $opening_time['image'];
$opening_time_title = $opening_time['title'];
$opening_time_text = $opening_time['text'];
?>
<section class="opening-time" id="opening-time">
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

<?php
$fees_and_payment = get_field( 'fees_and_payment' );
$fees_and_payment_title = $fees_and_payment['title'];
$fees_and_payment_text = $fees_and_payment['text'];
$fees_and_payment_list = $fees_and_payment['list'];
?>
<section class="fees-and-payment" id="fees-and-payment">
	<div class="fees-and-payment__head">
		<div class="container">
			<h2 class="fees-and-payment__title section-title"><?php echo $fees_and_payment_title ;?></h2>
			<div class="fees-and-payment__text"><?php echo $fees_and_payment_text ;?></div>
		</div>
	</div>

	<?php if ( $fees_and_payment_list ): ?>
		<div class="fees-and-payment-tabs">
			<div class="fees-and-payment-tabs__list-wrap">
				<div class="container">
					<div class="fees-and-payment-tabs__list-select">
							<span><?php echo $fees_and_payment_list[0]['title']; ?></span>
						<?php ith_the_icon( 'chevron-down' ); ?>
					</div>
					<ul class="fees-and-payment-tabs__list">
						<?php $i = 0; foreach ( $fees_and_payment_list as $item ): ?>
							<li>
								<a href="#<?php echo strtolower( str_replace( ' ', '-', $item['title'] ) ); ?>"<?php echo $i++ == 0 ? ' class="is-active"' : ''; ?>><?php echo $item['title']; ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<?php $i = 0; foreach ( $fees_and_payment_list as $item ): ?>
				<div class="fees-and-payment-tabs__item<?php echo $i++ == 0 ? ' is-active' : ''; ?>" id="<?php echo strtolower( str_replace( ' ', '-', $item['title'] ) ); ?>">
					<div class="container">
						<div class="fees-and-payment-tabs__content"><?php echo $item['content']; ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</section>

<?php if ( $big_image = get_field( 'big_image' ) ): ?>
	<figure class="big-image">
		<?php echo wp_get_attachment_image( $big_image, 'full' ); ?>
	</figure>
<?php endif; ?>

<?php
$staff = get_field( 'staff' );
$staff_title = $staff['title'];
$staff_list = $staff['list'];
$staff_image = $staff['image'];
?>

<section class="staff" id="staff">
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

<?php
$sign_up_child = get_field( 'sign_up_child' );
$sign_up_child_title = $sign_up_child['title'];
$sign_up_child_form = $sign_up_child['form'];
?>
<section class="sign-up-child" id="sign-up-child">
	<div class="container">
		<div class="sign-up-child__wrap">
			<h2 class="sign-up-child__title"><?php echo $sign_up_child_title; ?></h2>

			<?php if ( $sign_up_child_form ) {
				echo do_shortcode( '[contact-form-7 id="' . $sign_up_child_form . '"]' );
			} ?>

		</div>
	</div>
</section>

<?php
$policies_and_forms = get_field( 'policies_and_forms' );
$policies_and_forms_title = $policies_and_forms['title'];
$policies_and_forms_policies = $policies_and_forms['policies_list'];
$policies_and_forms_forms = $policies_and_forms['forms_list'];
?>

	<section class="policies-and-forms" id="policies-and-forms">
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

<?php get_template_part( 'template-parts/blocks' ); ?>

<?php get_footer();
