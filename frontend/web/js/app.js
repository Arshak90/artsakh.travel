/**
 *  @author Gevorg Avetisyan
 */

/**
 * menu is dropdown on hover
 */
$('.dropdown').hover(
    function () {
        $(this).addClass('open')
    },
    function () {
        $(this).removeClass('open');
    }
);
if (document.getElementById('latitudeId') !== null && document.getElementById('longitudeId') !== null) {
    var latitude = document.getElementById('latitudeId').value === "" ? 39.8152777778 : document.getElementById('latitudeId').value;
    var longitude = document.getElementById('longitudeId').value === "" ? 46.7519444444 : document.getElementById('longitudeId').value;
}

window.onscroll = function(e){
if (window.innerWidth > 767 && window.pageYOffset > 0) {
    $(".bottom-header").css("transform", "translateY(-30px)")
} else if (window.innerWidth > 767) {
    $(".bottom-header").css("transform", "translateY(0px)")
}
}

var init = function () {
    var mapOptions = {
        zoom: 16,

        center: new google.maps.LatLng(latitude, longitude),

        // How you would like to style the map.
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]
        }, {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#ffffff"}, {"lightness": 17}]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]
        }, {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [{"color": "#ffffff"}, {"lightness": 18}]
        }, {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [{"color": "#ffffff"}, {"lightness": 16}]
        }, {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]
        }, {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [{"color": "#dedede"}, {"lightness": 21}]
        }, {
            "elementType": "labels.text.stroke",
            "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]
        }, {
            "elementType": "labels.text.fill",
            "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]
        }, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]
        }, {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#fefefe"}, {"lightness": 20}]
        }, {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]
        }]
    };
    var mapElement = document.getElementById('map');

    var map = new google.maps.Map(mapElement, mapOptions);
    if(document.getElementById('latitudeId').value !== "" && document.getElementById('longitudeId') !== ""){
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            map: map,
            title: 'Artsakh.travel'
        });
    }

}

var selectedBlock = "";
var selectedIcon = "";
$( ".hover-class" ).click(
    function() {
        if(selectedBlock){
            $(selectedBlock).css("display", "none");
        }
        if(selectedIcon){
            selectedIcon.removeClass("active");
        }
        selectedBlock = $("[id^='"+$(this).attr("title")+"'");
        selectedIcon = $(this);
        selectedBlock.css("display", "block");
        selectedIcon.addClass("active");
    }
);