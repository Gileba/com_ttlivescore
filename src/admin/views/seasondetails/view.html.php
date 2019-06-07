<?php
	defined('_JEXEC') or die;

	JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');

class TTLivescoreViewSeasondetails extends JViewLegacy
{
	protected $items;
	protected $state;
	protected $pagination;
	protected $seasons;
	protected $clubs;


	public function display($tpl = null)
	{
		$this->items 		= $this->get('Items');
		$this->state 		= $this->get('State');
		$this->pagination	= $this->get('Pagination');

		TTLivescoreHelper::addSubmenu('seasondetails');

		//Get season options
		$this->seasons = JFormHelper::loadFieldType('seasons', false);

		//Get club options
		$this->clubs = JFormHelper::loadFieldType('clubs', false);

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

		JToolbarHelper::title(JText::_('COM_TTLIVESCORE_MANAGER_SEASONDETAILS'), '');
		JToolbarHelper::addNew('seasondetail.add');

		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::editList('seasondetail.edit');
		}

		if ($canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'seasondetails.delete', 'JTOOLBAR_DELETE');
		}

		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_ttlivescore');
		}

		JHtmlSidebar::setAction('index.php?option=com_ttlivescore&view=seasondetails');

		JHtmlSidebar::addFilter(Jtext::_('COM_TTLIVESCORE_FILTER_SEASONS'), 'filter_seasons', 
			JHtml::_('select.options', $this->seasons->getOptions(), 'value', 'text', $this->state->get('filter.seasons'), true)
		);
		JHtmlSidebar::addFilter(Jtext::_('COM_TTLIVESCORE_FILTER_CLUBS'), 'filter_clubs', 
			JHtml::_('select.options', $this->clubs->getOptions(), 'value', 'text', $this->state->get('filter.clubs'), true)
		);
	}

	protected function getSortFields()
	{
		return array(
			'a.season' => JText::_('COM_TTLIVESCORE_HEADING_SEASON'),
			'a.player' => JText::_('COM_TTLIVESCORE_HEADING_NAME'),
			'a.club' => JText::_('COM_TTLIVESCORE_HEADING_CLUB')
		);
	}
}
