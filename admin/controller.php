<?php
	defined('_JEXEC') or die;
	
	class TTLivescoreController extends JControllerLegacy
	{
		protected $default_view = 'players';
		
		public function display($cachable = false, $urlparams = false)
		{
			require_once JPATH_COMPONENT.'/helpers/ttlivescore.php';
			
			$view	= $this->input->get('view', 'players');
			$layout	= $this->input->get('layout', 'default');
			$id	= $this->input->getInt('id');
			
			if ($view == 'player' && $layout == 'edit' && !$this->checkEditId('com_ttlivescore.edit.player', $id))
			{
				$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=players', false));
				
				return false;
			}
			
			if ($view == 'club' && $layout == 'edit' && !$this->checkEditId('com_ttlivescore.edit.club', $id))
			{
				$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=clubs', false));
				
				return false;
			}
			
			if ($view == 'country' && $layout == 'edit' && !$this->checkEditId('com_ttlivescore.edit.country', $id))
			{
				$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=countries', false));
				
				return false;
			}
			
			if ($view == 'season' && $layout == 'edit' && !$this->checkEditId('com_ttlivescore.edit.season', $id))
			{
				$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=seasons', false));
				
				return false;
			}

			if ($view == 'seasondetail' && $layout == 'edit' && !$this->checkEditId('com_ttlivescore.edit.seasondetail', $id))
			{
				$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=seasondetails', false));
				
				return false;
			}

			if ($view == 'matchdefinition' && $layout == 'edit' && !$this->checkEditId('com_ttlivescore.edit.matchdefinition', $id))
			{
				$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=matchdefinitions', false));
				
				return false;
			}

			if ($view == 'clubmatch' && $layout == 'edit' && !$this->checkEditId('com_ttlivescore.edit.clubmatch', $id))
			{
				$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=clubmatches', false));
				
				return false;
			}

			parent::display();
			
			return $this;
		}
	}
