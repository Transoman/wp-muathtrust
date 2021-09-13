<?php
/**
 * Template Name: Business Hub Page
 */
get_header();

$breadcrumbs_visibility = get_field( 'breadcrumbs_visibility' );

get_template_part( 'template-parts/breadcrumbs' );
?>
	<section class="bh-hero<?php echo $breadcrumbs_visibility != 'hide' ? ' bh-hero--breadcrumbs-show' : ''; ?>">
		<div class="container">
			<h1 class="bh-hero__title"><?php the_title(); ?></h1>
		</div>
	</section>

<?php if ( $text = get_field( 'text' ) ): ?>
	<section class="bh-content">
		<div class="container">
			<div class="bh-content__text">
				<?php echo $text; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/blocks' ); ?>

<?php get_footer();
