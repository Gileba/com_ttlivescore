<?php
	defined('_JEXEC') or die;

	JHtml::_('formbehavior.chosen', 'select');
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm"
	id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				<?php
					if (empty($this->item->id)) {
						echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', JText::_('COM_TTLIVESCORE_NEW_SEASON', true));
					} else {
						echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', JText::sprintf('COM_TTLIVESCORE_EDIT_SEASON', $this->item->id, true));
					}
				?>
				<?php echo $this->form->renderField('name'); ?>
				<?php echo $this->form->renderField('published'); ?>
				<?php echo $this->form->renderField('country'); ?>
				<?php echo $this->form->renderField('startdate'); ?>
				<?php echo $this->form->renderField('enddate'); ?>
				<?php echo JHtml::_('bootstrap.endPanel'); ?>
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
				<?php echo JHtml::_('bootstrap.endPane'); ?>
			</fieldset>
		</div>
	</div>
</form>
