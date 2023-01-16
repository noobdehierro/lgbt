var mapLayers = {};
var map = L.map('map').
setView([24.325179, -104.6532400],5);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'IGOU TELECOM S.A.P.I. de C.V.',
    maxZoom: 18
}).addTo(map);

L.control.scale().addTo(map);
//L.marker([19.2878600, -99.6532400], {draggable: true}).addTo(map);


mapLayers['Cobertura Actual'] = L.tileLayer.wms('https://geomap.altanredes.com/geoserver/web_altanredes_geoaltan/ows?SERVICE=WMS?&authkey=0768cc4d', {
    layers: 'Cobertura_Actual',
    format: 'image/png',
    transparent: true,
    tiled: true,
    opacity : 1

}).addTo(map);

mapLayers['Cobertura Garantizada'] = L.tileLayer.wms('https://geomap.altanredes.com/geoserver/web_altanredes_geoaltan/ows?SERVICE=WMS?&authkey=0768cc4d', {
    layers: 'Cobertura_Garantizada',
    format: 'image/png',
    transparent: true,
    tiled: true,
    opacity : 0.9

}).addTo(map);

mapLayers['Red 4G'] = L.tileLayer.wms('https://geomap.altanredes.com/geoserver/web_altanredes_geoaltan/ows?SERVICE=WMS?&authkey=0768cc4d', {
    layers: 'Telcel_Lte_Roaming',
    format: 'image/png',
    transparent: true,
    tiled: true,
    opacity : 0.7
}).addTo(map);

mapLayers['Red 3G'] = L.tileLayer.wms('https://geomap.altanredes.com/geoserver/web_altanredes_geoaltan/ows?SERVICE=WMS?&authkey=0768cc4d', {
    layers: 'Telcel_3G_Roaming',
    format: 'image/png',
    transparent: true,
    tiled: true,
    opacity : 0.5
}).addTo(map);

L.control.layers(null, mapLayers).addTo(map);