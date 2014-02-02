<?php

class m140202_091450_dbt_create_tables extends CDbMigration
{

    public function up()
    {
        $this->createTable('sourceMessage', array(
            'id' => 'pk',
            'category' => 'varchar(32) DEFAULT NULL',
            'message' => 'text'
        ));
        $this->createTable('message', array(
            'id' => "int(11) NOT NULL DEFAULT '0'",
            'language' => "varchar(16) NOT NULL DEFAULT ''",
            'translation' => 'text',
        ));
        $this->addPrimaryKey('primary_key', 'message', 'id,language');
        $this->addForeignKey('fk_message_sourceMessage', 'message', 'id', 'sourceMessage', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_message_sourceMessage', 'message');
        $this->dropTable('sourceMessage');
        $this->dropTable('message');
    }

}