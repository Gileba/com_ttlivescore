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
		
		public function getCurrentSetBestOfFive($id)
		{
			$home 	= 0;
			$away 	= 0;
			
			// The livescore is in the first set
			if (($this->match->homeset1 < 11 && $this->match->awayset1 < 11) || (abs($this->match->homeset1 - $this->match->awayset1) < 2))
			{
				return 1;
			}
			
			// If the first set has finished, appoint set winner
			$this->match->homeset1 > $this->match->awayset1 ? $home++ : $away++;

			// The livescore is in the second set
			if (($this->match->homeset2 < 11 && $this->match->awayset2 < 11) || (abs($this->match->homeset1 - $this->match->awayset2) < 2))
			{
				return 2;
			}
			
			// If the second set has finished, appoint set winner
			$this->match->homeset2 > $this->match->awayset2 ? $home++ : $away++;

			// The livescore is in the third set
			if (($this->match->homeset3 < 11 && $this->match->awayset3 < 11) || (abs($this->match->homeset3 - $this->match->awayset3) < 2))
			{
				return 3;
			}
			
			// If the third set has finished, appoint set winner
			$this->match->homeset3 > $this->match->awayset3 ? $home++ : $away++;
			
			// If one of the players has won three sets, the match has ended
			if ($home == 3 || $away == 3) { return 3; }

			// The livescore is in the fourth set
			if (($this->match->homeset4 < 11 && $this->match->awayset4 < 11) || (abs($this->match->homeset4 - $this->match->awayset4) < 2))
			{
				return 4;
			}
			
			// If the fourth set has finished, appoint set winner
			$this->match->homeset4 > $this->match->awayset4 ? $home++ : $away++;

			// If one of the players has won three sets, the match has ended
			if ($home == 3 || $away == 3) { return 4; }
			
			// We are in the fifth and final set
			return 5;
		}
	
		public function getCurrentSetBestOfSeven($id)
		{
			$home 	= 0;
			$away 	= 0;
		
			// The livescore is in the first set
			if (($this->match->homeset1 < 11 && $this->match->awayset1 < 11) || (abs($this->match->homeset1 - $this->match->awayset1) < 2))
			{
				return 1;
			}
			// If the first set has finished, appoint set winner
			$this->match->homeset1 > $this->match->awayset1 ? $home++ : $away++;

			// The livescore is in the second set
			if (($this->match->homeset2 < 11 && $this->match->awayset2 < 11) || (abs($this->match->homeset1 - $this->match->awayset2) < 2))
			{
				return 2;
			}
			// If the second set has finished, appoint set winner
			$this->match->homeset2 > $this->match->awayset2 ? $home++ : $away++;

			// The livescore is in the third set
			if (($this->match->homeset3 < 11 && $this->match->awayset3 < 11) || (abs($this->match->homeset3 - $this->match->awayset3) < 2))
			{
				return 3;
			}
			// If the third set has finished, appoint set winner
			$this->match->homeset3 > $this->match->awayset3 ? $home++ : $away++;
			
			// The livescore is in the fourth set
			if (($this->match->homeset4 < 11 && $this->match->awayset4 < 11) || (abs($this->match->homeset4 - $this->match->awayset4) < 2))
			{
				return 4;
			}
			// If the fourth set has finished, appoint set winner
			$this->match->homeset4 > $this->match->awayset4 ? $home++ : $away++;

			// If the match is a best-of-seven and one of the players has won four sets, the match has ended
			if ($home == 4 || $away == 4) { return 4; }

			// The livescore is in the fifth set
			if (($this->match->homeset5 < 11 && $this->match->awayset5 < 11) || (abs($this->match->homeset5 - $this->match->awayset5) < 2))
			{
				return 5;
			}
			
			// If the fifth set has finished, appoint set winner
			$this->match->homeset5 > $this->match->awayset5 ? $home++ : $away++;

			// If the match is a best-of-seven and one of the players has won four sets, the match has ended
			if ($home == 4 || $away == 4) { return 5; }

			// The livescore is in the sixth set
			if (($this->match->homeset6 < 11 && $this->match->awayset6 < 11) || (abs($this->match->homeset6 - $this->match->awayset6) < 2))
			{
				return 6;
			}
			
			// If the sixth set has finished, appoint set winner
			$this->match->homeset6 > $this->match->awayset6 ? $home++ : $away++;

			// If the match is a best-of-seven and one of the players has won four sets, the match has ended
			if ($home == 4 || $away == 4) { return 6; }

			// We are in the seventh and final set of a best-of-seven
			return 7;
		}
	
		public function getCurrentSet($id)
		{
			$this->match = $this->getMatch($id);
			
			switch ($this->match->numberofsets)
			{
				case 7:
					return $this->getCurrentSetBestOfSeven($id);
				default:
					return $this->getCurrentSetBestOfFive($id);
			}
		}
	}