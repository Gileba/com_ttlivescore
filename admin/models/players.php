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
			$db	= $this->getDbo();
			$query = $db->getQuery(true);
			
			$query
				->select($db->quoteName(array('a.id', 'a.lastname', 'a.firstname')))
				->from($db->quoteName('#__ttlivescore_players', 'a'));
			
			return $query;
		}
	}