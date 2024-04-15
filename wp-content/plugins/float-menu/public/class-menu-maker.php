<?php
/**
 * Class Menu_Maker
 *
 * This class is responsible for generating the floating menu HTML using the provided parameters.
 *
 * @package    FloatMenuLite
 * @subpackage Public
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace FloatMenuLite;

defined( 'ABSPATH' ) || exit;

class Menu_Maker {
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
		if ( empty( $param['menu_1']['item_type'] ) || ! is_array( $param['menu_1']['item_type'] ) ) {
			return '';
		}
		$menu = '<div class="floating-menu float-menu-' . absint( $this->id ) . ' notranslate">';
		$menu .= '<ul class="fm-bar">';
		$menu .= $this->create_item();
		$menu .= '</ul>';
		$menu .= '</div>';

		return $menu;
	}


	private function create_item(): string {
		$param            = $this->param;
		$items            = $param['menu_1']['item_type'];
		$item             = '';
		foreach ( $items as $i => $value ) {
			$item .= '<li class="fm-item-' . absint( $this->id ) . '-' . absint( $i ) . '">';
			$item .= $this->start_item( $i, $value );
			$item .= $this->create_icon( $i );
			$item .= $this->create_label( $i, $value );
			$item .= $this->end_item( $i, $value );
			$item .= '</li>';
		}

		return $item;
	}

	private function filter_sub_items( $value ): bool {
		return ! empty( $value );
	}


	private function start_item( $i, $value ): string {
		$param = $this->param;

		$out = '<a ';

		if ( $value === 'link' ) {
			$link   = $param['menu_1']['item_link'][ $i ] ?? '#';
			$target = ! empty( $param['menu_1']['new_tab'][ $i ] ) ? '_blank' : '_self';
			$out    .= 'href="' . esc_url( $link ) . '" ';
			$out    .= 'target="' . esc_attr( $target ) . '" ';
			$out    .= $this->item_atts( $i );
		}


		if ( $value === 'login' ) {
			$url  = $param['menu_1']['item_link'][ $i ] ?? '#';
			$link = wp_login_url( $url );
			$out  .= 'href="' . esc_url( $link ) . '" ';
			$out  .= $this->item_atts( $i );
		}

		if ( $value === 'logout' ) {
			$url  = $param['menu_1']['item_link'][ $i ] ?? '#';
			$link = wp_logout_url( $url );
			$out  .= 'href="' . esc_url( $link ) . '" ';
			$out  .= $this->item_atts( $i );
		}

		if ( $value === 'lostpassword' ) {
			$url  = $param['menu_1']['item_link'][ $i ] ?? '#';
			$link = wp_lostpassword_url( $url );
			$out  .= 'href="' . esc_url( $link ) . '" ';
			$out  .= $this->item_atts( $i );
		}

		if ( $value === 'register' ) {
			$link = wp_registration_url();
			$out  .= 'href="' . esc_url( $link ) . '" ';
			$out  .= $this->item_atts( $i );
		}

		$out .= '>';

		return $out;
	}


	private function item_atts( $i ): string {
		$param = $this->param;
		$out   = '';
		if ( ! empty( $param['menu_1']['button_id'][ $i ] ) ) {
			$out .= 'id="' . esc_attr( $param['menu_1']['button_id'][ $i ] ) . '" ';
		}

		if ( ! empty( $param['menu_1']['button_class'][ $i ] ) ) {
			$out .= 'class="' . esc_attr( $param['menu_1']['button_class'][ $i ] ) . '" ';
		}

		if ( ! empty( $param['menu_1']['link_rel'][ $i ] ) ) {
			$out .= 'rel="' . esc_attr( $param['menu_1']['link_rel'][ $i ] ) . '" ';
		}

		return trim( $out );
	}

	private function end_item( $i, $value ): string {

		return '</a>';
	}

	private function create_icon( $i ): string {
		$param = $this->param;

		if ( ! empty( $param['menu_1']['item_custom'][ $i ] ) ) {
			$img_alt  = $param['menu_1']['image_alt'][ $i ] ?? '';
			$icon_url = $param['menu_1']['item_custom_link'][ $i ] ?? '';
			if ( $this->is_url( $icon_url ) ) {
				return '<div class="fm-icon"><img src="' . esc_url( $icon_url ) . '" alt="' . esc_attr( $img_alt ) . '"></div>';
			}

			return '<div class="fm-icon"><i class="' . esc_attr( $icon_url ) . '"></i></div>';
		}

		if ( ! empty( $param['menu_1']['item_custom_text_check'][ $i ] ) ) {
			$item_custom_text = $param['menu_1']['item_custom_text'][ $i ] ?? '';

			return '<div class="fm-icon fm-icon-text"><span>' . esc_html( $item_custom_text ) . '</span></div>';
		}

		$icon_class   = $param['menu_1']['item_icon'][ $i ] ?? '';
		$icon_animate = $param['menu_1']['item_icon_anomate'][ $i ] ?? '';

		return '<div class="fm-icon"><i class="' . esc_attr( $icon_class ) . ' ' . esc_attr( $icon_animate ) . '"></i></div>';
	}

	private function create_label( $i, $value ): string {
		$param = $this->param;

		$label = $param['menu_1']['item_tooltip'][ $i ] ?? '';
		$out   = '';
		if ( is_email( $label ) ) {
			$label = antispambot( $label );
		}
		$hold = ! empty( $param['menu_1']['hold_open'][ $i ] ) ? ' fm-hold-open' : '';

		if ( $value === 'search' ) {
			$out = '<div class="fm-label' . esc_attr( $hold ) . '">';
			$out .= '<form class="fm-search" action="' . esc_url( home_url( '/' ) ) . '">';
			$out .= '<input type="search" class="fm-input" name="s" placeholder="' . esc_attr( $label ) . '">';
			$out .= '</form></div>';

			return $out;
		}

		if ( ! empty( $param['menu_1']['item_text'][ $i ] ) && $value === 'text' ) {
			$out = '<div class="fm-label' . esc_attr( $hold ) . '">' . esc_html( $label );
			$out .= '<div class="fm-extra-text">' . do_shortcode( nl2br( wp_kses_post( $param['menu_1']['item_text'][ $i ] ) ) ) . '</div>';
			$out .= '</div>';

			return $out;
		}

		if ( empty( $label ) ) {
			return $out;
		}

		return '<div class="fm-label' . esc_attr( $hold ) . '">' . esc_html( $label ) . '</div>';
	}

	private function is_url( $string ): bool {
		return filter_var( $string, FILTER_VALIDATE_URL ) !== false;
	}
}