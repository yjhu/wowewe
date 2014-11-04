<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MItem;

class MItemSearch extends Model
{
    public $title;

    public $cid;

    public $quantity;

    public $old_price;

    public $old_price_hint;

    public $price;

    public $price_hint;

    public $title_hint;

    public $pkg_name;

    public $pkg_name_hint;

    public $pic_url;

    public $detail;
    
    public function rules()
    {
        return [
            [['cid'], 'integer'],            
            [['title'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = MItem::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $this->addCondition($query, 'cid');        
        $this->addCondition($query, 'title', true);
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
