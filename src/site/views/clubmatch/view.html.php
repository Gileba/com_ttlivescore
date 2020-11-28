<?php
	defined('_JEXEC') or die;

class TTLivescoreViewClubmatch extends JViewLegacy
{
	protected $items;

	public function display($tpl = null)
	{
		$this->items = $this->get('Items');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseErorr(500, implode("\n", $errors));
			return false;
		}

		parent::display($tpl);
	}
}
