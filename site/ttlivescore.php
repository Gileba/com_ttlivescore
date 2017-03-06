<?php
	defined ('_JEXEC') or die;
	
	$controller = JControllerLegacy::getInstance('TTLivescore');
	$controller->execute(JFactory::getApplication()->input->get('task'));
	$controller->redirect();
?>