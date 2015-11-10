<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>

<div class="element-fields row">
	<div class="element-fields">
        <div class="row field-row">
            <div class="large-2 column"><label>For the attention of:</label></div>

            <div class="large-4 column autocomplete-row">
                <span id="fao_user_display"><?php echo $element->for_the_attention_of_user ? $element->for_the_attention_of_user->getFullnameAndTitle() : ""; ?></span>
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => "find_user",
                    'id' => "find-user",
                    'value'=>'',
                    'source'=>"js:function(request, response) {
                                $.ajax({
                                    'url': '" . Yii::app()->createUrl('/OphCoMessaging/default/userfind') . "',
                                    'type':'GET',
                                    'data':{'search': request.term},
                                    'success':function(data) {
                                        data = $.parseJSON(data);
                                        response(data);
                                    }
                                });
                            }",
                    'options' => array(
                        'minLength'=>'3',
                        'select' => "js:function(event, ui) {
                                    $('#fao_user_display').html(ui.item.label);
                                    $('#Element_OphCoMessaging_Message_for_the_attention_of_user_id').val(ui.item.id);
                                    $('#find-user').val('');
                                    return false;
                                }",
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'search by name or username'
                    ),
                ));
                ?>
            </div>
            <?php echo $form->hiddenField($element, 'for_the_attention_of_user_id'); ?>
    </div>
	<?php echo $form->dropDownList($element, 'message_type_id', CHtml::listData(OphCoMessaging_Message_MessageType::model()->findAll(array('order'=> 'display_order asc')),'id','name'),array('empty'=>'- Please select -'), false, array('field' => 4))?>
	<?php echo $form->radioBoolean($element, 'urgent')?>
	<?php echo $form->textArea($element, 'message_text', array('rows' => 6, 'cols' => 80))?>
	</div>
</div>
