<?php

use yii\db\Schema;
use yii\db\Migration;

class m150503_070325_add_some_index_for_office_campaign extends Migration
{
    public function up()
    {
        $this->createIndex('idx_office_pic_category', 'wx_office_campaign_detail', ['office_id', 'pic_category']);
        $this->createIndex('idx_office_category_staff', 'wx_office_campaign_score', ['office_campaign_id', 'staff_id']);
    }

    public function down()
    {
        echo "m150503_070325_add_some_index_for_office_campaign cannot be reverted.\n";

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
