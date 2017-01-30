<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelPlayers extends JModelList
	{
		public function __construct($config = array())
		{
			if (empty($config['filter_fields']))
			{
				$config['filter_fields'] = array('id' ,'a.id', 'lastname', 'a.lastname', 'firstname', 'a.firstname', 'middlename', 'a.middlename', 'country', 'a.country', 'published', 'a.published', 'dateofbirth', 'a.dateofbirth', 'image', 'a.image', );
			}
			parent::__construct($config);
		}
		
		protected function populateState($ordering = null, $direction = null)
		{
				parent::populateState('a.lastname', 'asc')
		}
			
		protected function getListQuery()
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);
			$orderCol = $this->state->get('list.ordering');
			$orderDirn = $this->state->get('list.directiion');
			
			$query
				->select($db->quoteName(array('a.id', 'a.lastname', 'a.firstname', 'a.middlename', 'a.country', 'a.published', 'a.dateofbirth', 'a.image', )))
				->from($db->quoteName('#__ttlivescore_players', 'a'));
				->order($db->escape($orderCol . ' ' . $orderDirn));
			
			return $query;
		}
	}