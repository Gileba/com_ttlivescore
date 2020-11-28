<?php
	defined('_JEXEC') or die;

class TTLivescoreModelClubmatches extends JModelList
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
				'matchdate', 'a.date'
			);
		}

		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$date = new JDate('now - 12 hours');
		$db	= $this->getDbo();
		$query = $db->getQuery(true);

		$query
			->select(
				$db->quoteName(
					array('a.id', 's.name', 'hc.name', 'ac.name', 'a.date', 'a.livescorescreated'),
					array('id', 'season', 'homeclub', 'awayclub', 'matchdate', 'livescorescreated')
				)
			)
			->from($db->quoteName('#__ttlivescore_clubmatches', 'a'))
			->join('INNER', $db->quoteName('#__ttlivescore_clubs', 'hc') . ' ON (' . $db->quoteName('a.homeclub') . ' = ' . $db->quoteName('hc.id') .
				')'
			)
			->join('INNER', $db->quoteName('#__ttlivescore_clubs', 'ac') . ' ON (' . $db->quoteName('a.awayclub') . ' = ' . $db->quoteName('ac.id') .
				')'
			)
			->join('INNER', $db->quoteName('#__ttlivescore_seasons', 's') . ' ON (' . $db->quoteName('a.sid') . ' = ' . $db->quoteName('s.id') . ')')
			->where($db->quoteName('a.livescorescreated') . ' = 1')
			->where($db->quoteName('a.date') . " >= " . $db->quote($date->toSql(false, $db), false));

		return $query;
	}
}
