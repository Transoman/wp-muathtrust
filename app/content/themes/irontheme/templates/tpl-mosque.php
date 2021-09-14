<?php
/**
 * Template Name: Mosque Page
 */
get_header();

get_template_part( 'template-parts/breadcrumbs' );

$hero = get_field( 'hero' );
$section_2 = get_field( 'section_1' );
?>

	<section class="mosque-hero">
		<div class="mosque-hero__mobile-bg">
			<?php echo wp_get_attachment_image( $hero['image'], 'full' ); ?>
		</div>
		<div class="container">
			<div class="mosque-hero__bg">
				<?php echo wp_get_attachment_image( $hero['image'], 'full' ); ?>
			</div>
			<div class="mosque-hero__content">
				<h1 class="mosque-hero__title"><?php the_title(); ?></h1>

				<?php get_timetable_line( 'mosque-hero__timetable-line' ); ?>
			</div>
		</div>
	</section>

	<section class="mosque-content">
		<?php if ( have_rows( 'section_1' ) ): ?>
			<?php while ( have_rows( 'section_1' ) ): the_row(); ?>
				<div class="columns-text">
					<div class="container">
						<div class="columns-text__wrap">
							<div class="columns-text__left">
								<?php if ( $title = get_sub_field( 'title' ) ): ?>
									<h2 class="columns-text__title blue-color"><?php echo $title; ?></h2>
								<?php endif; ?>
							</div>

							<div class="columns-text__right">
								<?php if ( $text = get_sub_field( 'text' ) ): ?>
									<div class="columns-text__text"><?php echo $text; ?></div>
								<?php endif; ?>

								<?php if ( $list_links_title = get_sub_field( 'list_links_title' ) ): ?>
									<h2 class="columns-text__list-title"><?php echo $list_links_title; ?></h2>
								<?php endif; ?>

								<?php if ( have_rows( 'list_links' ) ): ?>
									<div class="columns-text__list-links">
										<?php while ( have_rows( 'list_links' ) ): the_row(); ?>
											<?php $link = get_sub_field( 'link' ); ?>
											<a href="<?php echo $link['url']; ?>" class="columns-text__list-links-item">
												<span class="columns-text__list-links-title"><?php echo $link['title']; ?></span>
												<?php ith_the_icon( 'arrow-diagonal' ); ?>
											</a>
										<?php endwhile; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php if ( have_rows( 'section_2' ) ): ?>
			<?php while ( have_rows( 'section_2' ) ): the_row(); ?>
				<div class="text-with-image">
					<div class="container">
						<?php if ( $title = get_sub_field( 'title' ) ): ?>
							<h2 class="text-with-image__title blue-color"><?php echo $title; ?></h2>
						<?php endif; ?>

						<div class="text-with-image__wrap">
							<div class="text-with-image__left">
								<?php echo wp_get_attachment_image( get_sub_field( 'image' ), 'text_with_image' ); ?>
							</div>

							<div class="text-with-image__right">
								<?php if ( $text = get_sub_field( 'text' ) ): ?>
									<div class="text-with-image__text"><?php echo $text; ?></div>
								<?php endif; ?>
								<?php if ( $btn = get_sub_field( 'button' ) ): ?>
									<a href="<?php echo $btn['url']; ?>" class="btn"><?php echo $btn['title']; ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>

<?php get_template_part( 'template-parts/blocks' ); ?>

<?php get_footer();
