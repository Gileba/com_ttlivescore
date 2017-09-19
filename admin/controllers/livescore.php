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
			
			if ($id !== 0) {
 
			}

			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=livescores&id=' . (int) $model->cmid, false));
			$this->redirect();
		}
	}