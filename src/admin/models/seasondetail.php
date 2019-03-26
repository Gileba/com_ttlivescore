<?php
	defined('_JEXEC') or die;

	class TTLivescoreModelSeasondetail extends JModelAdmin
	{
		protected $text_prefix = 'COM_TTLIVESCORE';

		public function getTable($type = 'Seasondetail', $prefix = 'TTLivescoreTable', $config = array())
		{
			return JTable::getInstance($type, $prefix, $config);
		}

		public function getForm($data = array(), $loadData = true)
		{
			$form = $this->loadForm('com_ttlivescore.seasondetail', 'seasondetail', array('control' => 'jform', 'load_data' => $loadData));
			if (empty($form))
			{
				return false;
			}

			return $form;
		}

		protected function loadFormData()
		{
			$data = JFactory::getApplication()->getUserState('com_ttlivescore.edit.seasondetail.data', array());

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
