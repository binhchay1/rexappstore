<?php

/**
 * Class WOWP_Public
 *
 * This class handles the public functionality of the Float Menu Pro plugin.
 *
 * @package    FloatMenuLite
 * @subpackage Public
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace FloatMenuLite;

use FloatMenuLite\Admin\DBManager;
use FloatMenuLite\Publish\Conditions;
use FloatMenuLite\Publish\Display;

defined( 'ABSPATH' ) || exit;

class WOWP_Public {

	private string $pefix;

	public function __construct() {
		$this->includes();
		// prefix for plugin assets
		$this->pefix = '.min';
		add_shortcode( WOWP_Plugin::SHORTCODE, [ $this, 'shortcode' ] );
		add_action( 'wp_footer', [ $this, 'footer' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'assets' ] );
	}

	public function assets(): void {
		$handle          = WOWP_Plugin::SLUG;
		$assets          = plugin_dir_url( __FILE__ ) . 'assets/';
		$version         = WOWP_Plugin::info( 'version' );
		$args            = $this->check_display();
		$url_fontawesome = WOWP_Plugin::url() . '/vendors/fontawesome/css/all.min.css';

		if ( ! empty( $args ) ) {
			wp_enqueue_style( $handle, $assets . 'css/style'.$this->pefix.'.css', [], $version, $media = 'all' );
			wp_enqueue_script( $handle, $assets . 'js/floatMenu'.$this->pefix.'.js', array( 'jquery' ), $version, true );

			foreach ( $args as $id => $param ) {
				if ( empty( $param['fontawesome'] ) ) {
					wp_enqueue_style( $handle . '-fontawesome', $url_fontawesome, null, '6.5.1' );
				}

				if ( empty( $param['velocity'] ) ) {
					$url_velocity = $assets . 'js/velocity.min.js';
					wp_enqueue_script( 'velocity', $url_velocity, array( 'jquery' ), $version, true );
				}

				$style        = new  Style_Maker( $id, $param );
				$inline_style = $style->init();
				wp_add_inline_style( $handle, $inline_style );

				$script        = new  Script_Maker( $id, $param );
				$inline_script = $script->init();
				wp_add_inline_script( $handle, $inline_script, 'before' );

			}

		}

	}



	public function includes(): void {
		require_once plugin_dir_path( __FILE__ ) . 'class-menu-maker.php';
		require_once plugin_dir_path( __FILE__ ) . 'class-style-maker.php';
		require_once plugin_dir_path( __FILE__ ) . 'class-script-maker.php';
	}

	public function shortcode( $atts ): string {

		$atts = shortcode_atts(
			[ 'id' => "", 'footer' => 'false' ],
			$atts,
			WOWP_Plugin::SHORTCODE
		);

		if ( empty( $atts['id'] ) ) {
			return '';
		}
		$result = DBManager::get_data_by_id( $atts['id'] );

		if ( empty( $result->param ) ) {
			return '';
		}

		$conditions = Conditions::init( $result );
		if ( $conditions === false ) {
			return '';
		}

		$param  = maybe_unserialize( $result->param );
		$walker = new Menu_Maker( $atts['id'], $param );
		$out    = $walker->init();

		if ( $atts['footer'] === 'false' ) {
			$this->load_assets( $atts['id'], $param );
		}


		return $out;

	}

	public function load_assets( $id, $param ): void {

		$handle          = WOWP_Plugin::SLUG;
		$assets          = plugin_dir_url( __FILE__ ) . 'assets/';
		$version         = WOWP_Plugin::info( 'version' );
		$url_fontawesome = WOWP_Plugin::url() . '/vendors/fontawesome/css/all.min.css';

		if ( empty( $param['fontawesome'] ) ) {
			wp_enqueue_style( $handle . '-fontawesome', $url_fontawesome, null, '6.5.1' );
		}

		$style        = new  Style_Maker( $id, $param );
		$inline_style = $style->init();

		if ( wp_style_is( $handle, 'enqueued' ) ) {
			echo '<style type="text/css">' . esc_html( $inline_style ) . '</style>';
		} else {
			wp_enqueue_style( $handle, $assets . 'css/style'.$this->pefix.'.css', [], $version, $media = 'all' );
			wp_add_inline_style( $handle, $inline_style );
		}


		if ( empty( $param['velocity'] ) ) {
			$url_velocity = $assets . 'js/velocity.min.js';
			wp_enqueue_script( 'velocity', $url_velocity, array( 'jquery' ), $version, true );
		}

		$url_script = $assets . 'js/floatMenu'.$this->pefix.'.js';
		wp_enqueue_script( $handle, $url_script, array( 'jquery' ), $version, true );

		$script        = new  Script_Maker( $id, $param );
		$inline_script = $script->init();
		wp_add_inline_script( $handle, $inline_script, 'before' );


	}


	public function footer(): void {

		$args = $this->check_display();

		if ( empty( $args ) ) {
			return;
		}
		$shortcodes = '';
		foreach ( $args as $id => $param ) {
			$shortcodes .= '[' . WOWP_Plugin::SHORTCODE . ' id="' . absint( $id ) . '" footer="true"]';
		}

		echo do_shortcode( $shortcodes );
	}

	private function check_display(): array {
		$args    = [];
		$results = DBManager::get_all_data();

		if ( $results === false ) {
			return $args;
		}

		foreach ( $results as $result ) {
			$param = maybe_unserialize( $result->param );
			if ( Display::init( $result->id, $param ) === true && Conditions::init( $result ) === true ) {
				$args[ $result->id ] = $param;
			}
		}

		return $args;
	}

}