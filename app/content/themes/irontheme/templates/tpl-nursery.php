<?php
/**
 * Template Name: Nursery Page
 */
get_header();

$breadcrumbs_visibility = get_field( 'breadcrumbs_visibility' );

get_template_part( 'template-parts/breadcrumbs' );
?>
<?php
$section_1 = get_field( 'section_1' );
$section_1_left_text = $section_1['left_text'];
$section_1_right_list = $section_1['right_list'];
$section_1_right_navigation = $section_1['navigation'];
?>
<section class="nursery-section-1<?php echo $breadcrumbs_visibility != 'hide' ? ' nursery-section-1--breadcrumbs-show' : ''; ?>">
	<div class="container">
		<div class="nursery-section-1__wrap">
			<div class="nursery-section-1__left">
				<h1 class="nursery-section-1__title"><?php the_title(); ?></h1>

				<?php if ( $section_1_left_text ): ?>
					<div class="nursery-section-1__left-text"><?php echo $section_1_left_text; ?></div>
				<?php endif; ?>

				<?php if ( $section_1_right_navigation ): ?>
				<ul class="page-nav">
					<?php foreach ( $section_1_right_navigation as $item ): ?>
						<li class="page-nav__item">
							<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="page-nav__link"><?php echo $item['link']['title']; ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
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

<?php get_template_part( 'template-parts/blocks' ); ?>

<?php get_footer();
