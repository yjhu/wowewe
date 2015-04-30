<?php

use yii\db\Schema;
use yii\db\Migration;

class m150430_105726_create_office_campaign_scorer_table extends Migration {

    public function up() {
        // 评分员：门店宣传竞赛活动评分员。
        $this->createTable('wx_office_campaign_scorer', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'department' => Schema::TYPE_STRING,
            'position' => Schema::TYPE_STRING,
            'mobile' => Schema::TYPE_STRING,
        ]);
    }

    public function down() {
        echo "m150430_105726_create_office_campaign_scorer_table cannot be reverted.\n";

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
