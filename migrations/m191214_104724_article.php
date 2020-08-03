<?php

use yii\db\Migration;

/**
 * Class m191214_104724_article
 */
class m191214_104724_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('article', [
        'id' => $this->primaryKey(),
        'author' => $this->string(255),
        'slug' => $this->string(255),
        'category_title' => $this->string(255),
        'title' => $this->string(255),
        'tag_list' => $this->string(255),
        'date_create' => $this->datetime(),
        'date_update' => $this->datetime(),
        'status' => $this->string(255),
        'short_content' => $this->string(255),
        'rating' => $this->integer(255)->defaultValue(0),
        'content' => $this->string(255),
        'peoples_voices' => $this->integer(255)->defaultValue(0),
        'mark' => $this->integer(255)->defaultValue(0),
        'ip_array' => $this->string(255),
 ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191214_104724_article cannot be reverted.\n";
         $this->dropTable('article');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191214_104724_article cannot be reverted.\n";

        return false;
    }
    */
}
