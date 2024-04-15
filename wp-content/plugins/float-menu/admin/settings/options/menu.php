<?php

use FloatMenuLite\Settings_Helper;

defined( 'ABSPATH' ) || exit;

$args = [
	'item_tooltip' => [
		'type'  => 'text',
		'title' => __( 'Label Text', 'float-menu' ),
	],


	'item_type' => [
		'type'  => 'select',
		'title' => __( 'Type', 'float-menu' ),
		'atts'  => Settings_Helper::item_type(),
	],

	'item_link' => [
		'type'  => 'text',
		'title' => __( 'Link', 'float-menu' ),
		'class' => 'is-hidden',
	],

	'new_tab' => [
		'type'  => 'checkbox',
		'title' => __( 'Open in new Window', 'float-menu' ),
		'label' => __( 'Enable', 'float-menu' ),
		'class' => 'is-hidden',
	],



	// Icons
	'item_icon'  => [
		'type'  => 'select',
		'title' => __( 'Icon', 'float-menu' ),
		'atts'  => Settings_Helper::icons(),
	],


	// Style
	'color'            => [
		'type'  => 'text',
		'val'   => '#ffffff',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
		'title' => __( 'Color', 'float-menu' ),
	],

	'hcolor' => [
		'type'  => 'text',
		'val'   => '#ffffff',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
		'title' => __( 'Hover Color', 'float-menu' ),
	],

	'bcolor' => [
		'type'  => 'text',
		'val'   => '#184c72',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
		'title' => __( 'Background', 'float-menu' ),
	],

	'hbcolor' => [
		'type'  => 'text',
		'val'   => '#184c72',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
		'title' => __( 'Hover Background', 'float-menu' ),
	],


	// Attributes
	'button_id'           => [
		'type'  => 'text',
		'title' => __( 'ID for element', 'float-menu' ),
	],

	'button_class' => [
		'type'  => 'text',
		'title' => __( 'Class for element', 'float-menu' ),
	],

	'link_rel' => [
		'type'  => 'text',
		'title' => __( 'Attribute: rel', 'float-menu' ),
	],


];

$prefix  = 'menu_1-';
$newArgs = [];

foreach ( $args as $key => $value ) {
	$newArgs[ $prefix . $key ] = $value;
}

return $newArgs;