<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelCountries extends JModelList
	{
		public function __construct($config = array())
		{
			if (empty($config['filter_fields']))
			{
				$config['filter_fields'] = array(
					'id' ,'a.id', 
					'name', 'a.name', 
					'ioc_code', 'a.ioc_code', 
					'published', 'a.published', 
					'publish_up', 'a.publish_up',
					'publish_down', 'a.publish_down', 
					'ordering', 'a.ordering'
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
			
			parent::populateState('a.ordering', 'asc');
		}
			
		protected function getListQuery()
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);
			$orderCol = $this->state->get('list.ordering');
			$orderDirn = $this->state->get('list.direction');
			
			$query
				->select($db->quoteName(array('a.id', 'a.name', 'a.ioc_code', 'a.published', 'a.ordering', 'a.publish_up', 'a.publish_down', 'a.rankingprefix')))
				->from($db->quoteName('#__ttlivescore_countries', 'a'))
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
				$like = $db->escape('%' . $search . '%', true);
				$query->where('(a.name LIKE ' . $db->quote($like, false) . ')');
			}
			
			return $query;
		}
	}
