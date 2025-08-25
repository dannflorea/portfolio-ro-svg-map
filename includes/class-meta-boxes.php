<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WPRM_Meta_Boxes {
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_judet_meta_box']);
        add_action('save_post', [$this, 'save_judet_meta']);
    }

    public function add_judet_meta_box() {
        add_meta_box(
            'wprm_judet_box',
            'Județ',
            [$this, 'render_judet_box'],
            'portofoliu',
            'side',
            'default'
        );
    }

    public function render_judet_box($post) {
        $value = get_post_meta($post->ID, '_wprm_judet', true);

        $judete = [
            'AB' => 'Alba',
            'AR' => 'Arad',
            'AG' => 'Argeș',
            'BC' => 'Bacău',
            'BH' => 'Bihor',
            'BN' => 'Bistrița-Năsăud',
            'BR' => 'Brăila',
            'BT' => 'Botoșani',
            'BV' => 'Brașov',
            'B'  => 'București',
            'BZ' => 'Buzău',
            'CS' => 'Caraș-Severin',
            'CL' => 'Călărași',
            'CJ' => 'Cluj',
            'CT' => 'Constanța',
            'CV' => 'Covasna',
            'DB' => 'Dâmbovița',
            'DJ' => 'Dolj',
            'GL' => 'Galați',
            'GR' => 'Giurgiu',
            'GJ' => 'Gorj',
            'HR' => 'Harghita',
            'HD' => 'Hunedoara',
            'IL' => 'Ialomița',
            'IS' => 'Iași',
            'IF' => 'Ilfov',
            'MM' => 'Maramureș',
            'MH' => 'Mehedinți',
            'MS' => 'Mureș',
            'NT' => 'Neamț',
            'OT' => 'Olt',
            'PH' => 'Prahova',
            'SM' => 'Satu Mare',
            'SJ' => 'Sălaj',
            'SB' => 'Sibiu',
            'SV' => 'Suceava',
            'TR' => 'Teleorman',
            'TM' => 'Timiș',
            'TL' => 'Tulcea',
            'VS' => 'Vaslui',
            'VL' => 'Vâlcea',
            'VN' => 'Vrancea'
        ];

        echo '<select name="wprm_judet" style="width:100%;">';
        echo '<option value="">Selectează județul</option>';
        foreach ($judete as $key => $name) {
            printf(
                '<option value="%s" %s>%s</option>',
                esc_attr($key),
                selected($value, $key, false),
                esc_html($name)
            );
        }
        echo '</select>';
    }

    public function save_judet_meta($post_id) {
        if (isset($_POST['wprm_judet'])) {
            update_post_meta($post_id, '_wprm_judet', sanitize_text_field($_POST['wprm_judet']));
        }
    }
}
