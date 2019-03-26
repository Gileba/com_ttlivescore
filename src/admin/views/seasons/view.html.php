<?php
	defined('_JEXEC') or die;

	JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');

class TTLivescoreViewSeasons extends JViewLegacy
{
	protected $items;
	protected $state;
	protected $pagination;
	protected $countries;


	public function display($tpl = null)
	{
		$this->items 		= $this->get('Items');
		$this->state 		= $this->get('State');
		$this->pagination	= $this->get('Pagination');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		//Get country options
		$this->countries = JFormHelper::loadFieldType('countries', false);

		TTLivescoreHelper::addSubmenu('seasons');

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		$canDo	= TTLivescoreHelper::getActions();
		$state 	= $this->get('State');

		JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_SEASONS'), '');
		JToolbarHelper::addNew('season.add');
		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::editList('season.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::publish('seasons.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('seasons.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolbarHelper::archiveList('seasons.archive');
			JToolbarHelper::checkin('seasons.checkin');
		}

		if ($state->get('filter.state') === -2 && ($canDo->get('core.delete')))
		{
			JToolbarHelper::deleteList('', 'seasons.delete', 'JTOOLBAR_EMPTY_TRASH');
		}

		if ($canDo->get('core.edit.state') && !($state->get('filter.state') !== -2))
		{
			JToolbarHelper::trash('seasons.trash');
		}

		JToolbarHelper::custom('seasons.details', 'list-2', 'list-2', JText::_('COM_TTLIVESCORE_SUBMENU_SEASONDETAILS'), true);
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_ttlivescore');
		}

		JHtmlSidebar::setAction('index.php?option=com_ttlivescore&view=seasons');

		JHtmlSidebar::addFilter(Jtext::_('JOPTION_SELECT_PUBLISHED'), 'filter_state', JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true));
		JHtmlSidebar::addFilter(Jtext::_('COM_TTLIVESCORE_FILTER_COUNTRY'), 'filter_countries', JHtml::_('select.options', $this->countries->getOptions(), 'value', 'text', $this->state->get('filter.countries'), true));
	}

	protected function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.published' => JText::_('JSTATUS'),
			'a.name' => JText::_('COM_TTLIVESCORE_HEADING_NAME'),
			'a.country' => JText::_('COM_TTLIVESCORE_HEADING_IOCCODE')
		);
	}
}
