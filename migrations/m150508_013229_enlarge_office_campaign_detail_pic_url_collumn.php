<?php

use yii\db\Schema;
use yii\db\Migration;

class m150508_013229_enlarge_office_campaign_detail_pic_url_collumn extends Migration
{
    public function up()
    {
        $this->alterColumn('wx_office_campaign_detail', 'pic_url', 'varchar(1024)');
    }

    public function down()
    {
        echo "m150508_013229_enlarge_office_campaign_detail_pic_url_collumn cannot be reverted.\n";

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
