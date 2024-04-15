<?php
/*
 * Page Name: List
 */

use FloatMenuLite\Admin\ListTable;
use FloatMenuLite\WOWP_Plugin;

defined( 'ABSPATH' ) || exit;

$list_table = new ListTable();
$list_table->prepare_items();
$table_page = WOWP_Plugin::SLUG;
?>

    <form method="post" class="wpie-list">
		<?php
		$list_table->search_box( esc_attr__( 'Search', 'float-menu' ), WOWP_Plugin::PREFIX );
		$list_table->display();
		?>
        <input type="hidden" name="page" value="<?php echo esc_attr( $table_page ); ?>"/>
		<?php wp_nonce_field( WOWP_Plugin::PREFIX . '_nonce', WOWP_Plugin::PREFIX . '_list_action' ); ?>
    </form>
<?php
