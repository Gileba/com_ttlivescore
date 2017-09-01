<?php
	defined('_JEXEC') or die;
	class TTLivescoreControllerSeason extends JControllerForm 
	{
		public function details()
		{
			// Get the input
			$app = JFactory::getApplication();
			$id = $app->input->getInt('id', '0');
			
			// Set filter for Season Details
			$app->setUserState('com_ttlivescore.seasondetails.filter.seasons', $id );
			
			// Redirect to the season details form.
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=seasondetails', false));
			$this->redirect();
		}		
	}
