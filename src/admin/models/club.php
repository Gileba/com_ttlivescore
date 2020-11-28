<?php
	defined('_JEXEC') or die;
class TTLivescoreModelClub extends JModelAdmin
{
	/**
	 * Model text prefix string.
	 *
	 * @var		string
	 */
	protected $text_prefix = 'COM_TTLIVESCORE';

	public function getTable($type = 'Club', $prefix = 'TTLivescoreTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_ttlivescore.club', 'club', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_ttlivescore.edit.club.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	protected function prepareTable($table)
	{
		$table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);
	}
}
