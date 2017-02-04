
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKWJB82KCsyohqLHqOdncRYh4KNHVllKU"></script>

<script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 11,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(35.760235, 51.440897), // New York

            // How you would like to style the map.
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"all","elementType":"geometry","stylers":[{"color":"#660000"}]},{"featureType":"all","elementType":"labels.text","stylers":[{"color":"#fff8f8"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"gamma":0.01},{"lightness":20},{"color":"#fddfdf"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"saturation":-31},{"lightness":-33},{"weight":2},{"gamma":0.8},{"color":"#0d0000"}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":30},{"saturation":30}]},{"featureType":"poi","elementType":"geometry","stylers":[{"saturation":20}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"lightness":20},{"saturation":-20}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":10},{"saturation":-30}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"saturation":25},{"lightness":25}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"},{"hue":"#ff0000"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"saturation":"-13"},{"invert_lightness":true},{"color":"#fffbfb"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"color":"#ef2929"}]},{"featureType":"water","elementType":"all","stylers":[{"lightness":-20}]}]
        };

        // Get the HTML DOM element that will contain your map
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(35.760235, 51.440897),
            map: map,
            title: 'Snazzy!',
            icon: 'img/pin.png'
        });
    }
    $(document).ready(function () {
        init();
    })
</script>



<div id="map"></div>
<div class="contact-data">
        <div class="c-left">
            <h2>Contact Us</h2>
            <a href="https://www.google.com/maps/dir//4th+St,+Tehran+Province,+Tehran/@35.760194,51.3708867,12z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x3f8e0419f9c1a931:0xfe2cc78d161690f1!2m2!1d51.4409263!2d35.7602143">Unit 10 No.12 .4th Alley Razan St. Madar Sq.Mirdamad blvd, TEHRAN, IRAN.</a>

            <a href="tel:+98(21)26410305">Phone : +98(21)26410305-7</a>
            <a href="tel:+98(21)26410308">Fax : +98(21)26410308</a>
            <a href="#">Postalcode: 1911926476</a>

            <a href="mailto:info@banamid.org">info@banamid.org</a>
            <h4>Social Networks</h4>
            <div class="socials">
                <a href="http://www.instagram.com/meshoffice"><i class="a-w-d fa fa-facebook-square"></i></a>
                <a href="http://www.facebook.com/meshoffice"><i class="a-w-d fa fa-instagram"></i></a>
                <a href="http://www.linkedin.com/meshoffice"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>

            </div>
        </div>
    <div class="c-right">
        <h4>General Inquiries</h4>
        <a href="mailto:info@meshoffice.org">info@meshoffice.org</a>
        <h4>We are continuously looking for new staaf. For those interested in applying, please submit your portfolio & cv to</h4>
        <a href="mailto:job@meshoffice.org">job@meshoffice.org</a>
        <h4>For press material, please send an email to</h4>
        <a href="mailto:pr@meshoffice.org"> pr@meshoffice.org</a>

    </div>

</div>
<a href="http://www.dokmeh-studio.com" class="dokmeh">© Copyright 2017. All Rights Reserved. ِDesign by <img src="http://dokmeh-studio.com/img/Dokmeh-logo.svg" style="width:100px"></a>
