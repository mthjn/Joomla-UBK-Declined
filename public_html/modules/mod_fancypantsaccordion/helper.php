<?php

#@license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

defined('_JEXEC') or die;

jimport('joomla.application.component.model');
JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');

abstract class mod_fancypantsaccordionHelper{

	public function getList($params){
		$app = JFactory::getApplication();
		$db	= JFactory::getDbo();
		//calls to application

		//get an instance of generic article model
		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		//set the application parameters
		$appParams = JFactory::getApplication()->getParams();
		$model->setState('params',$appParams);

		//start the list of content from the beginning
		$model->setState('list.start',0);

		//gets how many to stop at from parameters or sets as 5
		$model->setState('list.limit',(int) $params->get('count',5));

		//filters out unpublished content
		$model->setState('filter.published',1);

		//lists fields to return
		$model->setState('a.id, a.fulltext, a.title, a.alias, a.title_alias, a.introtext, a.state, a.catid');


		//sorts out the ordering
		switch($params->get('ordering'))
		{
			case 'pubAsc':
				$model->setState('list.ordering','publish_up');
				$model->setState('list.direction', 'ASC');
				break;
			case 'pubDesc':
				$model->setState('list.ordering','publish_up');
				$model->setState('list.direction', 'DESC');
				break;
			case 'dsc':
				$model->setState('list.ordering','a.ordering');
				$model->setState('list.direction', 'DESC');
				break;
			case 'asc':
				$model->setState('list.ordering','a.ordering');
				$model->setState('list.direction','ASC');
				break;
			case 'alpasc':
				$model->setState('list.ordering','a.title');
				$model->setState('list.direction', 'DESC');
				break;
			case 'alpdesc':
				$model->setState('list.ordering','a.title');
				$model->setState('list.direction','ASC');
				break;
			case 'random':
				$model->setState('list.ordering','rand()');
				break;
			case 'rcnt':
			default:
				$model->setState('list.ordering', 'a.created');
				$model->setState('list.direction', 'DESC');
				break;
		}

		//sets access levels on articles for non registered etc
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$model->setState('filter.access',$access);

		//filter out by category we defined in xml
		$model->setState('filter.category_id',$params->get('catid',array()));

		//filter out other languages
		$model->setState('filter.language',$app->getLanguageFilter());

		if($params->get('feat') == 1){
			$model->setState('filter.featured','only');
		}

		$items = $model->getItems();
		return $items;

	}

	public function load_jquery(&$params){
		if($params->get('load_jquery')){
			JLoader::import( 'joomla.version' );
			$version = new JVersion();
			if (version_compare( $version->RELEASE, '2.5', '<=')) {
					$doc = &JFactory::getDocument();
					$app = &JFactory::getApplication();
					$file='//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js';
					$file2=JURI::root(true).'/modules/mod_fancypantsaccordion/assets/js/no-conflict.js';
					$doc->addScript($file);
					$doc->addScript($file2);
			} else {
				JHtml::_('jquery.framework');
			}
		}
	}

}
