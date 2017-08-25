<?php
	defined('_JEXEC') or die;
	class TTLivescoreControllerSeason extends JControllerForm 
	{
		public function details()
		{
			// Get the input
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('id', '0');
			
			// Redirect to the season details form.
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=seasondetails&id=' . (int) $id), false);
			$this->redirect();
		}		
	}
