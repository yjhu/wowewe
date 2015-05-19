<?php

use yii\db\Schema;
use yii\db\Migration;

class m150519_084751_add_office_campaign_score_comment_collumn extends Migration
{
    public function up()
    {
        $this->addColumn('wx_office_campaign_score', 'comment', 'varchar(1024)');
    }

    public function down()
    {
        echo "m150519_084751_add_office_campaign_score_comment_collumn cannot be reverted.\n";

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
