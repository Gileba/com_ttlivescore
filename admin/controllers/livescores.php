<?php
	defined('_JEXEC') or die;
	
	class TTLivescoreControllerLivescores extends JControllerAdmin
	{
		public function getModel($name = 'Livescore', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}
	}