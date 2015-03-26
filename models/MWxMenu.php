<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

use app\models\U;
use app\models\MGh;

use app\models\ButtonClick;
use app\models\ButtonView;
use app\models\ButtonLocationSelect;
use app\models\ButtonComplex;

use app\models\WxMenu;
use app\models\Wechat;

/*
DROP TABLE IF EXISTS wx_menu;
CREATE TABLE IF NOT EXISTS wx_menu (
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    wx_menu_id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL DEFAULT '',
    type VARCHAR(64) NOT NULL DEFAULT '',
    keyword VARCHAR(128) NOT NULL DEFAULT '',
    url VARCHAR(256) NOT NULL DEFAULT '',
    parent_id int(10) unsigned NOT NULL DEFAULT 0,
    is_sub_button tinyint(3) unsigned NOT NULL DEFAULT 0,
    sort_order int(10) unsigned DEFAULT 0,
    KEY idx_gh_id(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
*/

class MWxMenu extends \yii\db\ActiveRecord
{
	const WX_MENU_TYPE_CLICK = 'click';
	const WX_MENU_TYPE_VIEW = 'view';
	const WX_MENU_TYPE_LOCATION_SELECT = 'location_select';

    const WX_MENU_SORT_ORDER_FROM = 10;
	const WX_MENU_SORT_ORDER_STEP = 10;

    public static function tableName()
    {
        return 'wx_menu';
    }

    public function rules()
    {
        return [
            
			[['parent_id', 'sort_order', 'is_sub_button'], 'integer'],
			[['gh_id'], 'string', 'max' => 32],
			[['name', 'type'], 'string', 'max' => 64],
			[['keyword'], 'string', 'max' => 128],
			[['url'], 'string', 'max' => 512]
		];
    }

    public function attributeLabels()
    {
        return [
            'gh_id' => Yii::t('backend', 'Gh ID'),
			'wx_menu_id' => Yii::t('backend', 'Wx Menu ID'),
			'name' => Yii::t('backend', 'Title'),
			'type' => Yii::t('backend', 'Type'),
			'keyword' => Yii::t('backend', 'Keyword'),
			'url' => Yii::t('backend', 'Url'),
			'parent_id' => Yii::t('backend', 'Parent ID'),
			'sort_order' => Yii::t('backend', 'Sort Order'),
		];
    }

	public static function getMenuTypeOptionName($key=null)
	{
		$arr = array(
			self::WX_MENU_TYPE_CLICK => '点击事件',
			self::WX_MENU_TYPE_VIEW => '直接跳转',
			self::WX_MENU_TYPE_LOCATION_SELECT => '发送位置',						
		);		  
		return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
	}

    public static function getSubButtonOptionName($key=null)
    {
        $arr = array(
            '1' => '目录菜单',
            '0' => '叶子菜单',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    public function getButton()
    {
	    if ($this->is_sub_button) {
			throw new NotFoundHttpException('Just sub model has button.');			
	    } elseif ($this->type == self::WX_MENU_TYPE_VIEW) {
			return new ButtonView($this->name, $this->url);
        } elseif ($this->type == self::WX_MENU_TYPE_LOCATION_SELECT) {
            return new ButtonLocationSelect($this->name, $this->keyword);            
		} else {
			return new ButtonClick($this->name, $this->keyword);
		}    
    }

    public function afterDelete()
    {
        $models = MWxMenu::find()->where(['parent_id'=>$this->wx_menu_id])->all();
        foreach($models as $model) {
            $model->delete();
        }
    }

    public static function getSubModels($gh_id, $parent_id=0)
    {
		$models = MWxMenu::find()->where(['gh_id'=>$gh_id, 'parent_id'=>$parent_id])->orderBy(['sort_order'=>SORT_ASC])->all();
		return $models;
    }
	
    public static function importFromWechat($gh_id)
    {
		$n = MWxMenu::deleteAll('gh_id=:gh_id', array(':gh_id'=>$gh_id));
        Yii::$app->wx->setGhId($gh_id);
        $arr = Yii::$app->wx->WxMenuGet();

        $buttons = $arr['menu']['button'];
        $sort_order = self::WX_MENU_SORT_ORDER_FROM;
        foreach($buttons as $button) {
            if (!empty($button['sub_button'])) {
                $model = new MWxMenu();
                $model->gh_id = $gh_id;
                $model->name = $button['name'];
                $model->parent_id = 0;
                $model->sort_order = $sort_order;
                $sort_order += self::WX_MENU_SORT_ORDER_STEP;
                $model->is_sub_button = 1;
                if ($model->save()) {
                    $sub_buttons = $button['sub_button'];
                    foreach($sub_buttons as $sub_button) {
                        $subModel = new MWxMenu();
                        $subModel->gh_id = $gh_id;
                        $subModel->name = $sub_button['name'];
                        $subModel->type = $sub_button['type'];
                        $subModel->keyword = empty($sub_button['key']) ? '' : $sub_button['key'];
                        $subModel->url = empty($sub_button['url']) ? '' : $sub_button['url'];
                        $subModel->parent_id = $model->wx_menu_id;
                        $subModel->sort_order = $sort_order;
                        $sort_order += self::WX_MENU_SORT_ORDER_STEP;
                        if (!$subModel->save()) {
							U::W('save sub button err');
                        }
                    }
                } else {
					U::W('save button err');
                }
            } else {
                $model = new MWxMenu();
                $model->gh_id = $gh_id;
                $model->name = $button['name'];
                $model->type = $button['type'];
                $model->keyword = empty($button['key']) ? '' : $button['key'];
                $model->url = empty($button['url']) ? '' : $button['url'];
                $model->parent_id = 0;
                $model->is_sub_button = 0;
                $model->sort_order = $sort_order;
                $sort_order += self::WX_MENU_SORT_ORDER_STEP;
                $model->save();
            }
        }

    }

	public static function getButtonsFromDb($gh_id)
	{
		$models = MWxMenu::getSubModels($gh_id);
		$buttons = [];
		foreach ($models as $model) {
			if ($model->is_sub_button) {
				$subModels = MWxMenu::getSubModels($gh_id, $model->wx_menu_id);
				$subButtons = [];				
				foreach ($subModels as $subModel) {
					$subButtons[] = $subModel->getButton();
				}
				$buttons[] = new ButtonComplex($model->name, $subButtons);
			} else {
				$buttons[] = $model->getButton();
			}
		}
		return $buttons;

	}

	public static function exportToWechat($gh_id)
	{
		Yii::$app->wx->setGhId($gh_id);	
		$buttons = static::getButtonsFromDb($gh_id);
		if (empty($buttons)) {
			return false;
		}			
		$menu = new WxMenu($buttons);		
        $menu_json = Wechat::json_encode($menu);
        U::W([$menu, $menu_json]);
        try {
            $arr = Yii::$app->wx->WxMenuCreate($menu);
        }
        catch(\Exception $e) {
            return false;
        }
        U::W($arr);
        return true;
	}

    public static function getMaxSortOrder($gh_id)
    {
        $model = MWxMenu::find()->where(['gh_id'=>$gh_id])->orderBy(['sort_order'=>SORT_DESC])->one();
        return empty($model->sort_order) ? 0 : $model->sort_order;
    }

    public static function getNextSortOrder($gh_id)
    {
        return self::WX_MENU_SORT_ORDER_STEP + static::getMaxSortOrder($gh_id);
    }

}


