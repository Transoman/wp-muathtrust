<?php
/**
 * Template Name: Donate Page
 */
get_header();

get_template_part( 'template-parts/breadcrumbs' );
?>
<?php
$hero = get_field( 'hero' );
$hero_title = $hero['title'];
$hero_bg_image = $hero['background_image'];
?>
<section class="donate-hero" style="background-image: url(<?php echo $hero_bg_image; ?>)">
	<div class="container">
		<h1 class="donate-hero__title"><?php echo $hero_title ? $hero_title : get_the_title(); ?></h1>
	</div>
</section>

<?php
$section_1 = get_field( 'section_1' );
$section_1_text = $section_1['text'];
?>

<section class="donate-section-1">
	<div class="container">
		<div class="donate-section-1__wrap">
			<div class="donate-section-1__left">
				<form class="donation-form">
					<div class="donation-form__inner">
						<div class="donation-form__types">
							<div class="donation-form__type">
								<input type="radio" name="type" value="once" id="donation-type-single" checked>
								<label for="donation-type-single">Single</label>
							</div>
							<div class="donation-form__type">
								<input type="radio" name="type" value="monthly" id="donation-type-monthly">
								<label for="donation-type-monthly">Monthly</label>
							</div>
						</div>

						<div class="donation-form__list">
							<?php
							$args = array(
								'post_type' => 'appeals',
								'posts_per_page' => -1
							);

							$appeals = new WP_Query( $args );

							if ( $appeals->have_posts() ):
								while ( $appeals->have_posts() ): $appeals->the_post();
									$appeals_details = get_field( 'appeals_details' );
								?>
									<label class="donation-form__list-item">
										<input type="radio" name="donation" value="<?php echo get_the_ID(); ?>" data-name="<?php the_title(); ?>" data-amount="<?php echo $appeals_details['price']; ?>">
										<span class="donation-form__list-price">£<?php echo $appeals_details['price']; ?></span>
										<span class="donation-form__list-name"><?php the_title(); ?></span>
									</label>
								<?php endwhile; wp_reset_postdata();
							endif; ?>
						</div>

						<div class="donation-form__other-amount">
							<h4>Or enter amount</h4>
							<div class="form-group">
								<input type="number" name="amount_custom" inputmode="numeric">
								<span class="donation-form__other-amount-symbol">£</span>
								<a href="#" class="donation-form__other-amount-remove">Remove</a>
							</div>
						</div>

						<div class="donation-form__bottom text-center">
							<button type="submit" class="btn btn--lighten">Donate</button>
						</div>
					</div>
				</form>
			</div>

			<div class="donate-section-1__right">
				<?php echo $section_1_text; ?>
			</div>
		</div>
	</div>
</section>

<?php
$section_2 = get_field( 'section_2' );
$section_2_text = $section_2['text'];
$section_2_image_left = $section_2['image_left'];
$section_2_image_right = $section_2['image_right'];
?>

<section class="donate-section-2">
	<div class="container">
		<div class="donate-section-2__wrap">
			<div class="donate-section-2__left">
				<?php echo $section_2_text; ?>

				<?php if ( $section_2_image_left ): ?>
					<figure>
						<?php echo wp_get_attachment_image( $section_2_image_left, 'full' ); ?>

						<?php if ( $figcaption = wp_get_attachment_caption( $section_2_image_left ) ): ?>
							<figcaption><?php echo $figcaption; ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>
			</div>

			<div class="donate-section-2__right">
				<?php if ( $section_2_image_right ): ?>
					<figure>
						<?php echo wp_get_attachment_image( $section_2_image_right, '260x330' ); ?>

						<?php if ( $figcaption = wp_get_attachment_caption( $section_2_image_right ) ): ?>
							<figcaption><?php echo $figcaption; ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php
$section_3 = get_field( 'section_3' );
$section_3_text = $section_3['text'];
$section_3_image_left = $section_3['image_left'];
$section_3_image_right = $section_3['image_right'];
?>

<section class="donate-section-3">
	<div class="container">
		<div class="donate-section-3__wrap">
			<div class="donate-section-3__left">
				<?php if ( $section_3_image_left ): ?>
					<figure>
						<?php echo wp_get_attachment_image( $section_3_image_left, '260x330' ); ?>

						<?php if ( $figcaption = wp_get_attachment_caption( $section_3_image_left ) ): ?>
							<figcaption><?php echo $figcaption; ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>
			</div>

			<div class="donate-section-3__right">
				<?php echo $section_3_text; ?>

				<?php if ( $section_3_image_right ): ?>
					<figure>
						<?php echo wp_get_attachment_image( $section_3_image_right, 'full' ); ?>

						<?php if ( $figcaption = wp_get_attachment_caption( $section_3_image_right ) ): ?>
							<figcaption><?php echo $figcaption; ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/blocks' ); ?>

<?php get_footer();
