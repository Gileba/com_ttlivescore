<?php
 
defined('JPATH_BASE') or die;
 
jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * Custom Field class for the Joomla Framework.
 *
 * @package		Joomla.Administrator
 * @subpackage	        com_my
 * @since		1.6
 */
class JFormFieldCountries extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Countries';
 
	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	public function getOptions()
	{
		// Initialize variables.
		$db	= JFactory::getDbo();
		$query	= $db->getQuery(true);
 
		$query->select('a.ioc_code As value, a.name As text');
		$query->from('#__ttlivescore_countries AS a');
		$query->order('a.ordering');
		$query->where('a.published = 1');
 
		// Get the options.
		$db->setQuery($query);
 
		$rows = $db->loadObjectList();
		
		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}
		
		foreach ($rows as $row)
		{
			$options[] = array('value' => $row->value, 'text' => JText::_($row->text));
		}
 
		return $options;
	}
}