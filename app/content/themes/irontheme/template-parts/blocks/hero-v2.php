<?php
$title = get_sub_field( 'title' );
$bg_image = get_sub_field( 'background_image' );
$text_block = get_sub_field( 'text_block' );
?>
<section class="hero-v2<?php echo $text_block ? ' hero-v2--text-block' : ''; ?>">
	<div class="hero-v2__inner" style="background-image: url(<?php echo $bg_image; ?>)">
		<div class="container">
			<h1 class="hero-v2__title"><?php echo $title ? $title : get_the_title(); ?></h1>
		</div>
	</div>

	<?php if ( $text_block ): ?>
		<div class="container">
			<div class="hero-v2__text-block"><?php echo $text_block; ?></div>
		</div>
	<?php endif; ?>
</section>
