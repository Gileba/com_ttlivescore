<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelPlayers extends JModelList
	{
		public function __construct($config = array())
		{
			if (empty($config['filter_fields']))
			{
				$config['filter_fields'] = array('id' ,'a.id', 'lastname', 'a.lastname', 'firstname', 'a.firstname');
			}
			parent::__construct($config);
		}
		
		protected function getListQuery()
		{
			$db	= $this->getDBO();
			$query = $db->getQuery(true);
			
			$query->select($this->getState('list.select', 'a.id', 'a.lastname', 'a.firstname'));
			$query->from($db->quoteName('#__ttlivescore_players' . 'AS a'));
			
			return $query;
		}
	}