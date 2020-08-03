<?php

use yii\db\Migration;
use mdm\admin\components\Configs;

class m160312_050000_create_user extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $userTable = Configs::instance()->userTable;
        $db = Configs::userDb();

        // Check if the table exists
        if ($db->schema->getTableSchema($userTable, true) === null) {
            $this->createTable($userTable, [
                'id' => $this->primaryKey(),
                'username' => $this->string(64),
                'auth_key' => $this->string(32),
                'password_hash' => $this->string(),
                'password_reset_token' => $this->string(),
                'email' => $this->string(64),
                'created_at' => $this->integer(),
                'updated_at' => $this->integer(),
                'resetKey' => $this->string(64),
                'password' => $this->string(64),
                'displayname' => $this->string(64),
                'news-id' => $this->integer(),
                'cate-id' => $this->integer(),
                'access' => $this->string(64)->defaultValue('user'),
                'status' => $this->string(64)->defaultValue('user'),
                'ip' => $this->string(64),
                'voices_ip' => $this->integer(),
                // 'ip' => $this->string(64)->defaultValue(Yii::$app->request->userIP),
                // 'status' => $this->defaultValue('user')->string(64)->notNull(),
                ], $tableOptions);

                $this->insert($userTable, [
                  'username' => 'admin',
                  'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
                  'password' => 'admin',
                  'status' => '10',
                  'access' => 'admin',
                  'ip' => '::1',
                  'voices_ip' => 0,
                ]);
                $this->insert($userTable, [
                  'username' => 'demo',
                  'password_hash' => Yii::$app->security->generatePasswordHash('demo'),
                  'password' => 'demo',
                  'status' => '10',
                  'ip' => '::2',
                  'voices_ip' => 0,
                ]);
                // $this->addPrimaryKey('id', 'users', ['news-id', 'cate-id']);
        }


    }

    public function safeDown()
    {
        $this->delete($userTable, ['id' => 2]);
        $this->delete($userTable, ['id' => 1]);
        $userTable = Configs::instance()->userTable;
        $db = Configs::userDb();
        if ($db->schema->getTableSchema($userTable, true) !== null) {
            $this->dropTable($userTable);
        }
    }

}
