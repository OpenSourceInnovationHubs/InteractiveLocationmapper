//OSM tiles attribution and URL
var osmLink = '<a href="https://openstreetmap.org">OpenStreetMap</a>';
var osmURL = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
var osmAttrib = '&copy; ' + osmLink;

//Carto tiles attribution and URL
var cartoLink = '<a href="https://cartodb.com/attributions">CartoDB</a>';
var cartoURL = 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png';
var cartoAttrib = '&copy; ' + osmLink + ' &copy; ' + cartoLink;

//Basemap tiles attribution and URL
var basemapLink = '<a href="basemap.at">Basemap</a>';
var basemapURL = 'https://mapsneu.wien.gv.at/basemap/geolandbasemap/normal/google3857/{z}/{y}/{x}.png';
var basemapGREYURL = 'https://mapsneu.wien.gv.at/basemap/bmapgrau/normal/google3857/{z}/{y}/{x}.png';
var basemapHDPIURL = 'https://mapsneu.wien.gv.at/basemap/bmaphidpi/normal/google3857/{z}/{y}/{x}.jpeg';
var basemapAttrib = '&copy; ' + osmLink + ' &copy; ' + basemapLink;

//Stamen Toner tiles attribution and URL
var stamenURL = 'https://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}.{ext}';
var stamenAttrib = 'Map tiles by <a href="https://stamen.com">Stamen Design</a>, <a href="https://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>';

//Ortho
var orthoURL = 'https://mapsneu.wien.gv.at/wmts/lb/farbe/google3857/{z}/{y}/{x}.jpeg';

//Flaechenwidmungsplan
var flaechenwidmungURL = 'https://mapsneu.wien.gv.at/wmts/flwbplmzk/rot/google3857/{z}/{y}/{x}.jpeg';

//Creation of map tiles
var osmMap = L.tileLayer(osmURL, { attribution: osmAttrib });
var cartoMap = L.tileLayer(cartoURL, { attribution: cartoAttrib });
var baseMap = L.tileLayer(basemapURL, {
    attribution: basemapAttrib,
    subdomains: ['maps', 'maps1', 'maps2', 'maps3', 'maps4'],
    id: 'mapbox.streets'
});
var baseMapGREY = L.tileLayer(basemapGREYURL, {
    attribution: basemapAttrib,
    subdomains: ['maps', 'maps1', 'maps2', 'maps3', 'maps4'],
    id: 'mapbox.streets'
});
var baseMapHDPI = L.tileLayer(basemapHDPIURL, {
    attribution: basemapAttrib,
    subdomains: ['maps', 'maps1', 'maps2', 'maps3', 'maps4'],
    id: 'mapbox.streets'
});
var stamenMap = L.tileLayer(stamenURL, {
    attribution: stamenAttrib,
    subdomains: 'abcd',
    minZoom: 0,
    maxZoom: 20,
    ext: 'png'
});
var orthoMap = L.tileLayer(orthoURL, {
    attribution: osmAttrib,
    subdomains: ['maps', 'maps1', 'maps2', 'maps3', 'maps4'],
    id: 'mapbox.streets'
});
var flaechenwidmung = L.tileLayer(flaechenwidmungURL, {
    attribution: osmAttrib,
    subdomains: ['maps', 'maps1', 'maps2', 'maps3', 'maps4'],
    id: 'mapbox.streets'
});

//Base layers definition and addition
var baseLayers = {
    "OpenStreetMap": osmMap,
    "Carto DarkMatter": cartoMap,
    "Basemap": baseMap,
    "BasemapGREY": baseMapGREY,
    "BasemapHDPI": baseMapHDPI,
    "Land utilisation": flaechenwidmung,
    "Satellite": orthoMap
};