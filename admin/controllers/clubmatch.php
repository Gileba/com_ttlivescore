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
 
			// Redirect to the list screen.
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=clubmatch&layout=edit&id=' . $id, false));
			$this->redirect();
		}
		
	}