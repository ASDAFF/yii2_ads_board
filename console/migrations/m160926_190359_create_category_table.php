<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category`.
 */
class m160926_190359_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'nesting_lvl' => $this->integer()->notNull(),
            'parent_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
