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
				->select($db->quoteName(array('a.id', 'a.matchid', 'hp.lastname', 'ap.lastname'), array('id', 'matchid', 'homeplayer', 'awayplayer')))
				->from($db->quoteName('#__ttlivescore_livescores', 'a'))
				->join('INNER', $db->quoteName('#__ttlivescore_players', 'hp') . ' ON (' . $db->quoteName('a.homeplayerid') . ' = ' . $db->quoteName('hp.id') . ')')
				->join('INNER', $db->quoteName('#__ttlivescore_players', 'ap') . ' ON (' . $db->quoteName('a.awayplayerid') . ' = ' . $db->quoteName('ap.id') . ')')
				->order($orderCol . ' ' . $orderDirn);
			
			return $query;
		}
	}