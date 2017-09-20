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
			$nextMatch = $model->getNextMatch($id);
			
			print_r($nextMatch);
			
			if ($nextMatch->matchid !== 0) {
			// Redirect
				$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=livescore&layout=edit&id=' . (int) $nextMatch->matchid, false));
				$this->redirect();	
				return;			
			}
			
			// Redirect
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=livescores&id=' . (int) $nextMatch->cmid, false));
			$this->redirect();
		}
	}