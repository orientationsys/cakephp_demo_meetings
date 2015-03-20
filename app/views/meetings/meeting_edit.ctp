
<h2 class="section"><?php echo __('Edit Meetings',true)?></h2>
<?php $session->flash();?>
<div id="Edit">
	<div class="innercol">
    	<?php echo $form->create('Meeting', array('action'=>'meeting_edit', 'onsubmit'=>"
					if(!$('#datepicker').val()) {alert('Date is required.'); return false;}"));?>
        	<?php echo $form->hidden('id');?>
            <div class="input title_input">
                <label for="NewDate"><?php echo __('Date',true)?></label>
                <?php echo $form->input('date', array('id'=>'datepicker','type'=>'text', 'label'=>false, 'style'=>'width:100px'));?>
            </div>
            
            <div class="input select">
            	<div id="topic_select">
                	<h2><strong><?php echo __('Choose a topic',true)?></strong>(Or <a href="#" onclick="$('#topic_select').hide(); $('#topic_new').show();">Create a new topic</a>)</h2>
               		<?php echo $form->input('topic_id', array('type'=>'select', 'options'=>$topicLists, 'label'=>false));?>
                </div>
                <div id="topic_new" style="display:none" class="title_input">
                	<h2><strong><?php echo __('Enter a new topic name',true)?></strong>(Or <a href="#" onclick="$('#topic_select').show(); $('#topic_new').hide();">select an existing topic</a>)</h2>
                	<?php echo $form->input('topic_new',array('label'=>false));?>
                </div>
            </div>
            
            <div class="input select">
            	<h2><strong><?php echo __('Choose a room',true)?></strong></h2>
               		<?php echo $form->input('room_id', array('type'=>'select', 'options'=>$roomLists, 'label'=>false));?>
            </div>

             <div class="input select">
            	<h2><strong><?php echo __('Choose a Priority',true)?></strong></h2>
               		<?php 
						$priorityLists = array('High'=>'High', 'Medium'=>'Medium', 'Low'=>'Low');
						echo $form->input('priority', array('type'=>'select', 'options'=>$priorityLists, 'label'=>false));
					?>
            </div>
            
            
          
            <div class="options">
				<h2><strong>Attendee</strong></h2>
                <?php $coptions = $hht->list_view($attendeeLists, 3);?>
                <?php
					$existing = array();
					foreach($this->data['Attendee'] as $attendee){
						array_push($existing, $attendee['id']);
					}
				?>
                <?php echo $form->input('Attendee', array( 'type' => 'select', 'multiple' => 'checkbox', 'options'=>$attendeeLists ));?>
            </div>
            
            <div class="submit">
                <input class="form-button" type="submit" value="<?php echo __('Edit this Meeting',true)?>" />
            </div>
            <div class="cancel-edit"> or<?php echo $html->link('cancel', array('controller'=>'meetings', 'action'=>'index'))?></div>
        <?php echo $form->end();?>
    </div>
</div>




