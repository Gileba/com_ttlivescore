<?php
	defined('_JEXEC') or die;

	$user		= JFactory::getUser();
	$listOrder	= $this->escape($this->state->get('list.ordering'));
	$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=players'); ?>" method="post" name="adminForm" id="adminForm">
	<?php if(!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container">
	<?php endif; ?>
	<div id="filter-bar" class="btn-toolbar">
		<div class="filter-search btn-group pull-left">
			<label for="filter_search" class="element-invisible"><?php echo JText::_('COM_TTLIVESCORE_SEARCH_IN_NAME');?></label>
			<input 
				type="text" 
				name="filter_search" 
				id="filter_search" 
				placeholder="<?php echo JText::_('COM_TTLIVESCORE_SEARCH_IN_NAME'); ?>" 
				value="<?php echo $this->escape($this->state->get('filter.search')); ?>" 
				title="<?php echo JText::_('COM_TTLIVESCORE_SEARCH_IN_NAME'); ?>" 
			/>
		</div>
		<div class="btn-group pull-left">
			<button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?> "><i class="icon-search"></i></button>
			<button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.getElementById('filter_search').value=''; this.form.submit();"> <i class="icon-remove"> </i></button>
		</div>
		<div class="btn-group pull-right hidden-phone">
			<label for="limit" class="element-invisible">
				<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?>
			</label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		<div class="btn-group pull-right hidden-phone">
			<label for="directionTable" class="element-invisible"><?php echo jText::_('JFIELD_ORDERING_DESC'); ?></label>
			<select name="directionTable" id="directionTable" class="input-medium" size="1" onchange="var sortTbl = document.getElementById('sortTable'); var column = sortTbl.options[sortTbl.selectedIndex].value; var dirTbl = document.getElementById('directionTable'); var direction = dirTbl.options[dirTbl.selectedIndex].value; Joomla.tableOrdering(column, direction, '');">
				<option 
					value="asc" <?php if($listDirn === 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING'); ?></option>
				<option value="desc" <?php if($listDirn === 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING'); ?></option>
			</select>
		</div>
		<div class="btn-group pull-right">
			<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY'); ?></label>
			<select name="sortTable" id="sortTable" class="input-medium"  size="1" onchange="var sortTbl = document.getElementById('sortTable'); var column = sortTbl.options[sortTbl.selectedIndex].value; var dirTbl = document.getElementById('directionTable'); var direction = dirTbl.options[dirTbl.selectedIndex].value; Joomla.tableOrdering(column, direction, '');">
				<option value=""><?php echo JText::_('JGLOBAL_SORT_BY'); ?></option>
				<?php echo JHtml::_('select.options', $this->getSortFields(), 'value', 'text', $listOrder); ?>
			</select>
		</div>
	</div>
		<div class="clearfix"></div>
		<table class="table table-striped" id="playerList">
			<thead>
				<tr>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
					<th width="1%" style="min-width: 55px;" class="nowrap center">
						<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?php echo JHtml::_('grid.sort', 'COM_TTLIVESCORE_HEADING_LASTNAME', 'a.lastname', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?php echo JHtml::_('grid.sort', 'COM_TTLIVESCORE_HEADING_FIRSTNAME', 'a.firstname', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?php echo JText::_('COM_TTLIVESCORE_HEADING_COUNTRY'); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="10">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach($this->items as $i => $item) : 
					$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out === $user->get('id') || $item->checked_out === 0;
					$canChange = $user->authorise('core.edit.state', 'com_ttlivescore') && $canCheckin;
				?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $item->published, $i, 'players.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
					</td>
					<td class="nowrap has-context">
						<a href="<?php echo JROUTE::_('index.php?option=com_ttlivescore&task=player.edit&id=' . (int) $item->id); ?>">
							<?php 
								echo $this->escape($item->lastname); 
								if ($this->escape($item->middlename) !== '')
								{
									echo ' (' . $this->escape($item->middlename) . ')'; 
								}
							?>
						</a>
					</td>
					<td class="nowrap has-context">
						<a href="<?php echo JROUTE::_('index.php?option=com_ttlivescore&task=player.edit&id=' . (int) $item->id); ?>">
							<?php echo $this->escape($item->firstname); ?>
						</a>
					</td>
					<td class="nowrap has-context">
						<?php echo $this->escape($item->country); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>