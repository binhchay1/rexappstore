<?php
/*
 * Page Name: Targeting & Rules
 */

use FloatMenuLite\Admin\CreateFields;
use FloatMenuLite\Settings_Helper;

defined( 'ABSPATH' ) || exit;

$page_opt = include( 'options/rules.php' );
$field    = new CreateFields( $options, $page_opt );

?>

<div class="wpie-fieldset wpie-rules">
    <div class="wpie-legend"><?php esc_html_e( 'Display Rules', 'float-menu' ); ?></div>
    <div class="wpie-fields">
		<?php $field->create( 'show', 0 ); ?>
    </div>
</div>

<div class="wpie-fieldset">
    <div class="wpie-legend"><?php esc_html_e( 'Responsive Visibility', 'float-menu' ); ?></div>
    <div class="wpie-fields">
		<?php $field->create( 'mobile_rules' ); ?>
		<?php $field->create( 'mobile' ); ?>
		<?php $field->create( 'desktop' ); ?>
    </div>
</div>


<div class="wpie-fieldset">
    <div class="wpie-legend"><?php esc_html_e( 'Other', 'float-menu' ); ?></div>
    <div class="wpie-fields">
		<?php $field->create( 'fontawesome' ); ?>
		<?php $field->create( 'velocity' ); ?>
    </div>
</div>
