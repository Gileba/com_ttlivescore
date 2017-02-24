<?php
	defined('_JEXEC') or die;
	class TTLivescoreModelClubmatch extends JModelAdmin 
	{
		protected $text_prefix = 'COM_TTLIVESCORE';
		
		public function getTable($type = 'Clubmatch', $prefix = 'TTLivescoreTable', $config = array())
		{
			return JTable::getInstance($type, $prefix, $config);
		}
		
		public function getForm($data = array(), $loadData = true)
		{
			$form = $this->loadForm('com_ttlivescore.clubmatch', 'clubmatch', array('control' => 'jform', 'load_data' => $loadData));
			if (empty($form))
			{
				return false;
			}
			
			return $form;
		}
		
		protected function loadFormData()
		{
			$data = JFactory::getApplication()->getUserState('com_ttlivescore.edit.clubmatch.data', array());
			
			if (empty($data))
			{
				$data = $this->getItem();
			}
			
			return $data;
		}
		
		public function save($data)
		{
			$data['homeplayers'] = $data['homeplayer1'] . ',' . $data['homeplayer2'] . ',' . $data['homeplayer3'] . ',' . $data['homeplayer4'];
			$data['awayplayers'] = $data['awayplayer1'] . ',' . $data['awayplayer2'] . ',' . $data['awayplayer3'] . ',' . $data['awayplayer4'];
			$data['homereserves'] = $data['homereserveplayer1'];
			$data['awayreserves'] = $data['awayreserveplayer1'];
			
			if (parent::save($data))
			{
				return true;
			}

			return false;
		}

		public function creatematches($id)
		{
			// Get a db connection.
			$db = JFactory::getDbo();
 
 
			// Insert columns.
			$columns = array('cmid', 'matchid', 'homeplayerid', 'awayplayerid');
			
			// Array of payer-id's
			$homeplayers = explode(",", $this->gethomeplayers($id));
			$awayplayers = explode(",", $this->getawayplayers($id));

			// Get order of playing defined in matchdefinition
			$matchdefinition = $this->getmatchdefinition($id);			
			$homeplayerorder = explode(",", $matchdefinition->matchorderhome);
			$awayplayerorder = explode(",", $matchdefinition->matchorderaway);
 
			$i = 0;
			do
			{
				// Create a new query object.
				$query = $db->getQuery(true);

				// -1 because we are working with an array
				$homeplayer = $homeplayerorder[$i] - 1;
				$awayplayer = $awayplayerorder[$i] - 1;

				// Insert values.
				$values = array($id, $i+1, $homeplayers[$homeplayer], $awayplayers[$awayplayer]);
 
				// Prepare the insert query.
				$query
					->insert($db->quoteName('#__ttlivescore_livescores'))
					->columns($db->quoteName($columns))
					->values(implode(',', $values));
 
				// Set the query using our newly populated query object and execute it.
				$db->setQuery($query);
				$db->execute();
				
				$i++;
			} while ($i < $matchdefinition->matches);
			
			// Set value of created in table clubmatches to true
			$query = $db->getQuery(true);

			$id = $db->quote($id);

			$query
				->update($db->quoteName('#__ttlivescore_clubmatches', 'a'))
				->set(array($db->quoteName('a.livescorescreated') . ' = ' . $db->quoteName('1')))
				->where('a.id = ' . $id);
	
			$db->setQuery($query);
			$db->execute;

			return true;
		}
		
		public function getmatchdefinition($id)
		{
			// Get a db connection.
			$db = JFactory::getDbo();
 
			// Create a new query object.
			$query = $db->getQuery(true);
			
			$id = $db->quote($id);
 
			$query
				->select($db->quoteName(array('a.id', 'a.name', 'a.matchorderhome', 'a.matchorderaway', 'a.matches')))
				->from($db->quoteName('#__ttlivescore_matchdefinitions', 'a'))
				->where('a.id = ' . $id);

 
			// Set the query using our newly populated query object and execute it.
			$db->setQuery($query);			
			$db->execute();
			
			return $db->loadObject();
		}	

		public function gethomeplayers($id)
		{
			// Get a db connection.
			$db = JFactory::getDbo();
 
			// Create a new query object.
			$query = $db->getQuery(true);
			
			$id = $db->quote($id);
 
			$query
				->select($db->quoteName(array('a.homeplayers')))
				->from($db->quoteName('#__ttlivescore_clubmatches', 'a'))
				->where('a.id = ' . $id);

 
			// Set the query using our newly populated query object and execute it.
			$db->setQuery($query);			
			$db->execute();
			
			return $db->loadResult();
		}	

		public function getawayplayers($id)
		{
			// Get a db connection.
			$db = JFactory::getDbo();
 
			// Create a new query object.
			$query = $db->getQuery(true);
			
			$id = $db->quote($id);
 
			$query
				->select($db->quoteName(array('a.awayplayers')))
				->from($db->quoteName('#__ttlivescore_clubmatches', 'a'))
				->where('a.id = ' . $id);

 
			// Set the query using our newly populated query object and execute it.
			$db->setQuery($query);			
			$db->execute();
			
			return $db->loadResult();
		}	
	}
