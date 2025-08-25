<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WPRM_CPT {
    public function __construct() {
        //add_action('init', [$this, 'register_portfolio_cpt']);
        //add_action('init', [$this, 'register_portfolio_taxonomy']);
    }

    public function register_portfolio_cpt() {
        $labels = [
            'name' => 'Portofoliu',
            'singular_name' => 'Portofoliu'
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'menu_icon' => 'dashicons-portfolio'
        ];

        register_post_type('wprm_portfolio', $args);
    }

    public function register_portfolio_taxonomy() {
        $labels = [
            'name' => 'Categorii Portofoliu',
            'singular_name' => 'Categorie'
        ];

        $args = [
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'rewrite' => ['slug' => 'portfolio-category']
        ];

        register_taxonomy('wprm_category', ['wprm_portfolio'], $args);
    }
}
