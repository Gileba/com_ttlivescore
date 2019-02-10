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
		
		protected function populateState($ordering = 'a.id', $direction = 'desc')
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
				->select($db->quoteName(array('a.id', 's.name', 'hc.name', 'ac.name', 'a.date', 'a.livescorescreated'), array('id', 'season', 'homeclub', 'awayclub', 'matchdate', 'livescorescreated')))
				->from($db->quoteName('#__ttlivescore_clubmatches', 'a'))
				->join('INNER', $db->quoteName('#__ttlivescore_clubs', 'hc') . ' ON (' . $db->quoteName('a.homeclub') . ' = ' . $db->quoteName('hc.id') . ')')
				->join('INNER', $db->quoteName('#__ttlivescore_clubs', 'ac') . ' ON (' . $db->quoteName('a.awayclub') . ' = ' . $db->quoteName('ac.id') . ')')
				->join('INNER', $db->quoteName('#__ttlivescore_seasons', 's') . ' ON (' . $db->quoteName('a.sid') . ' = ' . $db->quoteName('s.id') . ')')
				->order($orderCol . ' ' . $orderDirn);
			
			//Filter by search in name
			$search = $this->getState('filter.search');

			if(!empty($search)){
				$like = '%' . $db->escape($search, true) . '%';
				$query->where('(hc.name LIKE ' . $db->quote($like, false) . ' OR ac.name LIKE ' . $db->quote($like, false) . ')');
			}
			
			return $query;
		}
	}