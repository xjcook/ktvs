<?php

class m131121_110019_create_schedule_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('tbl_schedule', array(
			// keys
			'id' => 'pk',
			'class' => 'integer NOT NULL',
			'tvobject_id' => 'integer NOT NULL',

			// attributes		
			'content' => 'text NOT NULL',
			
			// timestamp
			'updated_at' => 'timestamp',
		));
		
		$this->addForeignKey('schedule_fk1', 'tbl_schedule', 'tvobject_id', 'tbl_tvobject', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropTable('tbl_schedule');
	}
}
