<?php
/*
 * Page Name: Add New
 */

use FloatMenuLite\Admin\CreateFields;
use FloatMenuLite\Admin\Settings;
use FloatMenuLite\WOWP_Plugin;

defined( 'ABSPATH' ) || exit;

$options = Settings::get_options();

$title = $options['title'] ?? '';
$id    = $options['id'] ?? '';
?>
<form action="" id="wpie-settings" class="wpie-settings__wrapper" method="post">

    <div class="wpie-settings__main">

        <div class="wpie-field">
            <label class="wpie-field__label">
                <span class="screen-reader-text">
                    <?php esc_html_e( 'Enter title here', 'float-menu' ); ?></span>
                <input type="text" name="title" size="30" value="<?php
				echo esc_attr( $title ); ?>" id="title" placeholder="<?php
				esc_attr_e( 'Add title', 'float-menu' ); ?>">
            </label>
        </div>
		<?php
		Settings::init(); ?>

    </div>

    <div class="wpie-settings__sidebar">
		<?php
		require_once WOWP_Plugin::dir() . 'admin/settings/sidebar.php'; ?>
    </div>

    <input type="hidden" name="tool_id" value="<?php
	echo absint( $id ); ?>" id="tool_id"/>
    <input type="hidden" name="item_time" value="<?php
	echo esc_attr( time() ); ?>"/>
	<?php
	wp_nonce_field( WOWP_Plugin::PREFIX . '_nonce', WOWP_Plugin::PREFIX . '_settings' ); ?>
</form>
