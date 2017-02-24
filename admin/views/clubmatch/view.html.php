<?php
	defined('_JEXEC') or die;

	class TTLivescoreViewClubmatch extends JViewLegacy
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
			JFactory::getApplication()->input->set('hidemainmenu', true);
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_CLUBMATCH'), '');

			JToolbarHelper::apply('clubmatch.apply');

			JToolbarHelper::save('clubmatch.save');
			
			if (empty($this->item->id))
			{
				JToolbarHelper::cancel('clubmatch.cancel');
				return;
			}

			JToolbarHelper::cancel('clubmatch.cancel', 'JTOOLBAR_CLOSE');
			
			if($this->item->livescorescreated == false)
			{
				JToolbarHelper::custom('clubmatch.creatematches', 'tree-2', '', JText::_('COM_TTLIVESCORE_BUTTON_CREATEMATCHES', false);
			}
		}
	}
