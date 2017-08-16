<?php
	defined('_JEXEC') or die;

	class TTLivescoreControllerClubmatch extends JControllerForm 
	{
		public function creatematches()
		{
			// Get the input
			$input = JFactory::getApplication()->input;
			$id = $input->get('id', '0', 'text');
 
			// Get the model
			$model = $this->getModel();
 
			$model->creatematches($id);
 
			// Redirect to the club match form.
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=clubmatch&layout=edit&id=' . (int) $id, false));
			$this->redirect();
		}
		
		public function livescore()
		{
			// Redirect to the club match form.
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=livescores', false));
			$this->redirect();
		}
		
	}