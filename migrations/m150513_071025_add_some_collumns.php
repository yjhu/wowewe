<?php

use yii\db\Schema;
use yii\db\Migration;

class m150513_071025_add_some_collumns extends Migration
{
    public function up()
    {
        $this->addColumn('wx_user', 'belongto', "int unsigned default 0");
        $this->addColumn('wx_access_log', 'booked', 'tinyint default 0');
    }

    public function down()
    {
        $this->dropColumn('wx_user', 'belongto');
        $this->dropColumn('wx_access_log', 'booked');

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
