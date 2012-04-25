<?php
/*
Plugin Name: WP GitHub Shortcode
Plugin URI: https://github.com/iGARET/WPGitHubShortcode
Description: A quick, easy, and sexy shortcode for displaying a "get on github" button in a WordPress post.
Version: 1.0
Author: iGARET
Author URI: http://igaret.com
*/




include_once('updater.php');
define('WP_GITHUB_FORCE_UPDATE', true);

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin

	$config = array(
		'slug' => plugin_basename(__FILE__),
		'proper_folder_name' => 'WPGitHubShortcode',
		'api_url' => 'https://api.github.com/repos/iGARET/WPGitHubShortcode',
		'raw_url' => 'https://raw.github.com/iGARET/WPGitHubShortcode/master',
		'github_url' => 'https://github.com/iGARET/WPGitHubShortcode',
		'zip_url' => 'https://github.com/iGARET/WPGitHubShortcode/zipball/master',
		'sslverify' => true,
		'requires' => '3.0',
		'tested' => '3.3.2',
	);
	new WPGitHubUpdater($config);

}

add_shortcode("github", "display_github_button");
function display_github_button($atts)
{
	extract(shortcode_atts(array('repo' => ''), $atts));
	
	$data = explode("/", $repo);
	
	return "<div class='github_button blue'><a href='https://github.com/$repo'>get {$data[1]} on github.com</a></div>";
}



add_action('wp_head', 'addHeaderCode');
function addHeaderCode()
{
	print_r('<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/WPGitHubShortcode/css/style.css" />' . "\n");
}

?>
