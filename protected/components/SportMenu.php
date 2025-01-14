<?php

Yii::import('zii.widgets.CMenu');

class SportMenu extends CMenu
{
    public function init()
    {
        $criteria = new CDbCriteria;
        $criteria->order = '`id` ASC';

        $sports = Sport::model()->findAll($criteria);

        foreach ($sports as $sport)
        {
            $this->items[] = array('label'=>$sport->name, 
            	                   'url'=>Yii::app()->createUrl('sport/'.$sport->id));
        }

        parent::init();
    }
}
