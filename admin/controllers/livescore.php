<?php
	defined('_JEXEC') or die;

	class TTLivescoreControllerLivescore extends JControllerForm 
	{
		public function nextlivescore()
		{
			// Get the input
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('id', '0');
 
			// Get the model
			$model = $this->getModel();
			$currentMatch = $model->getMatch($id);
			
			// Redirect
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=livescores&id=' . (int) $currentMatch->cmid, false));
			$this->redirect();
		}
	}