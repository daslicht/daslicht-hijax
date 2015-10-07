<?php
/*
Plugin Name: HIJAX for Wordpress
Plugin URI: http://marcwensauer.de
Description: Simple HIJAX 
Version: 1.0
Author: Marc Wensauer
Author URI: http://marcwensauer.de
Text Domain: daslicht-hijax
Domain Path: /languages
*/

/**
 * 
 */
class DaslichtHijax
{
	
	/**
	 * Text Domain of the Plugin
	 * @var string
	 */
	private $text_domain = "";


	 /**
 	 * [daslicht_contactform_addvalidator description]
 	 * @return [type] [description]
 	 */
	public function addScripts() {

	    	//ChromePhp::log('test', plugins_url(). "/daslicht-contactform/validator.js"  );
	        wp_enqueue_script( $this->text_domain, plugins_url() . '/' .$this->text_domain ."/hijax.js"  );   //,'','',true
			//wp_enqueue_script( $this->text_domain, plugins_url() . '/' .$this->text_domain ."/history.js/scripts/bundled/html4+html5/jquery.history.js"  );   //,'','',true


	        $dataToBePassed = array(
			    'url' => admin_url( 'admin-ajax.php' )
			);
			//ChromePhp::log('phpvars ',$dataToBePassed );
			wp_localize_script( $this->text_domain, 'php_vars', $dataToBePassed );

	    //$path = rtrim("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",'/'); // the URL the form is called from
	}


	/**
	 * [sendemail description]
	 * @return [type] [description]
	 */
	function handle_AJAX_Request() {
		$data = $_POST;
		$the_slug = '/';
		$args = array(
		  'name'        => $the_slug,
		  'post_type'   => 'page',
		  'post_status' => 'publish',
		  'numberposts' => 1
		);
		$result = get_posts($args);



		//$result = wp_remote_retrieve_body( wp_remote_get('http://example.com') );
		//$result= wp_remote_get('http://example.com');
		//ChromePhp::log('result: ', $result  );
	die;
		//echo json_encode('$result');die;
	}

 	/**
 	 * [daslicht_contactform_addvalidator description]
 	 * @return [type] [description]
 	 */
	public function plugin_loaded () {

		//function my_plugin_load_plugin_textdomain() {
    	load_plugin_textdomain( $this->text_domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

    	//ChromePhp::log('lok: ',dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
	}


	/**
	 * [__construct description]
	 */
	function __construct() {
		$this->text_domain = "daslicht-hijax";
		
		add_action( 'wp_enqueue_scripts', array( $this, 'addScripts' ) );

		add_action( 'wp_ajax_nopriv_serversidefunction', array(  $this, 'handle_AJAX_Request' ) );
		add_action( 'wp_ajax_hijax', array( $this, 'handle_AJAX_Request' ) );


		add_action( 'plugins_loaded', array( $this, 'plugin_loaded' ));


		 if(!session_id()) {
	        session_start();
	    }
	}

}

$e  = new DaslichtHijax();


?>