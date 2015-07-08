<?php

use yii\db\Schema;
use yii\db\Migration;

class m150708_041922_add_aam_table extends Migration
{
    public function up()
    {
        $this->createTable('unicom_faq', [
            'id'            => Schema::TYPE_PK,
            'question'      => Schema::TYPE_STRING . '(512)',
            'answer'        => Schema::TYPE_TEXT,
            'created_at'    => Schema::TYPE_INTEGER,
            'updated_at'    => Schema::TYPE_INTEGER,
        ]);

    }

    public function down()
    {
        $this->dropTable('unicom_faq');

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
