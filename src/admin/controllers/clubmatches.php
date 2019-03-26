<?php
	defined('_JEXEC') or die;
	
	class TTLivescoreControllerClubmatches extends JControllerAdmin
	{
		public function getModel($name = 'Clubmatch', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}

		public function creatematches()
		{
			$id	= $this->input->getInt('id');

			// Get the model
			$model = $this->getModel();
 
			$model->creatematches($id);
 
			// Redirect to the club match form.
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=clubmatches', false));
			$this->redirect();
		}
	}
