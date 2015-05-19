<?php

use yii\db\Schema;
use yii\db\Migration;

class m150519_042827_add_organization_etc_tables extends Migration
{
    public function up()
    {
        $this->createTable('woso_client', [
            'client_id'     => Schema::TYPE_PK,
            'title'         => Schema::TYPE_STRING,
            'title_abbrev'  => Schema::TYPE_STRING,
            'province'      => Schema::TYPE_STRING,
            'city'          => Schema::TYPE_STRING,
        ]);
        $this->insert('woso_client', [
            'title'         => '中国联合网络通信有限公司襄阳市分公司',
            'title_abbrev'  => '襄阳联通',
            'province'      => '湖北',
            'city'          => '襄阳',
        ]);
        
        $this->createTable('client_wechat', [
            'wechat_id' => Schema::TYPE_PK,
            'client_id' => Schema::TYPE_INTEGER,
            'gh_id'     => Schema::TYPE_STRING,
        ]);
        $this->insert('client_wechat', [
            'client_id' => 1,       // ???yjhu 这儿假设襄阳联通永远是第1记录
            'gh_id'     => \app\models\MGh::GH_XIANGYANGUNICOM,
        ]);

        $this->createTable('client_organization', [
            'organization_id'   => Schema::TYPE_PK,
            'client_id'         => Schema::TYPE_INTEGER,
            'title'             => Schema::TYPE_STRING,
        ]);
        
        $this->createTable('client_organization_chart', [
            'subordinate_id'    => Schema::TYPE_INTEGER,
            'superior_id'       => Schema::TYPE_INTEGER,
        ]);
        
        $this->renameColumn('client_employee', 'id', 'employee_id');
        $this->dropColumn('client_employee', 'gh_id');
        $this->dropColumn('client_employee', 'department');
        $this->dropColumn('client_employee', 'position');
        $this->dropColumn('client_employee', 'mobile');
        $this->addColumn('client_employee', 'client_id', 'integer default 1');
        
        $this->createTable('client_employee_mobile', [
            'employee_id' => Schema::TYPE_INTEGER,
            'mobile'      => Schema::TYPE_STRING,
        ]);
        
        $this->createTable('client_employee_organization', [
            'employee_id'       => Schema::TYPE_INTEGER,
            'organization_id'   => Schema::TYPE_INTEGER,
            'position'          => Schema::TYPE_STRING,
        ]);
        
    }

    public function down()
    {
        echo "m150519_042827_add_organization_etc_tables cannot be reverted.\n";

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
