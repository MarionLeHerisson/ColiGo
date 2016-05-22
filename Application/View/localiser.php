<div class="cover-container cover-localiser">
    <div class="inner cover">
        <br><br><br>
        <h2>Localiser le point relais le plus proche de chez vous</h2>
        <br><br><br>
    </div>
</div>

<div class="container">

    <div id="map" style="height: 600px; width: 600px;"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPuG1oh7adZDZ1E_N5_owPxzz5bhtV4FI&callback=initMap&signed_in=true&libraries=places,visualization" async defer></script>
    <!--
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPuG1oh7adZDZ1E_N5_owPxzz5bhtV4FI&signed_in=true&libraries=places&callback=initMap"
            async defer></script>
            -->

    <script type="text/javascript">


        var address = "New Delhi";
        $.ajax({
            url:"http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=false",
            type: "POST",
            success:function(res){
                console.log(res.results[0].geometry.location.lat);
                console.log(res.results[0].geometry.location.lng);
            }
        });

    </script>


    <?php // key = AIzaSyAPuG1oh7adZDZ1E_N5_owPxzz5bhtV4FI ?>