<?php

use yii\db\Migration;

/**
 * Class m191225_090406_article_tag
 */
class m191225_090406_article_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('article_tag', [
        'id' => $this->primaryKey(),
        'article_id'=>$this->integer(),
        'tag_id'=>$this->integer()
]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191225_090406_article_tag cannot be reverted.\n";
         $this->dropTable('article_tag');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191225_090406_article_tag cannot be reverted.\n";

        return false;
    }
    */
}
