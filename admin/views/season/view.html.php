<?php
	defined('_JEXEC') or die;

	class TTLivescoreViewSeason extends JViewLegacy
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
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_SEASON'), '');
			JToolbarHelper::save('season.save');
			
			if (empty($this->item->id))
			{
				JToolbarHelper::cancel('season.cancel');
				return;
			}
			JToolbarHelper::cancel('season.cancel', 'JTOOLBAR_CLOSE');
			JToolbarHelper::custom('season.details', ' list-2', ' list-2', JText::_('COM_TTLIVESCORE_SEASON_DETAILS'), false);
		}
	}
