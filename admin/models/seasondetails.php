<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelSeasondetails extends JModelList
	{
		public function __construct($config = array())
		{
			if (empty($config['filter_fields']))
			{
				$config['filter_fields'] = array(
					'id' ,'a.id', 
					'season', 's.name', 
					'player', 'a.player', 
					'club', 'a.club', 
					'localranking', 'a.localranking'
				);
			}
			parent::__construct($config);
		}
		
		protected function populateState($ordering = null, $direction = null)
		{
			$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
			$this->setState('filter.search', $search);
			
			parent::populateState('a.player', 'asc');
		}
			
		protected function getListQuery()
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);
			$orderCol = $this->state->get('list.ordering');
			$orderDirn = $this->state->get('list.direction');
			
			$query
				->select($db->quoteName(array('a.id', 's.name', 'a.player', 'a.club', 'a.localranking')))
				->from($db->quoteName('#__ttlivescore_seasondetails', 'a'))
				->join('INNER', $db->quoteName('#__ttlivescore_seasons', 's') . ' ON (' . $db->quoteName('a.season') . ' = ' . $db->quoteName('s.id') . ')')
				->order($orderCol . ' ' . $orderDirn);
			
			$published = $this->getState('filter.state');
 
/** TODO: Search by name in name or club with join argument
			//Filter by search in name
			$search = $this->getState('filter.search');

			if(!empty($search)){
				$like = $db->quote('%' . $search . '%');
				$query->where('(a.lastname LIKE ' . $like . ' OR a.firstname LIKE ' . $like . ')');
			}
**/
			
			return $query;
		}
	}