<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelLivescore extends JModelAdmin 
	{
		protected $text_prefix = 'COM_TTLIVESCORE';
		
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
			
			return $data;
		}

		public function getCurrentSet($id)
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
			
			$match = $db->loadobject();
			$home = 0;
			$away = 0;
			
			// The livescore is in the first set
			if (($match->homeset1 < 11 && $match->awayset1 < 11) || (abs($match->homeset1 - $match->awayset1) < 2))
			{
				return 1;
			}
			// If the first set has finished, appoint set winner
			$match->homeset1 > $match->awayset1 ? $home++ : $away++;

			// The livescore is in the second set
			if (($match->homeset2 < 11 && $match->awayset2< 11) || (abs($match->homeset1 - $match->awayset2) < 2))
			{
				return 2;
			}
			// If the second set has finished, appoint set winner
			$match->homeset2 > $match->awayset2 ? $home++ : $away++;

			// The livescore is in the third set
			if (($match->homeset3 < 11 && $match->awayset3< 11) || (abs($match->homeset3 - $match->awayset3) < 2))
			{
				return 3;
			}
			// If the third set has finished, appoint set winner
			$match->homeset3 > $match->awayset3 ? $home++ : $away++;
			
			// If the match is a best-of-five and one of the players has won three sets, the match has ended
			if (($match->numberofsets == 5) && ($home == 3 || $away == 3))
			{
				return 3;
			}

			// The livescore is in the fourth set
			if (($match->homeset4 < 11 && $match->awayset4< 11) || (abs($match->homeset4 - $match->awayset4) < 2))
			{
				return 4;
			}
			// If the fourth set has finished, appoint set winner
			$match->homeset4 > $match->awayset4 ? $home++ : $away++;

			// If the match is a best-of-five and one of the players has won three sets, the match has ended
			if (($match->numberofsets == 5) && ($home == 3 || $away == 3))
			{
				return 4;
			}

			if ($match->numberofsets == 7)
			{
				// If the match is a best-of-seven and one of the players has won four sets, the match has ended
				if ($home == 4 || $away == 4)
				{
					return 4;
				}

				// The livescore is in the fifth set
				if (($match->homeset5 < 11 && $match->awayset5< 11) || (abs($match->homeset5 - $match->awayset5) < 2))
				{
					return 5;
				}
				// If the fifth set has finished, appoint set winner
				$match->homeset5 > $match->awayset5 ? $home++ : $away++;

				// If the match is a best-of-seven and one of the players has won four sets, the match has ended
				if ($home == 4 || $away == 4)
				{
					return 5;
				}

				// The livescore is in the sixth set
				if (($match->homeset6 < 11 && $match->awayset6< 11) || (abs($match->homeset6 - $match->awayset6) < 2))
				{
					return 6;
				}
				// If the sixth set has finished, appoint set winner
				$match->homeset6 > $match->awayset6 ? $home++ : $away++;

				// If the match is a best-of-seven and one of the players has won four sets, the match has ended
				if ($home == 4 || $away == 4)
				{
					return 6;
				}

				// We are in the seventh and final set of a best-of-seven
				return 7;
			}
			
			// If the match is a best-of-five, then we are in the fifth and final set
			return 5;
		}
	}