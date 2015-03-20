
<h2 class="section"><?php echo __('Meetings',true)?></h2>
<h2 class="new-col section" style=" display:none"><?php echo __('Create new Meeting',true)?></h2>
<?php $session->flash();?>
<div class="meeting_index">
	<table cellpadding="0" cellspacing="0" border="0">
    	<tr>
        	<th width="10%"><?php echo __('Date')?> </th>
        	<th width="15%"><?php echo __('Topic')?> </th>
            <th width="15%"><?php echo __('Room')?> </th>
            <th><?php echo __('Attendees')?> </th>
            <th width="5%"><?php echo __('Priority')?> </th>
            <th style="text-align:right">Action</th>
        </tr>
        <?php foreach($meetings as $v):?>
        	<tr id="meeting_list_<?php echo $v['Meeting']['id']?>">
            	<td><?php echo $time->format($format = 'd M', $v['Meeting']['date']); ?></td>
                <td><?php echo $v['Topic']['name']?></td>
                <td><?php echo $v['Room']['name']?></td>
                <td>
                	<?php 
						foreach($v['Attendee'] as $k=>$attendee){
							if(count($v['Attendee'])==$k-1)
								echo $attendee['username'];
							else
								echo $attendee['username'].', ';
						}
					?> 
                </td>
                <td><?php echo $v['Meeting']['priority']?></td>
                
                <td>
                	<div class="delete">
      					<div id="meeting_delete_<?php echo $v['Meeting']['id']?>">
                        	<span class="spinner"> </span>
                    		<a href="#" onclick="if (confirm('Are you sure you want to delete this meeting?')) {
                             $('#meeting_delete_<?php echo $v['Meeting']['id'];?>').addClass('busy');
                             Meeting.del('<?php echo $v['Meeting']['id']?>','<?php echo $html->url(array('controller'=>'meetings', 'action'=>'meeting_del', $v['Meeting']['id']))?>' )} return false;">Delete</a>
                    	</div>
                    </div>
                	<div class="edit">
                		<?php echo $html->link('Edit', array('controller'=>'meetings', 'action'=>'meeting_edit', $v['Meeting']['id']))?>
                    </div> 
                    
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>

<div id="swap_to" style="display:none">
	<div class="innercol">
    	<?php echo $form->create('Meeting', array('action'=>'create', 'onsubmit'=>"
					if(!$('#datepicker').val()) {alert('Date is required.'); return false;}"));?>
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
                <?php //pr($attendeeLists);?>
                <?php echo $form->input('Attendee', array( 'type' => 'select', 'multiple' => 'checkbox', 'options'=>$attendeeLists ));?>
            </div>
            
            <div class="submit">
                <input class="form-button" type="submit" value="<?php echo __('Create this Meeting',true)?>" />
            </div>
            <div class="cancel-edit"> or <a href="javascript:void(0)" onclick="$('.meeting_index, #sidebar, .section ').show(500);  $('#swap_to , .new-col').hide(500);"><l18n><?php echo __('cancel',true)?></l18n></a></div>
        <?php echo $form->end();?>
    </div>
</div>


<?php $partialLayout->blockStart('sidebar'); ?>
   	<li class="sidebar-col">
		<div class="button_to_add_new">
        <a href="javascript:void(0)" class="add-col" onclick="$('.meeting_index, #sidebar, .section ').css('display','none'); $('.new-col').show(); $('#swap_to').show(500)">
        	<span><?php echo __('Add a Meeting')?></span>
        </a>
        </div>
    </li>
<?php $partialLayout->blockEnd(); ?>

