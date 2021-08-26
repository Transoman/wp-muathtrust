<?php
extract( $args );

$json = wp_remote_get( 'http://muathtrust.loc/wp-json/dpt/v1/prayertime?filter=today' );
if ( $json['body'] ):
	$result = json_decode( $json['body'] );
	?>
	<div class="timetable-line <?php echo $class; ?>">
		<div class="timetable-line__left">
			<div class="timetable-line__name">Prayer Times</div>
			<div class="timetable-line__time"><?php echo date( 'l', strtotime($result[0]->d_date) ); ?> Prayers start at <?php echo date( 'g:i a', strtotime($result[0]->zuhr_begins) ); ?></div>
		</div>

		<div class="timetable-line__right">
			<a href="<?php echo home_url( '/prayer-timetable' ); ?>" class="timetable-line__link">See full timetable</a>
			<a href="<?php echo home_url( '/prayer-timetable' ); ?>"
			   class="timetable-line__btn btn-round"><?php ith_the_icon( 'arrow-right' ); ?></a>
		</div>
	</div>
<?php endif;