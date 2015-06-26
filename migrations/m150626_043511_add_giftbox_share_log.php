<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_043511_add_giftbox_share_log extends Migration
{
    public function up()
    {
        $this->createTable('giftbox_sharelog', [
            'id' => Schema::TYPE_PK,
            'giftbox_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'sharer_ghid' => Schema::TYPE_STRING . ' NOT NULL',
            'sharer_openid' => Schema::TYPE_STRING . ' NOT NULL',
            'sharing_to' => Schema::TYPE_STRING,
            'sharing_time' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('giftbox_sharelog');

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
