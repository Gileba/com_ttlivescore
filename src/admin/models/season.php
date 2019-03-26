<?php
	defined('_JEXEC') or die;
	class TTLivescoreModelSeason extends JModelAdmin 
	{
		protected $text_prefix = 'COM_TTLIVESCORE';
		
		public function getTable($type = 'Season', $prefix = 'TTLivescoreTable', $config = array())
		{
			return JTable::getInstance($type, $prefix, $config);
		}
		
		public function getForm($data = array(), $loadData = true)
		{
			$form = $this->loadForm('com_ttlivescore.season', 'season', array('control' => 'jform', 'load_data' => $loadData));
			if (empty($form))
			{
				return false;
			}
			
			return $form;
		}
		
		protected function loadFormData()
		{
			$data = JFactory::getApplication()->getUserState('com_ttlivescore.edit.season.data', array());
			
			if (empty($data))
			{
				$data = $this->getItem();
				if ($data->startdate === '0000-00-00') { $data->startdate = ''; 
                }

				if ($data->enddate === '0000-00-00') { $data->endtdate = ''; 
                }
			}
			
			return $data;
		}
		
		protected function prepareTable($table)
		{
			$table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);
		}
	}
