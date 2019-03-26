<?php
	defined('_JEXEC') or die;

	JLoader::register('TTLivescoreHelper', JPATH_ADMINISTRATOR . '/components/com_ttlivescore/helpers/ttlivescore.php');

class TTLivescoreModelClubmatch extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id' ,'a.id',
				'season', 's.id',
				'homeclub', 'hc.name',
				'awayclub', 'ac.name',
				'matchdate', 'a.date',
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		$id = JRequest::getInt('id');
		$this->setState('id', $id);
	}

	protected function getListQuery()
	{
		$db	= $this->getDbo();
		$query = $db->getQuery(true);

		$query
			->select($db->quoteName(
				array('a.id', 'a.cmid', 'a.homeplayerid', 'a.awayplayerid', 'a.homepointsset1', 'a.homepointsset2', 'a.homepointsset3', 
					'a.homepointsset4', 'a.homepointsset5', 'a.homepointsset5', 'a.homepointsset7', 'a.awaypointsset1', 'a.awaypointsset2', 
					'a.awaypointsset3', 'a.awaypointsset4', 'a.awaypointsset5', 'a.awaypointsset6', 'a.awaypointsset7', 'cm.homeclub', 'cm.awayclub', 
					'md.matches'
				), 
				array('id', 'cmid', 'homeplayerid', 'awayplayerid', 'homeset1', 'homeset2', 
					'homeset3', 'homeset4', 'homeset5', 'homeset6', 'homeset7', 'awayset1', 'awayset2', 'awayset3', 'awayset4', 'awayset5', 
					'awayset6', 'awayset7', 'homeclub', 'awayclub', 'matches'
				)
			))
			->from($db->quoteName('#__ttlivescore_livescores', 'a'))
			->join('INNER', $db->quoteName('#__ttlivescore_clubmatches', 'cm') . 
				' ON (' . $db->quoteName('a.cmid') . ' = ' . $db->quoteName('cm.id') . ')')
			->join('INNER', $db->quoteName('#__ttlivescore_matchdefinitions', 'md') . 
				' ON (' . $db->quoteName('cm.mdid') . ' = ' . $db->quoteName('md.id') . ')');
		if ($id = $this->getState('id'))
		{
			$query->where($db->quoteName('a.cmid') . ' = ' . (int) $id);
		}

		return $query;
	}

	protected function getSetScoreQuery($id)
	{
		$db	= $this->getDbo();
		$query = $db->getQuery(true);

		$query
			->select($db->quoteName(
				array('a.homepointsset1', 'a.homepointsset2', 'a.homepointsset3', 'a.homepointsset4', 'a.homepointsset5', 'a.homepointsset5', 
					'a.homepointsset7', 'a.awaypointsset1', 'a.awaypointsset2', 'a.awaypointsset3', 'a.awaypointsset4', 'a.awaypointsset5', 
					'a.awaypointsset6', 'a.awaypointsset7','a.id', 'a.cmid', 'md.sets', 'cm.homeclub', 'cm.awayclub'
				), 
				array('homeset1', 'homeset2', 'homeset3', 'homeset4', 'homeset5', 'homeset6', 'homeset7', 'awayset1', 'awayset2', 'awayset3', 
					'awayset4', 'awayset5', 'awayset6', 'awayset7', 'id', 'clubmatchid', 'numberofsets', 'homeclub', 'awayclub'
				)
			))
			->from($db->quoteName('#__ttlivescore_livescores', 'a'))
			->join('INNER', $db->quoteName('#__ttlivescore_clubmatches', 'cm') . 
				' ON (' . $db->quoteName('a.cmid') . ' = ' . $db->quoteName('cm.id') . ')')
			->join('INNER', $db->quoteName('#__ttlivescore_matchdefinitions', 'md') . 
				' ON (' . $db->quoteName('cm.mdid') . ' = ' . $db->quoteName('md.id') . ')')
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

		return $db->loadobjectList();
	}

	public function getSetScore($id)
	{
		$scores 	= $this->getSetScoreQuery($id);

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
					break 2;
				}

				if ($away > ($scores[$i]->numberofsets / 2))
				{
					break 2;
				}
			}
		}

		return array('home' => $home, 'away' => $away);
	}

	public function getLivescore($id)
	{
		$scores 	= $this->getSetScoreQuery($id);
		$homesets	= array(0);
		$awaysets	= array(0);

		for ($i = 0; $i < count($scores); $i++)
		{
			$homesets 	= array($scores[$i]->homeset1, $scores[$i]->homeset2, $scores[$i]->homeset3, $scores[$i]->homeset4, $scores[$i]->homeset5, $scores[$i]->homeset6, $scores[$i]->homeset7);
			$awaysets 	= array ($scores[$i]->awayset1, $scores[$i]->awayset2, $scores[$i]->awayset3, $scores[$i]->awayset4, $scores[$i]->awayset5, $scores[$i]->awayset6, $scores[$i]->awayset7);
		}

		return array('home' => $homesets, 'away' => $awaysets);
	}

	public function getShortScore($id, $set)
	{
		$scores 	= $this->getSetScoreQuery($id);

		switch ($set) {
			case "1":
				$homeset	= $scores[0]->homeset1;
				$awayset	= $scores[0]->awayset1;
				break;
			case "2":
				$homeset	= $scores[0]->homeset2;
				$awayset	= $scores[0]->awayset2;
				break;
			case "3":
				$homeset	= $scores[0]->homeset3;
				$awayset	= $scores[0]->awayset3;
				break;
			case "4":
				$homeset	= $scores[0]->homeset4;
				$awayset	= $scores[0]->awayset4;
				break;
			case "5":
				$homeset	= $scores[0]->homeset5;
				$awayset	= $scores[0]->awayset5;
				break;
			case "6":
				$homeset	= $scores[0]->homeset6;
				$awayset	= $scores[0]->awayset6;
				break;
			case "7":
				$homeset	= $scores[0]->homeset7;
				$awayset	= $scores[0]->awayset7;
				break;
		}

		if ($homeset < $awayset) {
			return "-" . $homeset;
		}

		return $awayset;
	}

	public function getClubname($id)
	{
		$db	= $this->getDbo();
		$query = $db->getQuery(true);

		$query
			->select($db->quoteName(array('a.name'), array('name')))
			->from($db->quoteName('#__ttlivescore_clubs', 'a'))
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

		return $result->name;
	}

	public function getCurrentMatch($id)
	{
		$currentScore = TTLivescoreHelper::getScore($id);
		return $currentScore['home'] + $currentScore['away'] + 1;
	}
}
