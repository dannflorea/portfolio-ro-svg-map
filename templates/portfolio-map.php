<div class="wprm-wrapper">
    <div class="top_area">
        <div class="wprm-filters">
            <button class="wprm-filter-category active" data-category="all">Toate</button>
            <?php
            $terms = get_terms(['taxonomy' => 'categorie-portofoliu', 'hide_empty' => true]);
            foreach ($terms as $term) {
                echo '<button class="wprm-filter-category" data-category="'.$term->slug.'">'.$term->name.'</button>';
            }
            ?>
        </div>

        <div class="wprm-map">
            <?php include WPRM_PATH . 'assets/svg/romania-map.svg'; ?>
        </div>
    </div>

    <div id="wprm-results" class="wprm-grid">
        <?php
        $query = new WP_Query([
            'post_type' => 'portofoliu',
            'posts_per_page' => 8 // afișăm 8 pe pagină
        ]);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="wprm-item">
              		<a href="<?php echo get_permalink(get_the_ID()); ?>">
                    <div class="wprm-img-wrapper">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else : ?>
                            <img src="<?php echo WPRM_URL . 'assets/img/placeholder.jpg'; ?>" alt="Placeholder">
                        <?php endif; ?>
					</div></a>
                        <div class="wprm-text-area">
                            <h4><?php the_title(); ?></h4>
                            <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                            <a href="<?php echo get_permalink(get_the_ID()); ?>" class="wprm-btn">Vezi Proiectul</a>
                        </div>
                    </div>
            <?php endwhile;
        else :
            echo '<p>Niciun rezultat găsit.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>