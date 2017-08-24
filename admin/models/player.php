<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelPlayer extends JModelAdmin 
	{
		protected $text_prefix = 'COM_TTLIVESCORE';
		
		public function getTable($type = 'Player', $prefix = 'TTLivescoreTable', $config = array())
		{
			return JTable::getInstance($type, $prefix, $config);
		}
		
		public function getForm($data = array(), $loadData = true)
		{
			$form = $this->loadForm('com_ttlivescore.player', 'player', array('control' => 'jform', 'load_data' => $loadData));
			if (empty($form))
			{
				return false;
			}
			
			return $form;
		}
		
		protected function loadFormData()
		{
			$data = JFactory::getApplication()->getUserState('com_ttlivescore.edit.player.data', array());
			
			if (empty($data))
			{
				$data = $this->getItem();
				if ($data->dateofbirth === '0000-00-00') { $data->dateofbirth = ''; }
			}
			
			return $data;
		}
		
		protected function prepareTable($table)
		{
			$table->lastname = htmlspecialchars_decode($table->lastname, ENT_QUOTES);
			$table->firstname = htmlspecialchars_decode($table->firstname, ENT_QUOTES);
			$table->middlename = htmlspecialchars_decode($table->middlename, ENT_QUOTES);
			$table->dateofbirth = JFactory::getDate($table->dateofbirth)->toSql();
		}
	}
