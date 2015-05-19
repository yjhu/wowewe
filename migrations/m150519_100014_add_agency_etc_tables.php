<?php

use yii\db\Schema;
use yii\db\Migration;

class m150519_100014_add_agency_etc_tables extends Migration
{
    public function up()
    {
        $this->renameTable('client_agency', 'client_agent');
        $this->renameColumn('client_agent', 'id', 'agent_id');
        $this->renameColumn('client_agent', 'contact_person', 'name');
        $this->dropColumn('client_agent', 'gh_id');
        $this->dropColumn('client_agent', 'title');
        $this->dropColumn('client_agent', 'mobile');
        $this->dropColumn('client_agent', 'msc_brev_name');
        
        $this->createTable('client_agent_mobile', [
            'agent_id'  => Schema::TYPE_INTEGER,
            'mobile'    => Schema::TYPE_STRING,
        ]);
        
        $this->createTable('client_outlet', [
            'outlet_id'     => Schema::TYPE_PK,
            'client_id'     => Schema::TYPE_INTEGER,
            'supervison_organization_id'    => Schema::TYPE_INTEGER,
            'title'         => Schema::TYPE_STRING,
            'address'       => Schema::TYPE_STRING,
            'telephone'     => Schema::TYPE_STRING,
            'category'      => Schema::TYPE_SMALLINT,
            'longitude'     => Schema::TYPE_FLOAT,
            'latitude'      => Schema::TYPE_FLOAT,
        ]);
        
        $this->createTable('client_employee_outlet', [
            'employee_id'   => Schema::TYPE_INTEGER,
            'outlet_id'     => Schema::TYPE_INTEGER,
            'position'      => Schema::TYPE_STRING,
        ]);
        
        $this->createTable('client_agent_outlet', [
            'agent_id'      => Schema::TYPE_INTEGER,
            'outlet_id'     => Schema::TYPE_INTEGER,
            'position'      => Schema::TYPE_STRING,
        ]);
    }

    public function down()
    {
        echo "m150519_100014_add_agency_etc_tables cannot be reverted.\n";

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
