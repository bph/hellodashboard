<?php
/*
 * Plugin Name:       Hello Dashboard
 * Plugin URI:        https://github.com/bph/hellodashboard/blob/main/hellodashboard.php
 * Description:       Example of a Dashboard widget
 * Version:           0.0.1
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Author:            Birgit Pauli-Haack
 * Author URI:        https://icodeforapurpose.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gt
 */

 
/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function gt_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'gt_dashboard_widget',                          // Widget slug.
		esc_html__( 'Welcome to Playground!', 'gt' ), // Title.
		'gt_dashboard_widget_render'                    // Display function.
	); 
    // Globalize the metaboxes array, this holds all the widgets for wp-admin.
	global $wp_meta_boxes;
	
	// Get the regular dashboard widgets array 
	// (which already has our new widget but appended at the end).
	$default_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	
	// Backup and delete our new dashboard widget from the end of the array.
	$gt_dashboard_backup = array( 'gt_dashboard_widget' => $default_dashboard['gt_dashboard_widget'] );
	unset( $default_dashboard['gt_dashboard_widget'] );
 
	// Merge the two arrays together so our widget is at the beginning.
	$sorted_dashboard = array_merge( $gt_dashboard_backup, $default_dashboard );
 
	// Save the sorted array back into the original metaboxes. 
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action( 'wp_dashboard_setup', 'gt_add_dashboard_widgets' );

/**
 * Create the function to output the content of our Dashboard Widget.
 */
function gt_dashboard_widget_render() {
    $dashboard_content = '
<p>Learn more about Playground and its tools and<br/> 
visit the <strong><a href="/category/playground">Playground Guide</a></strong></p> 
<p>For questions connect with <a href="mailto:birgit.pauli@gmail.com">Birgit via email</a>
';
	echo $dashboard_content;
}
