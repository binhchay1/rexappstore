<?php
/**
 * Class Script_Maker
 *
 * Helper class for generating Float Menu Pro JavaScript code.
 *
 * @package    FloatMenuLite
 * @subpackage Public
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace FloatMenuLite;

defined( 'ABSPATH' ) || exit;

class Script_Maker {
	/**
	 * @var mixed
	 */
	private $id;
	/**
	 * @var mixed
	 */
	private $param;

	public function __construct( $id, $param ) {
		$this->id    = $id;
		$this->param = $param;
	}

	public function init(): string {
		$param = $this->param;

		$mobile_screen            = $param['mobile_rules'] ?? 768;
		$mobile_rules             = ( ! empty( $param['mobile_rules_on'] ) ) ? 'true' : 'false';

		$arg = [
			'selector'       => ".float-menu-$this->id",
			'position'       => [ $param['menu'], 'center' ],
			'shape'          => ! empty( $param['shape'] ) ? $param['shape'] : 'square',
			'sideSpace'      => filter_var( $param['sideSpace'], FILTER_VALIDATE_BOOLEAN ),
			'buttonSpace'    => filter_var( $param['buttonSpace'], FILTER_VALIDATE_BOOLEAN ),
			'labelSpace'     => filter_var( $param['labelSpace'], FILTER_VALIDATE_BOOLEAN ),
			'labelConnected' => filter_var( $param['labelConnected'], FILTER_VALIDATE_BOOLEAN ),
			'labelEffect'    => ! empty( $param['labelEffect'] ) ? $param['labelEffect'] : 'fade',
			'color'          => 'default',
			'overColor'      => 'default',
			'labelsOn'       => filter_var( $param['labelsOn'], FILTER_VALIDATE_BOOLEAN ),
			'mobileEnable'   => filter_var( $mobile_rules, FILTER_VALIDATE_BOOLEAN ),
			'mobileScreen'   => (int) $mobile_screen,
		];

		return "var FloatMenu_$this->id = " . wp_json_encode( $arg );
	}
}