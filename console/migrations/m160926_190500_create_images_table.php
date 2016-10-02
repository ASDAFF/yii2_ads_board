<?php

use yii\db\Migration;

/**
 * Handles the creation for table `images`.
 */
class m160926_190500_create_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'path' => $this->string()->notNull(),
            'ads_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('images');
    }
}
