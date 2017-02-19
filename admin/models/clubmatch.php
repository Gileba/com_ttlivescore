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
		
		protected function prepareTable($table)
		{
		}
	}
