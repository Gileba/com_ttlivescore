<?php
	defined('_JEXEC') or die;
	
	class TTLivescoreControllerSeasons extends JControllerAdmin
	{
		public function getModel($name = 'Season', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}
	}
