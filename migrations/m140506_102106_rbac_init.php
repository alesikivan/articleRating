<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use yii\base\InvalidConfigException;
use yii\rbac\DbManager;

/**
 * Initializes RBAC tables.
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */
class m140506_102106_rbac_init extends \yii\db\Migration
{
    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    /**
     * @return bool
     */
    protected function isMSSQL()
    {
        return $this->db->driverName === 'mssql' || $this->db->driverName === 'sqlsrv' || $this->db->driverName === 'dblib';
    }

    protected function isOracle()
    {
        return $this->db->driverName === 'oci';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;
        $schema = $this->db->getSchema()->defaultSchema;

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($authManager->ruleTable, [
            'name' => $this->string(64), //убрал notNull()
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY ([[name]])',
        ], $tableOptions);

        $this->createTable($authManager->itemTable, [
            'name' => $this->string(64),
            'type' => $this->smallInteger(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY ([[name]])',
            'FOREIGN KEY ([[rule_name]]) REFERENCES ' . $authManager->ruleTable . ' ([[name]])' .
                $this->buildFkClause('ON DELETE SET NULL', 'ON UPDATE CASCADE'),
        ], $tableOptions);
        $this->createIndex('idx-auth_item-type', $authManager->itemTable, 'type');

        $this->createTable($authManager->itemChildTable, [
            'parent' => $this->string(64),
            'child' => $this->string(64),
            'PRIMARY KEY ([[parent]], [[child]])',
            'FOREIGN KEY ([[parent]]) REFERENCES ' . $authManager->itemTable . ' ([[name]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[child]]) REFERENCES ' . $authManager->itemTable . ' ([[name]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ], $tableOptions);

        $this->createTable($authManager->assignmentTable, [
            'item_name' => $this->string(64),
            'user_id' => $this->string(64),
            'created_at' => $this->integer(),
            'PRIMARY KEY ([[item_name]], [[user_id]])',
            'FOREIGN KEY ([[item_name]]) REFERENCES ' . $authManager->itemTable . ' ([[name]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ], $tableOptions);

        if ($this->isMSSQL()) {
            $this->execute("CREATE TRIGGER {$schema}.trigger_auth_item_child
            ON {$schema}.{$authManager->itemTable}
            INSTEAD OF DELETE, UPDATE
            AS
            DECLARE @old_name VARCHAR (64) = (SELECT name FROM deleted)
            DECLARE @new_name VARCHAR (64) = (SELECT name FROM inserted)
            BEGIN
            IF COLUMNS_UPDATED() > 0
                BEGIN
                    IF @old_name <> @new_name
                    BEGIN
                        ALTER TABLE {$authManager->itemChildTable} NOCHECK CONSTRAINT FK__auth_item__child;
                        UPDATE {$authManager->itemChildTable} SET child = @new_name WHERE child = @old_name;
                    END
                UPDATE {$authManager->itemTable}
                SET name = (SELECT name FROM inserted),
                type = (SELECT type FROM inserted),
                description = (SELECT description FROM inserted),
                rule_name = (SELECT rule_name FROM inserted),
                data = (SELECT data FROM inserted),
                created_at = (SELECT created_at FROM inserted),
                updated_at = (SELECT updated_at FROM inserted)
                WHERE name IN (SELECT name FROM deleted)
                IF @old_name <> @new_name
                    BEGIN
                        ALTER TABLE {$authManager->itemChildTable} CHECK CONSTRAINT FK__auth_item__child;
                    END
                END
                ELSE
                    BEGIN
                        DELETE FROM {$schema}.{$authManager->itemChildTable} WHERE parent IN (SELECT name FROM deleted) OR child IN (SELECT name FROM deleted);
                        DELETE FROM {$schema}.{$authManager->itemTable} WHERE name IN (SELECT name FROM deleted);
                    END
            END;");
        }

        //создание маршрута для admin
        $this->insert($authManager->itemTable, [
          'name' => '/*',
          'type' => '2',
        ]);

        //создание роли admin
        $this->insert($authManager->itemTable, [
          'name' => 'admin',
          'type' => '1',
        ]);

        //добавление роли
        $this->insert($authManager->itemChildTable, [
          'parent' => 'admin',
          'child' => '/*',
        ]);

        // присваивание новой роли
        $this->insert($authManager->assignmentTable, [
          'item_name' => 'admin',
          'user_id' => '1',
        ]);




              //создание маршрута для demo
              $this->insert($authManager->itemTable, [
                'name' => '/page/*',
                'type' => '2',
              ]);
              $this->insert($authManager->itemTable, [
                'name' => '/site/*',
                'type' => '2',
              ]);

              //создание роли demo
              $this->insert($authManager->itemTable, [
                'name' => 'demo',
                'type' => '1',
              ]);

              //добавление роли
              $this->insert($authManager->itemChildTable, [
                'parent' => 'demo',
                'child' => '/page/*',
              ]);
              $this->insert($authManager->itemChildTable, [
                'parent' => 'demo',
                'child' => '/site/*',
              ]);

              // присваивание новой роли
              $this->insert($authManager->assignmentTable, [
                'item_name' => 'demo',
                'user_id' => '2',
              ]);



              //создание правила
              // $file = file('../basic/components/AuthorRule.php', FILE_USE_INCLUDE_PATH);
              $this->insert($authManager->ruleTable, [
                'name' => 'Author', //убрал notNull()
                'data' => 'O:25:"app\components\AuthorRule":4:{s:4:"name";s:6:"Author";s:6:"result";N;s:9:"createdAt";i:1580373120;s:9:"updatedAt";i:1580373120;}',
                'created_at' => '1580373120',
                'updated_at' => '1580373120',
              ]);

              //созздание разрешения
              $this->insert($authManager->itemTable, [
                'name' => 'updateOwnPost',
                'type' => '2',
                'rule_name' => 'Author',
              ]);
              $this->insert($authManager->itemTable, [
                'name' => 'updatePost',
                'type' => '2',
              ]);

              $this->insert($authManager->itemChildTable, [
                'parent' => 'updateOwnPost',
                'child' => 'updatePost',
              ]);

              //присвоение правила
              $this->insert($authManager->itemChildTable, [
                'parent' => 'demo',
                'child' => 'updateOwnPost',
              ]);



              //добавление правила
              $this->insert($authManager->assignmentTable, [
                'item_name' => 'updateOwnPost',
                'user_id' => '2',
              ]);

              $this->insert($authManager->assignmentTable, [
                'item_name' => 'updateOwnPost',
                'user_id' => '3',
              ]);
              $this->insert($authManager->assignmentTable, [
                'item_name' => 'updateOwnPost',
                'user_id' => '4',
              ]);

              $this->insert($authManager->itemTable, [
                'name' => 'debug/*',
                'type' => '2',
              ]);

              $this->insert($authManager->itemTable, [
                'name' => 'rating/*',
                'type' => '2',
              ]);
              $this->insert($authManager->itemTable, [
                'name' => 'user/*',
                'type' => '2',
              ]);


              $this->insert($authManager->itemChildTable, [
                'parent' => 'demo',
                'child' => 'debug/*',
              ]);
              $this->insert($authManager->itemChildTable, [
                'parent' => 'demo',
                'child' => 'rating/*',
              ]);
              $this->insert($authManager->itemChildTable, [
                'parent' => 'demo',
                'child' => 'user/*',
              ]);





    } //end



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;
        $schema = $this->db->getSchema()->defaultSchema;

        if ($this->isMSSQL()) {
            $this->execute("DROP TRIGGER {$schema}.trigger_auth_item_child;");
        }

        // $this->delete($authManager->assignmentTable, ['user_id' => '3']);
        // $this->delete($authManager->itemChildTable, ['child' => '/site/*']);
        // $this->delete($authManager->itemChildTable, ['child' => '/page/*']);
        // $this->delete($authManager->itemTable, ['name' => 'user']);
        // $this->delete($authManager->itemTable, ['name' => '/site/*']);
        // $this->delete($authManager->itemTable, ['name' => '/page/*']);


        $this->delete($authManager->itemChildTable, ['child' => 'user/*']);
        $this->delete($authManager->itemChildTable, ['child' => 'rating/*']);
        $this->delete($authManager->itemChildTable, ['child' => 'debug/*']);
        $this->delete($authManager->itemTable, ['name' => 'user/*']);
        $this->delete($authManager->itemTable, ['name' => 'rating/*']);
        $this->delete($authManager->itemTable, ['name' => 'debug/*']);
        $this->delete($authManager->assignmentTable, ['user_id' => '4']);
        $this->delete($authManager->assignmentTable, ['user_id' => '3']);
        $this->delete($authManager->assignmentTable, ['item_name' => 'updateOwnPost']);
        $this->delete($authManager->itemChildTable, ['child' => 'updateOwnPost']);
        $this->delete($authManager->itemChildTable, ['parent' => 'updateOwnPost']);
        $this->delete($authManager->itemTable, ['name' => 'updatePost']);
        $this->delete($authManager->itemTable, ['name' => 'updateOwnPost']);
        $this->delete($authManager->ruleTable, ['name' => 'Author']);
        $this->delete($authManager->assignmentTable, ['item_name' => 'demo']);
        $this->delete($authManager->itemChildTable, ['child' => '/site/*']);
        $this->delete($authManager->itemChildTable, ['child' => '/page/*']);
        $this->delete($authManager->itemTable, ['name' => 'demo']);
        $this->delete($authManager->itemTable, ['name' => '/site/*']);
        $this->delete($authManager->itemTable, ['name' => '/page/*']);
        $this->delete($authManager->assignmentTable, ['item_name' => 'admin']);
        $this->delete($authManager->itemChildTable, ['parent' => 'admin']);
        $this->delete($authManager->itemTable, ['name' => 'admin']);
        $this->delete($authManager->itemTable, ['name' => '/*']);
        $this->dropTable($authManager->assignmentTable);
        $this->dropTable($authManager->itemChildTable);
        $this->dropTable($authManager->itemTable);
        $this->dropTable($authManager->ruleTable);
    }

    protected function buildFkClause($delete = '', $update = '')
    {
        if ($this->isMSSQL()) {
            return '';
        }

        if ($this->isOracle()) {
            return ' ' . $delete;
        }

        return implode(' ', ['', $delete, $update]);
    }
}
