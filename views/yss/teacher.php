<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v0.1');
$this->title='教师风采';
?>

<style type="text/css">
	p{font-size: 12pt;}

    img{padding: 2px;}

    .blueimp-gallery > .description {
      position: absolute;
      top: 40px;
      left: 15px;
      color: #fff;
      display: none;
    }
    .blueimp-gallery-controls > .description {
      display: block;
    }
</style>



<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<!--
<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
-->


<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-use-bootstrap-modal="false" >
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
     <!-- The placeholder for the description label: -->
    <p class="description"></p>

    <a class="prev">‹</a>
    <a class="next">›</a>

    <a class="close">×</a>
    <!--
    <a class="play-pause"></a>
    -->
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-warning next">
                        Next 
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<center>

<div id="links">
    <a href="./swiper/1b.jpg" title="Picture#1" data-gallery="" data-description="This is a description#1">
        <img src="./swiper/1.jpg" alt="Picture#1">
    </a>
   
    <a href="./swiper/2b.jpg" title="Picture#2" data-gallery="" data-description="This is a description#2">
        <img src="./swiper/2.jpg" alt="Picture#2" >
    </a>

    <a href="./swiper/3b.jpg" title="Picture#3" data-gallery="" data-description="This is a description#3">
        <img src="./swiper/3.jpg" alt="Picture#3">
    </a>

    <a href="./swiper/4b.jpg" title="Picture#4" data-gallery="" data-description="This is a description#4">
        <img src="./swiper/4.jpg" alt="Picture#4">
    </a>

    <a href="./swiper/5b.jpg" title="Picture#5" data-gallery="" data-description="This is a description#5">
        <img src="./swiper/5.jpg" alt="Picture#5">
    </a>

    <a href="http://nw.55wh.com/resource/attachment//images/1/2014/12/IB8X6up4lA46yQpi44WapTUaxI8YtA.jpg" title="Picture#6" data-gallery="" data-description="This is a description#6">
        <img src="./swiper/1.jpg" alt="Picture#6">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Picture#7" data-gallery="" data-description="This is a description#7">
        <img src="./swiper/2.jpg" alt="Picture#7">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Picture#8" data-gallery="" data-description="This is a description#8">
        <img src="./swiper/3.jpg" alt="Picture#8">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/4.jpg" alt="Banana">
    </a>
      
    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/5.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/6.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/7.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/8.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/9.jpg" alt="Banana">
    </a>        

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/2.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/3.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/5.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/6.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/7.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/8.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/9.jpg" alt="Banana">
    </a>    

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/9.jpg" alt="Banana">
    </a>        

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/2.jpg" alt="Banana">
    </a>

    <a href="<?php echo Yii::$app->getRequest()->baseUrl.'/images/item/iphone4s-head.jpg'?>" title="Banana" data-gallery="">
        <img src="./swiper/3.jpg" alt="Banana">
    </a>
 
</div>



</center>
<a href="http://wosotech.com/wx/web/index.php?r=yss/teacherz">link to list view style</a>
&nbsp;&nbsp;
<a href="http://wosotech.com/wx/web/index.php?r=yss/reserve">reserve</a>
<br>
<script type="text/javascript">

blueimp.Gallery(
    document.getElementById('links'), {
        onslide: function (index, slide) {
            var text = this.list[index].getAttribute('data-description'),
                node = this.container.find('.description');
            node.empty();
            if (text) {
                node[0].appendChild(document.createTextNode(text));
            }
        }
});

document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event, onslide: function (index, slide) {
            var text = this.list[index].getAttribute('data-description'),
                node = this.container.find('.description');
            node.empty();
            if (text) {
                node[0].appendChild(document.createTextNode(text));
            }
        } },
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};


</script>

<?php
