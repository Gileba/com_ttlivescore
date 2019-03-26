<?php
	defined('_JEXEC') or die;
	
	class TTLivescoreControllerSeasondetails extends JControllerAdmin
	{
		public function getModel($name = 'Seasondetail', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}
	}
