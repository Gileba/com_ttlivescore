<?php
	defined('_JEXEC') or die;

	class TTLivescoreControllerCountries extends JControllerAdmin
	{
		public function getModel($name = 'Country', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}
	}
