<?php

use yii\db\Schema;
use yii\db\Migration;

class m151015_093414_add_redpack_log extends Migration
{
    public function up()
    {
        $this->createTable('redpack_log', [
            'gh_id'            => Schema::TYPE_STRING,
            'openid'           => Schema::TYPE_STRING,
            'mobile'           => Schema::TYPE_STRING,
            'amount'           => Schema::TYPE_INTEGER,
            'sendtime'         => Schema::TYPE_INTEGER,
            'category'         => Schema::TYPE_INTEGER . ' DEFAULT 0',
        ]);
    }

    public function down()
    {
        $this->dropTable('redpack_log');
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
