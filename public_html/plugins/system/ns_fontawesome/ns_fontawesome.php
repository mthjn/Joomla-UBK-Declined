<?php
/**
* @version		v3.0
* @package	Joomla!®
* @copyright	Copyright © 2011 Natural Selection Web Design LLC.
* @support      http://nsel.co
* @license		GNU/GPL, see license.txt
*/

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgSystemns_fontawesome extends JPlugin {
	/**
	 * Constructor.
	 */
	function plgSystems_fontawesome(&$subject, $config) {
		parent::__construct($subject, $config);
	}

	//public function onAfterInitialise() {
		public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
	    $document = JFactory::getDocument();
	    $document->addStyleSheet(JURI::base(). "plugins/system/ns_fontawesome/fontawesome/css/font-awesome.css");
	}
}