<?php

use yii\db\Schema;
use yii\db\Migration;

class m150522_085536_alter_outlet_collumn_name extends Migration
{
    public function up()
    {
        $this->renameColumn('client_outlet', 'supervison_organization_id', 'supervision_organization_id');
    }

    public function down()
    {
        echo "m150522_085536_alter_outlet_collumn_name cannot be reverted.\n";

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
