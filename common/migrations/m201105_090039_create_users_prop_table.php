<?php
namespace common\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_prop}}`.
 */
class m201105_090039_create_users_prop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%users_prop}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name'=>$this->string(50),
            'last_name'=>$this->string(50),
            'phone'=>$this->string(12),
            'email'=>$this->string(50),
            'birth'=>$this->date()
        ]);
        $this->createIndex('idx-users_prop-user_id','users_prop','user_id');
        $this->addForeignKey(
            'fk-users_prop-user_id',
            'users_prop',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-users_prop-user_id','users_prop');
        $this->dropIndex('idx-users_prop-user_id','users_prop');
        $this->dropTable('{{%users_prop}}');
    }
}
