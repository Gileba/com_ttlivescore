<?php
	defined('_JEXEC') or die;

	class TTLivescoreControllerClubmatch extends JControllerForm 
	{
		public function creatematches()
		{
			// Get the input
			$id = JFactory::getApplication()->input->getInt('id', '0');
 
			// Get the model
			$model = $this->getModel();
 
			$model->creatematches($id);
 
			// Redirect to the club match form.
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=clubmatch&layout=edit&id=' . (int) $id, false));
			$this->redirect();
		}
		
		public function livescore()
		{
			// Get the input
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('id', '0');
			
			// Redirect to the club match form.
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=livescores&id=' . (int) $id , false));
			$this->redirect();
		}
		
	}
