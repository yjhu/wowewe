<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_060347_add_2_column_to_outlets extends Migration
{
    public function up()
    {
        $this->addColumn('client_outlet', 'pics', 'varchar(1024)');
        $this->addColumn('client_outlet', 'orginal_office_id', 'integer');
    }

    public function down()
    {
        echo "m150525_060347_add_2_column_to_outlets cannot be reverted.\n";

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
