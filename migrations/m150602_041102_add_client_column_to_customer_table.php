<?php

use yii\db\Schema;
use yii\db\Migration;

class m150602_041102_add_client_column_to_customer_table extends Migration
{
    public function up()
    {
        $this->addColumn('wx_custom', 'client_id', 'integer default 1');
    }

    public function down()
    {
        echo "m150602_041102_add_client_column_to_customer_table cannot be reverted.\n";

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
