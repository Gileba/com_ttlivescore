<?php
	defined('_JEXEC') or die;

?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				<?php echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_TTLIVESCORE_NEW_CLUBMATCH', true) : JText::sprintf('COM_TTLIVESCORE_EDIT_CLUBMATCH', $this->item->id, true)); ?>
				<?php echo $this->form->renderField('matchdefinition'); ?>
				<?php echo $this->form->renderField('season'); ?>
				<?php echo $this->form->renderField('date'); ?>
				<div class="span6 form-horizontal pull-right">
					<?php echo $this->form->renderField('awayclub'); ?>
					<?php echo $this->form->renderField('awayplayer1'); ?>
					<?php echo $this->form->renderField('awayplayer2'); ?>
					<?php echo $this->form->renderField('awayplayer3'); ?>
					<?php echo $this->form->renderField('reserveawayplayer1'); ?>
				</div>
				<div class="span6 form-horizontal">
					<?php echo $this->form->renderField('homeclub'); ?>
					<?php echo $this->form->renderField('homeplayer1'); ?>
					<?php echo $this->form->renderField('homeplayer2'); ?>
					<?php echo $this->form->renderField('homeplayer3'); ?>
					<?php echo $this->form->renderField('reservehomeplayer1'); ?>
				</div>
				<?php echo JHtml::_('bootstrap.endPanel'); ?>
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
				<?php echo JHtml::_('bootstrap.endPane'); ?>
			</fieldset>
		</div>
	</div>
</form>
