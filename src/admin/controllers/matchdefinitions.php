<?php
	defined('_JEXEC') or die;

class TTLivescoreControllerMatchdefinitions extends JControllerAdmin
{
	public function getModel($name = 'Matchdefinition', $prefix='TTLivescoreModel', $config=array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}
