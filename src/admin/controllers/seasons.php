<?php
	defined('_JEXEC') or die;

class TTLivescoreControllerSeasons extends JControllerAdmin
{
	public function getModel($name = 'Season', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	public function details()
	{
		// Get the input
		$checkedIds	= $this->input->getInt('cid');

		// Set filter for Season Details
		$app = JFactory::getApplication();
		$app->setUserState('com_ttlivescore.seasondetails.filter.seasons', $checkedIds[0]);

		// Redirect to the season details form.
		$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=seasondetails', false));
		$this->redirect();
	}
}
