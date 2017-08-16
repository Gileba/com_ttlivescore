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
		
		public static function addSubmenu($vname = 'clubmatches')
		{
			JHtmlSidebar::addEntry(
				JText::_('COM_TTLIVESCORE_SUBMENU_CLUBMATCHES'),
				'index.php?option=com_ttlivescore&view=clubmatches',
				$vname === 'clubmatches'
			);
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
				JText::_('COM_TTLIVESCORE_SUBMENU_SEASONS'),
				'index.php?option=com_ttlivescore&view=seasons',
				$vname === 'seasons'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_TTLIVESCORE_SUBMENU_SEASONDETAILS'),
				'index.php?option=com_ttlivescore&view=seasondetails',
				$vname === 'seasondetails'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_TTLIVESCORE_SUBMENU_MATCHDEFINITIONS'),
				'index.php?option=com_ttlivescore&view=matchdefinitions',
				$vname === 'matchdefinitions'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_TTLIVESCORE_SUBMENU_COUNTRIES'),
				'index.php?option=com_ttlivescore&view=countries',
				$vname === 'countries'
			);
		}

		public static function getPlayername($id)
		{
			$db	= JFactory::getDbo();
			$query = $db->getQuery(true);
			$query
				->select($db->quoteName(array('a.lastname', 'a.firstname', 'a.middlename'), array('lastname', 'firstname', 'middlename')))
				->from($db->quoteName('#__ttlivescore_players', 'a'))
				->where($db->quoteName('a.id') . ' = ' . (int) $id);
			
			$db->setQuery($query);
			$db->execute();
			
			$result = $db->loadobject();
			
			$player = $result->lastname;
			if ($result->middlename !== '')
			{
				$player .= ' (' . $result->middlename . ')';
			}
			$player .= ', ' . $result->firstname;
			
			return $player;
		}
	}
