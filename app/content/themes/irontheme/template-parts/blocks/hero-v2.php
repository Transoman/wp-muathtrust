<?php
$title = get_sub_field( 'title' );
$bg_image = get_sub_field( 'background_image' );
?>
<section class="hero-v2" style="background-image: url(<?php echo $bg_image; ?>)">
	<div class="container">
		<h1 class="hero-v2__title"><?php echo $title ? $title : get_the_title(); ?></h1>
	</div>
</section>
