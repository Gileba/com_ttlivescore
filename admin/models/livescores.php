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
				->select($db->quoteName(array('a.id')))
				->from($db->quoteName('#__ttlivescore_livescores', 'a'))
				->order($orderCol . ' ' . $orderDirn);
			
			return $query;
		}
	}