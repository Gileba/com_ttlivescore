<?php
	defined('_JEXEC') or die;

	JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');

	class TTLivescoreViewMatchDefinitions extends JViewLegacy
	{
		protected $items;
		protected $state;
		protected $pagination;
		

		public function display($tpl = null) {
			$this->items 		= $this->get('Items');
			$this->state 		= $this->get('State');
			$this->pagination	= $this->get('Pagination');
			
			TTLivescoreHelper::addSubmenu('matchdefinitions');
						
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
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_MATCHDEFINITIONS'), '');
			JToolbarHelper::addNew('matchdefintion.add');
			
			if ($canDo->get('core.edit'))
			{
				JToolbarHelper::editList('matchdefintion.edit');
			}
			if ($canDo->get('core.edit.state'))
			{
				JToolbarHelper::publish('matchdefintions.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('matchdefintions.unpublish', 'JTOOLBAR_UNPUBLISH', true);
				JToolbarHelper::archiveList('matchdefintions.archive');
				JToolbarHelper::checkin('matchdefintions.checkin');
			}
			if ($state->get('filter.state') === -2 && ($canDo->get('core.delete')))
			{
				JToolbarHelper::deleteList('', 'matchdefintions.delete', 'JTOOLBAR_EMPTY_TRASH');
			}
			if ($canDo->get('core.edit.state') && !($state->get('filter.state') !== -2))
			{
				JToolbarHelper::trash('matchdefintions.trash');
			}
			if ($canDo->get('core.admin'))
			{
				JToolbarHelper::preferences('com_ttlivescore');
			}
			
			JHtmlSidebar::setAction('index.php?option=com_ttlivescore&view=matchdefintions');
			
			JHtmlSidebar::addFilter(Jtext::_('JOPTION_SELECT_PUBLISHED'),'filter_state', JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true));
		}
		
		protected function getSortFields()
		{
			return array(
				'a.published' => JText::_('JSTATUS'),
				'a.name' => JText::_('COM_TTLIVESCORE_HEADING_NAME')
			);
		}
	}