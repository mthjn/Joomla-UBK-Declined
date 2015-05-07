<?php
/**
* @version		v1.3
* @package	Joomla!®
* @copyright	Copyright © 2011 Natural Selection Web Design LLC.
* @support      http://nsel.co
* @license		GNU/GPL, see license.txt
*/

// no direct access
defined('_JEXEC') or die;

class JFormFieldSpacera extends JFormField
{
	public $type = 'Spacera';

	protected function getInput()
	{
		if ($this->value) {
			return JText::_($this->value);
		} else {
			return '<div style="width:350px;font-family:arial;font-size:13px;">Having Trouble? <a style="font-family:arial;color:#828627;" target="blank" href="http://nswd.co/forum/">Support Here</a></div>';
		}
	}
}
