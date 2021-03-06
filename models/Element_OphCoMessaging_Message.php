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

namespace OEModule\OphCoMessaging\models;

/**
 * This is the model class for table "et_ophcomessaging_message".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $for_the_attention_of
 * @property integer $message_type_id
 * @property integer $urgent
 * @property string $message_text
 * @property integer $marked_as_read
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphCoMessaging_Message_MessageType $message_type
 */

class Element_OphCoMessaging_Message extends \BaseEventTypeElement
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophcomessaging_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('event_id, for_the_attention_of, message_type_id, urgent, message_text, marked_as_read', 'safe'),
			array('for_the_attention_of_user_id, message_type_id, message_text, ', 'required'),
			array('id, event_id, for_the_attention_of_user-id, message_type_id, urgent, message_text, marked_as_read', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
            'for_the_attention_of_user' => array(self::BELONGS_TO, 'User', 'for_the_attention_of_user_id'),
			'message_type' => array(self::BELONGS_TO, 'OEModule\\OphCoMessaging\\models\\OphCoMessaging_Message_MessageType', 'message_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'for_the_attention_of_user_id' => 'For the attention of',
			'message_type_id' => 'Message Type',
			'urgent' => 'Urgent',
			'marked_as_read' => 'Mark as read',
			'message_text' => 'Message Text',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new \CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('for_the_attention_of_user_id', $this->for_the_attention_of_user_id  );
		$criteria->compare('message_type_id', $this->message_type_id);
		$criteria->compare('urgent', $this->urgent);
		$criteria->compare('marked_as_read', $this->marked_as_read);
		$criteria->compare('message_text', $this->message_text);
        $criteria->order = 'created_date desc';

		return new \CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

    public function getMessageDate()
    {
        return $this->event->event_date;
    }



	protected function afterSave()
	{

		return parent::afterSave();
	}
}
?>