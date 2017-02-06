<?php
	defined('_JEXEC') or die;

	class TTLivescoreHelper
	{
		public static function getActions($categoryId = 0)
		{
			$user	= JFactory::getUser();
			$result	= new JObject;
			
			switch (empty($categoryId)) {
				case true:
					$assetName	= 'com_ttlivescore';
					$level		= 'component';
					break;
				default:
					$assetName	= 'com_ttlivescore.category.' . (int) $categoryId;
					$level		= 'category';
					break;
			}
			
			$actions = JAccess::getActions('com_ttlivescore', $level);
			
			foreach ($actions as $action)
			{
				$result->set($action->name, $user->authorise($action->name, $assetName));
			}
			
			return $result;
		}
		
		public static function addSubmenu($vname = 'players')
		{
			JHtmlSidebar::addEntry(
				JText::_('COM_TTLIVESCORE_SUBMENU_PLAYERS'),
				'index.php?option=com_ttlivescore&view=players',
				$vname === 'players'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_TTLIVESCORE_SUBMENU_CLUBS'),
				'index.php?option=com_ttlivescore&view=clubs',
				$vname === 'clubs'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_TTLIVESCORE_SUBMENU_COUNTRIES'),
				'index.php?option=com_ttlivescore&view=countries',
				$vname === 'countries'
			);
		}
	}
