<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_093212_rename_column_name extends Migration
{
    public function up()
    {
        $this->renameColumn('client_outlet', 'orginal_office_id', 'original_office_id');
    }

    public function down()
    {
        echo "m150525_093212_rename_column_name cannot be reverted.\n";

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
