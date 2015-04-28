<?php

use yii\db\Schema;
use yii\db\Migration;

class m150428_090746_insert_office_campaign_pic_categories extends Migration
{
    public function up()
    {
        $this->addColumn('wx_office_campaign_pic_category', 'sort_order', Schema::TYPE_SMALLINT);
        $this->insert('wx_office_campaign_pic_category', [
            'name' => '厅外整体形象',
            'sort_order' => 1,
        ]);
        $this->insert('wx_office_campaign_pic_category', [
            'name' => '厅内海报宣传',
            'sort_order' => 2,
        ]);
        $this->insert('wx_office_campaign_pic_category', [
            'name' => '业务受理台席/柜台',
            'sort_order' => 3,
        ]);
        $this->insert('wx_office_campaign_pic_category', [
            'name' => '4G终端销售柜台',
            'sort_order' => 4,
        ]);
        $this->insert('wx_office_campaign_pic_category', [
            'name' => '宣传架及宣传单摆放',
            'sort_order' => 5,
        ]);
        $this->insert('wx_office_campaign_pic_category', [
            'name' => '其它',
            'sort_order' => 6,
        ]);
    }

    public function down()
    {
        echo "m150428_090746_insert_office_campaign_pic_categories cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
