<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unicom_faq".
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 */
class UnicomFaq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unicom_faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer'], 'string'],
            [['question'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => '问题',
            'answer' => '回答',
        ];
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        $xs_unicom = new \XS('unicom');
        $xs_index = $xs_unicom->index;
        $xs_data = array (
            'id' => $this->id,
            'question' => $this->question,
            'answer' => $this->answer,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        );
        $xs_doc = new \XSDocument;
        $xs_doc->setFields($xs_data);
        if ($insert) {
            $xs_index->add($xs_doc);
        } else {
            $xs_index->update($xs_doc);
        }
    }
    
    public function afterDelete() {
        parent::afterDelete();
        $xs_unicom = new \XS('unicom');
        $xs_index = $xs_unicom->index;
        $xs_index->del($this->id);
    }
}
