<?php
	defined('_JEXEC') or die;
	
	// Check user permissions and return error if manage is prohibited
	if (!JFactory::getUser()->authorize('core.manage', 'com_ttlivescore'))
	{
		return JERROR::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	}
	
	// Create controller and determine the next task
	$controller = JControllerLegacy::getInstance('TTLivescore');
	$controller->execute(JFactory::getApplication()->input->get('task'));
	$controller->redirect();