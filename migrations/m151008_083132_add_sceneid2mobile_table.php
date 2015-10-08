<?php

use yii\db\Schema;
use yii\db\Migration;

class m151008_083132_add_sceneid2mobile_table extends Migration
{
    public function up()
    {
        $this->createTable('sceneid_mobile', [
            'scene_id'      => Schema::TYPE_PK,
            'mobile'        => Schema::TYPE_STRING . '(11) UNIQUE',
            'ticket'        => Schema::TYPE_STRING,
            'expire_seconds' => Schema::TYPE_INTEGER,
            'url'           => Schema::TYPE_STRING,
            'qr_url'        => Schema::TYPE_STRING,
            'created_at'    => Schema::TYPE_INTEGER,
            'updated_at'    => Schema::TYPE_INTEGER,
        ]);

    }

    public function down()
    {
        $this->dropTable('sceneid_mobile');

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
