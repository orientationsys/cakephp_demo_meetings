<?php

class Meeting extends AppModel
{
    var $name = 'Meeting';
	var $actsAs = array('Containable');
	

	public $hasAndBelongsToMany = array(				
				'Attendee'=>array(
							'className' => 'Attendee',
							'joinTable' => 'attendee_meetings',
							'foreignKey' => 'meeting_id',
							'associationForeignKey' => 'attendee_id'
						)				
	);
	
	public $belongsTo = array(
				'Topic' => array(
					'className'  => 'Topic',
					'foreignKey' => 'topic_id'
				),
				
				'Room' => array(
					'className'  => 'Room',
					'foreignKey' =>'room_id'
				)
				
				
	);

	
}

?>