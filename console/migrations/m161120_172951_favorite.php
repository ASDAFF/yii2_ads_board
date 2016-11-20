<?php

use yii\db\Migration;

class m161120_172951_favorite extends Migration
{
    public function up()
    {
        $this->createTable('',[
            'id' => $this->primaryKey(),
            'ads_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        echo "m161120_172951_favorite cannot be reverted.\n";

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
