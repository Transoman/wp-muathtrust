<?php


class Booking_Services_List_Table extends WP_List_Table {

	function __construct(){
		parent::__construct(array(
			'singular' => 'booking-service',
			'plural'   => 'booking-services',
			'ajax'     => false,
		));

		$this->bulk_action_handler();

		// screen option
		add_screen_option( 'per_page', array(
			'label'   => 'Number of items per page',
			'default' => 20,
			'option'  => 'booking_services_per_page',
		) );

		$this->prepare_items();

//		add_action( 'wp_print_scripts', [ __CLASS__, '_list_table_css' ] );
	}

	function prepare_items() {
		global $wpdb;

		// пагинация
		$per_page = get_user_meta( get_current_user_id(), get_current_screen()->get_option( 'per_page', 'option' ), true ) ?: 20;

		$args = [
			'post_type' => 'booking_service',
			'posts_per_page' => $per_page,
		];

		$query = new WP_Query( $args );
		$data = [];

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				$one_date = get_post_meta( get_the_ID() , 'one_date', true );
				$one_time = get_post_meta( get_the_ID() , 'one_time', true );
				$block_date = get_post_meta( get_the_ID() , 'block_date', true );
				$block_time = get_post_meta( get_the_ID() , 'block_time', true );
				$str_date = '';

				if ( $one_date ) {
					$str_date .= $one_date . ' ' . $one_time . '<br>';
				}

				if ( $block_date ) {
					$block_date = explode( ', ', $block_date );
					for( $i = 0; $i < count($block_date); $i++ ) {
						$str_date .= $block_date[$i] . '<br>';
					}
				}

				$data[] = [
					'id' => get_the_ID(),
					'name' => get_post_meta( get_the_ID() , 'name', true ),
					'email' => get_post_meta( get_the_ID() , 'email', true ),
					'phone' => get_post_meta( get_the_ID() , 'phone', true ),
					'company' => get_post_meta( get_the_ID() , 'company', true ),
					'date' => $str_date
				];
			}
		}
		wp_reset_postdata();

		$this->set_pagination_args( array(
			'total_items' => $query->max_num_pages,
			'per_page'    => $per_page,
		) );
		$cur_page = (int) $this->get_pagenum(); // желательно после set_pagination_args()

		// элементы таблицы
		// обычно элементы получаются из БД запросом
		// $this->items = get_posts();

		// чтобы понимать как должны выглядеть добавляемые элементы
		$this->items = $data;

	}

	// колонки таблицы
	function get_columns(){
		return array(
			'cb'    => '<input type="checkbox" />',
			'name'  => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'address' => 'Address',
			'company' => 'Company',
			'date'  => 'Booking Dates'
		);
	}

	// сортируемые колонки
	function get_sortable_columns(){
		return array(
			'name' => array( 'name', 'desc' ),
		);
	}

	protected function get_bulk_actions() {
		return array(
			'delete' => 'Delete',
		);
	}

	function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			default:
				return $item[ $column_name ];
		}
	}

	function column_cb( $item ){
		echo '<input type="checkbox" name="licids[]" id="cb-select-'. $item['id'] .'" value="'. $item['id'] .'" />';
	}

	function column_address( $item ) {
		$address = [];
		$street = get_post_meta( $item['id'], 'street', true );
		$city = get_post_meta( $item['id'], 'city', true );
		$area = get_post_meta( $item['id'], 'area', true );
		$postcode = get_post_meta( $item['id'], 'postcode', true );

		if ( $city ) {
			$address['city'] = $city;
		}

		if ( $street ) {
			$address['street'] = $street;
		}

		if ( $area ) {
			$address['area'] = $area;
		}

		if ( $postcode ) {
			$address['postcode'] = $postcode;
		}

		echo implode( ' | ', $address );
	}

	// остальные методы, в частности вывод каждой ячейки таблицы...

	// helpers -------------

	private function bulk_action_handler(){
		if( empty($_POST['licids']) || empty($_POST['_wpnonce']) ) return;

		if ( ! $action = $this->current_action() ) return;

		if( ! wp_verify_nonce( $_POST['_wpnonce'], 'bulk-' . $this->_args['plural'] ) )
			wp_die('nonce error');

		foreach( $_POST['licids'] as $item) {
			wp_delete_post( $item, true );
		}
	}

	/*
	// Пример создания действий - ссылок в основной ячейки таблицы при наведении на ряд.
	// Однако гораздо удобнее указать их напрямую при выводе ячейки - см ячейку customer_name...

	// основная колонка в которой будут показываться действия с элементом
	protected function get_default_primary_column_name() {
		return 'disp_name';
	}

	// действия над элементом для основной колонки (ссылки)
	protected function handle_row_actions( $post, $column_name, $primary ) {
		if ( $primary !== $column_name ) return ''; // только для одной ячейки

		$actions = array();

		$actions['edit'] = sprintf( '<a href="%s">%s</a>', '#', __('edit','hb-users') );

		return $this->row_actions( $actions );
	}
	*/
}