<?php
	defined('_JEXEC') or die;

	JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');

class TTLivescoreViewPlayers extends JViewLegacy
{
	protected $items;
	protected $state;
	protected $pagination;
	protected $countries;
	protected $sex;


	public function display($tpl = null)
	{
		$this->items 		= $this->get('Items');
		$this->state 		= $this->get('State');
		$this->pagination	= $this->get('Pagination');

		TTLivescoreHelper::addSubmenu('players');

		//Get country options
		$this->countries = JFormHelper::loadFieldType('countries', false);

		//Get sex options
		$this->sex = JFormHelper::loadFieldType('sex', false);

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

		if ($state->get('filter.state') === -2 && ($canDo->get('core.delete')))
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

		JHtmlSidebar::setAction('index.php?option=com_ttlivescore&view=players');

		JHtmlSidebar::addFilter(Jtext::_('COM_TTLIVESCORE_FILTER_COUNTRY'), 'filter_countries', 
			JHtml::_('select.options', $this->countries->getOptions(), 'value', 'text', $this->state->get('filter.countries'), true)
		);
		JHtmlSidebar::addFilter(Jtext::_('COM_TTLIVESCORE_FILTER_SEX'), 'filter_sex', 
			JHtml::_('select.options', $this->sex->getOptions(), 'value', 'text', $this->state->get('filter.sex'), true)
		);
		JHtmlSidebar::addFilter(Jtext::_('JOPTION_SELECT_PUBLISHED'), 'filter_state', 
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);
	}

	protected function getSortFields()
	{
		return array(
			'a.published' => JText::_('JSTATUS'),
			'a.lastname' => JText::_('COM_TTLIVESCORE_HEADING_LASTNAME'),
			'a.firstname' => JText::_('COM_TTLIVESCORE_HEADING_FIRSTNAME')
		);
	}
}
