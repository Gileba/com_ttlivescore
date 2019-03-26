<?php
	defined('_JEXEC') or die;

	JHtml::stylesheet('com_ttlivescore/site.stylesheet.css', array(), true);

	$controller = JControllerLegacy::getInstance('TTLivescore');
	$controller->execute(JFactory::getApplication()->input->getWord('task'));
	$controller->redirect();
