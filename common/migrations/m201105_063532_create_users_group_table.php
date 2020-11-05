<?php
namespace common\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_group}}`.
 */
class m201105_063532_create_users_group_table extends Migration
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
        $this->createTable('{{%users_group}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'level'=>$this->integer(2)->notNull()->defaultValue(10)
        ]);
        $this->insert('{{%users_group}}',[
            'name'=>'superuser',
            'level'=>1
        ]);
        $this->insert('{{%users_group}}',[
            'name'=>'guest',
            'level'=>10
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%users_group}}',['id'=>2]);
        $this->delete('{{%users_group}}',['id'=>1]);
        $this->dropTable('{{%users_group}}');
    }
}
