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

class JFormFieldLogo extends JFormField
{
	public $type = 'Logo';

	protected function getInput()
	{
		if ($this->value) {
			return JText::_($this->value);
		} else {
			return '<img border="0" src="../plugins/system/ns_fontawesome/fields/logo.png" width="400" height="91" title="NS Font Awesome" alt="NS Font Awesome">';
		}
	}
}