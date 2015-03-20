<?php

class Attendee extends AppModel
{
    var $name = 'Attendee';
	
	function getAttendeeSelect(){
		$lists = $this->find('all', array(
									'recursive' => -1
								)
							);
		$ids = Set::extract($lists, "{n}.{$this->name}.id");
		$names = Set::extract($lists, "{n}.{$this->name}.username");
		$lists = array_combine($ids, $names);
		return $lists;
	}
	
}

?>