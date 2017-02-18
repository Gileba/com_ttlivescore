<?php
	defined('_JEXEC') or die;
	
	class TTLivescoreControllerClubmatches extends JControllerAdmin
	{
		public function getModel($name = 'Clubmatch', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}
	}