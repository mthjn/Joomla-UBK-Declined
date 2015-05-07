<?php

#@license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

/* FANCY PANTS ACCORDION */

defined('_JEXEC') or die;
JHtml::_('behavior.framework', true);

// add the helper file becuase we need it...
require_once(dirname(__FILE__).'/helper.php');

// define document
$doc =& JFactory::getDocument();

// add stylesheey
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_fancypantsaccordion/assets/css/style.css', 'text/css' );

// get the list of articles (passing in paramaters)
$list = mod_fancypantsaccordionHelper::getList($params);

//keeps module class suffix even if templateer tries to stop it
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

// do we need jquery? Run that method and pass in the params
mod_fancypantsaccordionHelper::load_jquery($params);

// this figures out if they want the pop to top functionality and loads in the relevant js
if($params->get('poptotop','1')){
	$doc->addScript(JURI::base(true) . '/modules/mod_fancypantsaccordion/assets/js/accordion_with_scroll.min.js');
} else{
	$doc->addScript(JURI::base(true) . '/modules/mod_fancypantsaccordion/assets/js/accordion_with_no_scroll.min.js');
}

// get the template
require(JModuleHelper::getLayoutPath('mod_fancypantsaccordion'));
