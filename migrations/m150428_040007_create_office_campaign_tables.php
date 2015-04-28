<?php

use yii\db\Schema;
use yii\db\Migration;

class m150428_040007_create_office_campaign_tables extends Migration
{
    public function up()
    {
        // 督导表：督导实际是一个特殊员工，本表是员工督导某门店的关系表。
        $this->createTable('wx_rel_supervision_staff_office', [
            'id' => Schema::TYPE_PK,
            'staff_id' => Schema::TYPE_BIGINT,
            'office_id' => Schema::TYPE_BIGINT,
        ]);
//        $this->addForeignKey('fk_rel_supervision_staff_id', 'wx_rel_supervision_staff_office', 'staff_id', 'wx_staff', 'staff_id');
//        $this->addForeignKey('fk_rel_supervision_office_id', 'wx_rel_supervision_staff_office', 'office_id', 'wx_office', 'office_id');
        
        
        // 营销片区表。
        $this->createTable('wx_marketing_region', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
        ]);
        
         // 营服中心表：Marketing Service Center，简称msc。
        $this->createTable('wx_msc', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'region_id' => Schema::TYPE_BIGINT,
        ]);
//        $this->addForeignKey('fk_msc_region_id', 'wx_msc', 'region_id', 'wx_marketing_region', 'id');
        
         // 门店的营服归属表：Marketing Service Center，简称msc。
        $this->createTable('wx_rel_office_msc', [
            'id' => Schema::TYPE_PK,
            'office_id' => Schema::TYPE_BIGINT,
            'msc_id' => Schema::TYPE_BIGINT,
        ]);
//        $this->addForeignKey('fk_rel_office_msc_office_id', 'wx_rel_office_msc', 'office_id', 'wx_office', 'office_id');
//        $this->addForeignKey('fk_rel_office_msc_msc_id', 'wx_rel_office_msc', 'msc_id', 'wx_msc', 'id');
        
        //门店的资料类型表
        $this->createTable('wx_office_campaign_pic_category', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
        ]);
        
        // 门店的活动资料表
        $this->createTable('wx_office_campaign_detail', [
            'id' => Schema::TYPE_PK,
            'office_id' => Schema::TYPE_BIGINT,
            'pic_url' => Schema::TYPE_STRING,
            'pic_category' => Schema::TYPE_BIGINT,
            'created_time' => Schema::TYPE_DATETIME,
        ]);
//        $this->addForeignKey('fk_office_campaign_office_id', 'wx_office_campaign_detail', 'office_id', 'wx_office', 'office_id');
//        $this->addForeignKey('fk_office_campaign_pic_category', 'wx_office_campaign_detail', 'pic_category', 'wx_office_campaign_pic_category', 'id');

        // 门店的活动成绩表
        $this->createTable('wx_office_campaign_score', [
            'id' => Schema::TYPE_PK,
            'office_campaign_id' => Schema::TYPE_BIGINT,
            'staff_id' => Schema::TYPE_BIGINT,
            'score' => Schema::TYPE_SMALLINT,
        ]);
//        $this->addForeignKey('fk_office_campaign_score_staff_id', 'wx_office_campaign_score', 'staff_id', 'wx_staff', 'staff_id');
//        $this->addForeignKey('fk_office_campaign_score_office_campaign_id', 'wx_office_campaign_score', 'office_campaign_id', 
//                'wx_office_campaign_detail', 'id');
    }

    public function down()
    {
        echo "m150428_040007_create_office_campaign_tables cannot be reverted.\n";

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
