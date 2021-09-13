<?php
$basket_items = get_basket_items();
$count_items = count($basket_items);

$total = 0;
foreach ( $basket_items as $basket_item ) {
	$total += intval( $basket_item['amount'] );
}
?>

<div class="widget-cart__body">
	<div class="widget-cart__body-top">
		<div class="widget-cart__cart">
			<?php ith_the_icon( 'cart', 'widget-cart__cart-icon' ); ?>
			<span class="widget-cart__cart-count"><?php echo $count_items; ?></span>
		</div>

		<a href="#" class="widget-cart__close"></a>
	</div>

	<h4 class="widget-cart__title">Donation Basket</h4>

	<div class="widget-cart__total-wrap">
		<div class="widget-cart__total-text">Your Donation</div>
		<div class="widget-cart__total">£<span><?php echo $total; ?></span></div>
	</div>

	<?php if ( $basket_items ): ?>
		<ul class="widget-cart-items">
			<?php foreach ( $basket_items as $basket_item ): ?>
				<li class="widget-cart-items__item">
					<div class="widget-cart-items__name"><?php echo $basket_item['title'] ? $basket_item['title'] : 'General Muath Trust'; ?></div>
					<div class="widget-cart-items__period"><?php echo get_donation_type_label( $basket_item['type'] ); ?></div>
					<div class="widget-cart-items__price">£<?php echo $basket_item['amount']; ?></div>
					<a href="#" class="widget-cart-items__remove">Remove</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<div class="widget-cart__body-bottom">
			<a href="<?php echo home_url( 'checkout?step=2' ); ?>" class="btn btn--light">Checkout</a>
		</div>
	<?php endif; ?>
</div>