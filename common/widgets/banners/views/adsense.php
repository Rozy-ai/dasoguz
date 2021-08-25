<?php
$outer_css_id = $this->context->outer_css_id;
$outer_css_class = $this->context->outer_css_class;

?>

<!--noindex-->
 <div id="<?php echo $outer_css_id;  ?>" class="adsense <?php echo $outer_css_class; ?>">
     <?php
    if(isset($bannerModel)){
        echo $bannerModel->adsense_code;
    }
?>
</div>
<!--/noindex-->
