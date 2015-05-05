<?php

use yii\db\Schema;
use yii\db\Migration;

class m150505_101619_add_self_operated_column_to_office_table extends Migration
{
    public function up()
    {
        $this->addColumn('wx_office', 'is_selfOperated', 'tinyint default 0');
    }

    public function down()
    {
        echo "m150505_101619_add_self_operated_column_to_office_table cannot be reverted.\n";

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
