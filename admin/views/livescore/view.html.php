<?php
	defined('_JEXEC') or die;

	class TTLivescoreViewLivescore extends JViewLegacy
	{
		protected $item;
		protected $form;
		protected $set;
		
		public function display($tpl = null)
		{
			$this->item	= $this->get('Item');
			$this->form	= $this->get('Form');
			$model  	= $this->getModel();
			$this->set 	= $model->getCurrentSet($this->item->id);
			
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
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_LIVESCORE'), '');
			JToolbarHelper::back(JText::_('JTOOLBAR_BACK'), 'index.php?option=com_ttlivescore&view=livescores&id=' . (int) $this->item->cmid);
			JToolbarHelper::custom('livescore.nextlivescore', 'next', '', JText::_('COM_TTLIVESCORE_TOOLBAR_NEXT'), false);
		}
	}
