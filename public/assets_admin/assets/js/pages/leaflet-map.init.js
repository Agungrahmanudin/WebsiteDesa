/*
Template Name: StarCode & Dashboard Template
Author: StarCode Kh
Website: https://StarCode Kh.in/
Contact: StarCode Kh@gmail.com
File: Leaflet init js
*/

// =====================================================
// LEAFLET MAP
// Menggunakan OpenStreetMap, tidak membutuhkan Mapbox Token
// =====================================================

// leaflet-map
var mymap = L.map('leaflet-map').setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(mymap);


// =====================================================
// LEAFLET MAP MARKER
// =====================================================

var markermap = L.map('leaflet-map-marker').setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(markermap);

var mapPinIcon = L.icon({
    iconUrl: 'assets/images/map-pin.png',
});

L.marker([51.5, -0.09], {
    icon: mapPinIcon
}).addTo(markermap);

L.circle([51.508, -0.11], {
    color: '#0ab39c',
    fillColor: '#0ab39c',
    fillOpacity: 0.5,
    radius: 500
}).addTo(markermap);

L.polygon([
    [51.509, -0.08],
    [51.503, -0.06],
    [51.51, -0.047]
], {
    color: '#405189',
    fillColor: '#405189',
}).addTo(markermap);


// =====================================================
// WORKING WITH POPUPS
// =====================================================

var popupmap = L.map('leaflet-map-popup').setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(popupmap);

var mapPinIconPopup = L.icon({
    iconUrl: 'assets/images/map-pin.png',
});

L.marker([51.5, -0.09], {
    icon: mapPinIconPopup
}).addTo(popupmap)
    .bindPopup("<b>Hello world!</b><br />I am a popup.")
    .openPopup();

L.circle([51.508, -0.11], 500, {
    color: '#f06548',
    fillColor: '#f06548',
    fillOpacity: 0.5
}).addTo(popupmap)
    .bindPopup("I am a circle.");

L.polygon([
    [51.509, -0.08],
    [51.503, -0.06],
    [51.51, -0.047]
], {
    color: '#405189',
    fillColor: '#405189',
}).addTo(popupmap)
    .bindPopup("I am a polygon.");

var popup = L.popup();


// =====================================================
// LEAFLET MAP CUSTOM ICONS
// =====================================================

var customiconsmap = L.map('leaflet-map-custom-icons').setView([51.5, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(customiconsmap);

var LeafIcon = L.Icon.extend({
    options: {
        iconSize: [45, 45],
        iconAnchor: [22, 94],
        popupAnchor: [-3, -76]
    }
});

var greenIcon = new LeafIcon({
    iconUrl: 'assets/images/logo-sm.png'
});

L.marker([51.5, -0.09], {
    icon: greenIcon
}).addTo(customiconsmap);


// =====================================================
// INTERACTIVE CHOROPLETH MAP
// =====================================================

var interactivemap = L.map('leaflet-map-interactive-map').setView([37.8, -96], 4);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(interactivemap);


// get color depending on population density value
function getColor(d) {
    return d > 1000 ? '#405189' :
        d > 500 ? '#516194' :
            d > 200 ? '#63719E' :
                d > 100 ? '#7480A9' :
                    d > 50 ? '#8590B4' :
                        d > 20 ? '#97A0BF' :
                            d > 10 ? '#A8B0C9' :
                                '#A8B0C9';
}

function style(feature) {
    return {
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7,
        fillColor: getColor(feature.properties.density)
    };
}

var geojson = L.geoJson(statesData, {
    style: style,
}).addTo(interactivemap);


// =====================================================
// LEAFLET MAP GROUP CONTROL
// =====================================================

var cities = L.layerGroup();

var mapPinIconCities = L.icon({
    iconUrl: 'assets/images/map-pin.png',
});

L.marker([39.61, -105.02], {
    icon: mapPinIconCities
}).bindPopup('This is Littleton, CO.').addTo(cities);

L.marker([39.74, -104.99], {
    icon: mapPinIconCities
}).bindPopup('This is Denver, CO.').addTo(cities);

L.marker([39.73, -104.8], {
    icon: mapPinIconCities
}).bindPopup('This is Aurora, CO.').addTo(cities);

L.marker([39.77, -105.23], {
    icon: mapPinIconCities
}).bindPopup('This is Golden, CO.').addTo(cities);


// =====================================================
// BASE LAYERS
// OpenStreetMap digunakan untuk semua layer
// =====================================================

var osmUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

var osmAttribution =
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

var grayscale = L.tileLayer(osmUrl, {
    maxZoom: 19,
    attribution: osmAttribution
});

var streets = L.tileLayer(osmUrl, {
    maxZoom: 19,
    attribution: osmAttribution
});


// =====================================================
// GROUP CONTROL MAP
// =====================================================

var layergroupcontrolmap = L.map('leaflet-map-group-control', {
    center: [39.73, -104.99],
    zoom: 10,
    layers: [streets, cities]
});

var baseLayers = {
    "OpenStreetMap": streets,
    "Map": grayscale
};

var overlays = {
    "Cities": cities
};

L.control.layers(baseLayers, overlays).addTo(layergroupcontrolmap);