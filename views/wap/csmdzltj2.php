<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;

    use app\models\MOfficeCampaignDetail;
?>
    


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>襄阳联通</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
  
    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="javascript:history.back();"></a>
      <h1 class="title">
       参赛门店资料提交
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <p class="content-padded">
          <?= $model_office->title ?>
        </p>

       <ul class="table-view">
      <?php foreach($models_categories as $model_category) {  ?>
   
            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['csmdzltj3', 'office_id'=>$model_office->office_id, 'model_category_id'=>$model_category->id],true) ?>">
               
                <?php 
                    $model_office_campaign_detail = MOfficeCampaignDetail::findOne(['pic_category' => $model_category->id, 'office_id' => $model_office->office_id]);

                    if(!empty($model_office_campaign_detail))
                    {
                      $url = $model_office_campaign_detail->getImageUrl();
                    }
                    else
                      $url = 'http://placehold.it/64x64';
                ?>
                <img class="media-object pull-left" src="<?= $url ?>" width="64" height="64">
               
                <div class="media-body">
                  <?= $model_category->name ?>
                  <!--
                  <p>...</p>
                  -->
                </div>
              </a>
            </li>
      <?php } ?>
        </ul>
      

    </div>

      
      
  </body>
</html>