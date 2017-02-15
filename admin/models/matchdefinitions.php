<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelMatchdefinitions extends JModelList
	{
		public function __construct($config = array())
		{
			if (empty($config['filter_fields']))
			{
				$config['filter_fields'] = array(
					'id' ,'a.id', 
					'name', 'a.name', 
					'ordering', 'a.ordering',
				);
			}
			parent::__construct($config);
		}
		
		protected function populateState($ordering = null, $direction = null)
		{
			$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
			$this->setState('filter.search', $search);
			
			parent::populateState('a.name', 'asc');
		}
			
		protected function getListQuery()
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);
			$orderCol = $this->state->get('list.ordering');
			$orderDirn = $this->state->get('list.direction');
			
			$query
				->select($db->quoteName(array('a.id', 'a.name', 'a.ordering')))
				->from($db->quoteName('#__ttlivescore_matchdefinitions', 'a'))
				->order($orderCol . ' ' . $orderDirn);
			
			$published = $this->getState('filter.state');
 
			//Filter by search in name
			$search = $this->getState('filter.search');

			if(!empty($search)){
				$like = $db->quote('%' . $search . '%');
				$query->where('(a.name LIKE ' . $like . ')');
			}
			
			return $query;
		}
	}