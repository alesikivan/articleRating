<?php

use yii\db\Migration;

/**
 * Class m191215_142641_category
 */
class m191215_142641_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('category', [
        'id' => $this->primaryKey(),
        'slug' => $this->string(255),
        'title' => $this->string(255),
        'status' => $this->string(255),
        'id_parent' => $this->integer(255),
 ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191215_142641_category cannot be reverted.\n";
           $this->dropTable('category');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191215_142641_category cannot be reverted.\n";

        return false;
    }
    */
}
