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
			
			if ($layout ==='edit')
			{
				switch ($view)
				{
					case 'player':
						if (!$this->checkEditId('com_ttlivescore.edit.player', $id))
						{
							$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
							$this->setMessage($this->getError(), 'error');
							$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=players', false));

							return false;
						}
					case 'club':
						if (!$this->checkEditId('com_ttlivescore.edit.club', $id))
						{
							$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
							$this->setMessage($this->getError(), 'error');
							$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=clubs', false));
				
							return false;
						}
					case 'country':
						if (!$this->checkEditId('com_ttlivescore.edit.country', $id))
						{
							$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
							$this->setMessage($this->getError(), 'error');
							$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=countries', false));
							
							return false;
						}
					case 'season':
						if (!$this->checkEditId('com_ttlivescore.edit.season', $id))
						{
							$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
							$this->setMessage($this->getError(), 'error');
							$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=seasons', false));
							
							return false;
						}
					case 'seasondetails':
						if (!$this->checkEditId('com_ttlivescore.edit.seasondetail', $id))
						{
							$this->setError(JTEXT::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
							$this->setMessage($this->getError(), 'error');
							$this->setRedirect(JROUTE::_('index.php?option=com_ttlivescore&view=seasondetails', false));
							
							return false;
						}
				}
			}

			parent::display();
			
			return $this;
		}
	}
