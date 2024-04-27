<?php

class StickyactionproAdmin{
	private const bgcolor = '#FF8800';
	private const txtcolor = '#FFFFFF';
	private const size = 13;

	function __construct(){
		add_action('admin_enqueue_scripts', [$this,'assets']);
		add_action('admin_menu', [$this,'stickyactionproadmin_menu']);
	
		add_action('wp_ajax_save_action', [$this,'stickyactionproadmin_save']);
		
		

	}

	public function assets($hook){
		$current_screen = get_current_screen();
		if (is_admin() && $current_screen && $current_screen->id == 'toplevel_page_stickyactionproadmin-settings') {
		
			wp_enqueue_style('stickyactionpro-admin-fontawsome', plugins_url('../assets/fontawesome/fontawesome.min.css', __FILE__));
			wp_enqueue_style('stickyactionpro-admin-iconpicker', plugins_url('../assets/iconpicker/iconpicker-1.5.0.css', __FILE__));
			
			wp_enqueue_style('stickyactionpro-admin-styles', plugins_url('../assets/admin-styles.css', __FILE__));
			
			wp_enqueue_script('stickyactionpro-jquery', plugins_url('../assets/jquery-3.7.1.min.js', __FILE__));
			wp_enqueue_script('icon-picker-jquery', plugins_url('../assets/iconpicker/iconpicker-1.5.0.js', __FILE__));
			

			$path = plugins_url('../assets/admin-scripts.js', __FILE__);
			wp_enqueue_script('stickyactionpro-admin-scripts', $path, array(), '1.0', true);

			wp_localize_script('stickyactionpro-admin-scripts', 'customAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

			wp_enqueue_script('wplink');
			wp_enqueue_script('jquery');
			wp_enqueue_style('editor-buttons');
			wp_enqueue_editor();
		}

	}


	public function stickyactionproadmin_menu() {
		add_menu_page(
			'Sticky Action Pro Settings',
			'Sticky Action Pro Settings',
			'manage_options',
			'stickyactionproadmin-settings',
			[$this,'stickyactionproadmin_settings_page']
		);
	}


	

	public function stickyactionproadmin_settings_page() {
		$bgcolor = get_option('stickyactionpro_bgcolor') == false ? self::bgcolor : get_option('stickyactionpro_bgcolor');
		$txtcolor = get_option('stickyactionpro_txtcolor') == false ? self::txtcolor : get_option('stickyactionpro_txtcolor');
		$size = get_option('stickyactionpro_size') == false ?  self::size : get_option('stickyactionpro_size');
		$blocks = get_option('stickyactionpro_blocks') == false ? [] : get_option('stickyactionpro_blocks');

		include	STICKYACTIONPRO__PLUGIN_DIR.'/stickyactionpro-admin.html.php';
	}

	public function stickyactionproadmin_save(){
		$bgcolor = isset($_POST['bgcolor']) ? $_POST['bgcolor'] : '';
        $txtcolor = isset($_POST['txtcolor']) ? $_POST['txtcolor'] : '';
        $size = isset($_POST['size']) ? $_POST['size'] : '';
		$blocks = isset($_POST['blocks']) ? $_POST['blocks'] : '';
		update_option('stickyactionpro_bgcolor',$bgcolor);
		update_option('stickyactionpro_txtcolor',$txtcolor);
		update_option('stickyactionpro_size',$size);
		update_option('stickyactionpro_blocks',($blocks));
		wp_send_json(['success'=>true]);
	}


}
