<?php

namespace Replicator\Base_Commands\Plugin;

use \Replicator\Core\Common;
use \WP_CLI;

/**
 * 🔌 Replicate WordPress Plugins from Boilerplate
 */
class Command extends Common {
	/**
	 * Function Invoked by WP-CLI to Replicate Plugins.
	 *
	 * @param array $args - WP-CLI Positional Arguments
	 * @param array $assoc_args - WP-CLI Associative Arguments & Flags
	 * @return void
	 */
	public function __invoke( $args, $assoc_args ) {
		$this->initialConfig();
		$this->commonPrompts( $args, $assoc_args );

		$this->runReplication();
	}

	/**
	 * This is a good opportunity to set required attributes:
	 * - $this->type (valid strings include: 'plugin', 'theme', 'package')
	 * - $this->template (path to directory containing mustache templates)
	 * 
	 * @return void
	 */
	protected function initialConfig() {
		$this->type      = 'plugin';
		$this->templates = __DIR__ . '/templates';
	}

	/**
	 * Allows modification of the generated composer.json and package.json files.
	 * 
	 * Files are written after this function fires.
	 */
	protected function modifyConfigFiles() {
		$this->composer_data = array_merge( $this->composer_data, [
			'autoload'	=> [
				'psr-4' => [
					$this->data['namespace_check'] . '\\\\' => 'src/'
				]
			]
		]);
	}

	/**
	 * Setup the structure of the Plugin.
	 */
	protected function setupStructure() {
		$slug = $this->data['slug'];
		$this->structure = [
			'.editorconfig'		=> '.editorconfig',
			'.gitignore'		=> '.editorconfig',
			"{$slug}.php" 		=> 'plugin.php',
			'README.md'  		=> 'README.md',
		];
	}
}
