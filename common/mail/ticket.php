<?php
/* @var $this yii\web\View */
?>

<div style="background-color:#f3f3f3;min-width:600px">
    <table cellpadding="0" width="100%" height="100%" cellspacing="0"
           style="background-color: #f3f3f3;
            min-width: 600px;
            font-family: Arial,serif;
            min-height: 500px;
            vertical-align: top;">
        <tbody>
        <tr>
            <td style="vertical-align:top">
                <div style="height:137px;background-color:#00a652;width:100%"></div>
            </td>
            <td style="vertical-align:top;min-width:600px;width:600px">
                <div style="background-color:#00a551">
                    <table cellpadding="0" style="text-align:center" cellspacing="0" width="100%" height="103">
                        <tbody>
                        <tr>
                            <td style="text-align:center;vertical-align:middle;">
                                <table cellpadding="0" cellspacing="0" style="text-align:center;">
                                    <tbody>
                                    <tr>
                                        <td style="font-size: 28px;color: #fff;">TURKMENTEATRLARY</td>
                                        <td style="">
                                            <div
                                                style="margin: 0px 15px;width:2px;height: 24px;background: #e8fff3;"></div>
                                        </td>
                                        <td style="white-space:nowrap;color: #ffffff;font-size: 17px;">
                                            Petek barada maglumat
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div
                    style="background-color:#fff;padding: 20px 40px 50px 40px;color:#777;line-height:21px;width:600px;font-size:14px;border-top: 7px solid #eecf1f;border-bottom: 4px solid #00a652;">


                    <div>
                        <div style="margin-top: 15px;">

                            <?php
                            $eventModel = $model->event;
                            if (isset($eventModel)) {
                                $eventContent = $eventModel->loadContent();
                            }
                            ?>

                            <table width="100%" style="font-size: 13px;border-collapse: collapse;color: #8a8a8a;">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="padding-bottom: 23px;">
                                        <label
                                            style="font-family: Verdana, Helvetica, sans-serif;"><?= $eventModel->getAttributeLabel('title') . ":" ?></label>
                                        <div
                                            style="font-weight: bold;font-size: 25px;color: #020202;margin-top: 7px;"><?= $eventContent->title ?></div>
                                    </td>
                                    <td style="width: 170px;">
                                        <div
                                            style="font-size: 16px;text-transform: uppercase;font-weight: bolder;margin-bottom: 6px;color: #444;"><?php echo $model->getAttributeLabel('ticket_id') . ":"; ?></div>
                                        <div
                                            style="border: 1px solid #222;font-size: 19px;font-weight: bold;padding: 7px;text-transform: uppercase;margin-bottom: 8px;color: #252525;"><?php echo $model->unique_code; ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 35%;">
                                        <label
                                            style="font-family: Verdana, Helvetica, sans-serif;"><?= $eventModel->getAttributeLabel('event_start_day') . ":" ?></label>
                                        <p style="margin: 0px;font-weight: bold;font-size: 16px;color: #444;"><?= $model->formatDate($eventModel->start_time, 'd.m.Y') ?></p>
                                    </td>
                                    <td>
                                        <label
                                            style="font-family: Verdana, Helvetica, sans-serif;"><?= $eventModel->getAttributeLabel('event_start_hour') . ":" ?></label>
                                        <p style="margin: 0px;font-weight: bold;font-size: 16px;color: #444;"><?= $model->formatDate($eventModel->start_time, 'H:i') ?></p>
                                    </td>
                                    <td rowspan="3">
                                        <div
                                            class="ticker_qr_code"><?php echo \yii\helpers\Html::img($model->getQrCodePath()); ?></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding-top: 20px;">
                                        <?php
                                        $eventSeats = $model->getEventSeatNames();
                                        if (isset($eventSeats)) { ?>
                                            <label
                                                style="font-family: Verdana, Helvetica, sans-serif;"><?= $model->getAttributeLabel('event_to_seats') . ":" ?></label>
                                            <p style="margin: 0px;font-weight: bold;font-size: 16px;color: #444;"><?= implode($eventSeats, ',') ?></p>
                                        <?php } ?>
                                    </td>
                                    <td style="padding-top: 20px;">
                                        <?php
                                        $paymentModel = $model->payment;
                                        if (isset($paymentModel)) {
                                            $total_payment = $paymentModel->amount ? $paymentModel->amount / 100 : 0; ?>
                                            <label
                                                style="font-family: Verdana, Helvetica, sans-serif;"><?= $paymentModel->getAttributeLabel('total_amount') . ":" ?></label>
                                            <p style="margin: 0px;font-weight: bold;font-size: 16px;color: #444;"><?= $total_payment . ' ' . Yii::t('app', 'manat') ?></p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 19px 0px 30px 0px;">
                                        <?php
                                        $locationModel = $model->location;
                                        if (isset($locationModel)) { ?>
                                            <label
                                                style="font-family: Verdana, Helvetica, sans-serif;"><?= $locationModel->getAttributeLabel('title') . ":" ?></label>
                                            <p style="margin: 0px;font-weight: normal;font-size: 15px;color: #2d2c2c;text-transform: uppercase;"><?= $locationModel->fullTitle ?></p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr style="border-top: 1px solid #dddddd;">
                                    <td style="padding: 8px 0px 15px 0px;">
                                        <label
                                            style="font-family: Verdana, Helvetica, sans-serif;"><?= $model->getAttributeLabel('fullname') . ":" ?></label>
                                        <p style="margin: 0px;font-weight: bold;font-size: 16px;color: #444;"><?= $model->getFullName() ?></p>
                                    </td>
                                    <td style="padding: 8px 0px 15px 0px;">
                                        <label
                                            style="font-family: Verdana, Helvetica, sans-serif;"><?= $model->getAttributeLabel('phone') . ":" ?></label>
                                        <p style="margin: 0px;font-weight: bold;font-size: 16px;color: #444;"><?= $model->phone ?></p>
                                    </td>
                                    <td style="padding: 8px 0px 15px 0px;">
                                        <label
                                            style="font-family: Verdana, Helvetica, sans-serif;"><?= $model->getAttributeLabel('email') . ":" ?></label>
                                        <p style="margin: 0px;font-weight: bold;font-size: 16px;color: #444;"><?= $model->email ?></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                            <?php if ($model->status == \common\models\wrappers\TicketWrapper::STATUS_SUCCESS && isset($paymentModel) && isset($paymentModel->status_response_json)) { ?>
                                <?php
                                $payment_status_response = json_decode($paymentModel->status_response_json, true);
                                if (isset($payment_status_response)) { ?>

                                    <div
                                        style="width: 100%;border-bottom: 1px solid #ececec;margin-bottom: 6px;margin-top: 18px;">
                                        <h3 style="font-size: 16px;margin-bottom: 4px;font-weight: normal;color: #444;"><?php echo Yii::t('app', 'Töleg maglumatlary') ?></h3>
                                    </div>

                                    <table width="100%"
                                           style="margin-bottom: 45px; font-size: 13px;text-align: center;">
                                        <thead style="color: #8a8a8a;font-family: Verdana, Helvetica, sans-serif;">
                                        <tr>
                                            <th style="font-weight: normal">№</th>
                                            <th style="font-weight: normal">Töleg nomeri</th>
                                            <th style="font-weight: normal">Möçberi</th>
                                            <th style="font-weight: normal">Maglumatlar</th>
                                            <th style="font-weight: normal">Senesi</th>
                                            <th style="font-weight: normal">Sagady</th>
                                        </tr>
                                        </thead>
                                        <tbody style="color: #444;font-weight: bold;">
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <?php
                                                if (isset($payment_status_response['OrderNumber']))
                                                    echo $payment_status_response['OrderNumber'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($payment_status_response['Amount']))
                                                    echo $payment_status_response['Amount'] / 100;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $infoStr = "";
                                                if (isset($payment_status_response['cardholderName'])) {
                                                    $infoStr = strtoupper($payment_status_response['cardholderName']);
                                                }
                                                if (isset($payment_status_response['Pan'])) {
                                                    $infoStr = $infoStr . " " . $payment_status_response['Pan'];
                                                }

                                                echo $infoStr;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($paymentModel->date_finished))
                                                    echo $paymentModel->formatDate($paymentModel->date_finished, 'd.m.Y');
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($paymentModel->date_finished))
                                                    echo $paymentModel->formatDate($paymentModel->date_finished, 'H:i');
                                                ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                    <div
                        style="width: 100%;padding: 20px 15px;border: 2px solid #404040;display: inline-block;box-sizing: border-box;font-size: 13px;margin-bottom: 30px;line-height: 1.3;color: #313131;">
                        <h3 style="margin: 0px;font-size: 21px;"><?= Yii::t('app', 'Pay Attention') ?></h3>
                        <div>
                            <?= Yii::t('app', 'ticket_attention_text') ?>
                        </div>
                    </div>

                    <div style="width: 100%; display: inline-block; font-size: 13px;">
                        @ <?= \yii\helpers\Html::a('Turkmenteatrlary.gov.tm ', 'https://turkmenteatrlary.gov.tm') ?><?php echo date('Y') . '.' . Yii::t('app', 'All rights reserved') ?>
                    </div>
                </div>
            </td>
            <td style="vertical-align:top">
                <div style="height:137px;background-color:#00a652;width:100%"></div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

