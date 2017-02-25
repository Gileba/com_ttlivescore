<?php
	defined('_JEXEC') or die;

	$user		= JFactory::getUser();
	$listOrder	= $this->escape($this->state->get('list.ordering'));
	$listDirn	= $this->escape($this->state->get('list.direction'));
	$sortFields = $this->getSortFields();
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=livescores'); ?>" method="post" name="adminForm" id="adminForm">
	<?php if(!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container">
	<?php endif; ?>
	<div id="filter-bar" class="btn-toolbar">
		<div class="btn-group pull-right hidden-phone">
			<label for="limit" class="element-invisible">
				<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?>
			</label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	</div>
		<div class="clearfix"></div>
		<table class="table table-striped" id="livescoreList">
			<thead>
				<tr>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
					<th width="2%" class="hidden-phone">
						#
					</th>
					<th class="center">
						<?php echo JText::_('COM_TTLIVESCORE_HEADING_HOME'); ?>
					</th>
					<th width="1%"></th>
					<th class="center">
						<?php echo JText::_('COM_TTLIVESCORE_HEADING_AWAY'); ?>
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
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="1">
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td class="center hidden-phone">
						<?php echo $item->matchid; ?>
					</td>
					<td class="center">
						<?php 
							echo $item->homeplayerlastname . ', ' . $item->homeplayerfirstname; 
							if ($this->escape($item->homeplayermiddlename) !== '')
							{
								echo ' (' . $this->escape($item->homeplayermiddlename) . ')'; 
							}
						?>
						<br /><?php echo $item->homeset1; ?>
						<br /><?php echo $item->homeset2; ?>
						<br /><?php echo $item->homeset3; ?>
						<br /><?php echo $item->homeset4; ?>
						<br /><?php echo $item->homeset5; ?>
						<?php
							if ($this->escape($item->numberofsets) == 7)
							{
						?>
								<br /><?php echo $item->homeset6; ?>
								<br /><?php echo $item->homeset7; ?>
						<?php
							}
						?>
					</td>
					<td class="center">-</td>
					<td class="center">
						<?php
							echo $item->awayplayerlastname . ', ' . $item->awayplayerfirstname;
							if ($item->awayplayermiddlename !== '')
							{
								echo ' (' . $this->escape($item->awayplayermiddlename) . ')'; 
							}
						?>
						<br /><?php echo $item->awayset1; ?>
						<br /><?php echo $item->awayset2; ?>
						<br /><?php echo $item->awayset3; ?>
						<br /><?php echo $item->awayset4; ?>
						<br /><?php echo $item->awayset5; ?>
						<?php
							if ($this->escape($item->numberofsets) == 7)
							{
						?>
								<br /><?php echo $item->awayset6; ?>
								<br /><?php echo $item->awayset7; ?>
						<?php
							}
						?>
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
