<?php
/*
 * Plugin Name: Fast Demo Importer
 * Description: Demo Importer plugin, please uninstall this plugin after you've finished importing demo contents.
 * Author: FastDemo Team
 * Version: 2.2.0
 * License: GPL2+
 * Text Domain: fw
 * Domain Path: /framework/languages
 */

if (is_admin() && !defined('FW')) {
	require_once dirname(__FILE__) . '/fast/framework/bootstrap.php';


	// Framework URI
	add_filter('fw_framework_directory_uri', function () {
		return plugin_dir_url(__FILE__) . 'fast/framework';
	});

	// Remove footer version
	add_action('after_setup_theme', function () {
		$obj = fw();
		remove_filter('update_footer', array($obj->backend, '_filter_footer_version'), 11);
	}, 12);

	// Add some inline styles
	add_action('admin_enqueue_scripts', function () {
		$style = "#fw-ext-backups-demo-list .fw-ext-backups-demo-item.active .theme-actions {display: block !important;}";
		wp_add_inline_style('fw-ext-backups-demo', $style);
	}, 20);

	add_action('admin_menu',         'fast_modify_fast_menu', 12);
	add_action('network_admin_menu', 'fast_modify_fast_menu', 12);
}

function fast_modify_fast_menu()
{
	remove_menu_page('fw-extensions');
	remove_submenu_page('tools.php', 'fw-backups');
}
