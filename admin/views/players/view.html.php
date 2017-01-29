<?php
	defined('_JEXEC') or die;

	class TTLivescoreViewPlayers extends JViewLegacy
	{
		protected $items;
		
		public function display($tpl = null) {
			$this->items = $this->get('Items');
			
			if (count($errors = $this->get('Errors')))
			{
				JError::raiseError(500, implode("/n", $errors));
				return false;
			}
			
			$this->addToolbar();
			parent::display($tpl);
		}
		
		protected function addToolbar()
		{
			$canDo	= TTLivescoreHelper::getActions();
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_PLAYERS'), '');
			JToolbarHelper::addNew('player.add');
			
			if ($canDo->get('core.edit'))
			{
				JToolbarHelper::editList('player.edit');
			}
			if ($canDo->get('core.admin'))
			{
				JToolbarHelper::preferences('com_ttlivescore');
			}
		}
	}