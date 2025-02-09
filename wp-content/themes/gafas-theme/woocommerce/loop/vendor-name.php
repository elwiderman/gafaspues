<?php
/**
 * Vendor name loop template.
 *
 * @since      4.0.0
 * @author     YITH
 * @package YITH\MultiVendor
 * @var YITH_Vendor $vendor The vendor.
 */

/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

defined( 'YITH_WPV_INIT' ) || exit; // Exit if accessed directly.

?>

<div class="product__brand">
	<span><?php _e('Marca:', 'gafas');?></span>&nbsp;
	<a href="<?php echo esc_url( $vendor->get_url() ); ?>" target="_blank" rel="noopener noreferrer">
		<?php echo esc_html( $vendor->get_name() ); ?>
	</a>
</div>