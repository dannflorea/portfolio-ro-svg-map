<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WPRM_Ajax {
    public function __construct() {
        add_action('wp_ajax_wprm_filter_portfolio', [$this, 'filter_portfolio']);
        add_action('wp_ajax_nopriv_wprm_filter_portfolio', [$this, 'filter_portfolio']);
    }

    public function filter_portfolio() {
        check_ajax_referer('wprm_nonce', 'nonce');

        $judet = sanitize_text_field($_POST['judet']);
        $category = sanitize_text_field($_POST['category']);

        $args = [
            'post_type' => 'portofoliu',
            'posts_per_page' => -1,
        ];

        $meta_query = [];
        if (!empty($judet)) {
            $meta_query[] = [
                'key' => '_wprm_judet',
                'value' => $judet,
                'compare' => '='
            ];
        }
        if (!empty($meta_query)) {
            $args['meta_query'] = $meta_query;
        }

        if (!empty($category) && $category !== 'all') {
            $args['tax_query'] = [[
                'taxonomy' => 'categorie-portofoliu',
                'field'    => 'slug',
                'terms'    => $category
            ]];
        }

        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) : $query->the_post();
                echo '<div class="wprm-item">';
          		echo '<a href="'.get_permalink(get_the_ID()).'">';
          		echo '<div class="wprm-img-wrapper">';
                if (has_post_thumbnail()) {
                    the_post_thumbnail('medium');
                }
          		echo '</div>';
          		echo '</a>';
          		echo '<div class="wprm-text-area">';
                echo '<h4>'.get_the_title().'</h4>';
                echo '<p>'.wp_trim_words(get_the_content(), 15).'</p>';
          		echo '<a href="'.get_permalink(get_the_ID()).'" class="wprm-btn">Vezi Proiectul</a>';
                echo '</div>';
          		echo '</div>';
            endwhile;
        } else {
            echo '<p>Niciun rezultat găsit.</p>';
        }
        wp_die();
    }
}