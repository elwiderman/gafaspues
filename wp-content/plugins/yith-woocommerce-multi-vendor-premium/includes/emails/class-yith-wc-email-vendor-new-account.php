<?php
/**
 * Vendor's new account approval email
 *
 * @author  YITH
 * @package YITH\MultiVendor
 * @version 4.0.0
 */

defined( 'YITH_WPV_INIT' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'YITH_WC_Email_Vendor_New_Account' ) ) {
	/**
	 * Vendor's new account approval
	 * Emails are sent to the vendor as soon as the admin approves his/her account.
	 *
	 * @class      YITH_WC_Email_Vendor_New_Account
	 * @extends    WC_Email
	 * @package YITH\MultiVendor
	 * @version    4.0.0
	 */
	class YITH_WC_Email_Vendor_New_Account extends WC_Email {

		/**
		 * The current vendor account email
		 *
		 * @var string
		 */
		public $user_email;

		/**
		 * The current user account display name.
		 *
		 * @var string
		 */
		protected $user_display_name = '';

		/**
		 * The vendor object
		 *
		 * @var null|YITH_Vendor
		 */
		protected $vendor;

		/**
		 * Constructor
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

			$this->id          = 'vendor_new_account';
			$this->title       = __( 'Vendor account approved', 'yith-woocommerce-product-vendors' );
			$this->description = __( 'Sent to the vendor as soon as the admin approves his/her account.', 'yith-woocommerce-product-vendors' );

			$this->template_base  = YITH_WPV_TEMPLATE_PATH;
			$this->template_html  = 'emails/vendor-new-account.php';
			$this->template_plain = 'emails/plain/vendor-new-account.php';

			$this->subject = __( 'Your vendor account on the website {site_title} has been approved.', 'yith-woocommerce-product-vendors' );
			$this->heading = __( 'Welcome to {site_title}', 'yith-woocommerce-product-vendors' );

			// Call parent constructor.
			parent::__construct();

			// Triggers for this email.
			add_action( 'yith_wcmv_vendor_account_approved', array( $this, 'trigger' ), 10, 1 );
			add_action( 'yith_wcmv_vendor_account_approved_notification', array( $this, 'trigger' ), 10, 1 ); // Backward compatibility.
		}

		/**
		 * Trigger function.
		 *
		 * @access public
		 * @param string|integer $user_id The user ID.
		 * @return void
		 */
		public function trigger( $user_id ) {

			if ( $user_id ) {
				$this->object            = new WP_User( $user_id );
				$this->user_email        = stripslashes( $this->object->user_email );
				$this->user_display_name = stripslashes( $this->object->display_name );
				$this->recipient         = $this->user_email;
			}

			if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
				return;
			}

			$this->setup_locale();

			$this->vendor = yith_wcmv_get_vendor( $this->object, 'user' );

			$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );

			$this->restore_locale();
		}

		/**
		 * Get the email content in HTML format.
		 *
		 * @access public
		 * @return string
		 */
		public function get_content_html() {
			ob_start();
			yith_wcmv_get_template(
				$this->template_html,
				array(
					'email_heading'     => $this->get_heading(),
					'blogname'          => $this->get_blogname(),
					'user_display_name' => $this->user_display_name,
					'vendor'            => $this->vendor,
					'sent_to_admin'     => false,
					'plain_text'        => false,
					'admin_url'         => apply_filters( 'yith_wcmv_get_main_page_url', function_exists( 'yith_wcfm_get_main_page_url' ) ? yith_wcfm_get_main_page_url() : wc_get_account_endpoint_url( 'vendor-dashboard' ) ),
					'email'             => $this,
				)
			);

			return ob_get_clean();
		}

		/**
		 * Get the email content in plain text format.
		 *
		 * @access public
		 * @return string
		 */
		public function get_content_plain() {
			ob_start();
			yith_wcmv_get_template(
				$this->template_plain,
				array(
					'email_heading'     => $this->get_heading(),
					'blogname'          => $this->get_blogname(),
					'user_display_name' => $this->user_display_name,
					'vendor'            => $this->vendor,
					'sent_to_admin'     => false,
					'plain_text'        => true,
					'admin_url'         => apply_filters( 'yith_wcmv_get_main_page_url', function_exists( 'yith_wcfm_get_main_page_url' ) ? yith_wcfm_get_main_page_url() : wc_get_account_endpoint_url( 'vendor-dashboard' ) ),
					'email'             => $this,
				)
			);

			return ob_get_clean();
		}

		/**
		 * Initialise Settings Form Fields
		 *
		 * @access public
		 * @return void
		 */
		public function init_form_fields() {
			$this->form_fields = array(
				'enabled'    => array(
					'title'   => __( 'Enable/Disable', 'yith-woocommerce-product-vendors' ),
					'type'    => 'checkbox',
					'label'   => __( 'Enable notification for this email', 'yith-woocommerce-product-vendors' ),
					'default' => 'yes',
				),
				'subject'    => array(
					'title'       => __( 'Subject', 'yith-woocommerce-product-vendors' ),
					'type'        => 'text',
					// translators: %s is a list of available placeholder for email.
					'description' => sprintf( __( 'Available placeholders: %s', 'yith-woocommerce-product-vendors' ), '<code>' . implode( '</code><code>', array_keys( $this->placeholders ) ) . '</code>' ),
					'placeholder' => $this->get_default_subject(),
					'default'     => '',
				),
				'heading'    => array(
					'title'       => __( 'Email heading', 'yith-woocommerce-product-vendors' ),
					'type'        => 'text',
					// translators: %s is a list of available placeholder for email.
					'description' => sprintf( __( 'Available placeholders: %s', 'yith-woocommerce-product-vendors' ), '<code>' . implode( '</code><code>', array_keys( $this->placeholders ) ) . '</code>' ),
					'placeholder' => $this->get_default_heading(),
					'default'     => '',
				),
				'email_type' => array(
					'title'       => __( 'Email type', 'yith-woocommerce-product-vendors' ),
					'type'        => 'select',
					'description' => __( 'Choose email format.', 'yith-woocommerce-product-vendors' ),
					'default'     => 'html',
					'class'       => 'email_type wc-enhanced-select',
					'options'     => $this->get_email_type_options(),
				),
			);
		}
	}
}

return new YITH_WC_Email_Vendor_New_Account();
