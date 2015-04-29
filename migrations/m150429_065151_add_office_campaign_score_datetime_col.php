<?php

use yii\db\Schema;
use yii\db\Migration;

class m150429_065151_add_office_campaign_score_datetime_col extends Migration
{
    public function up()
    {
        $this->addColumn('wx_office_campaign_score', 'created_time', Schema::TYPE_DATETIME);
    }

    public function down()
    {
        echo "m150429_065151_add_office_campaign_score_datetime_col cannot be reverted.\n";

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
