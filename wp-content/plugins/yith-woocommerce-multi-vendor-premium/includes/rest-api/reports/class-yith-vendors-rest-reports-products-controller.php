<?php
/**
 * REST API Products controller.
 *
 * @author  YITH
 * @package YITH\MultiVendor
 * @version 2.0.0
 */

defined( 'YITH_WPV_INIT' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'YITH_Vendors_REST_Reports_Products_Controller' ) ) {
	/**
	 * REST API Reports controller class.
	 */
	class YITH_Vendors_REST_Reports_Products_Controller extends YITH_Vendors_Abstract_REST_Reports_Controller {

		/**
		 * Contains collection that will be returned through API
		 *
		 * @var YITH_Vendors_Object_Collection|null
		 */
		private $response_collection = null;

		/**
		 * Part of the url after $this::rest_base.
		 *
		 * @var string
		 */
		protected $rest_path = 'products';

		/**
		 * A list of properties that should be retrieved as external stats
		 *
		 * @var array
		 */
		protected $stat_properties = array(
			'commissions_total_earnings',
			'commissions_store_gross_total',
		);

		/**
		 * Stores correct order of vendors id to show in the end result
		 * Will be used to order subsequent stats queries
		 *
		 * @var int[]
		 */
		protected $items_order = array();

		/**
		 * Get all reports.
		 *
		 * @param \WP_REST_Request $request Request data.
		 * @return \WP_Rest_Response|\WP_Error
		 */
		public function get_items( $request ) {
			$args = $this->get_query_args( $request );

			$this->response_collection = new YITH_Vendors_Object_Collection( 'YITH_Vendors_Commissions_Factory', $args );
			$this->response_collection->get_stats();
			$data = array();

			if ( ! $this->response_collection->is_empty() ) {
				foreach ( $this->response_collection->get_items() as $product ) {
					$item   = $this->prepare_item_for_response( $product, $request );
					$data[] = $this->prepare_response_for_collection( $item );
				}
			}

			$response = rest_ensure_response( $data );
			$response = $this->prepare_pagination_params( $this->response_collection, $request, $response );

			return $response;
		}

		/**
		 * Get the Report's schema, conforming to JSON Schema.
		 *
		 * @return array
		 */
		public function get_item_schema() {
			$schema = array(
				'$schema'    => 'http://json-schema.org/draft-04/schema#',
				'title'      => 'report_vendors',
				'type'       => 'object',
				'properties' => array(
					'id'                            => array(
						'type'        => 'integer',
						'readonly'    => true,
						'context'     => array( 'view', 'edit' ),
						'description' => _x( 'Product ID.', '[REST API] Product schema', 'yith-woocommerce-product-vendors' ),
					),
					'post_id'                       => array(
						'type'        => 'integer',
						'readonly'    => true,
						'context'     => array( 'view', 'edit' ),
						'description' => _x( 'Product ID (if the product is a variation, this will contain the parent ID).', '[REST API] Product schema', 'yith-woocommerce-product-vendors' ),
					),
					'name'                          => array(
						'type'        => 'string',
						'readonly'    => true,
						'context'     => array( 'view', 'edit' ),
						'description' => _x( 'Product name.', '[REST API] Product schema', 'yith-woocommerce-product-vendors' ),
					),
					'commissions_total_earnings'    => array(
						'type'        => 'number',
						'readonly'    => true,
						'context'     => array( 'view', 'edit' ),
						'description' => _x( 'Vendors total commissions earnings in the specified interval.', '[REST API] Product schema', 'yith-woocommerce-product-vendors' ),
					),
					'commissions_store_gross_total' => array(
						'type'        => 'number',
						'readonly'    => true,
						'context'     => array( 'view', 'edit' ),
						'description' => _x( 'Store gross earnings generated by vendors in the specified interval.', '[REST API] Product schema', 'yith-woocommerce-product-vendors' ),
					),
					'extended_info'                 => array(
						'image' => array(
							'type'        => 'string',
							'readonly'    => true,
							'context'     => array( 'view', 'edit' ),
							'description' => _x( 'Product image.', '[REST API] Product schema', 'yith-woocommerce-product-vendors' ),
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

			// add params specific to this controller.
			$params['vendors'] = array(
				'description'       => _x( 'Limit the result to items with the specified vendors IDs.', '[REST API] Vendor collection params.', 'yith-woocommerce-product-vendors' ),
				'type'              => 'array',
				'sanitize_callback' => 'wp_parse_id_list',
				'validate_callback' => 'rest_validate_request_arg',
				'items'             => array(
					'type' => 'integer',
				),

			);

			return $params;
		}

		/* === PREPARE RESPONSE === */

		/**
		 * Serialize an YITH_Vendors_Data_Store, according to schema
		 *
		 * @param YITH_Vendors_Data_Store|object|array $object     Data object.
		 * @param array                                $properties Properties to retrieve, defaults to entire schema.
		 *
		 * @return array Serialized object.
		 */
		protected function serialize_object( $object, $properties = array() ) {
			$object    = (array) $object;
			$formatted = array();
			$product   = wc_get_product( $object['product_id'] );

			if ( empty( $properties ) ) {
				$schema     = $this->get_item_schema();
				$properties = isset( $schema['properties'] ) ? array_keys( $schema['properties'] ) : array();
			}

			if ( ! $product || empty( $properties ) ) {
				return $formatted;
			}

			foreach ( $properties as $property ) {
				switch ( $property ) {
					case 'extended_info':
						$schema        = $this->get_item_schema();
						$extended_info = isset( $schema['properties'] ) && isset( $schema['properties']['extended_info'] ) ? array_keys( $schema['properties']['extended_info'] ) : array();

						if ( $extended_info ) {
							$value = $this->serialize_object( $object, $extended_info );
						}

						break;
					case 'id':
						$value = $object['product_id'];
						break;
					case 'post_id':
						$value = $product->is_type( 'variation' ) ? $product->get_parent_id() : $product->get_id();
						break;
					case 'name':
						$value = wp_strip_all_tags( $product->get_formatted_name() );
						break;
					case 'image':
						$image_id = $product->get_image_id();

						if ( ! $image_id ) {
							$value = wc_placeholder_img_src( array( 50, 50 ) );
						} else {
							$value = wp_get_attachment_image_url( $image_id, array( 50, 50 ) );
						}
						break;
					default:
						$value = isset( $object[ $property ] ) ? $object[ $property ] : false;
						break;
				}

				$formatted[ $property ] = $value;
			}

			return $formatted;
		}

		/* === QUERY HANDLING === */

		/**
		 * Returns an array of valid values for orderby param
		 * Should be overridden on dedicated class to have report-aware response
		 *
		 * @return array
		 */
		public function get_valid_orderby_values() {
			return array_merge(
				array(
					'product_id',
				),
				$this->stat_properties
			);
		}

		/**
		 * Returns the default value for orderby param
		 *
		 * @since  4.0.0
		 * @return string
		 */
		public function get_default_orderby_value() {
			return 'commissions_total_earnings';
		}

		/**
		 * Returns arguments used to query database for collection stats
		 *
		 * @param WP_REST_Request $request Original request.
		 *
		 * @return array Array of query arguments.
		 */
		public function get_query_args( $request ) {
			$query_args = parent::get_query_args( $request );

			$query_args['stats']    = $this->stat_properties;
			$query_args['group_by'] = 'product_id';
			$query_args['orderby']  = $this->get_correct_orderby( $query_args );

			// Maybe restrict content to current vendor.
			$query_args = $this->maybe_restrict_content_for_vendor( $query_args );

			return $query_args;
		}
	}
}
