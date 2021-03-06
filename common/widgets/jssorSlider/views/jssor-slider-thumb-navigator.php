<div>
    <div id="slider1_container" style="position: relative; width: <?= $this->context->width ?>px;
        height: <?= $this->context->height ?>px; overflow: hidden;">

        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin"
             style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;"
                 src="../svg/loading/static-svg/spin.svg"/>
        </div>

        <!-- Slides Container -->
        <div data-u="slides"
             style="position: absolute; left: 0px; top: 0px; width: <?= $this->context->width ?>px; height: <?= $this->context->height ?>px;
                 overflow: hidden;">
            <?php
            $sliderItems = $this->context->items;
            foreach ($sliderItems as $item) {
                if (!isset($item['imagePath']))
                    continue;
                ?>

                <div>
                    <img data-u="image" src="<?= $item['imagePath'] ?>" alt=""/>
                    <img data-u="thumb" src="<?= $item['thumbPath'] ?>" alt=""/>
                </div>
            <?php } ?>
        </div>

        <!--#region Thumbnail Navigator Skin Begin -->
        <!-- Help: https://www.jssor.com/development/slider-with-thumbnail-navigator.html -->
        <style>
            /* jssor slider loading skin spin css */
            .jssorl-009-spin img {
                animation-name: jssorl-009-spin;
                animation-duration: 1.6s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }

            @keyframes jssorl-009-spin {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(360deg);
                }
            }

            /* jssor slider thumbnail navigator skin 07 css */
            /*
            .jssort07 .p            (normal)
            .jssort07 .p:hover      (normal mouseover)
            .jssort07 .pav          (active)
            .jssort07 .pav:hover    (active mouseover)
            .jssort07 .pdn          (mousedown)
            */
            .jssort07 {
                position: absolute;
                /* size of thumbnail navigator container */
                width: 800px;
                height: 100px;
            }

            .jssort07 .p {
                position: absolute;
                top: 0;
                left: 0;
                width: 99px;
                height: 66px;
            }

            .jssort07 .i {
                position: absolute;
                top: 0px;
                left: 0px;
                width: 99px;
                height: 66px;
                filter: alpha(opacity=80);
                opacity: .8;
            }

            .jssort07 .p:hover .i, .jssort07 .pav .i {
                filter: alpha(opacity=100);
                opacity: 1;
            }

            .jssort07 .o {
                position: absolute;
                top: 0px;
                left: 0px;
                width: 97px;
                height: 64px;
                border: 1px solid #000;
                box-sizing: content-box;
                transition: border-color .6s;
                -moz-transition: border-color .6s;
                -webkit-transition: border-color .6s;
                -o-transition: border-color .6s;
            }

            .jssort07 .pav .o {
                border-color: #0099ff;
            }

            .jssort07 .p:hover .o {
                border-color: #fff;
                transition: none;
                -moz-transition: none;
                -webkit-transition: none;
                -o-transition: none;
            }

            .jssort07 .p.pdn .o {
                border-color: #0099ff;
            }

            * html .jssort07 .o {
                /* ie quirks mode adjust */
                width /**/: 99px;
                height /**/: 66px;
            }
        </style>

        <!-- thumbnail navigator container -->
        <div data-u="thumbnavigator" class="jssort07"
             style="width: <?= $this->context->width ?>px; height: 100px; left: 0px; bottom: 0px;">
            <!-- Thumbnail Item Skin Begin -->
            <div data-u="slides" style="cursor: default;">
                <div data-u="prototype" class="p">
                    <div data-u="thumbnailtemplate" class="i"></div>
                    <div class="o"></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->

            <!--#region Arrow Navigator Skin Begin -->
            <!-- Help: https://www.jssor.com/development/slider-with-arrow-navigator.html -->
            <style>
                .jssora051 {
                    display: block;
                    position: absolute;
                    cursor: pointer;
                }

                .jssora051 .a {
                    fill: none;
                    stroke: #fff;
                    stroke-width: 360;
                    stroke-miterlimit: 10;
                }

                .jssora051:hover {
                    opacity: .8;
                }

                .jssora051.jssora051dn {
                    opacity: .5;
                }

                .jssora051.jssora051ds {
                    opacity: .3;
                    pointer-events: none;
                }
            </style>
            <div data-u="arrowleft" class="jssora051" style="width:40px;height:40px;top:123px;left:8px;"
                 data-autocenter="2"
                 data-scale="0.75" data-scale-left="0.75">
                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                </svg>
            </div>
            <div data-u="arrowright" class="jssora051" style="width:40px;height:40px;top:123px;right:8px;"
                 data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                </svg>
            </div>
            <!--#endregion Arrow Navigator Skin End -->

        </div>
        <!--#endregion Thumbnail Navigator Skin End -->

    </div>
</div>

<?php
$width = $this->context->width;

$this->registerJs(
    '
    var width="$width";
         $(document).ready(function ($) {
            var options = {
                $FillMode: 2,   
                $AutoPlay: 1,                                    //[Optional] Auto play or not, to enable slideshow, this option must be set to greater than 0. Default value is 0. 0: no auto play, 1: continuously, 2: stop at last slide, 4: stop on click, 8: stop on user navigation (by arrow/bullet/thumbnail/drag/arrow key navigation)
                $Idle: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
//                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)
                $UISearchMode: 0,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $Loop: 1,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, default value is 1
                    $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0

                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $Steps: 6                                       //[Optional] Steps to go for each navigation request, default value is 1
                    }
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            /*#region responsive code begin*/
            //you can remove responsive code if you don\'t want the slider scales while window resizing
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.min(parentWidth, width));
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }

            var MAX_WIDTH = 3000;
            function ScaleSlider2 () {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {
                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                    $(".jssor_caption").each(function(){
                        var captionW=$(".container").outerWidth();
                        var width=(captionW)/expectedWidth;
                        $(this).css({"transform":"scale("+width+")","padding":"0px 15px"});
                    });
                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        });
    ',
    \yii\web\View::POS_READY,
    'my-button-handler'
);
?>
