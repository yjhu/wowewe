<?php

use yii\db\Schema;
use yii\db\Migration;

class m150604_024901_add_wechat_message_tables extends Migration
{
    public function up()
    {
        $this->createTable('wechat_message', [
            'message_id'    => 'pk',
            'sender_id'     => 'integer unsigned',
            'reciever_id'   => 'integer unsigned',
            'content_id'    => 'integer unsigned',
            'send_time'     => 'timestamp',
            'recieve_time'  => 'timestamp',
        ]);
        $this->createTable('wechat_message_content', [
            'content_id'    => 'pk',
            'content_type'  => 'tinyint',
            'content'       => 'varchar(1024)',
        ]);

    }

    public function down()
    {
        echo "m150604_024901_add_wechat_message_tables cannot be reverted.\n";

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
