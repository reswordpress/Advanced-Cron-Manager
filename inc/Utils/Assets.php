<?php
/**
 * Assets class
 * Loads plugin assets
 */

namespace underDEV\AdvancedCronManager\Utils;
use underDEV\AdvancedCronManager\AdminScreen;

class Assets {

	/**
	 * Current plugin version
	 * @var string
	 */
	public $plugin_version;

	/**
	 * Files class
	 * @var instance of underDEV\AdvancedCronManager\Utils\Files
	 */
	public $files;

	/**
	 * Screen hook handle
	 * @var string
	 */
	public $screen_hook;

	public function __construct( $version, Files $files, $screen_hook ) {

		$this->plugin_version = $version;
		$this->files          = $files;
		$this->screen_hook    = $screen_hook;

	}

	/**
	 * Enqueue admin scripts
	 * @return void
	 */
	public function enqueue_admin( $current_page_hook ) {

		if ( $current_page_hook != $this->screen_hook ) {
			return;
		}

		wp_register_script( 'advanced-cron-manager/event-manager', $this->files->vendor_asset_url( 'event-manager', 'event-manager.min.js' ), array( 'jquery' ), $this->plugin_version, true );

		wp_enqueue_style( 'advanced-cron-manager', $this->files->asset_url( 'css', 'style.css' ), array(), $this->plugin_version );
		wp_enqueue_script( 'advanced-cron-manager', $this->files->asset_url( 'js', 'scripts.min.js' ), array( 'jquery', 'advanced-cron-manager/event-manager' ), $this->plugin_version, true );

		wp_localize_script( 'advanced-cron-manager', 'advanced_cron_manager', array(
			'i18n' => array(
				/* translators: used for js to count number of vents in table, ie: 4 events */
				'events' => __( 'events' )
			)
		) );

	}

}
