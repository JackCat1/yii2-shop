<?php
namespace common\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201105_080908_create_user_table extends Migration
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
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'login'=>$this->string(50)->notNull()->unique(),
            'pass_hash'=>$this->string()->notNull(),
            'active'=>$this->boolean()->defaultValue(1),
            'group_id'=>$this->integer()->defaultValue(2)
        ]);
        $this->createIndex('idx-user-group_id','user','group_id');
        $this->addForeignKey(
            'fk-user-group_id',
            'user',
            'group_id',
            'users_group',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-group_id','user');
        $this->dropIndex('idx-user-group_id','user');
        $this->dropTable('{{%user}}');
    }
}
