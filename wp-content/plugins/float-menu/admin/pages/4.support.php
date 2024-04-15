<?php
/**
 * Page Name: Support
 *
 */

use FloatMenuLite\Admin\SupportForm;
use FloatMenuLite\WOWP_Plugin;

defined( 'ABSPATH' ) || exit;
?>

    <div class="wpie-block-tool is-white">

        <p>
			<?php
			esc_html_e( 'To get your support related question answered in the fastest timing, please send a message via the form below or write to us via', 'float-menu' );
			echo ' <a href="' . esc_url( WOWP_Plugin::info( 'support' ) ) . '">' . esc_html__( 'support page', 'float-menu' ) . '</a>';
			?>
        </p>

        <p>
			<?php esc_html_e( 'Also, you can send us your ideas and suggestions for improving the plugin.', 'float-menu' ); ?>
        </p>

		<?php SupportForm::init(); ?>

    </div>
<?php
