<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelPlayers extends JModelList
	{
		public function __construct($config = array())
		{
			if (empty($config['filter_fields']))
			{
				$config['filter_fields'] = array(
					'id' ,'a.id', 
					'lastname', 'a.lastname', 
					'firstname', 'a.firstname', 
					'middlename', 'a.middlename', 
					'country', 'a.country', 
					'published', 'a.published', 
					'dateofbirth', 'a.dateofbirth', 
					'image', 'a.image',
					'publish_up', 'a.publish_up',
					'publish_down', 'a.publish_down'
					);
			}
			parent::__construct($config);
		}
		
		protected function populateState($ordering = null, $direction = null)
		{
			$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
			$this->setState('filter.search', $search);
			
			$published = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
			$this->setState('filter.state', $published);
			
			parent::populateState('a.lastname', 'asc');
		}
			
		protected function getListQuery()
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);
			$orderCol = $this->state->get('list.ordering');
			$orderDirn = $this->state->get('list.direction');
			
			$query
				->select($db->quoteName(array('a.id', 'a.lastname', 'a.firstname', 'a.middlename', 'a.country', 'a.published', 'a.dateofbirth', 'a.image', 'a.publish_up', 'a.publish_down')))
				->from($db->quoteName('#__ttlivescore_players', 'a'))
				->order($orderCol . ' ' . $orderDirn);
			
			$published = $this->getState('filter.state');
			if (is_numeric($published))
			{
				$query->where('a.published = ' . (int) $published);
			}
			elseif ($published === '')
			{
				$query->where('(a.published IN (0, 1))');
			}
			
			//Filter by search in name
			$search = $this->getState('filter.search');

			if(!empty($search)){
				$like = $db->quote('%' . $search . '%');
				$query->where('(a.lastname LIKE ' . $like . ' OR a.firstname LIKE ' . $like . ')');
			}
			
			return $query;
		}
	}