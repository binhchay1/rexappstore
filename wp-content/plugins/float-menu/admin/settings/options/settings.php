<?php

defined( 'ABSPATH' ) || exit;

return [
	'menu' => [
		'type'  => 'select',
		'title' => __( 'Side', 'float-menu' ),
		'val'   => 'left',
		'atts'  => [
			'left'  => __( 'Left', 'float-menu' ),
			'right' => __( 'Right', 'float-menu' ),
		],
	],

	'shape' => [
		'type'  => 'select',
		'title' => __( 'Shape', 'float-menu' ),
		'val'   => 'square',
		'atts'  => [
			'square'      => __( 'Square', 'float-menu' ),
			'round'       => __( 'Round', 'float-menu' ),
			'rounded'     => __( 'Rounded', 'float-menu' ),
			'rounded-out' => __( 'Rounded-out', 'float-menu' ),
		],
	],

	'sideSpace' => [
		'type'  => 'select',
		'title' => __( 'Side Space', 'float-menu' ),
		'val'   => 'true',
		'atts'  => [
			'true'  => __( 'Yes', 'float-menu' ),
			'false' => __( 'No', 'float-menu' ),
		],
	],

	'buttonSpace' => [
		'type'  => 'select',
		'title' => __( 'Button Space', 'float-menu' ),
		'val'   => 'true',
		'atts'  => [
			'true'  => __( 'Yes', 'float-menu' ),
			'false' => __( 'No', 'float-menu' ),
		],
	],

	'labelsOn' => [
		'type'  => 'select',
		'title' => __( 'Label On', 'float-menu' ),
		'val'   => 'true',
		'atts'  => [
			'true'  => __( 'Yes', 'float-menu' ),
			'false' => __( 'No', 'float-menu' ),
		],
	],

	'labelSpace' => [
		'type'  => 'select',
		'title' => __( 'Label Space', 'float-menu' ),
		'val'   => 'true',
		'atts'  => [
			'true'  => __( 'Yes', 'float-menu' ),
			'false' => __( 'No', 'float-menu' ),
		],
	],

	'labelConnected' => [
		'type'  => 'select',
		'title' => __( 'Label Connected', 'float-menu' ),
		'val'   => 'true',
		'atts'  => [
			'true'  => __( 'Yes', 'float-menu' ),
			'false' => __( 'No', 'float-menu' ),
		],
	],

	'labelSpeed' => [
		'type'  => 'number',
		'title' => __( 'Label Speed', 'float-menu' ),
		'val'   => '400',
		'addon' => __( 'ms', 'float-menu' ),
	],

	'iconSize' => [
		'type'  => 'number',
		'title' => __( 'Icon size', 'float-menu' ),
		'val'   => '24',
		'addon' => __( 'px', 'float-menu' ),
	],

	'mobiliconSize' => [
		'type'  => 'number',
		'title' => __( 'Icon size for mobile', 'float-menu' ),
		'val'   => '24',
		'addon' => __( 'px', 'float-menu' ),
	],

	'mobilieScreen' => [
		'type'  => 'number',
		'title' => __( 'Mobile Screen', 'float-menu' ),
		'val'   => '480',
		'addon' => __( 'px', 'float-menu' ),
	],

	'labelSize' => [
		'type'  => 'number',
		'title' => __( 'Label size', 'float-menu' ),
		'val'   => '15',
		'addon' => __( 'px', 'float-menu' ),
	],

	'mobillabelSize' => [
		'type'  => 'number',
		'title' => __( 'Label size for mobile', 'float-menu' ),
		'val'   => '15',
		'addon' => __( 'px', 'float-menu' ),
	],


	'zindex' => [
		'type'  => 'number',
		'title' => __( 'Z-index', 'float-menu' ),
		'val'   => '9999',
	],

];