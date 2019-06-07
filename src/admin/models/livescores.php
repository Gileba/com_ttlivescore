<?php
	defined('_JEXEC') or die;

class TTLivescoreModelLivescores extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id' ,'a.id',
				'homeplayer', 'hp.lastname',
				'awayplayer', 'ap.lastname',
				);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = 'a.id', $direction = 'asc')
	{
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		parent::populateState($ordering, $direction);
	}

	protected function getListQuery()
	{
		$db	= $this->getDbo();
		$query = $db->getQuery(true);
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');

		$query
			->select($db->quoteName(array('a.id', 'a.matchid', 'hp.lastname', 'hp.firstname', 'hp.middlename', 'ap.lastname', 'ap.firstname',
				'ap.middlename', 'a.homepointsset1', 'a.homepointsset2', 'a.homepointsset3', 'a.homepointsset4', 'a.homepointsset5',
				'a.homepointsset5', 'a.homepointsset7', 'a.awaypointsset1', 'a.awaypointsset2', 'a.awaypointsset3', 'a.awaypointsset4',
				'a.awaypointsset5', 'a.awaypointsset6', 'a.awaypointsset7', 'md.sets'), array('id', 'matchid', 'homeplayerlastname',
				'homeplayerfirstname', 'homeplayermiddlename', 'awayplayerlastname', 'awayplayerfirstname', 'awayplayermiddlename', 'homeset1',
				'homeset2', 'homeset3', 'homeset4', 'homeset5', 'homeset6', 'homeset7', 'awayset1', 'awayset2', 'awayset3', 'awayset4', 'awayset5',
				'awayset6', 'awayset7', 'numberofsets')))
			->from($db->quoteName('#__ttlivescore_livescores', 'a'))
			->join('INNER', $db->quoteName('#__ttlivescore_players', 'hp') . ' ON (' . $db->quoteName('a.homeplayerid') . ' = ' .
				$db->quoteName('hp.id') . ')'
			)
			->join('INNER', $db->quoteName('#__ttlivescore_players', 'ap') . ' ON (' . $db->quoteName('a.awayplayerid') . ' = ' .
				$db->quoteName('ap.id') . ')'
			)
			->join('INNER', $db->quoteName('#__ttlivescore_clubmatches', 'cb') . ' ON (' . $db->quoteName('a.cmid') . ' = ' .
				$db->quoteName('cb.id') . ')'
			)
			->join('INNER', $db->quoteName('#__ttlivescore_matchdefinitions', 'md') . ' ON (' . $db->quoteName('cb.mdid') . ' = ' .
				$db->quoteName('md.id') . ')'
			)
			->order($orderCol . ' ' . $orderDirn);

		$cmid = JRequest::getVar('id');
		if ($cmid)
		{
			$query->where($db->quoteName('a.cmid') . ' = ' . (int) $cmid);
		}

		return $query;
	}
}
