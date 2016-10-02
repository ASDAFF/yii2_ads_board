<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `adsense`.
 */
class m160926_165947_create_adsense_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('adsense', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'city_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'state' => Schema::TYPE_STRING . '(100) NOT NULL',
            'cost' => Schema::TYPE_INTEGER . ' NOT NULL',
            'publish_status' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_publish' => Schema::TYPE_DATETIME . ' NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('adsense');
    }
}
