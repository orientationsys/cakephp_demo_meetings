<?php

class Room extends AppModel
{
    var $name = 'Room';
	
	function getRoomSelect(){
		$lists = $this->find('all', array(
									'recursive' => -1
								)
							);
		
		$ids = Set::extract($lists, "{n}.{$this->name}.id");
		$names = Set::extract($lists, "{n}.{$this->name}.name");
		$lists = array_combine($ids, $names);
		return $lists;
	}

}

?>