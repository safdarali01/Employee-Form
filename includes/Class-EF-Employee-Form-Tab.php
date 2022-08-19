<?php
/**
 * Employee Form in Setting Tab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'EF_Employee_Form_Tab' ) ) {
	/**
	 * Class EF_Employee_Form_Tab
	 */
	class EF_Employee_Form_Tab {

		/**
		 * Constructor
		 */
		public function __construct() { 
			add_action("admin_menu", array( $this, "add_employee_tab_in_setting_menu"));
			$this->save_employees_data();
			$this->delete_employees_data();
		}
		/**
		 * Create a tab in setting menu page.
		 */
		public function add_employee_tab_in_setting_menu(){
			add_submenu_page( 
				'options-general.php',
				'Employees',
				'Employee Form',
				'administrator',
				'employee-form',
				array($this, 'add_menu_page'),null );
		}

		/**
		 * Display a Form and Table of Employees
		 */
		public function add_menu_page(){
			global $wpdb;
			$employees = $wpdb->prefix . 'employee';
			$result = $wpdb->get_results ( "SELECT * FROM $employees");
			include_once dirname( __DIR__ ).'/templates/Employee-Form.php';
			include_once dirname( __DIR__ ).'/templates/Display-Data.php';

		}

		/**
		 * Save data from employees form.
		 */
		public function save_employees_data() { 
			global $wpdb;
			$employees = $wpdb->prefix . 'employee';
			$result = $wpdb->get_results ( "SELECT email FROM $employees");
			$proceed ='';
			$profile ='';
			if ( isset( $_POST['submit'] ) ){  
				$fname = $_POST['fname'];
				$lastname = $_POST['lastname'];
				$email = $_POST['email'];
				$image = $_FILES['image'];

				/**
				* Save Image.
				*/
				require_once( ABSPATH . '/wp-includes/pluggable.php' );
				require_once( ABSPATH . 'wp-admin/includes/file.php' );

				$upload = wp_handle_upload(
				$image,
				array( 'test_form' => false )
				);

				if( ! empty( $upload[ 'error' ] ) ) {
				wp_die( $upload[ 'error' ] );
				}

				/**
				* Add Image into Media.
				*/
				$attachment_id = wp_insert_attachment(
				array(
				'guid' => $upload[ 'url' ],
				'post_mime_type' => $upload[ 'type' ],
				'post_title' => basename( $upload[ 'file' ] ),
				'post_content' => '',
				'post_status' => 'inherit',
				),
				$upload[ 'file' ]
				);

				$profile = $upload[ 'url' ];

				if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
				wp_die( 'Upload error.' );
				}

				/**
				* Update Metadata.
				*/
				require_once( ABSPATH . 'wp-admin/includes/image.php' );

				wp_update_attachment_metadata(
				$attachment_id,
				wp_generate_attachment_metadata( $attachment_id, $upload[ 'file' ] )
				);


				/**
				* Update Employee Data.
				*/
				foreach ($result as $key => $value) {
					foreach ($value as $nested_key => $nested_value) {
						if($nested_key != 'email'){
							continue;
						}
						else if($email == $nested_value){
							$proceed = 'to_update';
							print_r($proceed);
							break;
						}
					}
	
					if( $proceed == 'to_update' ){
						break;
					}
				}
				if('to_update' == $proceed){
					$wpdb->update(
						$employees, array(
							'fname' => $fname,
							'lname' => $lastname,
							'email' => $email,
							'img' => $profile
						), 
						array(
							'email'=>$email
						)
					);

				}

				else{
					$wpdb->insert(
						$employees, array(
							'fname' => $fname,
							'lname' => $lastname,
							'email' => $email,
							'img' => $profile
						)
					);
				}
			}
		}

		/**
		 * Save data from employees form.
		 */
		public function delete_employees_data() { 
			
			global $wpdb;
			$employees = $wpdb->prefix . 'employee';
			if(isset($_GET['dlt'])){
				$dlt_id= $_GET['dlt'];
				// echo $dlt_id;
				$wpdb->delete(
					$employees, array(
						'id' => $dlt_id
					)
				);
			}
		}
	}
}

new EF_Employee_Form_Tab();
