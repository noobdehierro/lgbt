<!DOCTYPE html><html>
    <meta charset="utf-8" />
    <head>
        <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />

        <style>
            #map {
                width: 100%;
                height: 700px;
                position: relative !important;
            }
        </style>

    </head>
    <body>
        <div class="qodef-page-title qodef-m qodef-title--standard qodef-alignment--left qodef-vertical-alignment--header-bottom">
            <div class="qodef-m-inner">
                <div class="qodef-m-content qodef-content-grid ">
                    <h3 class="qodef-m-title entry-title">
                        <?php the_title(); ?>
                    </h3>
                </div>
            </div>
        </div>
        <div id="map" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom"></div>
        <script src="/wp-content/plugins/figou-integrations/public/js/secured.js"></script>
    </body>
</html>
