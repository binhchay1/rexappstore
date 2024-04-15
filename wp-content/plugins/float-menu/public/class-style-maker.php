<?php

/**
 * Class Style_Maker
 * Creates the CSS style for Float Menu Pro.
 *
 * @package    FloatMenuLite
 * @subpackage Public
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace FloatMenuLite;

defined( 'ABSPATH' ) || exit;

class Style_Maker {
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

		$css = $this->main_style();
		$css .= $this->mobile_size();
		$css .= $this->items_style();
		$css .= $this->mobile_rules();

		return trim( preg_replace( '~\s+~', ' ', $css ) );
	}

	private function main_style(): string {
		$param      = $this->param;
		$z_index    = $param['zindex'] ?? 0;
		$icon_size  = $param['iconSize'] ?? 24;
		$label_size = $param['labelSize'] ?? 15;

		return ".float-menu-$this->id {
		    --fm-icon-size: {$icon_size}px;
		    --fm-label-size: {$label_size}px;
		    --fm-border-radius: 50%;
		    --fm-color: #E86E2C;
		    --fm-background: #1b094f;
		    --fm-z-index: $z_index;
		}";
	}

	private function mobile_size(): string {
		$param             = $this->param;
		$mobile_icon_size  = $param['mobiliconSize'] ?? 24;
		$mobile_label_size = $param['mobillabelSize'] ?? 15;
		$mobile_screen     = $param['mobilieScreen'] ?? 480;

		return "@media only screen and (max-width: {$mobile_screen}px){
			.float-menu-$this->id {
				--fm-icon-size: {$mobile_icon_size}px;
				--fm-label-size: {$mobile_label_size}px;
			}
		}";
	}

	private function items_style(): string {
		$param = $this->param;
		$css   = '';

		if ( empty( $param['menu_1']['item_type'] ) || ! is_array( $param['menu_1']['item_type'] ) ) {
			return $css;
		}

		foreach ( $param['menu_1']['item_type'] as $i => $value ) {
			$label_font   = $param['menu_1']['item_tooltip_font'][ $i ] ?? 'inherit';
			$label_style  = $param['menu_1']['item_tooltip_style'][ $i ] ?? 'normal';
			$label_weight = $param['menu_1']['item_tooltip_weight'][ $i ] ?? 'normal';
			$text_font    = $param['menu_1']['item_text_font'][ $i ] ?? 'inherit';
			$text_size    = $param['menu_1']['item_text_size'][ $i ] ?? '16';
			$text_weight  = $param['menu_1']['item_text_weight'][ $i ] ?? 'normal';
			$color        = $param['menu_1']['color'][ $i ] ?? '#ffffff';
			$bcolor       = $param['menu_1']['bcolor'][ $i ] ?? '#184c72';
			$hcolor       = $param['menu_1']['hcolor'][ $i ] ?? $color;
			$hbcolor      = $param['menu_1']['hbcolor'][ $i ] ?? $bcolor;

			$css .= ".fm-item-$this->id-$i {
				--fm-color: $color;
				--fm-background: $bcolor;
				--fm-label-font: $label_font;
				--fm-label-font-style: $label_style;
				--fm-label-weight: $label_weight;
				--fm-text-font: $text_font;
				--fm-text-size: {$text_size}px;
				--fm-text-weight: $text_weight;
			}";

			$css .= ".fm-item-$this->id-$i:hover {
				--fm-hover-color: $hcolor;
				--fm-hover-background: $hbcolor;
			}";

		}

		return $css;
	}

	private function mobile_rules(): string {
		$param = $this->param;
		$css   = '';

		if ( ! empty( $param['mobile_on'] ) ) {
			$mobile = $param['mobile'] ?? 480;
			$css    .= "@media only screen and (max-width: {$mobile}px){
				.float-menu-$this->id {
					display:none;
				}
			}";
		}

		if ( ! empty( $param['desktop_on'] ) ) {
			$desktop = $param['desktop'] ?? 1024;
			$css     .= "@media only screen and (min-width: {$desktop}px){
				.float-menu-$this->id {
					display:none;
				}
			}";
		}

		return $css;
	}
}