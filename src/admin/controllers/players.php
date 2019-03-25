<?php
	defined('_JEXEC') or die;
	
	class TTLivescoreControllerPlayers extends JControllerAdmin
	{
		public function getModel($name = 'Player', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}
	}