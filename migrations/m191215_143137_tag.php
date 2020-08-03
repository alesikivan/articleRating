<?php

use yii\db\Migration;

/**
 * Class m191215_143137_tag
 */
class m191215_143137_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('tag', [
        'id' => $this->primaryKey(),
        'slug' => $this->string(255),
        'title' => $this->string(255),
 ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191215_143137_tag cannot be reverted.\n";
        $this->dropTable('tag');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191215_143137_tag cannot be reverted.\n";

        return false;
    }
    */
}
