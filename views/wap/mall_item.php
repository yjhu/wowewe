
<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>


<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
	  <?php echo Html::img(Url::to('images/item/'.$model['pic_url'])); ?>
      <div class="caption">
        <h3><?php echo $model['title']; ?></h3>
        <p>原价：￥<?php echo $model['price']; ?></p>
        <p>
		<a href="#" class="btn btn-primary" role="button">Button</a> 
		<a href="#" class="btn btn-default" role="button">Button</a>
		</p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
		<?php echo Html::img(Url::to('images/item/'.$model['pic_url'])); ?>
      <div class="caption">
        <h3><?php echo $model['title']; ?></h3>
        <p>原价：￥<?php echo $model['price']; ?></p>
        <p>
		<a href="#" class="btn btn-primary" role="button">Button</a> 
		<a href="#" class="btn btn-default" role="button">Button</a>
		</p>
      </div>
    </div>
  </div>


</div>

<?php 

/*
<div class="tmall_coupon_view span-5">

	<div class="title">
	<?php 
		echo Html::a($model['title'], $model['url'], array('target'=>'_blank'));
	?>
	</div>

	<div class="price">
		<div class="left">
		<?php echo Html::img(Url::to('images/item/'.$model['pic_url'])); ?>
		</div>

		<div class="left">
		原价：￥<del><?php echo $model['price']; ?></del>
		</div>

		<div class="right">
		<?php //echo sprintf("%.1f",$data->coupon_rate/1000); ?>
		优惠价：￥<?php echo $model['new_price']; ?>
		</div>

		<div class="clear"></div>
	</div>


</div>
<br />

*/
