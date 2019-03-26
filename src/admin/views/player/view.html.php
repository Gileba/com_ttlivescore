<?php
	defined('_JEXEC') or die;

	class TTLivescoreViewPlayer extends JViewLegacy
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
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_PLAYER'), '');
			JToolbarHelper::apply('player.apply');
			JToolbarHelper::save('player.save');

			if ($canDo->get('core.create')) {
				JToolbarHelper::save2new('player.save2new');				
			}
			
			if (empty($this->item->id))
			{
				JToolbarHelper::cancel('player.cancel');
				return;
			}

			JToolbarHelper::cancel('player.cancel', 'JTOOLBAR_CLOSE');
		}
	}