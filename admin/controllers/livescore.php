<?php
	defined('_JEXEC') or die;

	class TTLivescoreControllerLivescore extends JControllerForm 
	{
		public function nextlivescore()
		{
			// Get the input
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('id', '0');
 
			// Get the model
			$model = $this->getModel();
			$nextMatch = $model->getNextMatch($id);
			
			if ($nextMatch['matchid'] !== 0) {
				// Give user edit access
				$app = JFactory::getApplication();
				$values = (array) $app->getUserState('$this->option.edit.$this->context');

				// Add the id to the list if non-zero.
				if (!empty($nextMatch['matchid']))
				{
					$values[] = (int) $nextMatch['matchid'];
					$values   = array_unique($values);
					$context = $this->option . '.edit.' . $this->context . '.id';
					JFactory::getApplication()->enqueueMessage($context);
					$app->setUserState($context, $values);
				}


				// Redirect
				$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=livescore&layout=edit&id=' . (int) $nextMatch['matchid'], false));
				$this->redirect();
				return;
			}
			
			// Redirect
			$this->setRedirect(JRoute::_('index.php?option=com_ttlivescore&view=livescores&id=' . (int) $nextMatch['cmid'], false));
			$this->redirect();
		}
	}