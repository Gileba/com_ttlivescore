<?php
	defined('_JEXEC') or die;
	

	class TTLivescoreModelLivescore extends JModelAdmin 
	{
		protected $text_prefix 	= 'COM_TTLIVESCORE';
		protected $match;
		
		public function getTable($type = 'Livescore', $prefix = 'TTLivescoreTable', $config = array())
		{
			return JTable::getInstance($type, $prefix, $config);
		}
		
		public function getForm($data = array(), $loadData = true)
		{
			$form = $this->loadForm('com_ttlivescore.livescore', 'livescore', array('control' => 'jform', 'load_data' => $loadData));
			if (empty($form))
			{
				return false;
			}
			
			return $form;
		}
		
		protected function loadFormData()
		{
			$data = JFactory::getApplication()->getUserState('com_ttlivescore.edit.livescore.data', array());
			
			if (empty($data))
			{
				$data = $this->getItem();
			}
			
			return $data;
		}

		protected function getMatch($id)
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);

			$query
				->select($db->quoteName(array('a.homepointsset1', 'a.homepointsset2', 'a.homepointsset3', 'a.homepointsset4', 'a.homepointsset5', 'a.homepointsset5', 'a.homepointsset7', 'a.awaypointsset1', 'a.awaypointsset2', 'a.awaypointsset3', 'a.awaypointsset4', 'a.awaypointsset5', 'a.awaypointsset6', 'a.awaypointsset7', 'md.sets'), array('homeset1', 'homeset2', 'homeset3', 'homeset4', 'homeset5', 'homeset6', 'homeset7', 'awayset1', 'awayset2', 'awayset3', 'awayset4', 'awayset5', 'awayset6', 'awayset7', 'numberofsets')))
				->from($db->quoteName('#__ttlivescore_livescores', 'a'))
				->join('INNER', $db->quoteName('#__ttlivescore_clubmatches', 'cb') . ' ON (' . $db->quoteName('a.cmid') . ' = ' . $db->quoteName('cb.id') . ')')
				->join('INNER', $db->quoteName('#__ttlivescore_matchdefinitions', 'md') . ' ON (' . $db->quoteName('cb.mdid') . ' = ' . $db->quoteName('md.id') . ')')
				->where($db->quoteName('a.id') . ' = ' . $id);
			
			$db->setQuery($query);
			$db->execute();
			
			return $db->loadobject();
		}
		
		public function getPlayername($id)
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);

			$query
				->select($db->quoteName(array('a.lastname', 'a.firstname', 'a.middlename'), array('lastname', 'firstname', 'middlename')))
				->from($db->quoteName('#__ttlivescore_players', 'a'))
				->where($db->quoteName('a.id') . ' = ' . $id);
			
			$db->setQuery($query);
			$db->execute();
			
			$result = $db->loadobject();
			
			$player = $result->lastname;
			if ($result->middlename !== '')
			{
				$player .= ' (' . $result->middlename . ')';
			}
			$player .= ', ' . $result->firstname;
			
			return $player;
		}
		
		public function getCurrentSet($id)
		{
			$this->match 	= $this->getMatch($id);
			$home 			= 0;
			$away 			= 0;
			$homesets 		= array($this->match->homeset1, $this->match->homeset2, $this->match->homeset3, $this->match->homeset4, $this->match->homeset5, $this->match->homeset6, $this->match->homeset7);
			$awaysets 		= array ($this->match->awayset1, $this->match->awayset2, $this->match->awayset3, $this->match->awayset4, $this->match->awayset5, $this->match->awayset6, $this->match->awayset7);
			
			for ($i = 0; $i < $this->match->numberofsets; $i++)
			{
				if (($homesets[$i] < 11 && $awaysets[$i] < 11) || ((abs($homesets[$i] - $awaysets[$i]) < 2)))
				{
					return $i + 1;
				}
				
				$homesets[$i] > $awaysets[$i] ? $home++ : $away++;
				
				if ($home > ($this->match->numberofsets / 2) || $away > ($this->match->numberofsets / 2)) {
					return $i + 1;
				}
			}
			
			return $i + 1;
		}
	}