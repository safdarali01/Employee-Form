<?php
	/**
	 * Main Loader.
	 *
	 * @package Employee-Form
	 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'EF_Loader' ) ) {

	/**
	 * Class EF_Loader
	 */
	class EF_Loader {

		/**
		 * Constructor.
		 */
		public function __construct() { 
			$this->includes();
			add_action( 'admin_enqueue_scripts', array( $this, 'mmp_admin_enqueue_scripts' ) );
			add_action('init', array( $this, 'Create_Employee_Table'));
		}		

		/**
		 * Function for Including Files.
		 */
		public function includes() {
			include_once 'Class-EF-Employee-Form-Tab.php';
		}

		/**
		 * Enqueue Admin File.
		 */
		public function mmp_admin_enqueue_scripts() {
			wp_enqueue_script( 'mmp_admin_script', plugin_dir_url( __DIR__ ) . 'asset/js/employee.js', array( 'jquery' ), wp_rand() );
		}

		/**
		 * Function for create table of employee.
		 */
		public function Create_Employee_Table() {

			global $wpdb;
		
			$table_name = $wpdb->prefix . "employee";
		
			$charset_collate = $wpdb->get_charset_collate();
		
			$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			fname varchar(50) NOT NULL,
			lname varchar(50) NOT NULL,
			email varchar(50) NOT NULL,
			img varchar(350) NOT NULL,
			PRIMARY KEY id (id)
			) $charset_collate;";
		
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}    
	}
}
new EF_Loader();

