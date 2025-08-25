jQuery(document).ready(function ($) {
    let selectedCategory = 'all';
    let selectedJudet = '';

    // Tooltip
    const tooltip = $('<div id="wprm-tooltip"></div>').appendTo('body');

    /** ==============================
     * Hover pe județ (tooltip)
     =============================== */
    $(document).on('mouseenter', '.wprm-map path[data-judet]', function () {
        const name = $(this).data('name') || $(this).data('judet');
        tooltip.text(name).fadeIn(150);
    });

    $(document).on('mousemove', '.wprm-map path[data-judet]', function (e) {
        tooltip.css({
            top: e.pageY + 10,
            left: e.pageX + 10
        });
    });

    $(document).on('mouseleave', '.wprm-map path[data-judet]', function () {
        tooltip.hide();
    });
    console.log('Delegăm evenimentul click pe path-uri...');

    /** ==============================
     * Click pe județ
     =============================== */
    jQuery(document).on('click', '.wprm-map path[data-judet]', function () {
        const judet = jQuery(this).data('judet');
        console.log('✅ Click pe județ:', judet);

        // Scoate active de pe toate
        jQuery('.wprm-map path[data-judet]').removeClass('active');

        // Adaugă active pe cel curent
        jQuery(this).addClass('active');

        selectedJudet = judet;
        loadPortfolio();
    });

    /** ==============================
     * Click pe categorie
     =============================== */
    $('.wprm-filter-category').on('click', function () {
    $('.wprm-filter-category').removeClass('active');
    $(this).addClass('active');
    selectedCategory = $(this).data('category');

    if (selectedCategory === 'all') {
        // ✅ Resetăm județul selectat
        selectedJudet = '';
        $('.wprm-map path').removeClass('active').css('fill', '');
    }

    loadPortfolio();
});


    /** ==============================
     * AJAX pentru portofolii
     =============================== */
    function loadPortfolio() {
        $.ajax({
            url: wprm_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'wprm_filter_portfolio',
                nonce: wprm_ajax.nonce,
                category: selectedCategory,
                judet: selectedJudet
            },
            beforeSend: function () {
                $('#wprm-results').html('<p>Se încarcă...</p>');
            },
            success: function (response) {
                $('#wprm-results').html(response);
            },
            error: function () {
                $('#wprm-results').html('<p>Eroare la încărcare.</p>');
            }
        });
    }
});