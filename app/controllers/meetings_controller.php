<?php
class MeetingsController extends AppController
{
	var $name = 'Meetings';
	public $pageTitle = 'Meetings';
	public $uses = array('Meeting','Topic');
	public $helpers = array('Hht');	
	
	/**
	 * Meeting controller index page
	 *
	 * Display Meeting List
	 */
	function index(){
		//rooms select list
		$roomLists = ClassRegistry::init('Room')->getRoomSelect();
		//topics select list
		$topicLists = ClassRegistry::init('Topic')->getTopicSelect();
		//attendee check list
		$attendeeLists = ClassRegistry::init('Attendee')->getAttendeeSelect();
		//index list
		$meetings = $this->Meeting->find('all',array('order'=>'Meeting.id','recursive'=>2));  //'recursive'> 1  返回关联的其他对象
		
		$this->set(compact('roomLists', 'topicLists', 'attendeeLists', 'meetings'));//compact返回参数所组成的数组:  键名是参数，键值是参数变量的值
	}
	
	
	/**
	 * Create New Meeting Create
	 *
	 * Save data
	 */
	function create(){
		if($this->data){
			//if add a new topic
			if($this->data['Meeting']['topic_new']){
				$this->data['Topic']['name'] = $this->data['Meeting']['topic_new'];
				if($this->Topic->save($this->data['Topic'])){
					$this->data['Meeting']['topic_id'] = $this->Topic->id;
				}
			}
			unset($this->data['Meeting']['topic_new']);
			
			$this->data['Meeting']['date'] = ($this->data['Meeting']['date']) ? date('Y-m-d', strtotime($this->data['Meeting']['date'])) : '';
			$this->Meeting->create($this->data);
			$this->Meeting->save();
			$this->Session->setFlash('The new meeting was added.');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	
	function meeting_edit($id = null){
		if($this->data){
			//if add a new topic
			if($this->data['Meeting']['topic_new']){
				$this->data['Topic']['name'] = $this->data['Meeting']['topic_new'];
				if($this->Topic->save($this->data['Topic'])){
					$this->data['Meeting']['topic_id'] = $this->Topic->id;
				}
			}
			unset($this->data['Meeting']['topic_new']);
			$this->data['Meeting']['date'] = ($this->data['Meeting']['date']) ? date('Y-m-d', strtotime($this->data['Meeting']['date'])) : '';
			$this->Meeting->create($this->data);
			$this->Meeting->save();
			$this->Session->setFlash('The  meeting was edited.');
			$this->redirect(array('action' => 'index'));
			
		}else{
		
			//rooms select list
			$roomLists = ClassRegistry::init('Room')->getRoomSelect();
			//topics select list
			$topicLists = ClassRegistry::init('Topic')->getTopicSelect();
			//attendee check list
			$attendeeLists = ClassRegistry::init('Attendee')->getAttendeeSelect();
			$this->data = $this->Meeting->findById($id);
	
		}
		$this->set(compact('roomLists', 'topicLists', 'attendeeLists'));
	}
	
	/**
	 * Delete Meeting 
	 *
	 * @param ajax del dom
	 */
	function meeting_del($id){
		if($this->Meeting->del($id))
			echo 'success';		
		Configure::write('debug', 0);
		$this->autoRender =false;
	}
}
	
?>