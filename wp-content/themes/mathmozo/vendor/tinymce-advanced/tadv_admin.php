<?php
/**
 * User and admin settings UI.
 * @package advanced-editor-tools
 */

if ( ! defined( 'TADV_ADMIN_PAGE' ) ) {
	exit;
}

// TODO
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( 'Invalid request' );
}

$message = '';
$tadv_options_updated = false;
$settings = $admin_settings = array();
//$images_url = plugins_url( 'plugin-assets/images', __FILE__ );
$images_url = get_template_directory().'/vendor/tinymce-advanced/plugin-assets/images';
$form_action = esc_url( remove_query_arg( array( 'tadv-import-file-complete' ), wp_unslash( $_SERVER['REQUEST_URI'] ) ) );

if ( isset( $_POST['tadv-save'] ) ) {
	check_admin_referer( 'tadv-save-buttons-order' );
	$this->save_settings();
} elseif ( isset( $_POST['tadv-restore-defaults'] ) ) {
	check_admin_referer( 'tadv-save-buttons-order' );

	// TODO: only for admin || SA
	$this->admin_settings = $this->get_default_admin_settings();
	update_option( 'tadv_admin_settings', $this->get_default_admin_settings() );

	// TODO: all users that can have settings
	$this->user_settings = $this->get_default_user_settings();
	update_option( 'tadv_settings', $this->get_default_user_settings() );

	$message = '<div class="updated notice notice-success is-dismissible"><p>' .  __( 'Default settings restored.', 'tinymce-advanced' ) . '</p></div>';
} elseif ( isset( $_POST['tadv-import-settings'] ) ) {
	check_admin_referer( 'tadv-save-buttons-order' );

	// TODO: all users
	?>
	<div class="wrap advanced-editor-tools">
	<h2><?php _e( 'Advanced Editor Tools Settings Import', 'tinymce-advanced' ); ?></h2>

	<div class="tadv-import-export">
		<form action="" method="post" enctype="multipart/form-data" class="import-file">
			<p><?php _e( 'The settings are imported from a previously exported settings file.', 'tinymce-advanced' ); ?></p>
			<p><input type="file" name="tadv-import"></p>
			<p><input type="submit" class="button button-primary" name="tadv-import-file" value="<?php _e( 'Import settings', 'tinymce-advanced' ); ?>" /></p>
			<?php wp_nonce_field( 'tadv-import-settings', 'tadv-import-settings-nonce', false ); ?>
		</form>
		<hr>
		<form action="<?php echo $form_action; ?>" method="post">
			<p><?php _e( 'Alternatively the settings can be imported from a JSON encoded string. Please paste the exported string in the text area below.', 'tinymce-advanced' );	?></p>
			<p><textarea id="tadv-import" name="tadv-import"></textarea></p>
			<p>
				<button type="button" class="button" id="tadv-import-verify"><?php _e( 'Verify', 'tinymce-advanced' ); ?></button>
				<input type="submit" class="button button-primary alignright" name="tadv-import-submit" value="<?php _e( 'Import settings from string', 'tinymce-advanced' ); ?>" />
			</p>
			<?php wp_nonce_field( 'tadv-import-settings', 'tadv-import-settings-nonce', false ); ?>
			<p id="tadv-import-error"></p>
		</form>
		<p><a href=""><?php _e( 'Back to Editor Settings', 'tinymce-advanced' ); ?></a></p>
	</div>
	</div>
	<?php

	return;
} elseif ( isset( $_POST['tadv-import-submit'] ) && ! empty( $_POST['tadv-import'] ) && is_string( $_POST['tadv-import'] ) ) {
	check_admin_referer( 'tadv-import-settings', 'tadv-import-settings-nonce' );

	// TODO: all users that can have settings
	$import = json_decode( trim( wp_unslash( $_POST['tadv-import'] ) ), true );

	if ( ! is_array( $import ) ) {
		$message = '<div class="error notice is-dismissible"><p>' .  __( 'Importing of settings failed.', 'tinymce-advanced' ) . '</p></div>';
	} else {
		$this->save_settings( $import );
		$message = '<div class="updated notice notice-success is-dismissible"><p>' . __( 'Settings imported successfully.', 'tinymce-advanced' ) . '</p></div>';
	}
} elseif ( isset( $_GET['tadv-import-file-complete'] ) ) {
	$err = (int) $_GET['tadv-import-file-complete'];

	switch( $err ) {
		case 1:
			$message = __( 'Importing of settings failed. Please import a valid settings file.', 'tinymce-advanced' );
			break;
		case 2:
			$message = __( 'Importing of settings failed. The imported file is empty.', 'tinymce-advanced' );
			break;
		case 3:
			$message = __( 'Importing of settings failed. The imported file is invalid.', 'tinymce-advanced' );
			break;
	}

	if ( empty( $message ) ) {
		$message = '<div class="updated notice notice-success is-dismissible"><p>' . __( 'Settings imported successfully.', 'tinymce-advanced' ) . '</p></div>';
	} else {
		$message = '<div class="error notice is-dismissible"><p>' . $message . '</p></div>';
	}
}

$this->load_settings();

if ( empty( $this->toolbar_1 ) && empty( $this->toolbar_2 ) && empty( $this->toolbar_3 ) && empty( $this->toolbar_4 ) ) {
	$message = '<div class="error"><p>' . __( 'ERROR: All toolbars are empty. Default settings loaded.', 'tinymce-advanced' ) . '</p></div>';

	$this->admin_settings = $this->get_default_admin_settings();
	$this->user_settings = $this->get_default_user_settings();
	$this->load_settings();
}

$all_buttons = $this->get_all_buttons();

?>
<div class="wrap tinymce-advanced block-active<?php if ( is_rtl() ) echo ' mce-rtl'; ?>" id="contain">
<h2><?php _e( 'Advanced Editor Tools', 'tinymce-advanced' ); ?></h2>
<?php

// TODO admin || SA
$this->warn_if_unsupported();

if ( isset( $_POST['tadv-save'] ) && empty( $message ) ) {
	?><div class="updated notice notice-success is-dismissible"><p><?php _e( 'Settings saved.', 'tinymce-advanced' ); ?></p></div><?php
} else {
	echo $message;
}

$dashicons_arrow = is_rtl() ? 'dashicons-arrow-left' : 'dashicons-arrow-right';

?>
<form id="tadvadmin" method="post" action="<?php echo $form_action; ?>">

<div class="toggle">
	<p class="tadv-submit tadv-submit-top">
		<input class="button-primary button-large top-button" type="submit" name="tadv-save" value="<?php _e( 'Save Changes', 'tinymce-advanced' ); ?>" />
	</p>
	<h3 class="settings-toggle block" tabindex="0">
		<span class="dashicons dashicons-arrow-down"></span>
		<span class="dashicons arrow-open <?php echo $dashicons_arrow; ?>"></span>
		<?php _e( 'Block Editor (Gutenberg)', 'tinymce-advanced' ); ?>
	</h3>
	<h3 class="settings-toggle classic" tabindex="0">
		<span class="dashicons dashicons-arrow-down"></span>
		<span class="dashicons arrow-open <?php echo $dashicons_arrow; ?>"></span>
		<?php _e( 'Classic Editor (TinyMCE)', 'tinymce-advanced' ); ?>
	</h3>
</div>

<div id="block-editor">
<h4><?php _e( 'Additional buttons for the Rich-Text toolbar', 'tinymce-advanced' ); ?></h4>
<div class="block-toolbars yes-no-wrap">
	<div class="yes-no-text">
		<p>
			<?php _e( 'The <b>Mark</b> button will wrap the selected text in a plain &lt;mark&gt; HTML element. The appearance would depend on your theme and usually resembles highlighted text.', 'tinymce-advanced' ); ?>
		</p>
		<p>
			<?php _e( 'The <b>Clear formatting</b> button will remove text formatting from the selected text, or from the whole paragraph if there is no selection. This includes femoval of most text styling like bold, italic, underline, background and foreground color, etc.', 'tinymce-advanced' ); ?>
		</p>
	</div>
	<div class="yes-no-buttons">
		<div>
			<input type="radio" name="richtext_buttons" id="richtext_buttons_yes" value="yes"<?php if ( ! $this->check_user_setting( 'disable_richtext_buttons' ) ) echo ' checked'; ?>>
			<label for="richtext_buttons_yes"><?php _e( 'Enable', 'tinymce-advanced' ); ?></label>
		</div>
		<div>
			<input type="radio" name="richtext_buttons" id="richtext_buttons_no"  value="no"<?php if ( $this->check_user_setting( 'disable_richtext_buttons' ) ) echo ' checked'; ?>>
			<label for="richtext_buttons_no"><?php _e( 'Disable', 'tinymce-advanced' ); ?></label>
		</div>
	</div>
</div>

<h4 class="classic-blocks-title-h4"><?php _e( 'Toolbars for the Classic Paragraph and Classic blocks', 'tinymce-advanced' ); ?></h4>

<p>
	<?php _e( 'The toolbars in the Classic Paragraph and Classic blocks are narrower and show on focus.', 'tinymce-advanced' ); ?>
	<?php _e( 'For best results enable the menu and add only essential buttons.', 'tinymce-advanced' ); ?>
	<?php _e( 'The buttons will wrap around depending on the width of the toolbar.', 'tinymce-advanced' ); ?>
</p>

<p>
	<input type="checkbox" name="options[]" id="menubar_block" value="menubar_block" <?php if ( $this->check_user_setting( 'menubar_block' ) ) { echo ' checked'; } ?>>
	<label for="menubar_block"><?php _e( 'Enable the editor menu (recommended).', 'tinymce-advanced' ); ?></label>
</p>

<div class="tadv-block-editor-toolbars-wrap">
	<div class="tadv-mce-menu tadv-block-editor mce-container mce-menubar mce-toolbar mce-first mce-stack-layout-item
		<?php if ( $this->check_user_setting( 'menubar_block' ) ) { echo ' enabled'; } ?>">
		<div class="mce-container-body mce-flow-layout">
			<div class="mce-widget mce-btn mce-menubtn mce-first mce-flow-layout-item">
				<button type="button">
					<span class="tadv-translate">File</span>
					<i class="mce-caret"></i>
				</button>
			</div>
			<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item">
				<button type="button">
					<span class="tadv-translate">Edit</span>
					<i class="mce-caret"></i>
				</button>
			</div>
			<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item">
				<button type="button">
					<span class="tadv-translate">Insert</span>
					<i class="mce-caret"></i>
				</button>
			</div>
			<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-toolbar-item">
				<button type="button">
					<span class="tadv-translate">View</span>
					<i class="mce-caret"></i>
				</button>
			</div>
			<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item">
				<button type="button">
					<span class="tadv-translate">Format</span>
					<i class="mce-caret"></i>
				</button>
			</div>
			<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item">
				<button type="button">
					<span class="tadv-translate">Table</span>
					<i class="mce-caret"></i>
				</button>
			</div>
			<div class="mce-widget mce-btn mce-menubtn mce-last mce-flow-layout-item">
				<button type="button">
					<span class="tadv-translate">Tools</span>
					<i class="mce-caret"></i>
				</button>
			</div>
		</div>
	</div>

	<div class="tadvdropzone tadv-block-editor mce-toolbar">
		<ul id="toolbar_classic_block" class="container-classic-block">
		<?php

		$mce_text_buttons = array( 'styleselect', 'formatselect', 'fontselect', 'fontsizeselect' );
		$all_buttons_block = $all_buttons;

		// Remove the toolbar-toggle
		unset( $all_buttons_block['wp_adv'] );

		foreach( $this->toolbar_classic_block as $button_id ) {
			$name = '';

			if ( strpos( $button_id, 'separator' ) !== false || in_array( $button_id, array( 'moveforward', 'movebackward', 'absolute' ) ) ) {
				continue;
			}

			if ( isset( $all_buttons_block[ $button_id ] ) ) {
				$name = $all_buttons_block[ $button_id ];
				unset( $all_buttons_block[ $button_id ] );
			} else {
				continue;
			}

			?>
			<li class="tadvmodule" id="<?php echo $button_id; ?>">
				<?php

				if ( in_array( $button_id, $mce_text_buttons, true ) ) {
					?>
					<div class="tadvitem mce-widget mce-btn mce-menubtn mce-fixed-width mce-listbox">
						<div class="the-button">
							<span class="descr"><?php echo $name; ?></span>
							<i class="mce-caret"></i>
							<input type="hidden" class="tadv-button" name="toolbar_classic_block[]" value="<?php echo $button_id; ?>" />
						</div>
					</div>
					<?php
				} else {
					?>
					<div class="tadvitem">
						<i class="mce-ico mce-i-<?php echo $button_id; ?>" title="<?php echo $name; ?>"></i>
						<span class="descr"><?php echo $name; ?></span>
						<input type="hidden" class="tadv-button" name="toolbar_classic_block[]" value="<?php echo $button_id; ?>" />
					</div>
					<?php
				}

				?>
			</li>
			<?php
		}

		?>
		</ul>
	</div>
</div>

<p><?php _e( 'Drop buttons in the toolbars, or drag the buttons to rearrange them.', 'tinymce-advanced' ); ?></p>

<div class="unuseddiv">
	<p><strong><?php _e( 'Unused Buttons for the Classic Paragraph and Classic blocks toolbars', 'tinymce-advanced' ); ?></strong></p>
	<div>
		<ul id="unused-classic-block" class="unused container-classic-block">
		<?php

		foreach( $all_buttons_block as $button_id => $name ) {
			if ( strpos( $button_id, 'separator' ) !== false ) {
				continue;
			}

			?>
			<li class="tadvmodule" id="<?php echo $button_id; ?>">
				<?php

				if ( in_array( $button_id, $mce_text_buttons, true ) ) {
					?>
					<div class="tadvitem mce-widget mce-btn mce-menubtn mce-fixed-width mce-listbox">
						<div class="the-button">
							<span class="descr"><?php echo $name; ?></span>
							<i class="mce-caret"></i>
							<input type="hidden" class="tadv-button" name="unused-classic-block[]" value="<?php echo $button_id; ?>" />
						</div>
					</div>
					<?php
				} else {
					?>
					<div class="tadvitem">
						<i class="mce-ico mce-i-<?php echo $button_id; ?>" title="<?php echo $name; ?>"></i>
						<span class="descr"><?php echo $name; ?></span>
						<input type="hidden" class="tadv-button" name="unused-classic-block[]" value="<?php echo $button_id; ?>" />
					</div>
					<?php
				}

				?>
			</li>
			<?php
		}

		?>
		</ul>
	</div><!-- /highlight -->
</div><!-- /unuseddiv -->
</div><!-- /block-editor -->

<div id="classic-editor">
<h4><?php _e( 'Toolbars for the Classic Editor', 'tinymce-advanced' ); ?></h4>

<div class="tadvzones">
<p>
	<input type="checkbox" name="options[]" id="menubar" value="menubar" <?php if ( $this->check_user_setting( 'menubar' ) ) { echo ' checked="checked"'; } ?>>
	<label for="menubar"><?php _e( 'Enable the editor menu.', 'tinymce-advanced' ); ?></label>
</p>

<div class="tadv-mce-menu tadv-classic-editor mce-container mce-menubar mce-toolbar mce-first mce-stack-layout-item
	<?php if ( $this->check_user_setting( 'menubar' ) ) { echo ' enabled'; } ?>">
	<div class="mce-container-body mce-flow-layout">
		<div class="mce-widget mce-btn mce-menubtn mce-first mce-flow-layout-item">
			<button type="button">
				<span class="tadv-translate">File</span>
				<i class="mce-caret"></i>
			</button>
		</div>
		<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item">
			<button type="button">
				<span class="tadv-translate">Edit</span>
				<i class="mce-caret"></i>
			</button>
		</div>
		<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item">
			<button type="button">
				<span class="tadv-translate">Insert</span>
				<i class="mce-caret"></i>
			</button>
		</div>
		<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-toolbar-item">
			<button type="button">
				<span class="tadv-translate">View</span>
				<i class="mce-caret"></i>
			</button>
		</div>
		<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item">
			<button type="button">
				<span class="tadv-translate">Format</span>
				<i class="mce-caret"></i>
			</button>
		</div>
		<div class="mce-widget mce-btn mce-menubtn mce-flow-layout-item">
			<button type="button">
				<span class="tadv-translate">Table</span>
				<i class="mce-caret"></i>
			</button>
		</div>
		<div class="mce-widget mce-btn mce-menubtn mce-last mce-flow-layout-item">
			<button type="button">
				<span class="tadv-translate">Tools</span>
				<i class="mce-caret"></i>
			</button>
		</div>
	</div>
</div>

<?php

$all_buttons_classic = $all_buttons;
$button_id = '';

for ( $i = 1; $i < 5; $i++ ) {
	$toolbar = "toolbar_$i";

	?>
	<div class="tadvdropzone mce-toolbar">
	<ul id="toolbar_<?php echo $i; ?>" class="container">
	<?php

	foreach( $this->$toolbar as $button_id ) {
		if ( strpos( $button_id, 'separator' ) !== false || in_array( $button_id, array( 'moveforward', 'movebackward', 'absolute' ) ) ) {
			continue;
		}

		if ( isset( $all_buttons_classic[ $button_id ] ) ) {
			$name = $all_buttons_classic[ $button_id ];
			unset( $all_buttons_classic[ $button_id ] );
		} else {
			continue;
		}

		?>
		<li class="tadvmodule" id="<?php echo $button_id; ?>">
			<?php

			if ( in_array( $button_id, $mce_text_buttons, true ) ) {
				?>
				<div class="tadvitem mce-widget mce-btn mce-menubtn mce-fixed-width mce-listbox">
					<div class="the-button">
						<span class="descr"><?php echo $name; ?></span>
						<i class="mce-caret"></i>
						<input type="hidden" class="tadv-button" name="toolbar_<?php echo $i; ?>[]" value="<?php echo $button_id; ?>" />
					</div>
				</div>
				<?php
			} else {
				?>
				<div class="tadvitem">
					<i class="mce-ico mce-i-<?php echo $button_id; ?>" title="<?php echo $name; ?>"></i>
					<span class="descr"><?php echo $name; ?></span>
					<input type="hidden" class="tadv-button" name="toolbar_<?php echo $i; ?>[]" value="<?php echo $button_id; ?>" />
				</div>
				<?php
			}

			?>
		</li>
		<?php

	}

	?>
	</ul></div>
	<?php
}

?>
</div>

<p><?php _e( 'Drop buttons in the toolbars, or drag the buttons to rearrange them.', 'tinymce-advanced' ); ?></p>

<div class="unuseddiv">
	<h4><?php _e( 'Unused Buttons', 'tinymce-advanced' ); ?></h4>
	<div>
		<ul id="unused" class="unused container">
		<?php

		foreach( $all_buttons_classic as $button_id => $name ) {
			if ( strpos( $button_id, 'separator' ) !== false ) {
				continue;
			}

			?>
			<li class="tadvmodule" id="<?php echo $button_id; ?>">
				<?php

				if ( in_array( $button_id, $mce_text_buttons, true ) ) {
					?>
					<div class="tadvitem mce-widget mce-btn mce-menubtn mce-fixed-width mce-listbox">
						<div class="the-button">
							<span class="descr"><?php echo $name; ?></span>
							<i class="mce-caret"></i>
							<input type="hidden" class="tadv-button" name="unused[]" value="<?php echo $button_id; ?>" />
						</div>
					</div>
					<?php
				} else {
					?>
					<div class="tadvitem">
						<i class="mce-ico mce-i-<?php echo $button_id; ?>" title="<?php echo $name; ?>"></i>
						<span class="descr"><?php echo $name; ?></span>
						<input type="hidden" class="tadv-button" name="unused[]" value="<?php echo $button_id; ?>" />
					</div>
					<?php
				}

				?>
			</li>
			<?php
		}

		?>
		</ul>
	</div><!-- /highlighted -->
</div>
</div><!-- /classic-editor -->

<div class="advanced-options">
	<h3><?php _e( 'Options', 'tinymce-advanced' ); ?></h3>

	<div>
		<input type="checkbox" name="options[]" value="merge_toolbars" id="merge_toolbars" <?php if ( $this->check_user_setting( 'merge_toolbars' ) ) echo ' checked'; ?> />
		<label for="merge_toolbars"><?php _e( 'Append all buttons to the top toolbar in the Classic Paragraph and Classic blocks.', 'tinymce-advanced' ); ?></label>
		<p><?php _e( 'This affects buttons that are added by other plugins. These buttons will be appended to the top toolbar row instead of forming second, third, and forth rows.', 'tinymce-advanced' ); ?></p>
	</div>

	<div>
		<input type="checkbox" name="options[]" value="advlist" id="advlist" <?php if ( $this->check_user_setting('advlist') ) echo ' checked'; ?> />
		<label for="advlist"><?php _e( 'List Style Options', 'tinymce-advanced' ); ?></label>
		<p>
			<?php _e( 'Enable more list options: upper or lower case letters for ordered lists, disk or square for unordered lists, etc.', 'tinymce-advanced' ); ?>
		</p>
	</div>

	<div>
		<input type="checkbox" name="options[]" value="contextmenu" id="contextmenu" <?php if ( $this->check_user_setting('contextmenu') ) echo ' checked'; ?> />
		<label for="contextmenu"><?php _e( 'Context Menu', 'tinymce-advanced' ); ?></label>
		<p><?php _e( 'Replace the browser context (right-click) menu.', 'tinymce-advanced' ); ?></p>
	</div>

	<div>
		<input type="checkbox" name="options[]" value="advlink" id="advlink" <?php if ( $this->check_user_setting('advlink') ) echo ' checked'; ?> />
		<label for="advlink"><?php _e( 'Alternative link dialog', 'tinymce-advanced' ); ?></label>
		<p><?php _e( 'Open the TinyMCE link dialog when using the link button on the toolbar or the link menu item.', 'tinymce-advanced' ); ?></p>
	</div>

	<div>
		<input type="checkbox" name="options[]" value="fontsize_formats" id="fontsize_formats" <?php if ( $this->check_user_setting( 'fontsize_formats' ) ) echo ' checked="checked"'; ?> />
		<label for="fontsize_formats"><?php _e( 'Font sizes', 'tinymce-advanced' ); ?></label>
		<p><?php printf( __( 'Replace the size setting available for fonts with: %s.', 'tinymce-advanced' ), $this->fontsize_formats ); ?></p>
	</div>
</div>
<?php

if ( ! is_multisite() || current_user_can( 'manage_sites' ) ) {
	?>
	<div class="advanced-options">
	<h3><?php _e( 'Advanced Options', 'tinymce-advanced' ); ?></h3>
	<div>
		<input type="checkbox" name="admin_options[]" value="classic_paragraph_block" id="classic_paragraph_block" <?php if ( $this->check_admin_setting( 'classic_paragraph_block' ) ) echo ' checked'; ?> />
		<label for="classic_paragraph_block"><?php _e( 'Add Classic Paragraph block', 'tinymce-advanced' ); ?></label>
		<p>
			<?php _e( 'The Classic Paragraph block includes the familiar TinyMCE editor and is an extended and enhanced Classic block.', 'tinymce-advanced' ); ?>
			<?php _e( 'You can add multiple paragraphs, tables, galleries, embed video, set fonts and colors, and generally use everything that is available in the Classic Editor.', 'tinymce-advanced' ); ?>
			<?php _e( 'Also, like the Classic block, most existing TinyMCE plugins and add-ons will continue to work.', 'tinymce-advanced' ); ?>
			<?php _e( 'This makes the Block Editor more familiar, easier to use, easier to get used to, and more compatible with your existing workflow.', 'tinymce-advanced' ); ?>
		</p>
		<p>
			<?php _e( 'In addition most default blocks can be transformed into classic paragraphs, and a Classic Paragraph can be converted to multiple blocks.', 'tinymce-advanced' ); ?>
			<?php _e( 'It can be used everywhere instead of the Paragraph block including in columns, when creating reusable blocks, etc.', 'tinymce-advanced' ); ?>
		</p>
	</div>

	<div>
		<input type="checkbox" name="admin_options[]" value="hybrid_mode" id="hybrid_mode" <?php if ( $this->check_admin_setting( 'hybrid_mode' ) ) echo ' checked'; ?> />
		<label for="hybrid_mode"><?php _e( 'Make the Classic Paragraph or Classic block the default block (hybrid mode)', 'tinymce-advanced' ); ?></label>
		<p>
			<?php _e( 'The default block is inserted on pressing Enter in the title, or clicking under the last block.', 'tinymce-advanced' ); ?>
			<?php _e( 'Selecting this option also adds some improvements and fixes for the Classic block.', 'tinymce-advanced' ); ?>
		</p>
	</div>

	<div>
		<?php

		if ( function_exists( 'is_plugin_active' ) && ! is_plugin_active( 'classic-editor/classic-editor.php' ) ) {

			?>
			<input type="checkbox" name="admin_options[]" value="replace_block_editor" id="replace_block_editor" <?php if ( $this->check_admin_setting( 'replace_block_editor' ) ) echo ' checked'; ?> />
			<label for="replace_block_editor"><?php _e( 'Replace the Block Editor with the Classic Editor', 'tinymce-advanced' ); ?></label>
			<p>
				<?php _e( 'Selecting this option will restore the previous (&#8220;classic&#8221;) editor and the previous Edit Post screen.', 'tinymce-advanced' ); ?>
				<?php _e( 'It will allow you to use other plugins that enhance that editor, add old-style Meta Boxes, or in some way depend on the previous Edit Post screen.', 'tinymce-advanced' ); ?>
			</p>
			<p>
				<?php

				$text = __( 'If you prefer to use both editors side by side, do not enable this option. It is better to install the %1$sClassic Editor plugin%2$s.', 'tinymce-advanced' );
				/* translators: URL to (localised) Classic Editor plugin. */
				$url = __( 'https://wordpress.org/plugins/classic-editor/', 'tinymce-advanced' );
				printf( $text, '<a href="' . esc_url( $url ) . '">', '</a>' );

				?>
			</p>
			<?php
		}

		?>
	</div>
	<div>
		<input type="checkbox" name="admin_options[]" value="no_autop" id="no_autop" <?php if ( $this->check_admin_setting( 'no_autop' ) ) echo ' checked'; ?> />
		<label for="no_autop"><?php _e( 'Keep paragraph tags in the Classic block and the Classic Editor', 'tinymce-advanced' ); ?></label>
		<p>
			<?php _e( 'Stop removing &lt;p&gt; and &lt;br&gt; tags in the Classic Editor and show them in the Text tab.', 'tinymce-advanced' ); ?>
			<?php _e( 'This will make it possible to use more advanced coding in the Text tab without the back-end filtering affecting it much.', 'tinymce-advanced' ); ?>
			<?php _e( 'However it may behave unexpectedly in rare cases, so test it thoroughly before enabling it permanently.', 'tinymce-advanced' ); ?>
			<?php _e( 'Line breaks in the Text tab in the Classic Editor would still affect the output, in particular do not use empty lines, line breaks inside HTML tags or multiple &lt;br&gt; tags.', 'tinymce-advanced' ); ?>
		</p>
	</div>
	<?php

	$has_editor_style = $this->has_editor_style();
	$disabled = ' disabled';

	if ( $has_editor_style === false ) {
		add_editor_style();
		$has_editor_style = $this->has_editor_style();
	}

	if ( $has_editor_style ) {
		$disabled = '';
	}

	?>
	<div>
		<input type="checkbox" name="admin_options[]" value="importcss" id="importcss" <?php if ( ! $disabled && $this->check_admin_setting( 'importcss' ) ) echo ' checked'; echo $disabled; ?> />
		<label for="importcss"><?php _e( 'Create CSS classes menu', 'tinymce-advanced' ); ?></label>
		<p>
			<?php _e( 'Load the CSS classes used in editor-style.css and replace the Formats menu.', 'tinymce-advanced' ); ?>
		</p>
		<?php

		if ( $disabled ) {
			?>
			<p>
			<span class="tadv-error"><?php _e( 'Disabled:', 'tinymce-advanced' ); ?></span>
			<?php _e( 'A stylesheet file named editor-style.css was not added by your theme.', 'tinymce-advanced' ); ?>
			<br>
			<?php
		}

		?>
		</p>
	</div>
	<div class="advanced-table-options">
		<h4><?php _e( 'Advanced options for tables', 'tinymce-advanced' ); ?></h4>
		<div>
			<input type="checkbox" name="admin_options[]" value="table_resize_bars" id="table_resize_bars" <?php if ( $this->check_admin_setting( 'table_resize_bars' ) ) echo ' checked'; ?> />
			<label for="table_resize_bars"><?php _e( 'Enable resizing of tables, rows, and columns by dragging with the mouse', 'tinymce-advanced' ); ?></label>
			<p>
				<?php _e( 'When enabled the whole table, rows, and columns can be resized by dragging but the sizes are set with inline CSS styles.', 'tinymce-advanced' ); ?>
				<?php _e( 'This may override some styles that are set by your theme and usually makes the table non-responsive when viewed on a small screen like a smartphone.', 'tinymce-advanced' ); ?>
				<?php _e( 'When a row or a column is resized the inline styles are updated on all table rows and cells.', 'tinymce-advanced' ); ?>
			</p>
			<p>
				<?php _e( 'Disabling this option will stop the editor from adding inline CSS styles and will produce cleaner HTML code.', 'tinymce-advanced' ); ?>
				<?php _e( 'Then the table, the rows and the cells can be resized by typing the size values in the advanced options tabs.', 'tinymce-advanced' ); ?>
			</p>
			<p>
				<span class="dashicons dashicons-info"></span>
				<?php _e( 'This option does not affect inline styles on tables in existing posts. To reset table size or remove all formatting for the whole table please see the two buttons at the bottom of the Format menu.', 'tinymce-advanced' ); ?>
			</p>
		</div>
		<div>
			<input type="checkbox" name="admin_options[]" value="table_default_attributes" id="table_default_attributes" <?php if ( $this->check_admin_setting( 'table_default_attributes' ) ) echo ' checked'; ?> />
			<label for="table_default_attributes"><?php _e( 'When inserting a table set the HTML border attribute to 1', 'tinymce-advanced' ); ?></label>
			<p>
				<?php _e( 'This will add a border around the table unless it is overriden by your theme.', 'tinymce-advanced' ); ?>
			</p>
		</div>
		<div>
			<input type="checkbox" name="admin_options[]" value="table_grid" id="table_grid" <?php if ( $this->check_admin_setting( 'table_grid' ) ) echo ' checked'; ?> />
			<label for="table_grid"><?php _e( 'When inserting a table show a grid where the number of rows and columns can be selected by dragging with the mouse', 'tinymce-advanced' ); ?></label>
			<p>
				<?php _e( 'If the grid is disabled the number of rows and columns can be typed in the Insert Table dialog.', 'tinymce-advanced' ); ?>
			</p>
		</div>
		<div>
			<input type="checkbox" name="admin_options[]" value="table_tab_navigation" id="table_tab_navigation" <?php if ( $this->check_admin_setting( 'table_tab_navigation' ) ) echo ' checked'; ?> />
			<label for="table_tab_navigation"><?php _e( 'Jump to the next cell when pressing the tab key while editing a table', 'tinymce-advanced' ); ?></label>
			<p>
				<?php _e( 'When disabled, pressing the tab key will jump outside the editor area.', 'tinymce-advanced' ); ?>
			</p>
		</div>
		<div>
			<input type="checkbox" name="admin_options[]" value="table_advtab" id="table_advtab" <?php if ( $this->check_admin_setting( 'table_advtab' ) ) echo ' checked'; ?> />
			<label for="table_advtab"><?php _e( 'Show the advanced tabs in the table properties dialogs', 'tinymce-advanced' ); ?></label>
			<p>
				<?php _e( 'The advanced tabs allow setting of inline CSS styles on the table, each row, and each cell. They have fields for easier setting of border, border color and background color styles.', 'tinymce-advanced' ); ?>
			</p>
			<p>
				<span class="dashicons dashicons-warning"></span>
				<?php _e( 'To keep the table more responsive please use percentage values when setting widths.', 'tinymce-advanced' ); ?>
			</p>
		</div>
	</div>
	</div>

	<div class="advanced-options">
	<h3><?php _e( 'Administration', 'tinymce-advanced' ); ?></h3>
	<div>
		<h4><?php _e( 'Settings import and export', 'tinymce-advanced' ); ?></h4>
		<p>
			<?php _e( 'The settings are exported as a JSON encoded file.', 'tinymce-advanced' ); ?>
			<?php _e( 'It is important that the exported file is not edited in any way.', 'tinymce-advanced' ); ?>
		</p>
		<p>
			<?php wp_nonce_field( 'tadv-export-settings', 'tadv-export-settings-nonce', false ); ?>
			<input type="submit" class="button" name="tadv-export-settings" value="<?php _e( 'Export Settings', 'tinymce-advanced' ); ?>" /> &nbsp;
			<input type="submit" class="button" name="tadv-import-settings" value="<?php _e( 'Import Settings', 'tinymce-advanced' ); ?>" />
		</p>
	</div>
	<div>
		<h4><?php _e( 'Enable the editor enhancements for:', 'tinymce-advanced' ); ?></h4>
		<p>
			<input type="checkbox" id="tadv_enable_1" name="tadv_enable_at[]" value="edit_post_screen" <?php if ( $this->check_admin_setting( 'enable_edit_post_screen' ) ) echo ' checked'; ?> />
			<label for="tadv_enable_1"><?php _e( 'The Classic Editor (Add New and Edit posts and pages)', 'tinymce-advanced' ); ?></label>
		</p>
		<p>
			<input type="checkbox" id="tadv_enable_2" name="tadv_enable_at[]" value="rest_of_wpadmin" <?php if ( $this->check_admin_setting( 'enable_rest_of_wpadmin' ) ) echo ' checked'; ?> />
			<label for="tadv_enable_2"><?php _e( 'Other instances of the Classic (TinyMCE) editor in wp-admin', 'tinymce-advanced' ); ?></label>
		</p>
		<p>
			<input type="checkbox" id="tadv_enable_3" name="tadv_enable_at[]" value="on_front_end" <?php if ( $this->check_admin_setting( 'enable_on_front_end' ) ) echo ' checked'; ?> />
			<label for="tadv_enable_3"><?php _e( 'Instances of the Classic editor on the front end of the site', 'tinymce-advanced' ); ?></label>
		</p>
	</div>
	</div>
	<?php

}


// Add a notice that the plugin was renamed.
?>
<p>
	<span class="dashicons dashicons-info" style="color: #777;"></span>
	<?php _e( 'Please note: This plugin was renamed from "TinyMCE Advanced" to "Advanced Editor Tools". The plugin functionality remains the same.', 'tinymce-advanced' ); ?>
</p>

<hr>

<p class="tadv-submit">
	<?php wp_nonce_field( 'tadv-save-buttons-order' ); ?>
	<input class="button" type="submit" name="tadv-restore-defaults" value="<?php _e( 'Restore Default Settings', 'tinymce-advanced' ); ?>" />
	<input class="button-primary button-large" type="submit" name="tadv-save" value="<?php _e( 'Save Changes', 'tinymce-advanced' ); ?>" />
</p>
</form>

<div id="wp-adv-error-message" class="tadv-error">
<?php _e( 'The [Toolbar toggle] button shows or hides the second, third, and forth button rows. It will only work when it is in the first row and there are buttons in the second row.', 'tinymce-advanced' ); ?>
</div>
</div><?php // .wrap.tinymce-advanced end ?>
