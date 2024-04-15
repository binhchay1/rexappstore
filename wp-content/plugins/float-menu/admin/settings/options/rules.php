<?php


use FloatMenuLite\Settings_Helper;

defined( 'ABSPATH' ) || exit;

$show = [
	'general_start' => __( 'General', 'float-menu' ),
	'shortcode'     => __( 'Shortcode', 'float-menu' ),
	'everywhere'    => __( 'Everywhere', 'float-menu' ),
	'general_end'   => __( 'General', 'float-menu' ),
];


$args = [
	'show' => [
		'type'  => 'select',
		'title' => __( 'Display', 'float-menu' ),
		'val'   => 'everywhere',
		'atts'  => $show,
	],


	'fontawesome' => [
		'type'  => 'checkbox',
		'title' => __( 'Disable Font Awesome Icon', 'float-menu' ),
		'val'   => 0,
		'label' => __( 'Disable', 'float-menu' ),
	],

	'velocity' => [
		'type'  => 'checkbox',
		'title' => __( 'Velocity.js', 'float-menu' ),
		'val'   => 0,
		'label' => __( 'Disable', 'float-menu' ),
	],

	'mobile' => [
		'type'  => 'number',
		'title' => [
			'label'  => __( 'Hide on smaller screens', 'float-menu' ),
			'name'   => 'mobile_on',
			'toggle' => true,
		],
		'val'   => 480,
		'addon' => 'px',
	],

	'desktop' => [
		'type'  => 'number',
		'title' => [
			'label'  => __( 'Hide on larger screens', 'float-menu' ),
			'name'   => 'desktop_on',
			'toggle' => true,
		],
		'val'   => 1024,
		'addon' => 'px'
	],

	'mobile_rules' => [
		'type'  => 'number',
		'title' => [
			'label'  => __( 'Mobile Rules', 'float-menu' ),
			'name'   => 'mobile_rules_on',
			'toggle' => true,
		],
		'val'   => 768,
		'addon' => 'px',
	],


];

return $args;
