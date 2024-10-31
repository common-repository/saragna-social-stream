<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class SSSW_Admin_Class extends SSSW_Errors{
		protected static $table_prefix;
		const TABLE_FB_YOU_VIMEO_NAME = 'wp_fb_you_vimeo';
		const ver = '1.0';
		public function __construct(){
			global $wpdb;
			add_action('admin_print_scripts',array( $this, 'animate_load_admin_script'));
			self::$table_prefix = $wpdb->base_prefix;
			$this->onActivate();
		}
		function animate_load_admin_script(){
			
			wp_enqueue_style( 'wp-color-picker' );
			
			wp_enqueue_style( 'sssw-admin-css', $this->animate_plugin_url( '../assets/css/admin.css'), array(), '' );
			wp_enqueue_style( 'sssw-font-awesome-css', $this->animate_plugin_url('../assets/css/font-awesome.min.css'));
			wp_enqueue_script( 'sssw-admin-js',  $this->animate_plugin_url( '../assets/js/admin.js' ), array( 'jquery' ), self::ver, true );
		}
		
		/**
		 * a must function. please don't remove it.
		 * process activate event - install the db (with delta).
		 */
		public function onActivate(){
			self::createTable(self::TABLE_FB_YOU_VIMEO_NAME);
		}
		/**
		 * 
		 * craete tables
		 */
		private function createTable($tableName){
			//if table exists - don't create it.
			$tableRealName = self::$table_prefix.$tableName;
			if(self::isDBTableExists($tableRealName))
				return(false);
			
			switch($tableName){
				case self::TABLE_FB_YOU_VIMEO_NAME:					
				$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
							  id int(9) NOT NULL AUTO_INCREMENT,
							  slider_title tinytext NOT NULL,
							  slider_params text NOT NULL,
							  PRIMARY KEY (id)
							);";
				break;
				default:
					FunctionsAni::throwError("table: $tableName not found");
				break;
			}
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		
		/**
		 * 
		 * check if some db table exists
		 */
		public static function isDBTableExists($tableName){
			global $wpdb;
			if(empty($tableName))
				UniteFunctionsRev::throwError("Empty table name!!!");
			$sql = "show tables like '$tableName'";
			$table = $wpdb->get_var($sql);
			if($table == $tableName)
				return(true);
				
			return(false);
		}		
		protected function animate_plugin_url( $path = '' ) {
			return plugins_url( ltrim( $path, '/' ), __FILE__ );
		}
		
		protected function check_slider(){
			$tableRealName = self::$table_prefix.TABLE_FB_YOU_VIMEO_NAME;
		}
		protected function plugin_root_url(){
			return get_site_url().'/wp-admin/admin.php?page=social-fb-you-vimeo-twit-insta';
		}
	}