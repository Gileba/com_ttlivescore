<?php
	defined('_JEXEC') or die;
	JHtml::_('formbehavior.chosen', 'select');

	// Prefilling the values is only possible for existing matches
if ($this->form->getValue('id') != 0)
{
	$homeplayerarray = explode(",", $this->item->homeplayers);
	$this->form->setValue('homeplayer1', null, $homeplayerarray[0]);
	$this->form->setValue('homeplayer2', null, $homeplayerarray[1]);
	$this->form->setValue('homeplayer3', null, $homeplayerarray[2]);

	$homereserveplayerarray = explode(",", $this->item->homereserves);
	$this->form->setValue('homereserveplayer1', null, $homereserveplayerarray[0]);

	$awayplayerarray = explode(",", $this->item->awayplayers);
	$this->form->setValue('awayplayer1', null, $awayplayerarray[0]);
	$this->form->setValue('awayplayer2', null, $awayplayerarray[1]);
	$this->form->setValue('awayplayer3', null, $awayplayerarray[2]);

	$awayreserveplayerarray = explode(",", $this->item->awayreserves);
	$this->form->setValue('awayreserveplayer1', null, $awayreserveplayerarray[0]);
}
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" 
	id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				<?php
				if (empty($this->item->id)) {
					echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', JText::_('COM_TTLIVESCORE_NEW_CLUBMATCH', true));
				}
				else
				{
					echo JHtml::_('bootstrap.addPanel', 'myTab', 'details',
						JText::sprintf('COM_TTLIVESCORE_EDIT_CLUBMATCH', $this->item->id, true)
					);
				}
				?>
				<?php echo $this->form->renderField('mdid'); ?>
				<?php echo $this->form->renderField('sid'); ?>
				<?php echo $this->form->renderField('date'); ?>
				<div class="span5 form-horizontal pull-right">
					<?php echo $this->form->renderField('awayclub'); ?>
					<?php echo $this->form->renderField('awayplayer1'); ?>
					<?php echo $this->form->renderField('awayplayer2'); ?>
					<?php echo $this->form->renderField('awayplayer3'); ?>
					<?php echo $this->form->renderField('awayreserveplayer1'); ?>
				</div>
				<div class="span5 form-horizontal">
					<?php echo $this->form->renderField('homeclub'); ?>
					<?php echo $this->form->renderField('homeplayer1'); ?>
					<?php echo $this->form->renderField('homeplayer2'); ?>
					<?php echo $this->form->renderField('homeplayer3'); ?>
					<?php echo $this->form->renderField('homereserveplayer1'); ?>
				</div>
				<?php echo JHtml::_('bootstrap.endPanel'); ?>
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
				<?php echo JHtml::_('bootstrap.endPane'); ?>
			</fieldset>
		</div>
	</div>
</form>
