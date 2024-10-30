<?php
/*
Plugin Name: Best Splash
Plugin URI: http://writecode.info
Description: Keep any WordPress site look cool, attractive, and engage your readers.
"First Impress is last impression" 
Version: 1.0
Author: Sohail Ahmed
Author URI: http://www.writecode.info/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
	*/
defined('ABSPATH') or die();
define( 'BESTSPLASH_VERSION', '1.0' );
define( 'BESTSPLASH__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BESTSPLASH__PLUGIN_ASSETS', plugin_dir_url(__FILE__) .'/assets/');
define('BESTSPLASH_ADMIN', BESTSPLASH__PLUGIN_DIR.'/admin/');
define('BESTSPLASH_CORE', BESTSPLASH__PLUGIN_DIR.'/core/init.php');
define('BESTSPLASH_ASSETS', BESTSPLASH__PLUGIN_DIR.'assets');
class BestSplash{
	private $pluginContent;
	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivation' ) );
		require_once(BESTSPLASH_CORE);
		add_action('admin_enqueue_scripts', array($this,'bestsplash_admin_script'));
		add_action('admin_menu', array($this,'bestsplash_admin_menu'));
		$cont = $this->bestsplash_CheckContent();
		if($cont['activate_Splash_button'] == 1 && $cont['splashSelect'] >0){
			add_action('wp_head', array($this,'bestsplash_splash_style'));
			add_action('wp_footer', array($this,'bestsplash_front_end'));
			add_action('wp_footer', array($this,'bestsplash_splash_script'));
		}
	}
	public function plugin_activation(){
		return add_option('bestSplash','_activated');
	}
	public function plugin_deactivation(){
		delete_option('splash_plugin_content');
		return delete_option('bestSplash');
	}
	public function bestsplash_splash_style(){
		$pluginContent2 = get_option('splash_plugin_content');
		$img = unserialize($pluginContent2);
		$imag3 = BESTSPLASH__PLUGIN_ASSETS.'/images/Preloader_'.$img['splashSelect'].'.gif';
		?>
		<style type="text/css">
			.no-js #loader { display: none;  }
			.js #loader { display: block; position: absolute; left: 100px; top: 0; }
			.se-pre-con {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url(<?php echo $imag3; ?>) center no-repeat #fff;
			}
		</style>
		<?php
	}
	public function bestsplash_CheckContent(){
		$content = get_option('splash_plugin_content');
		$cont = unserialize($content);
		return $cont;
	}
	public function bestsplash_splash_script(){
		?>
		<script type="text/javascript">
			jQuery(window).load(function() {
				jQuery(".se-pre-con").fadeOut("slow");;
			});
		</script>
		<?php
	}
	public function bestsplash_front_end(){
		echo '<div class="se-pre-con"></div>';
	}
	public function bestsplash_admin_menu() {
		add_menu_page('Best Splash', 'Best Splash', 'manage_options', 'bestsplash', array($this,'bestsplash_main_page_content') );
	}
	public function bestsplash_main_page_content(){
			// $activation = get_option('__activate_Splash_button');
		$pluginContent = get_option('splash_plugin_content');
		if ($pluginContent) {
			$data_ = unserialize($pluginContent);
		}else{
			$data_ = 0;
		}
		include_once(BESTSPLASH_ADMIN.'admin.php');
	}
	function bestsplash_adding_styles() {
		wp_register_style('bestsplash-stylesheet', plugins_url('assets/css/custom.css', _FILE_));
		wp_enqueue_style('bestsplash-stylesheet');
	}
	function bestsplash_adding_scripts() {
		wp_register_script( 'modernizr',  plugins_url('/assets/js/modernizr.js', __FILE__) , array('jquery'), null, true  );
		wp_enqueue_script('modernizr');

	}
	function bestsplash_admin_script() {   
		if(isset($_GET['page']) && $_GET['page'] == 'bestsplash') {
			wp_enqueue_style( 'admin-css', plugins_url('/assets/css/admin/custom.css', __FILE__), array(), null, 'all' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'admin-alert-splash', plugins_url('/assets/js/admin/ohsnap.min.js', __FILE__) , array('jquery'), null, true );
		}
	}
}
global $bestsplash;
$bestsplash =  new BestSplash();
?>