<?php

use yii\db\Schema;
use yii\db\Migration;

class m150625_033508_add_giftbox_stuff extends Migration
{
    public function up()
    {
        $this->createTable('newfan_reward', [
            'id'=> Schema::TYPE_PK,
            'newfan_ghid' => Schema::TYPE_STRING . ' NOT NULL',
            'newfan_openid' => Schema::TYPE_STRING . ' NOT NULL',
            'getting_time' => Schema::TYPE_INTEGER,
        ]);
        
        $this->createTable('newfan_lottery', [
            'id'=> Schema::TYPE_PK,
            'newfan_ghid' => Schema::TYPE_STRING . ' NOT NULL',
            'newfan_openid' => Schema::TYPE_STRING . ' NOT NULL',
            'draw_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'draw_content' => Schema::TYPE_STRING . ' NOT NULL',
            'getting_time' => Schema::TYPE_INTEGER,
        ]);
        
        $this->createTable('giftbox_category', [
            'id'=> Schema::TYPE_PK,
            'content' => Schema::TYPE_STRING,
            'quantity' => Schema::TYPE_INTEGER,
            'remaining' => Schema::TYPE_INTEGER,
        ]);

        $this->createTable('giftbox_claimed', [
            'id' => Schema::TYPE_PK,
            'claimer_ghid' => Schema::TYPE_STRING . ' NOT NULL',
            'claimer_openid' => Schema::TYPE_STRING . ' NOT NULL',
            'claiming_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT,
            'category_id' => Schema::TYPE_INTEGER,
            'getting_time' => Schema::TYPE_INTEGER,
        ]);
        
        $this->createTable('giftbox_helped', [
            'id' => Schema::TYPE_PK,
            'giftbox_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'helper_ghid' => Schema::TYPE_STRING . ' NOT NULL',
            'helper_openid' => Schema::TYPE_STRING . ' NOT NULL',
            'helping_time' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('giftbox_helped');
        $this->dropTable('giftbox_claimed');
        $this->dropTable('giftbox_category');
        $this->dropTable('newfan_reward');
        $this->dropTable('newfan_lottery');
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
