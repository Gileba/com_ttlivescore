<?php
	defined('_JEXEC') or die;
	
	class TTLivescoreModelClubmatches extends JModelList
	{
		public function __construct($config = array())
		{
			if (empty($config['filter_fields']))
			{
				$config['filter_fields'] = array(
					'id' ,'a.id', 
					'season', 's.id',
					'homeclub', 'hc.name',
					'awayclub', 'ac.name',
					'matchdate', 'a.date'
				);
			}
			
			parent::__construct($config);
		}
		
		protected function getListQuery()
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);
			
			$query
				->select($db->quoteName(array('a.id', 's.name', 'hc.name', 'ac.name', 'a.date', 'a.livescorescreated'), array('id', 'season', 'homeclub', 'awayclub', 'matchdate', 'livescorescreated')))
				->from($db->quoteName('#__ttlivescore_clubmatches', 'a'))
				->join('INNER', $db->quoteName('#__ttlivescore_clubs', 'hc') . ' ON (' . $db->quoteName('a.homeclub') . ' = ' . $db->quoteName('hc.id') . ')')
				->join('INNER', $db->quoteName('#__ttlivescore_clubs', 'ac') . ' ON (' . $db->quoteName('a.awayclub') . ' = ' . $db->quoteName('ac.id') . ')')
				->join('INNER', $db->quoteName('#__ttlivescore_seasons', 's') . ' ON (' . $db->quoteName('a.sid') . ' = ' . $db->quoteName('s.id') . ')');
			
			return $query;
		}
		
		protected function getScoreQuery($id)
		{
			$db	= $this->getDbo();
			$query = $db->getQuery(true);
			
			$query
				->select($db->quoteName(array('a.homepointsset1', 'a.homepointsset2', 'a.homepointsset3', 'a.homepointsset4', 'a.homepointsset5', 'a.homepointsset5', 'a.homepointsset7', 'a.awaypointsset1', 'a.awaypointsset2', 'a.awaypointsset3', 'a.awaypointsset4', 'a.awaypointsset5', 'a.awaypointsset6', 'a.awaypointsset7','a.id', 'a.cmid', 'md.sets'), array('homeset1', 'homeset2', 'homeset3', 'homeset4', 'homeset5', 'homeset6', 'homeset7', 'awayset1', 'awayset2', 'awayset3', 'awayset4', 'awayset5', 'awayset6', 'awayset7', 'id', 'clubmatchid', 'numberofsets')))
				->from($db->quoteName('#__ttlivescore_livescores', 'a'))
				->join('INNER', $db->quoteName('#__ttlivescore_clubmatches', 'cm') . ' ON (' . $db->quoteName('a.cmid') . ' = ' . $db->quoteName('cm.id') . ')')
				->join('INNER', $db->quoteName('#__ttlivescore_matchdefinitions', 'md') . ' ON (' . $db->quoteName('cm.mdid') . ' = ' . $db->quoteName('md.id') . ')')
				->where($db->quoteName('a.cmid')  . ' = ' . $id);
				
			$db->setQuery($query);
			$db->execute();
			
			return $db->loadobjectList(); 			
		}
		
		public function getScore($id)
		{
			$scores 	= $this->getScoreQuery($id);
			$homeclub 	= 0;
			$awayclub 	= 0;
			
			for ($i = 0; $i < count($scores); $i++)
			{
				$home 		= 0;
				$away		= 0;
				$homesets 	= array($scores[$i]->homeset1, $scores[$i]->homeset2, $scores[$i]->homeset3, $scores[$i]->homeset4, $scores[$i]->homeset5, $scores[$i]->homeset6, $scores[$i]->homeset7);
				$awaysets 	= array ($scores[$i]->awayset1, $scores[$i]->awayset2, $scores[$i]->awayset3, $scores[$i]->awayset4, $scores[$i]->awayset5, $scores[$i]->awayset6, $scores[$i]->awayset7);
			
				for ($j = 0; $j < $scores[$i]->numberofsets; $j++)
				{
					if (($homesets[$j] < 11 && $awaysets[$j] < 11) || ((abs($homesets[$j] - $awaysets[$j]) < 2)))
					{
						break 2;
					}
				
					$homesets[$j] > $awaysets[$j] ? $home++ : $away++;
				
					if ($home > ($scores[$i]->numberofsets / 2))
					{
						$homeclub++;
						break;
					}
					
					if ($away > ($scores[$i]->numberofsets / 2)) 
					{
						$awayclub++;
						break;
					}
				}

			}
			
			return array('home' => $homeclub, 'away' => $awayclub);
		}
	}