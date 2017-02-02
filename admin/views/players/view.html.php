<?php
	defined('_JEXEC') or die;

	class TTLivescoreViewPlayers extends JViewLegacy
	{
		protected $items;
		protected $state;
		
		public function display($tpl = null) {
			$this->items = $this->get('Items');
			$this->state = $this->get('State');
			
			if (count($errors = $this->get('Errors')))
			{
				JError::raiseError(500, implode("/n", $errors));
				return false;
			}
			
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
			parent::display($tpl);
		}
		
		protected function addToolbar()
		{
			$canDo	= TTLivescoreHelper::getActions();
			$state 	= $this->get('State');
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_PLAYERS'), '');
			JToolbarHelper::addNew('player.add');
			
			if ($canDo->get('core.edit'))
			{
				JToolbarHelper::editList('player.edit');
			}
			if ($canDo->get('core.edit.state'))
			{
				JToolbarHelper::publish('players.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('players.unpublish', 'JTOOLBAR_UNPUBLISH', true);
				JToolbarHelper::archiveList('players.archive');
				JToolbarHelper::checkin('players.checkin');
			}
			if ($state->get('filter.state') === -2 && ($canDo->get('core.delete'))
			{
				JToolbarHelper::deleteList('', 'players.delete', 'JTOOLBAR_EMPTY_TRASH');
			}
			if ($canDo->get('core.edit.state') && !($state->get('filter.state') !== -2))
			{
				JToolbarHelper::trash('players.trash');
			}
			if ($canDo->get('core.admin'))
			{
				JToolbarHelper::preferences('com_ttlivescore');
			}
			
			JHtmlSidebar::setAction('index.php?option=com_ttlivescore&view-players');
			
			JHtmlSidebar::addFilter(Jtext::_('JOPTION_SELECT_PUBLISHED'), 'filter_state', JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true));
		}
	}