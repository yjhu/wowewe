<?php

use yii\db\Schema;
use yii\db\Migration;

class m150601_022617_add_some_columns_to_bind_mobiles extends Migration
{
    public function up()
    {
        $this->addColumn('wx_openid_bind_mobile', 'update_time', Schema::TYPE_TIMESTAMP);
        $this->addColumn('wx_openid_bind_mobile', 'carrier', Schema::TYPE_STRING);
        $this->addColumn('wx_openid_bind_mobile', 'province', Schema::TYPE_STRING);
        $this->addColumn('wx_openid_bind_mobile', 'city', Schema::TYPE_STRING);
    }

    public function down()
    {
        echo "m150601_022617_add_some_columns_to_bind_mobiles cannot be reverted.\n";

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
