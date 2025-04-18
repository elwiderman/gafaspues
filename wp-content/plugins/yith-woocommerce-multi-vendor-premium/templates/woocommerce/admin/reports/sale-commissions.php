<?php
/**
 * Admin View: Report by Date (with date filters)
 *
 * @author  YITH
 * @package YITH\MultiVendor
 * @version 4.0.0
 * @var YITH_Report_Sale_Commissions $report
 */

defined( 'YITH_WPV_INIT' ) || exit; // Exit if accessed directly.

?>

<div id="poststuff" class="woocommerce-reports-wide">
	<div class="postbox">
		<h3 class="stats_range">
			<?php YITH_Reports()->get_export_button(); ?>
			<ul>
				<?php
				foreach ( $ranges as $range => $name ) {
					echo '<li class="' . ( $current_range === $range ? 'active' : '' ) . '"><a href="' . esc_url( remove_query_arg( array( 'start_date', 'end_date' ), add_query_arg( 'range', $range ) ) ) . '">' . $name . '</a></li>'; // phpcs:ignore
				}
				?>
				<li class="custom <?php echo 'custom' === $current_range ? 'active' : ''; ?>">
					<?php esc_html_e( 'Custom:', 'yith-woocommerce-product-vendors' ); ?>
					<form method="GET">
						<div>
							<?php
							// Maintain query string.
							foreach ( $_GET as $key => $value ) { // phpcs:ignore
								if ( is_array( $value ) ) {
									foreach ( $value as $v ) {
										echo '<input type="hidden" name="' . esc_attr( sanitize_text_field( $key ) ) . '[]" value="' . esc_attr( sanitize_text_field( $v ) ) . '" />';
									}
								} else {
									echo '<input type="hidden" name="' . esc_attr( sanitize_text_field( $key ) ) . '" value="' . esc_attr( sanitize_text_field( $value ) ) . '" />';
								}
							}
							?>
							<input type="hidden" name="range" value="custom"/>
							<input type="text" size="9" placeholder="yyyy-mm-dd" value="<?php echo ! empty( $_GET['start_date'] ) ? esc_attr( $_GET['start_date'] ) : ''; // phpcs:ignore ?>" name="start_date" class="range_datepicker from"/>
							<input type="text" size="9" placeholder="yyyy-mm-dd" value="<?php echo ! empty( $_GET['end_date'] ) ? esc_attr( $_GET['end_date'] ) : ''; // phpcs:ignore ?>" name="end_date" class="range_datepicker to"/>
							<input type="submit" class="button" value="<?php esc_html_e( 'Go', 'yith-woocommerce-product-vendors' ); ?>"/>
						</div>
					</form>
				</li>
			</ul>
		</h3>
		<?php if ( empty( $hide_sidebar ) ) : ?>
			<div class="inside chart-with-sidebar">
				<div class="chart-sidebar">
					<?php
					$legends = $report->get_chart_legend();
					if ( ! empty( $legends ) ) :
						?>
						<ul class="chart-legend">
							<?php foreach ( $legends as $legend ) : ?>
								<li style="border-color: <?php echo esc_attr( $legend['color'] ); ?>"
									<?php
									if ( isset( $legend['highlight_series'] ) ) {
										echo 'class="highlight_series ' . ( isset( $legend['placeholder'] ) ? 'tips' : '' ) . '" data-series="' . esc_attr( $legend['highlight_series'] ) . '"';
									}
									?>
									data-tip="<?php echo isset( $legend['placeholder'] ) ? esc_attr( $legend['placeholder'] ) : ''; ?>">
									<?php echo wp_kses_post( $legend['title'] ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<ul class="chart-widgets">
						<?php foreach ( $report->get_chart_widgets() as $widget ) : ?>
							<li class="chart-widget">
								<?php if ( $widget['title'] ) : ?>
									<h4><?php echo wp_kses_post( $widget['title'] ); ?></h4><?php endif; ?>
								<?php call_user_func( $widget['callback'] ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="main">
					<?php $report->get_main_chart(); ?>
				</div>
			</div>
		<?php else : ?>
			<div class="inside">
				<?php $report->get_main_chart(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
