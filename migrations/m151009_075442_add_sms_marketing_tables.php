<?php

use yii\db\Schema;
use yii\db\Migration;

class m151009_075442_add_sms_marketing_tables extends Migration
{
    public function up()
    {
        $this->createTable('sms_marketing_config', [
            'key'      => Schema::TYPE_STRING,
            'value'    => Schema::TYPE_INTEGER,            
        ]);
        $this->createTable('sms_marketing_log', [
            'mobile'            => Schema::TYPE_STRING . ' PRIMARY KEY',
            'first_sendtime'    => Schema::TYPE_INTEGER,
            'last_sendtime'     => Schema::TYPE_INTEGER,
            'send_count'        => Schema::TYPE_INTEGER,
            'member_time'       => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('sms_marketing_config');
        $this->dropTable('sms_marketing_log');

        return true;
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
