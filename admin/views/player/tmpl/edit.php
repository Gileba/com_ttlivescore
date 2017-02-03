<?php
	defined('_JEXEC') or die;

?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				<?php echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_TTLIVESCORE_NEW_PLAYER', true) : JText::sprintf('COM_TTLIVESCORE_EDIT_PLAYER', $this->item->id, true)); ?>
				<?php echo $this->form->renderField('lastname'); ?>
				<?php echo $this->form->renderField('middlename'); ?>
				<?php echo $this->form->renderField('firstname'); ?>
				<?php echo $this->form->renderField('published'); ?>
				<?php echo $this->form->renderField('sex'); ?>
				<?php echo $this->form->renderField('dateofbirth'); ?>
				<?php echo $this->form->renderField('image'); ?>
				<?php echo $this->form->renderField('country'); ?>
				<?php echo JHtml::_('bootstrap.endPanel'); ?>
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
				<?php echo JHtml::_('bootstrap.endPane'); ?>
			</fieldset>
		</div>
	</div>
</form>