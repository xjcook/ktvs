<?php

class m131219_004225_add_student_sports extends CDbMigration
{
	public function safeUp()
	{
            $this->insert('tbl_student_sport', array('student_id'=>'1','sport_id'=>'1'));
            
            $this->insert('tbl_student_sport', array('student_id'=>'2','sport_id'=>'2'));
           
            $this->insert('tbl_student_sport', array('student_id'=>'3','sport_id'=>'3'));
            
	}

	public function safeDown()
	{
		$this->delete('tbl_student_sport');
	}
}