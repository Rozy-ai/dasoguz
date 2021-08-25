<?php
$seats = $this->context->seats;
$isShowOnlyAvailableSeats = $this->context->isShowOnlyAvailableSeats;
$itemCssClass = uniqid('seatselector');
?>


    <div id="seat-map" class="<?= $itemCssClass ?>">
        <?php
        if (isset($seats)) {
            foreach ($seats as $seatGroupId => $seatRows) {
                $seatGroupModel = \common\models\wrappers\SeatGroupWrapper::find()->where(['id' => $seatGroupId])->one();

                if (isset($seatGroupModel)) { ?>
                    <div class="seat_group">
                        <div class="header">
                            <h3><?= $seatGroupModel->name ?></h3>
                            <i class="fa fa-chevron-down"></i>
                            <i class="fa fa-chevron-up"></i>
                        </div>
                        <div class="seat_group_grid_wrapper" style="display: none">
                            <div class="seat_group_grid">
                                <?php foreach ($seatRows as $rowName => $seatPrices) { ?>
                                    <div class="row">
                                        <?php foreach ($seatPrices as $seatPrice => $seatList) { ?>
                                            <?php if (count($seatList) > 0) { ?>
                                                <div class="col-md-12 event_row">
                                                    <?php echo $rowName . ' ' . Yii::t('app', 'seatLabelX') . ' <span class="event_price">(' . (float)$seatPrice . ' man.)</span>' ?>
                                                </div>

                                                <div class="col-md-12" style="padding-bottom: 15px;">
                                                    <?php foreach ($seatList as $seat) { ?>
                                                        <?php
                                                        $eventToSeat = $seat->eventToSeat;
                                                        $status_btn_css = strtolower($eventToSeat->getStatusText());
                                                        if ((isset($eventToSeat) && $eventToSeat->isSeatAvailable()) || !$isShowOnlyAvailableSeats) { ?>
                                                            <a class="seat-btn <?= $status_btn_css ?>" href="#"
                                                               data-seat_id="<?= $seat->id ?>"
                                                               data-seat_status="<?= $eventToSeat->getStatusText() ?>"
                                                               data-seat_group_name="<?= $seat->seatGroup->name ?>"
                                                               data-seat_label_x="<?= $seat->label_x ?>"
                                                               data-seat_label_y="<?= $seat->label_y ?>"
                                                               data-seat_price="<?= (float)$seatPrice ?>"
                                                               data-seat_name="<?= $seat->name ?>"
                                                            ><?= $seat->label_x ?></a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                                <!--                                            <td width="10%">-->
                                                <!--                                                <div-->
                                                <!--                                                    class="event_price"> --><?php //echo (float)$seatPrice . ' man.' ?><!-- </div>-->
                                                <!--                                            </td>-->
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>


<?php
$availableSeats = $this->context->availableSeats;
$seatsJson = json_encode($availableSeats, true);

$this->registerJs("
    debugger;
    var seatsJson=JSON.parse('$seatsJson');
    ",
    \yii\web\View::POS_END,
    'seatSelectorGrid'
);
?>