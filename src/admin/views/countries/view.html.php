<?php
	defined('_JEXEC') or die;

	JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');

	class TTLivescoreViewCountries extends JViewLegacy
	{
		protected $items;
		protected $state;
		protected $pagination;
		

		public function display($tpl = null) {
			$this->items 		= $this->get('Items');
			$this->state 		= $this->get('State');
			$this->pagination	= $this->get('Pagination');
			
			if (count($errors = $this->get('Errors')))
			{
				JError::raiseError(500, implode("\n", $errors));
				return false;
			}
			
			TTLivescoreHelper::addSubmenu('countries');
						
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
			parent::display($tpl);
		}
		
		protected function addToolbar()
		{
			$canDo	= TTLivescoreHelper::getActions();
			
			JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_COUNTRIES'), '');
			if ($canDo->get('core.edit.state'))
			{
				JToolbarHelper::publish('countries.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('countries.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}

			if ($canDo->get('core.admin'))
			{
				JToolbarHelper::preferences('com_ttlivescore');
			}
			
			JHtmlSidebar::setAction('index.php?option=com_ttlivescore&view=countries');
			
			JHtmlSidebar::addFilter(Jtext::_('JOPTION_SELECT_PUBLISHED'), 'filter_state', JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true));
		}
		
		protected function getSortFields()
		{
			return array(
				'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
				'a.published' => JText::_('JSTATUS'),
				'a.name' => JText::_('COM_TTLIVESCORE_HEADING_NAME'),
				'a.ioc_code' => JText::_('COM_TTLIVESCORE_HEADING_IOCCODE')
			);
		}
	}
