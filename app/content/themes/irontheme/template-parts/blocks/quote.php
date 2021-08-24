<?php
$text = get_sub_field( 'text' );

if ( $text ):
?>
<section class="quote">
	<div class="container">
		<div class="quote__text"><?php echo $text; ?></div>
	</div>
</section>
<?php endif;