<?php
namespace common\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_event}}`.
 */
class m201105_090841_create_users_event_table extends Migration
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
        $this->createTable('{{%users_event}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users_event}}');
    }
}
