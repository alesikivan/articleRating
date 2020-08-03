<?php

use yii\db\Migration;

/**
 * Class m200130_162528_rating
 */
class m200130_162528_rating extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rating', [
          'page' => $this->string(255),
          'voice' => $this->integer()->defaultValue(0),
          'ip' => $this->string(255),
   ]);

   // $this->insert('rating', [
   //   'page' => 'admin',
   //   'ip' => '::1',
   // ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // $this->delete('rating', ['page' => 'admin']);
        $this->dropTable('rating');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200130_162528_rating cannot be reverted.\n";

        return false;
    }
    */
}
