<?php
/**
 * ☁️ WordPress Replicators
 * * *
 * 🖨 Replicate new WordPress Plugins, Themes, WP-CLI Packages and features using WP-CLI and Mustache Templates.
 * * *
 *
 * 1. 👀 Make sure WP-CLI is available
 * 2. 🔍 Make sure autoloader file is available.
 * 3. ✅ Autoload \\Replicator\\Base_Commands files.
 * 4. 🛠 Setup 'wp replicate' WP-CLI Commands
 */

/**
 * 1. 👀 Make sure WP-CLI is available
 */
if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * 2. 🔍 Make sure autoloader file is available.
 */
if ( ! is_readable( $replicate_command_autoloader = dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	return;
}

/**
 * 3. ✅ Autoload \\Replicator\\Core && \\Replicator\\Base_Commands files.
 */
require_once $replicate_command_autoloader;

/**
 * 4. 🏗 Setup 'wp replicate' WP-CLI Commands
 */
$namespace = '\\Replicator\\Base_Commands\\';

$commands  = [
	'plugin' => 'Plugin'
];

foreach( $commands as $cmd => $class ) {
	WP_CLI::add_command( 
		sprintf( 'replicate %s', $cmd ), 
		$namespace . $class . '\\Command' 
	);
}
