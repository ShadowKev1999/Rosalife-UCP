@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Karte</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Karte</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div id="map"></div>
@endsection

@section('custom-header-scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    #map {
        height: 712px;
        z-index: 1;
        background: url(images/map/tiles/water.png) repeat;
    }
</style>
@endsection

@section('custom-footer-scripts')
<script>
    var houses = {{ Js::from($houses) }};
    var stores = {{ Js::from($stores) }};
    var fuelstations = {{ Js::from($fuelstations) }};
    var ammunations = {{ Js::from($ammunations) }};
</script>
<script>
    var mapExtent = [1022.5, 1022.5,1022.5,1022.5];
    var mapMinZoom = 0;
    var mapMaxZoom = 3;
    var mapMaxResolution = 1;
    var mapMinResolution = Math.pow(2, mapMaxZoom) * mapMaxResolution;
    var tileExtent = [0,0,0,0];
    var crs = L.CRS.Simple;
    crs.transformation = new L.Transformation(1, 0, 1, 0);
    crs.scale = function(zoom) {
        return Math.pow(2, zoom) / mapMinResolution;
    };
    crs.zoom = function(scale) {
        return Math.log(scale * mapMinResolution) / Math.LN2;
    };

    var layer;

    var map = new L.Map('map', {
        maxZoom: mapMaxZoom,
        minZoom: mapMinZoom,
        crs: crs
    });

    layer = L.tileLayer('images/map/tiles/sat.{z}.{x}.{y}.png', {
        minZoom: mapMinZoom, maxZoom: mapMaxZoom,
        attribution: 'Charles Blackwood',
        noWrap: true,
        tms: false
    }).addTo(map);

    function mirrorNumbers(min, max, num) {
        j = (max - num) - (num - min);
        return num + j;
    }

    var houseIcon = L.icon({
        iconUrl: 'images/map/icons/house.gif',

        iconSize:     [24, 24], // size of the icon
        iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
        popupAnchor:  [-2, -10] // point from which the popup should open relative to the iconAnchor
    });

    var ammuIcon = L.icon({
        iconUrl: 'images/map/icons/ammu.gif',

        iconSize:     [24, 24], // size of the icon
        iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
        popupAnchor:  [-2, -10] // point from which the popup should open relative to the iconAnchor
    });

    var storeIcon = L.icon({
        iconUrl: 'images/map/icons/store.gif',

        iconSize:     [24, 24], // size of the icon
        iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
        popupAnchor:  [-2, -10] // point from which the popup should open relative to the iconAnchor
    });

    var fuelIcon = L.icon({
        iconUrl: 'images/map/icons/Fuelstation.gif',

        iconSize:     [24, 24], // size of the icon
        iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
        popupAnchor:  [-2, -10] // point from which the popup should open relative to the iconAnchor
    });

    function addHouseToMap(x, y, a) {
        const mapSideLength = 2045.0;
        const topLeftX = -2990.0;
        const topLeftY = 3000.0;

        x = mirrorNumbers(0.0, mapSideLength, (x / topLeftX) * mapSideLength ) / 2.0;
        y = mirrorNumbers(0.0, mapSideLength, (y / topLeftY) * mapSideLength ) / 2.0;

        L.marker([y, x], {icon: houseIcon}).addTo(map).bindPopup(a).openPopup();
    }

    function addStoreToMap(x, y, a) {
        const mapSideLength = 2045.0;
        const topLeftX = -2990.0;
        const topLeftY = 3000.0;

        x = mirrorNumbers(0.0, mapSideLength, (x / topLeftX) * mapSideLength ) / 2.0;
        y = mirrorNumbers(0.0, mapSideLength, (y / topLeftY) * mapSideLength ) / 2.0;

        L.marker([y, x], {icon: storeIcon}).addTo(map).bindPopup(a).openPopup();
    }

    function addFuelstationToMap(x, y, a) {
        const mapSideLength = 2045.0;
        const topLeftX = -2990.0;
        const topLeftY = 3000.0;

        x = mirrorNumbers(0.0, mapSideLength, (x / topLeftX) * mapSideLength ) / 2.0;
        y = mirrorNumbers(0.0, mapSideLength, (y / topLeftY) * mapSideLength ) / 2.0;

        L.marker([y, x], {icon: fuelIcon}).addTo(map).bindPopup(a).openPopup();
    }

    function addAmmuToMap(x, y, a) {
        const mapSideLength = 2045.0;
        const topLeftX = -2990.0;
        const topLeftY = 3000.0;

        x = mirrorNumbers(0.0, mapSideLength, (x / topLeftX) * mapSideLength ) / 2.0;
        y = mirrorNumbers(0.0, mapSideLength, (y / topLeftY) * mapSideLength ) / 2.0;

        L.marker([y, x], {icon: ammuIcon}).addTo(map).bindPopup(a).openPopup();
    }

    //addHouseToMap(0, 0, "TEST NULL PUNKT");

    houses.forEach(function(obj) { 
        addHouseToMap(obj.Pos_X, obj.Pos_Y, 'HausID: ' + obj.ID);
    });

    stores.forEach(function(obj) { 
        addStoreToMap(obj.Pos_X, obj.Pos_Y, 'StoreID: ' + obj.ID);
    });

    fuelstations.forEach(function(obj) { 
        addFuelstationToMap(obj.EPos_X, obj.EPos_Y, 'TankstellenID: ' + obj.ID);
    });

    ammunations.forEach(function(obj) {
        addAmmuToMap(obj.Pos_X, obj.Pos_Y, 'AmmuID: ' + obj.ID);
    })

    map.fitBounds([
        crs.unproject(L.point(mapExtent[2], mapExtent[3])),
        crs.unproject(L.point(mapExtent[0], mapExtent[1]))
    ]);
</script>
@endsection