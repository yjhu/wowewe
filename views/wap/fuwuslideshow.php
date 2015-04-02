<?php
	use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\MItem;

    use app\models\U;
?>


<style>

html {
  height: 100%;
}
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 13px;
  line-height: 1.5;
  position: relative;
  height: 100%;
}

.swiper-container, .swiper-slide {
  width: 100%;
  height: 100%;
  color: #fff;
  text-align: center;
}

.swiper-slide .title {
  font-style: italic;
  font-size: 42px;
  margin-top: 80px;
  margin-bottom: 0;
  line-height: 45px;
}

.pagination {
  position: absolute;
  z-index: 20;
  left: 10px;
  bottom: 10px;
}
.swiper-pagination-switch {
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 8px;
  background: #ccc;
  margin-right: 5px;
  opacity: 0.8;
  border: 1px solid #ccc;
  cursor: pointer;
}
.swiper-visible-switch {
  background: #fff;
}
.swiper-active-switch {
  background: #ff4c01;
}
</style>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu1.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu2.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu3.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu4.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu5.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu6.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu7.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu8.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu9.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu10.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu11.jpg?v1" alt=""/>
        </div>
        <div class="swiper-slide">
        <img id='transparent' width="100%" src="./images/fuwu/fuwu12.jpg?v1" alt=""/>
        </div>                             
    </div>
    <div class="pagination"></div>
</div>

<script>
      var mySwiper = new Swiper('.swiper-container',{
        pagination: '.pagination',
        paginationClickable: true,
        slidesPerView: 1,
        autoplay: 5000,
        loop: true
      })
</script>

<?php
/*

*/
?>
