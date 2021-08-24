<?php
$fees_and_payment_title = get_sub_field('title');
$fees_and_payment_text = get_sub_field('text');
$fees_and_payment_list = get_sub_field('list');
$fees_and_payment_id = get_sub_field('id');
?>
<section class="fees-and-payment" id="<?php echo $fees_and_payment_id; ?>">
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