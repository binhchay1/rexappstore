<?php

/**
 * Class SupportForm
 *
 * This class handles the support form functionality.
 *
 * @ackage     WowPlugin
 * @subpackage Admin
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace FloatMenuLite\Admin;

defined( 'ABSPATH' ) || exit;

use FloatMenuLite\WOWP_Plugin;

class SupportForm {

	public static function init(): void {

		$plugin  = WOWP_Plugin::info( 'name' ) . ' v.' . WOWP_Plugin::info( 'version' );
		$license = get_option( 'wow_license_key_' . WOWP_Plugin::PREFIX, 'no' );

		self::send();

		?>

        <form method="post">

            <fieldset class="wpie-fieldset">
                <legend>
					<?php esc_html_e( 'Support Form', 'float-menu' ); ?>
                </legend>

                <div class="wpie-fields is-column-2">
                    <div class="wpie-field">
                        <div class="wpie-field__title"><?php esc_html_e( 'Your Name', 'float-menu' ); ?></div>
                        <label class="wpie-field__label has-icon">
                            <span class="dashicons dashicons-admin-users"></span>
                            <input type="text" name="support[name]" id="support-name" value="">
                        </label>
                    </div>

                    <div class="wpie-field">
                        <div class="wpie-field__title"><?php esc_html_e( 'Contact email', 'float-menu' ); ?></div>
                        <label class="wpie-field__label has-icon">
                            <span class="dashicons dashicons-email"></span>
                            <input type="email" name="support[email]" id="support-email"
                                   value="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>">
                        </label>
                    </div>
                </div>

                <div class="wpie-fields is-column-2">

                    <div class="wpie-field">
                        <div class="wpie-field__title"><?php esc_html_e( 'Link to the issue', 'float-menu' ); ?></div>
                        <label class="wpie-field__label has-icon">
                            <span class="dashicons dashicons-admin-links"></span>
                            <input type="url" name="support[link]" id="support-link"
                                   value="<?php echo esc_url( get_option( 'home' ) ); ?>">
                        </label>
                    </div>

                    <div class="wpie-field" data-field-box="menu_open">
                        <div class="wpie-field__title"><?php esc_html_e( 'Message type', 'float-menu' ); ?></div>
                        <label class="wpie-field__label">
                            <select name="support[type]" id="support-type">
                                <option value="Issue"><?php esc_html_e( 'Issue', 'float-menu' ); ?></option>
                                <option value="Idea"><?php esc_html_e( 'Idea', 'float-menu' ); ?></option>
                            </select>
                        </label>
                    </div>

                </div>
                <div class="wpie-fields is-column-2">
                    <div class="wpie-field">
                        <div class="wpie-field__title"><?php esc_html_e( 'Plugin', 'float-menu' ); ?></div>
                        <label class="wpie-field__label has-icon">
                            <span class="dashicons dashicons-admin-plugins"></span>
                            <input type="text" readonly name="support[plugin]" id="support-plugin"
                                   value="<?php echo esc_attr( $plugin ); ?>">
                        </label>
                    </div>

                    <div class="wpie-field">
                        <div class="wpie-field__title"><?php esc_html_e( 'License Key', 'float-menu' ); ?></div>
                        <label class="wpie-field__label has-icon">
                            <span>🔑</span>
                            <input type="text" readonly name="support[license]" id="support-license"
                                   value="<?php echo esc_attr( $license ); ?>">
                        </label>
                    </div>

                </div>
                <div class="wpie-fields is-column">
					<?php
					$content   = esc_attr__( 'Enter Your Message', 'float-menu' );
					$editor_id = 'support-message';
					$settings  = array(
						'textarea_name' => 'support[message]',
					);
					wp_editor( $content, $editor_id, $settings ); ?>
                </div>

                <div class="wpie-fields is-column">

                    <div class="wpie-field">
						<?php submit_button( __( 'Send to Support', 'float-menu' ), 'primary', 'submit', false ); ?>
                    </div>

                </div>

				<?php wp_nonce_field( WOWP_Plugin::PREFIX . '_nonce_action', WOWP_Plugin::PREFIX . '_nonce_name' ); ?>
            </fieldset>


        </form>

		<?php


	}

	private static function send(): void {
		if ( ! self::verify() ) {

			return;
		}


		$error = self::error();
		if ( ! empty( $error ) ) {
			echo '<p class="notice notice-error">' . esc_html( $error ) . '</p>';

			return;
		}

		$support = $_POST['support'];

		$headers = array(
			'From: ' . esc_attr( $support['name'] ) . ' <' . sanitize_email( $support['email'] ) . '>',
			'content-type: text/html',
		);


		$message_mail = '<html>
                        <head></head>
                        <body>
                        <table>
                        <tr>
                        <td><strong>License Key:</strong></td>
                        <td>' . esc_attr( $support['license'] ) . '</td>
                        </tr>
                        <tr>
                        <td><strong>Plugin:</strong></td>
                        <td>' . esc_attr( $support['plugin'] ) . '</td>
                        </tr>
                        <tr>
                        <td><strong>Website:</strong></td>
                        <td><a href="' . esc_url( $support['link'] ) . '" target="_blank">' . esc_url( $support['link'] ) . '</a></td>
                        </tr>
                        </table>
                        <p/>
                        ' . nl2br( wp_kses_post( $support['message'] ) ) . ' 
                        </body>
                        </html>';
		$type         = sanitize_text_field( $support['type'] );
		$to_mail      = WOWP_Plugin::info( 'email' );
		$send         = wp_mail( $to_mail, 'August749 / Support Ticket: ' . $type, $message_mail, $headers );

		if ( $send ) {
			$text = __( 'Your message has been sent to the support team.', 'float-menu' );
			echo '<p class="notice notice-success">' . esc_html( $text ) . '</p>';
		} else {
			$text = __( 'Sorry, but message did not send. Please, contact us via support page.', 'float-menu' );
			echo '<p class="notice notice-error">' . esc_html( $text ) . '</p>';
		}

	}

	private static function error(): ?string {
		if ( ! self::verify() ) {
			return '';
		}
		$support = $_POST['support'];
		$fields  = [ 'name', 'email', 'link', 'type', 'plugin', 'license', 'message' ];

		foreach ( $fields as $field ) {
			if ( empty( $support[ $field ] ) ) {
				return __( 'Please fill in all the form fields below.', 'float-menu' );
			}
		}

		return '';
	}

	private static function verify(): bool {
		$support      = $_POST['support'] ?? [];
		$nonce_name   = WOWP_Plugin::PREFIX . '_nonce_name';
		$nonce_action = WOWP_Plugin::PREFIX . '_nonce_action';

		return ! empty( $support ) && wp_verify_nonce( $_POST[ $nonce_name ], $nonce_action );
	}

}
