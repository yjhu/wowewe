<?php

use yii\db\Schema;
use yii\db\Migration;

class m150509_033242_add_office_counters_collumn extends Migration
{
    public function up()
    {
        $this->addColumn('wx_marketing_region', "office_total_count", "int default 0");
        $this->addColumn('wx_marketing_region', "office_detailed_count", "int default 0");
        $this->addColumn('wx_marketing_region', "office_scored_count", "int default 0");
        $this->addColumn('wx_msc', "office_total_count", "int default 0"); 
        $this->addColumn('wx_msc', "office_detailed_count", "int default 0"); 
        $this->addColumn('wx_msc', "office_scored_count", "int default 0"); 
    }

    public function down()
    {
        $this->dropColumn('wx_marketing_region', 'office_total_count');
        $this->dropColumn('wx_marketing_region', 'office_detailed_count');
        $this->dropColumn('wx_marketing_region', 'office_scored_count');
        $this->dropColumn('wx_msc', "office_total_count");
        $this->dropColumn('wx_msc', "office_detailed_count");
        $this->dropColumn('wx_msc', "office_scored_count");

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
