<?php
	defined('_JEXEC') or die;

	class TTLivescoreViewLivescore extends JViewLegacy
	{
		protected $item;
		protected $form;
		
		public function display($tpl = null)
		{
			$this->item	= $this->get('Item');
			$this->form	= $this->get('Form');
			
			if (count($errors = $this->get('Errors')))
			{
				JError::raiseError(500, implode("\n", $errors));
				return false;
			}
			
			$this->addToolbar();
			parent::display($tpl);
		}
		
		protected function addToolbar()
		{
			$canDo	= TTLivescoreHelper::getActions();
			JFactory::getApplication()->input->set('hidemainmenu', true);
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_LIVESCORE'), '');
			if (empty($this->item->id))
			{
				JToolbarHelper::cancel('livescore.cancel');
				return;
			}
			JToolbarHelper::cancel('livescore.cancel', 'JTOOLBAR_CLOSE');
		}
	}