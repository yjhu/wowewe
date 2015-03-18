<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\FileHelper;

use yii\imagine\Image;

/*
DROP TABLE IF EXISTS wx_photo;
CREATE TABLE IF NOT EXISTS wx_photo (
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    photo_id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(64) NOT NULL DEFAULT '' COMMENT '标题',    
    des VARCHAR(256) NOT NULL DEFAULT '' COMMENT '简介',    
    tags VARCHAR(256) NOT NULL DEFAULT '' COMMENT '标签',    
    pic_url VARCHAR(256) NOT NULL DEFAULT '' COMMENT '照片url',    
	size int(10) unsigned NOT NULL DEFAULT 0 COMMENT '图片大小', 
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

*/

class MPhoto extends \yii\db\ActiveRecord
{
	const PHOTO_PATH = 'photo';
	const THUMB_PATH = 'thumb';	
	
    public static function tableName()
    {
        return 'wx_photo';
    }

    public function rules()
    {
        return [
            [['create_time'], 'safe'],
            [['title'], 'string', 'max' => 64],
            [['des'], 'string', 'max' => 256],
            [['size'], 'integer'],
            [['pic_url','tags'], 'string', 'max' => 256]
        ];
    }

    public function attributeLabels()
    {
        return [
            'photo_id' => Yii::t('app', 'Photo ID'),
            'title' => Yii::t('app', 'Title'),
            'des' => Yii::t('app', 'Des'),
            'tags' => Yii::t('app', 'Tags'),
            'size' => Yii::t('app', 'Size'),
            'pic_url' => Yii::t('app', 'Pic Url'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

	public function afterDelete()
	{
		$file = $this->getPicFile();
		@unlink($file);
		$files = FileHelper::findFiles(Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::PHOTO_PATH . DIRECTORY_SEPARATOR . self::THUMB_PATH, ['only' => [$this->pic_url.'*']]);
		foreach($files as $file) {		
			@unlink($file);
		}		        
        foreach($this->articles as $article) {
            $article->delete();            
        }
		parent::afterDelete();
	}

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->gh_id = Yii::$app->user->gh->gh_id;
            }
            return true;
        }
        return false;
    } 

    public function getArticles()
    {
        return $this->hasMany(MArticle::className(), ['photo_id' => 'photo_id']);
    }

	public function isVedio()
	{
		$ext = pathinfo($this->pic_url, PATHINFO_EXTENSION);
		if (in_array($ext, ['mp4']))
			return true;
		return false;
	}

	public function getPicFile()
	{
		return Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::PHOTO_PATH . DIRECTORY_SEPARATOR . $this->pic_url;
	}

	public function getPicThumbFile($width, $height)
	{
		return Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::PHOTO_PATH . DIRECTORY_SEPARATOR . self::THUMB_PATH . DIRECTORY_SEPARATOR . "{$this->pic_url}_{$width}x{$height}";
	}

	public function getMediaId()
	{
        $wechat = Yii::$app->user->getWechat();	
	    $type = 'image';        
        $arr = $wechat->WxMediaUpload($type, $this->getPicFile());
	    return $arr['media_id'];
	}

	public function getPicUrl($width=null, $height=null)
	{	
		if ($width === null && $height === null) {
			return Yii::$app->request->getHostInfo() . Yii::$app->request->getBaseUrl() . '/'. self::PHOTO_PATH. '/' ."{$this->pic_url}";		
        }
		if ($height === null)
			$height = $width;

		$thumbFilename = $this->getPicThumbFile($width, $height);
        if (!file_exists($thumbFilename)) {			
			$filename = $this->getPicFile();
			Image::thumbnail($filename, $width, $height)->save($thumbFilename, ['format'=>'jpg', 'quality' => 100]);
        }
        return Yii::$app->request->getHostInfo() . Yii::$app->request->getBaseUrl() . '/'. self::PHOTO_PATH . '/' . self::THUMB_PATH . '/'. "{$this->pic_url}_{$width}x{$height}";                
	}
    	
}

/*
	public static function thumbnail($filename, $width, $height)
	{
		Image::thumbnail($filename, $width, $height)->save($filename."_{$width}", ['format'=>'jpg']);									
	}

		public function getPicFile()
		{
			return Yii::getAlias('@storage').$this->pic_url;
		}
	
		public function getPicUrl($width=null, $height=null)
		{
			if ($width === null && $height === null)
				return "@storageUrl/{$this->pic_url}";
			if ($height === null)
				$height = $width;
			return "@storageUrl/{$this->pic_url}_{$width}x{$height}";
		}

	public static function thumbnailAll($filename, $sizes=[[75,75],[900,480]])
	{
		foreach($sizes as $size) {
			$width = $size[0];
			$height = $size[1];			
			Image::thumbnail($filename, $width, $height)->save($filename."_{$width}x{$height}", ['format'=>'jpg', 'quality' => 100]);			
		}
	}

	public function afterDelete()
	{
		$file = $this->getPicFile();

		@unlink($file);
		$sizes = [[75,75],[900,480]];
		foreach($sizes as $size) {
			$width = $size[0];
			$height = $size[1];			
		 	@unlink($file."_{$width}x{$height}");
		}
		$photoOwners = $this->photoOwners;
		foreach($photoOwners as $photoOwner) {
			$photoOwner->delete();
		}
		$this->trigger(self::EVENT_AFTER_DELETE);
	}
		
        public function getUploadPicUrl($filename)
        {
            return Url::to("@storageUrl/uploads/{$filename}", true);
        }
    */

