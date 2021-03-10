<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorite}}`.
 */
class m210310_143739_create_favorite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorite}}', [
            'id' => $this->primaryKey()->unsigned()->comment('id'),
            'user_id' => $this->integer(10)->unsigned()->comment('id пользователя'),
            'freelancer_id' => $this->integer(10)->unsigned()->comment('id исполнителя')
        ]);

        $this->addForeignKey(
            'favorite_ibfk_1',
            'favorite',
            'user_id',
            'users',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'favorite_ibfk_2',
            'favorite',
            'freelancer_id',
            'users',
            'id',
            'RESTRICT',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'favorite_ibfk_1',
            'favorite'
        );

        $this->dropForeignKey(
            'favorite_ibfk_2',
            'favorite'
        );

        $this->dropTable('{{%favorite}}');
    }
}
