<?php

    $date = New DateTime();

?>
<div style="background: #f6f5f4">
    <center>
        <table style="max-width: 660px">
            <tr bgcolor="ffffff">
                <td style="padding:40px 50px;" width="660">
                    <table style="width: 100%;font-size: 16px;" >
                        <tr>
                            <td >
                                <span style="font-weight: 600;font-size: 18px;"><span style="color: #fdab01">//</span><span >özişim</span><span style="color: #fdab01">.com</span></span> <?=$date->format('d.m.Y')?> seneli poçta
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="height: 1px;border-bottom: 2px solid #3e3e3e;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 style="margin: 2% 0 0 0;">
                                    <a href="http://ozisim.com/item/<?=$item->id?>" target="_blank" style="color: #000"><?=$item->title?></a>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img style="width: 300px;" src="<?=$item->getThumbPath()?>" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                    <p style="margin: 0 0;"><?=yii::$app->controller->truncateBySentence($item->description, 5)?> <a href="http://ozisim.com/item/<?=$item->id?>" target="_blank" style="font-size: 15px;">...>>></a></p>
                            </td>
                        </tr>
                        <tr style="">
                            <td style="padding: 2px 0;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <p style="width: 60%; margin: 0 auto;text-align: center;font-size: 13px;">
                                    Bu elektron haty Siz özişim.com poçtasyna ýazylanyňyz üçin aldyňyz. Bizi okaýandygyňyz üçin Size minnetdarlygymyzy bildirýäris!
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: center;">
                                    <a href="http://ozisim.com" style="color: #000;text-decoration: none;">
                                        <span style="font-size: 13px;">&copy;</span> <span style="font-size: 13px; font-weight: 600"><span style="color:#000;">özişim</span><span style="color: #fdab01">.com</span></span>
                                    </a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</div>