<?php
/**
 * Template Name: Business Hub Page
 */
get_header();
?>
	<section class="bh-hero">
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
