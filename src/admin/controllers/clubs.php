<?php
	defined('_JEXEC') or die;

class TTLivescoreControllerClubs extends JControllerAdmin
{
	public function getModel($name = 'Club', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}
