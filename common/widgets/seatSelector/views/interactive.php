<?php
$seats = $this->context->seats;
$location = $this->context->location;
$seatSvg = null;
$document = $location->getDocument('schema_svg');
if (isset($document)) {
    $seatSvg = $document->getFullPath();
}

$itemCssClass = uniqid('seatselector');
?>

    <div class="zoomHolder">
        <?php
        if (isset($seatSvg)) { ?>
            <div class="layerImg" data-elem="pinchzoomer"
                 data-options="adjustHolderSize:true; maxZoom:3; force3D:false; allowMouseWheelZoom:false; allowMouseWheelScroll:true; preloaderUrl:img/preloader.gif">
                <?php echo file_get_contents($seatSvg); ?>
            </div>
        <?php } ?>
    </div>


<?php
$availableSeats = $this->context->availableSeats;
$seatsJson = json_encode($availableSeats, true);

$this->registerJs("
    var seatsJson=JSON.parse('$seatsJson');
    ",
    \yii\web\View::POS_END,
    'seatSelectorSvg'
);
?>