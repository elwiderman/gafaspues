<?php
/**
 * REST API Vendors Stats controller.
 *
 * @author  YITH
 * @package YITH\MultiVendor
 * @version 2.0.0
 */

defined( 'YITH_WPV_INIT' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'YITH_Vendors_REST_Reports_Vendors_Stats_Controller' ) ) {
	/**
	 * REST API Reports controller class.
	 */
	class YITH_Vendors_REST_Reports_Vendors_Stats_Controller extends YITH_Vendors_Abstract_REST_Reports_Stats_Controller {

		/**
		 * Mapping between external parameter name and name used in query class.
		 *
		 * @var array
		 */
		protected $param_mapping = array(
			'vendors'  => 'vendor_id',
			'products' => 'product_id',
			'fields'   => 'stats',
		);

		/**
		 * Part of the url after $this::rest_base.
		 *
		 * @var string
		 */
		protected $rest_path = 'vendors/stats';

		/**
		 * A list of statistics that will be provided for each segment, for each interval.
		 *
		 * @var array
		 */
		protected $stats = array(
			'commissions_count',
			'commissions_total_pending',
			'commissions_total_earnings',
			'commissions_total_refunds',
			'commissions_total_paid',
			'commissions_store_gross_total',
			'commissions_store_net_total',
			'orders_count',
		);

		/**
		 * Get all reports.
		 *
		 * @param \WP_REST_Request $request Request data.
		 * @return \WP_Rest_Response|\WP_Error
		 */
		public function get_items( $request ) {
			$stats = $this->get_segmented_data( $request );
			$data  = array();

			foreach ( $stats as $interval_data ) {
				$item                = $this->prepare_item_for_response( $interval_data, $request );
				$data['intervals'][] = $this->prepare_response_for_collection( $item );
			}

			$data['totals'] = $this->get_segmented_totals( $request );

			$response = rest_ensure_response( $data );
			$response = $this->prepare_pagination_params( $stats, $request, $response );

			return $response;
		}

		/**
		 * Get the Report's schema, conforming to JSON Schema.
		 *
		 * @return array
		 */
		public function get_item_schema() {
			$data_values = array(
				'commissions_count'             => array(
					'type'        => 'integer',
					'readonly'    => true,
					'context'     => array( 'view', 'edit' ),
					'description' => _x( 'Count of commissions created for the vendor in the specified interval.', '[REST API] Vendor schema', 'yith-woocommerce-product-vendors' ),
				),
				'commissions_total_earnings'    => array(
					'type'        => 'number',
					'readonly'    => true,
					'context'     => array( 'view', 'edit' ),
					'description' => _x( 'Vendor\'s total commissions earnings in the specified interval.', '[REST API] Vendor schema', 'yith-woocommerce-product-vendors' ),
				),
				'commissions_total_pending'     => array(
					'type'        => 'number',
					'readonly'    => true,
					'context'     => array( 'view', 'edit' ),
					'description' => _x( 'Total pending commissions for the vendor in the specified interval.', '[REST API] Vendor schema', 'yith-woocommerce-product-vendors' ),
				),
				'commissions_total_refunds'     => array(
					'type'        => 'number',
					'readonly'    => true,
					'context'     => array( 'view', 'edit' ),
					'description' => _x( 'Total refunded commissions from the vendor in the specified interval.', '[REST API] Vendor schema', 'yith-woocommerce-product-vendors' ),
				),
				'commissions_total_paid'        => array(
					'type'        => 'number',
					'readonly'    => true,
					'context'     => array( 'view', 'edit' ),
					'description' => _x( 'Total paid commissions to the vendor in the specified interval.', '[REST API] Vendor schema', 'yith-woocommerce-product-vendors' ),
				),
				'commissions_store_gross_total' => array(
					'type'        => 'number',
					'readonly'    => true,
					'context'     => array( 'view', 'edit' ),
					'description' => _x( 'Store gross earnings generated by the vendor in the specified interval.', '[REST API] Vendor schema', 'yith-woocommerce-product-vendors' ),
				),
				'commissions_store_net_total'   => array(
					'type'        => 'number',
					'readonly'    => true,
					'context'     => array( 'view', 'edit' ),
					'description' => _x( 'Store net earnings produced by the vendor in the specified interval.', '[REST API] Vendor schema', 'yith-woocommerce-product-vendors' ),
				),
				'orders_count'                  => array(
					'type'        => 'integer',
					'readonly'    => true,
					'context'     => array( 'view', 'edit' ),
					'description' => _x( 'Number of orders registered for the vendor in the specified interval.', '[REST API] Vendor schema', 'yith-woocommerce-product-vendors' ),
				),
			);

			$segments = array(
				'segments' => array(
					'description' => _x( 'Reports data grouped by segment condition.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
					'type'        => 'array',
					'context'     => array( 'view', 'edit' ),
					'readonly'    => true,
					'items'       => array(
						'type'       => 'object',
						'properties' => array(
							'segment_id'    => array(
								'description' => _x( 'Segment identificator.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
								'type'        => 'integer',
								'context'     => array( 'view', 'edit' ),
								'readonly'    => true,
							),
							'segment_label' => array(
								'description' => _x( 'Human readable segment label, either product or variation name.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
								'type'        => 'string',
								'context'     => array( 'view', 'edit' ),
								'readonly'    => true,
								'enum'        => array( 'day', 'week', 'month', 'year' ),
							),
							'subtotals'     => array(
								'description' => _x( 'Interval subtotals.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
								'type'        => 'object',
								'context'     => array( 'view', 'edit' ),
								'readonly'    => true,
								'properties'  => $data_values,
							),
						),
					),
				),
			);

			$totals = array_merge( $data_values, $segments );

			$schema = array(
				'$schema'    => 'http://json-schema.org/draft-04/schema#',
				'title'      => 'report_vendor_stats',
				'type'       => 'object',
				'properties' => array(
					'totals'    => array(
						'description' => _x( 'Totals data.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
						'type'        => 'object',
						'context'     => array( 'view', 'edit' ),
						'readonly'    => true,
						'properties'  => $totals,
					),
					'intervals' => array(
						'description' => _x( 'Reports data grouped by intervals.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
						'type'        => 'array',
						'context'     => array( 'view', 'edit' ),
						'readonly'    => true,
						'items'       => array(
							'type'       => 'object',
							'properties' => array(
								'interval'       => array(
									'description' => _x( 'Type of interval.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
									'type'        => 'string',
									'context'     => array( 'view', 'edit' ),
									'readonly'    => true,
									'enum'        => array( 'day', 'week', 'month', 'year' ),
								),
								'date_start'     => array(
									'description' => _x( "The date the report start, in the site's timezone.", '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
									'type'        => 'date-time',
									'context'     => array( 'view', 'edit' ),
									'readonly'    => true,
								),
								'date_start_gmt' => array(
									'description' => _x( 'The date the report start, as GMT.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
									'type'        => 'date-time',
									'context'     => array( 'view', 'edit' ),
									'readonly'    => true,
								),
								'date_end'       => array(
									'description' => _x( "The date the report end, in the site's timezone.", '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
									'type'        => 'date-time',
									'context'     => array( 'view', 'edit' ),
									'readonly'    => true,
								),
								'date_end_gmt'   => array(
									'description' => _x( 'The date the report end, as GMT.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
									'type'        => 'date-time',
									'context'     => array( 'view', 'edit' ),
									'readonly'    => true,
								),
								'subtotals'      => array(
									'description' => _x( 'Interval subtotals.', '[REST API] Vendor schema', 'jyith-woocommerce-product-vendors' ),
									'type'        => 'object',
									'context'     => array( 'view', 'edit' ),
									'readonly'    => true,
									'properties'  => $totals,
								),
							),
						),
					),
				),
			);

			return $this->add_additional_fields_schema( $schema );
		}

		/**
		 * Get the query params for collections.
		 *
		 * @return array
		 */
		public function get_collection_params() {
			$params = parent::get_collection_params();

			$params['vendors']   = array(
				'description'       => _x( 'Limit the result to items with the specified vendor IDs.', '[REST API] General collection params.', 'yith-woocommerce-product-vendors' ),
				'type'              => 'array',
				'sanitize_callback' => 'wp_parse_id_list',
				'validate_callback' => 'rest_validate_request_arg',
				'items'             => array( 'type' => 'integer' ),
			);
			$params['products']  = array(
				'description'       => _x( 'Limit the result to items with the specified product IDs.', '[REST API] General collection params.', 'yith-woocommerce-product-vendors' ),
				'type'              => 'array',
				'sanitize_callback' => 'wp_parse_id_list',
				'validate_callback' => 'rest_validate_request_arg',
				'items'             => array( 'type' => 'integer' ),
			);
			$params['segmentby'] = array(
				'description'       => _x( 'Segment the response by additional constraint.', '[REST API] General collection params.', 'yith-woocommerce-product-vendors' ),
				'type'              => 'string',
				'enum'              => array( 'vendor', 'product' ),
				'validate_callback' => 'rest_validate_request_arg',
			);
			$params['fields']    = array(
				'description'       => _x( 'Limit stats fields to the specified items.', '[REST API] General collection params.', 'yith-woocommerce-product-vendors' ),
				'type'              => 'array',
				'sanitize_callback' => 'wp_parse_slug_list',
				'validate_callback' => 'rest_validate_request_arg',
				'items'             => array( 'type' => 'string' ),
			);

			return $params;
		}

		/* === SEGMENTS HANDLING === */

		/**
		 * Returns segments for current request
		 *
		 * @param WP_REST_Request $request Request object.
		 */
		protected function get_segments( $request ) {
			if ( ! isset( $request['segmentby'] ) || ! isset( $request['vendors'] ) || 'vendor' !== $request['segmentby'] ) {
				// if no segmentation is requested, return one single segment with current query args.
				$segments = parent::get_segments( $request );
			} else {
				// otherwise calculate segments depending on request data.
				$segments   = array();
				$query_args = $this->get_query_args( $request );
				$vendors    = $request['vendors'];

				foreach ( $vendors as $vendor_id ) {
					$vendor = yith_wcmv_get_vendor( $vendor_id );
					if ( ! $vendor || ! $vendor->is_valid() ) {
						continue;
					}

					$segments[] = array(
						'segment_id'    => $vendor->get_id(),
						'segment_label' => $vendor->get_name(),
						'query_args'    => array_merge(
							$query_args,
							array(
								'vendor_id' => $vendor->get_id(),
							)
						),
					);
				}
			}

			return $segments;
		}

		/**
		 * Returns data for a specific segment
		 *
		 * @param array           $segment Array describing the segment; it contains id and label of the segment,
		 *                                 as well as query_args to use for that segment.
		 * @param WP_REST_Request $request Request object.
		 *
		 * @return array Array of db data for that specific interval.
		 */
		protected function get_segment_data( $segment, $request ) {
			$intervals    = $this->maybe_populate_intervals( $request );
			$segment_data = array();

			$query_args          = $segment['query_args'];
			$query_args['stats'] = $this->stats;
			$stats               = YITH_Vendors_Commissions_Factory::get_stats( $query_args );

			if ( ! empty( $stats ) ) {
				foreach ( $intervals as $interval_id => $interval ) {
					if ( ! isset( $segment_data[ $interval_id ] ) ) {
						$segment_data[ $interval_id ] = array();
					}

					$interval_stats = isset( $stats[ $interval['db_interval'] ] ) ? $stats[ $interval['db_interval'] ] : array();

					foreach ( $interval_stats as $stat => $value ) {
						if ( in_array( $stat, array( 'vendor_id', 'time_interval' ), true ) ) {
							continue;
						}

						$segment_data[ $interval_id ][ $stat ] = (float) $value;
					}
				}
			}

			return $segment_data;
		}

		/**
		 * Returns totals for each of the segments
		 *
		 * @param WP_REST_Request $request Request object.
		 * @return array Array of segmented totals.
		 */
		protected function get_segmented_totals( $request ) {
			$segments       = $this->get_segments( $request );
			$single_segment = 1 === count( $segments ) && empty( $segments[0]['segment_id'] );
			$defaults       = $this->get_default_stats( $request );

			$query_args              = $this->get_query_args( $request );
			$query_args['orderby']   = '';
			$query_args['number']    = 0;
			$query_args['group_by']  = ! $single_segment ? 'vendor_id' : '';
			$query_args['intervals'] = array( $query_args['date_query'] );

			$stats = YITH_Vendors_Commissions_Factory::get_stats( $query_args );

			if ( ! empty( $stats ) ) {
				if ( ! $single_segment ) {
					$stats = array_combine( wp_list_pluck( $stats, 'vendor_id' ), $stats );
				} else {
					$stats = array( $stats );
				}

				foreach ( $segments as &$stat_segment ) {
					$segment_id = (int) $stat_segment['segment_id'];

					if ( ! isset( $stats[ $segment_id ] ) ) {
						continue;
					}

					if ( ! isset( $stat_segment['data'] ) ) {
						$stat_segment['data'] = array();
					}

					foreach ( $stats[ $segment_id ] as $stat => $value ) {
						if ( in_array( $stat, array( 'vendor_id', 'time_interval' ), true ) ) {
							continue;
						}

						$stat_segment['data'][ $stat ] = (float) $value;
					}
				}
			}

			if ( $single_segment ) {
				$totals = wp_parse_args( $segments[0]['data'], $defaults );
			} else {
				$totals = array(
					'segments' => array(),
				);

				foreach ( $segments as $segment ) {
					$totals['segments'][] = array(
						'segment_id'    => $segment['segment_id'],
						'segment_label' => $segment['segment_label'],
						'subtotals'     => wp_parse_args( $segment['data'], $defaults ),
					);
				}

				$totals = array_merge(
					$totals,
					$this->get_combined_totals( wp_list_pluck( $segments, 'data' ), $request )
				);
			}

			return $totals;
		}
	}
}
