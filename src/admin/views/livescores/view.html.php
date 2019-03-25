<?php
	defined('_JEXEC') or die;

	class TTLivescoreViewLivescores extends JViewLegacy
	{
		protected $items;
		protected $state;
		protected $pagination;
		protected $countries;
		

		public function display($tpl = null) {
			$this->items 		= $this->get('Items');
			$this->state 		= $this->get('State');
			$this->pagination	= $this->get('Pagination');
			
			if (count($errors = $this->get('Errors')))
			{
				JError::raiseError(500, implode("\n", $errors));
				return false;
			}
			
			TTLivescoreHelper::addSubmenu('livescores');
						
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
			parent::display($tpl);
		}
		
		protected function addToolbar()
		{
			$canDo	= TTLivescoreHelper::getActions();
			
			JToolbarHelper::back(JText::_('JTOOLBAR_BACK'), 'index.php?option=com_ttlivescore&view=clubmatches');
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_LIVESCORES'), '');
			if ($canDo->get('core.edit'))
			{
				JToolbarHelper::editList('livescore.edit');
			}
			if ($canDo->get('core.admin'))
			{
				JToolbarHelper::preferences('com_ttlivescore');
			}
			
			JHtmlSidebar::setAction('index.php?option=com_ttlivescore&view=livescores');
		}

		protected function getSortFields()
		{
			return array();
		}
	}
