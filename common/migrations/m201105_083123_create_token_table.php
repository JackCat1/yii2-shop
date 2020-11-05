<?php
namespace common\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%token}}`.
 */
class m201105_083123_create_token_table extends Migration
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
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(),
            'token'=>$this->string()->notNull(),
            'time'=>$this->integer(20)->notNull(),
            'user_id'=>$this->integer()->notNull()
        ]);
        $this->createIndex('idx-token-user_id','token','user_id');
        $this->addForeignKey(
            'fk-token-user_id',
            'token',
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
        $this->dropForeignKey('fk-token-user_id','token');
        $this->dropIndex('idx-token-user_id','token');
        $this->dropTable('{{%token}}');
    }
}
