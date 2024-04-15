<?php
/*
 * Page Name: Settings
 */

use FloatMenuLite\Admin\CreateFields;

defined( 'ABSPATH' ) || exit;

$page_opt = include( 'options/settings.php' );
$field    = new CreateFields( $options, $page_opt );
?>

    <div class="wpie-fieldset">
        <div class="wpie-legend"><?php esc_html_e( 'Position', 'float-menu' ); ?></div>
        <div class="wpie-fields">
			<?php $field->create( 'menu' ); ?>
        </div>
    </div>

    <div class="wpie-fieldset">
        <div class="wpie-legend"><?php esc_html_e( 'Appearance', 'float-menu' ); ?></div>
        <div class="wpie-fields">
			<?php $field->create( 'shape' ); ?>
			<?php $field->create( 'sideSpace' ); ?>
			<?php $field->create( 'buttonSpace' ); ?>
			<?php $field->create( 'labelSpace' ); ?>
        </div>
        <div class="wpie-fields">
			<?php $field->create( 'labelsOn' ); ?>
			<?php $field->create( 'labelConnected' ); ?>
			<?php $field->create( 'labelSpeed' ); ?>
        </div>
        <div class="wpie-fields">
			<?php $field->create( 'zindex' ); ?>
        </div>
    </div>

    <div class="wpie-fieldset">
        <div class="wpie-legend"><?php esc_html_e( 'Size', 'float-menu' ); ?></div>
        <div class="wpie-fields">
			<?php $field->create( 'iconSize' ); ?>
			<?php $field->create( 'labelSize' ); ?>
        </div>
        <div class="wpie-fields">
			<?php $field->create( 'mobilieScreen' ); ?>
			<?php $field->create( 'mobiliconSize' ); ?>
			<?php $field->create( 'mobillabelSize' ); ?>
        </div>
    </div>
<?php
