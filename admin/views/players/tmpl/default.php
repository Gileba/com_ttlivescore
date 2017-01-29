<?php
	defined('_JEXEC') or die;

	$listOrder	= '';
	$listDirn	= '';
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=players'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="j-main-container" class="span10">
		<div class="clearfix"></div>
		<table class="table table-striped" id="playerList">
			<thead>
				<tr>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
					<th>
						<?php echo JHtml::_('grid.sort', 'COM_TTLIVESCORE_HEADING_LASTNAME', 'a.lastname', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?php echo JHtml::_('grid.sort', 'COM_TTLIVESCORE_HEADING_FIRSTNAME', 'a.firstname', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?php echo JHtml::_('grid.sort', 'COM_TTLIVESCORE_HEADING_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($this->items as $i => $item) : ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td class="nowrap has-context">
						<a href="<?php echo JROUTE::_('index.php?option=com_ttlivescore&task=player.edit&id=' . (int) $item->id); ?>">
							<?php 
								echo $this->escape($item->lastname); 
								if ($this->escape($item->middlename) != '')
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