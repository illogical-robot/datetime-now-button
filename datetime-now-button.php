<?php
/*
Author: radiok
Plugin Name: Date/Time Now Button
Author URI: http://radiok.info/
Plugin URI: http://radiok.info/blog/category/datetime-now-button/
Description: Adds a Now button to the right of date and time fields.
Version: 0.2.2
Text Domain: datetime-now-button
Domain Path: /languages
*/

if ( !class_exists( 'DateTimeNowButtonPlugin' ) ) {
	class DateTimeNowButtonPlugin {
		function __construct() {
			add_action( 'init', array( $this, 'InitI18n' ), 10, 1 );
			add_action( 'admin_head', array($this, 'AddNowButton' ), 10, 1 );
		}

		function InitI18n() {
			// Place your language file in the languages subfolder and name it "datetime-now-button-{language}.mo" replace {language} with your language value from wp-config.php
			load_plugin_textdomain( 'datetime-now-button', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}
		
		function AddNowButton()	{
			?>
			<script type="text/javascript">
			jQuery(document).ready(function() {
				if (jQuery('#timestampdiv').length > 0) {
					jQuery('#timestampdiv').find('div')
						.append('&nbsp;')
						.append(jQuery('<a>')
							.attr('class', 'now button')
							.append('<?php _e( 'Now', 'datetime-now-button' ); ?>')
						);
				}

				if (jQuery('.inline-edit-date').length > 0) {
					jQuery('.inline-edit-date').find('div')
						.append('&nbsp;')
						.append(jQuery('<a>')
							.attr('class', 'now button')
							.append('<?php _e( 'Now', 'datetime-now-button' ); ?>')
						);
				}

				jQuery('.now.button').bind('click', function() {
					<?php
					$time_adj = current_time('timestamp');
					$cur_mm = gmdate( 'm', $time_adj );
					$cur_jj = gmdate( 'd', $time_adj );
					$cur_aa = gmdate( 'Y', $time_adj );
					$cur_hh = gmdate( 'H', $time_adj );
					$cur_mn = gmdate( 'i', $time_adj );
					?>

					if (jQuery('select[name="mm"]').length > 0) jQuery('select[name="mm"]').val('<?php echo $cur_mm; ?>');
					if (jQuery('input[name="jj"]').length > 0) jQuery('input[name="jj"]').val('<?php echo $cur_jj; ?>');
					if (jQuery('input[name="aa"]').length > 0) jQuery('input[name="aa"]').val('<?php echo $cur_aa; ?>');
					if (jQuery('input[name="hh"]').length > 0) jQuery('input[name="hh"]').val('<?php echo $cur_hh; ?>');
					if (jQuery('input[name="mn"]').length > 0) jQuery('input[name="mn"]').val('<?php echo $cur_mn; ?>');
				});
			});
			</script>
			<?php
		}
	}
}

if ( class_exists( 'DateTimeNowButtonPlugin' ) ) $date_time_now_button = new DateTimeNowButtonPlugin();