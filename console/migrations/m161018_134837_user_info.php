<?php

use yii\db\Migration;

class m161018_134837_user_info extends Migration
{
    public function up()
    {
        $this->createTable('',[
            'id' => $this->primaryKey(),
            'contact_name' => $this->string()->notNull(),
            'city' => $this->string(32)->notNull(),
            'telephon_number' => $this->string(20)->notNull(),
            'skype' => $this->string(),
        ]);

    }

    public function down()
    {
        echo "m161018_134837_user_info cannot be reverted.\n";

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
