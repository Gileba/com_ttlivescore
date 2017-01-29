<?php
	defined('_JEXEC') or die;

	class TTLivescoreHelper
	{
		public static function getActions($categoryId = 0)
		{
			$user	= JFactory::getUser();
			$result	= new JObject;
			
			switch (empty($categoryId)) {
				case true:
					$assetName	= 'com_ttlivescore';
					$level		= 'component';
					break;
				default:
					$assetName	= 'com_ttlivescore.category.' . (int) $categoryId;
					$level		= 'category';
					break;
			}
			
			$actions = JAccess::getActions('com_ttlivescore', $level);
			
			foreach ($actions as $action)
			{
				$result->set($action->name, $user->authorise($action->name, $assetName));
			}
			
			return $result;
		}
	}