<?php
namespace common\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_history}}`.
 */
class m201105_091036_create_users_history_table extends Migration
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
        $this->createTable('{{%users_history}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'event_id'=>$this->integer()->notNull(),
            'time'=>$this->integer(20)->notNull(),
            'detail'=>$this->text()
        ]);
        $this->createIndex('idx-users_history-user_id','users_history','user_id');
        $this->addForeignKey(
            'fk-users_history-user_id',
            'users_history',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->createIndex('idx-users_history-event_id','users_history','event_id');
        $this->addForeignKey(
            'fk-users_history-event_id',
            'users_history',
            'event_id',
            'users_event',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-users_history-event_id','users_history');
        $this->dropIndex('idx-users_history-event_id','users_history');
        $this->dropForeignKey('fk-users_history-user_id','users_history');
        $this->dropIndex('idx-users_history-user_id','users_history');
        $this->dropTable('{{%users_history}}');
    }
}
