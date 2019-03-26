<?php
	defined('_JEXEC') or die;

	class TTLivescoreTableClubmatch extends JTable
	{
		public function __construct(&$db)
		{
			parent::__construct('#__ttlivescore_clubmatches', 'id', $db);
		}
	}
