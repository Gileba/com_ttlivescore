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
		try
		{
			$db->execute();
		}
		catch (Exception $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage());
		}

		$result = $db->loadobject();

		$player = $result->lastname;
		if ($result->middlename !== '')
		{
			$player .= ' (' . $result->middlename . ')';
		}

		$player .= ', ' . $result->firstname;

		return $player;
	}

	protected static function getScoreQuery($id)
	{
		$db	= JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->select($db->quoteName(array('a.homepointsset1', 'a.homepointsset2', 'a.homepointsset3', 'a.homepointsset4', 'a.homepointsset5', 'a.homepointsset5', 'a.homepointsset7', 'a.awaypointsset1', 'a.awaypointsset2', 'a.awaypointsset3', 'a.awaypointsset4', 'a.awaypointsset5', 'a.awaypointsset6', 'a.awaypointsset7','a.id', 'a.cmid', 'md.sets'), array('homeset1', 'homeset2', 'homeset3', 'homeset4', 'homeset5', 'homeset6', 'homeset7', 'awayset1', 'awayset2', 'awayset3', 'awayset4', 'awayset5', 'awayset6', 'awayset7', 'id', 'clubmatchid', 'numberofsets')))
			->from($db->quoteName('#__ttlivescore_livescores', 'a'))
			->join('INNER', $db->quoteName('#__ttlivescore_clubmatches', 'cm') . ' ON (' . $db->quoteName('a.cmid') . ' = ' .
			$db->quoteName('cm.id') . ')')
			->join('INNER', $db->quoteName('#__ttlivescore_matchdefinitions', 'md') . ' ON (' . $db->quoteName('cm.mdid') . ' = ' .
			$db->quoteName('md.id') . ')')
			->where($db->quoteName('a.cmid') . ' = ' . (int) $id);

		$db->setQuery($query);
		try
		{
			$db->execute();
		}
		catch (Exception $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage());
		}

		return $db->loadobjectList();
	}

	public static function getScore($id)
	{
		$scores 	= self::getScoreQuery($id);
		$homeclub 	= 0;
		$awayclub 	= 0;

		for ($i = 0; $i < count($scores); $i++)
		{
			$home 		= 0;
			$away		= 0;
			$homesets 	= array($scores[$i]->homeset1, $scores[$i]->homeset2, $scores[$i]->homeset3, $scores[$i]->homeset4, $scores[$i]->homeset5, $scores[$i]->homeset6, $scores[$i]->homeset7);
			$awaysets 	= array ($scores[$i]->awayset1, $scores[$i]->awayset2, $scores[$i]->awayset3, $scores[$i]->awayset4, $scores[$i]->awayset5, $scores[$i]->awayset6, $scores[$i]->awayset7);

			for ($j = 0; $j < $scores[$i]->numberofsets; $j++)
			{
				if (($homesets[$j] < 11 && $awaysets[$j] < 11) || ((abs($homesets[$j] - $awaysets[$j]) < 2)))
				{
					break 2;
				}

				$homesets[$j] > $awaysets[$j] ? $home++ : $away++;

				if ($home > ($scores[$i]->numberofsets / 2))
				{
					$homeclub++;
					break;
				}

				if ($away > ($scores[$i]->numberofsets / 2))
				{
					$awayclub++;
					break;
				}
			}
		}

		return array('home' => $homeclub, 'away' => $awayclub);
	}

}
