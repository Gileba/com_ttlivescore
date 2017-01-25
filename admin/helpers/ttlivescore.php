<?php
	defined('_JEXEC') or die;

	class TTLivescoreHelper
	{
		public static function getActions($categoryId = 0)
		{
			$user	= JFactory::getUser();
			$result	= new JObject;
			
			if (empty($categoryId))
			{
				$assetName	= 'com_ttlivescore';
				$level		= 'component';
			}
			else
			{
				$assetName	= 'com_ttlivescore.category.' . (int) $categoryId;
				$level		= 'category';
			}
			
			$actions = JAccess::getActions('com_ttlivescore', $level);
			
			foreach ($actions as $action)
			{
				$result->set($action->name, $user->authorise($action->name, $assetName));
			}
			
			return $result;
		}
	}