<?php

class Stickyactionpro{
    public function __construct() {
        add_action('wp_enqueue_scripts',[$this,'fo_assets']);
        add_action('wp_footer', [$this,'stickyactionpro']);
    }

    
	public function fo_assets(){
		wp_enqueue_style('stickyactionpro-front-fontawsome', plugins_url('assets/fontawesome/fontawesome.min.css', __FILE__));
		wp_enqueue_style('stickyactionpro-front-styles', plugins_url('assets/front/front-styles.css', __FILE__)); 
	}

    public function stickyactionpro(){
        $blocks = get_option('stickyactionpro_blocks');

        if( is_array($blocks) && count($blocks) > 0 ){
            include 'stickyactionpro.html.php';
        }
	}
}