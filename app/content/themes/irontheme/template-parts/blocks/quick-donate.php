<?php
$show_cover = get_sub_field( 'show_cover' );
?>
<section class="quick-donate<?php echo $show_cover ? ' quick-donate--cover' : ''; ?>">
	<div class="container">
		<div class="quick-donate__wrap">
			<h2 class="quick-donate__title">Quick Donate</h2>

			<form action="" class="quick-donate-form">
				<div class="quick-donate-form__col">
					<div class="form-group">
						<span class="amount-field">£</span>
						<select name="amount" required>
							<option value="">Amount</option>
							<option value="500" data-custom-properties='{"title": "General Muath Trust"}'>£500</option>
							<option value="250" data-custom-properties='{"title": "General Muath Trust"}'>£250</option>
							<option value="100" data-custom-properties='{"title": "General Muath Trust"}'>£100</option>
							<option value="50" data-custom-properties='{"title": "General Muath Trust"}'>£50</option>
							<option value="25" data-custom-properties='{"title": "General Muath Trust"}'>£25</option>
							<option value="custom" data-custom-properties='{"title": "General Muath Trust"}'>Custom</option>
						</select>
					</div>

					<div class="form-group quick-donate-form__custom-amount">
						<span class="amount-field">£</span>
						<input type="number" name="custom_amount">
					</div>
				</div>

				<div class="quick-donate-form__col">
					<div class="form-group">
						<select name="type" required>
							<option value="">One-Off/Monthly</option>
							<option value="once" style="">One-off Donation</option>
							<option value="monthly" style="">Monthly Donation</option>
						</select>
					</div>
				</div>

				<div class="quick-donate-form__col">
					<div class="form-group form-group--btn">
						<button type="submit" class="btn">Donate now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>