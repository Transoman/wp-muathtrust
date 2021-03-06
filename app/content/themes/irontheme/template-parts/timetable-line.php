<?php
extract( $args );

$json = wp_remote_get( home_url( 'wp-json/dpt/v1/prayertime?filter=today' ) );

if ( ! is_wp_error($json) && isset( $json['body'] ) ):
	$result = json_decode( $json['body'] );

	$time = '';
	$name = '';
	$prayer_names = [
		'fajr_begins' => 'Fajr',
		'zuhr_begins' => 'Zuhr',
		'asr_mithl_1' => 'Asr',
		'asr_mithl_2' => 'Asr',
		'maghrib_begins' => 'Maghrib',
		'isha_begins' => 'Isha',
	];

	foreach ( $result[0] as $key => $item ) {
		switch ( $key ) {
			case 'fajr_begins':
			case 'zuhr_begins':
			case 'asr_mithl_1':
			case 'asr_mithl_2':
			case 'maghrib_begins':
			case 'isha_begins':
				if ( time() <= strtotime($item) ) {
					$time = date( 'g:i a', strtotime($item) );
					$name = $prayer_names[ $key ];
					break(2);
				}
		}
	}

	?>
	<div class="timetable-line <?php echo $class; ?>">
		<div class="timetable-line__left">
			<div class="timetable-line__name">Prayer Times</div>
			<div class="timetable-line__time"><?php echo $name; ?> prayers start at <?php echo $time; ?></div>
		</div>

		<div class="timetable-line__right">
			<a href="<?php echo home_url( '/prayer-timetable' ); ?>" class="timetable-line__link">See full timetable</a>
			<a href="<?php echo home_url( '/prayer-timetable' ); ?>"
			   class="timetable-line__btn btn-round"><?php ith_the_icon( 'arrow-right' ); ?></a>
		</div>
	</div>
<?php endif;