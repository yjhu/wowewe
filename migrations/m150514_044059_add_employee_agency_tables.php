<?php

use yii\db\Schema;
use yii\db\Migration;

class m150514_044059_add_employee_agency_tables extends Migration
{
    public function up()
    {
        $this->createTable('client_employee', [
            'id' => Schema::TYPE_PK,
            'gh_id' => Schema::TYPE_STRING,
            'name' => Schema::TYPE_STRING,
            'department' => Schema::TYPE_STRING,
            'position' => Schema::TYPE_STRING,
            'mobile' => Schema::TYPE_STRING,
        ]);
        $this->createTable('client_agency', [
            'id' => Schema::TYPE_PK,
            'gh_id' => Schema::TYPE_STRING,
            'contact_person' => Schema::TYPE_STRING,
            'msc_brev_name' => Schema::TYPE_STRING,
            'title' => Schema::TYPE_STRING,
            'mobile' => Schema::TYPE_STRING,
        ]);
    }

    public function down()
    {
        $this->dropTable('client_employee');
        $this->dropTable('client_agency');

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
