<?php
$cssId = $this->context->cssId;
$height = $this->context->height;
if ($height <= 0)
    $height = 400;
?>
<div id="<?= $cssId ?>" style="height: <?= $height ?>px;"></div>

<?php
$this->registerJs('
    var mymap = L.map("' . $cssId . '").setView([' . $this->context->lat . ', ' . $this->context->lng . '], ' . $this->context->zoom . ');
    var marker = L.marker([' . $this->context->lat . ', ' . $this->context->lng . ']).addTo(mymap);
    $("#' . $height = $this->context->latId . '").val(' . $this->context->lat . ');
    $("#' . $height = $this->context->lngId . '").val(' . $this->context->lng . ');
     
    L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
      attribution: "OpenStreetMap contributors"
    }).addTo(mymap);
    
    function onMapClick(e) {
        marker.setLatLng(e.latlng);
        console.log(e.latlng.lat);
        $("#' . $height = $this->context->latId . '").val(e.latlng.lat);
        $("#' . $height = $this->context->lngId . '").val(e.latlng.lng);
    }
    
    mymap.on("click", onMapClick);
    
  ', \yii\web\View::POS_END, 'leaflet_map');
?>
