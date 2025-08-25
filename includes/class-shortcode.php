<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WPRM_Shortcode {
    public function __construct() {
        add_shortcode('wprm_portfolio_map', [$this, 'render_shortcode']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets() {
        wp_enqueue_style('wprm-style', WPRM_URL . 'assets/css/style.css');
        wp_enqueue_script('wprm-script', WPRM_URL . 'assets/js/script.js', ['jquery'], null, true);
        wp_localize_script('wprm-script', 'wprm_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('wprm_nonce')
        ]);
    }

    public function render_shortcode() {
        ob_start();
        include WPRM_PATH . 'templates/portfolio-map.php';
        return ob_get_clean();
    }
}
