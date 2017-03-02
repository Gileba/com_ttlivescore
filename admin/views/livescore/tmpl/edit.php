<?php
	defined('_JEXEC') or die;
	
	$model = $this->getModel();
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				<?php echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', JText::sprintf('COM_TTLIVESCORE_EDIT_LIVESCORE', $this->item->id, true)); ?>
				<div class="span6 form-horizontal pull-right center">
					<?php
						echo $model->getPlayername($this->form->getValue('awayplayerid'));
						if ($this->set >= 1) {
							echo '<br />' . $this->form->getValue('awaypointsset1');
						}
						if ($this->set >= 2) {
							echo '<br />' . $this->form->getValue('awaypointsset2');
						}
						if ($this->set >= 3) {
							echo '<br />' . $this->form->getValue('awaypointsset3');
						}
						if ($this->set >= 4) {
							echo '<br />' . $this->form->getValue('awaypointsset4');
						}
						if ($this->set >= 5) {
							echo '<br />' . $this->form->getValue('awaypointsset5');
						}
						if ($this->set >= 6) {
							echo '<br />' . $this->form->getValue('awaypointsset6');
						}
						if ($this->set == 7) {
							echo '<br />' . $this->form->getValue('awaypointsset7');
						}
					?>
				</div>
				<div class="span6 form-horizontal center">
					<?php
						echo $model->getPlayername($this->form->getValue('homeplayerid'));
						if ($this->set >= 1) {
							echo '<br />' . $this->form->getValue('homepointsset1');
						}
						if ($this->set >= 2) {
							echo '<br />' . $this->form->getValue('homepointsset2');
						}
						if ($this->set >= 3) {
							echo '<br />' . $this->form->getValue('homepointsset3');
						}
						if ($this->set >= 4) {
							echo '<br />' . $this->form->getValue('homepointsset4');
						}
						if ($this->set >= 5) {
							echo '<br />' . $this->form->getValue('homepointsset5');
						}
						if ($this->set >= 6) {
							echo '<br />' . $this->form->getValue('homepointsset6');
						}
						if ($this->set == 7) {
							echo '<br />' . $this->form->getValue('homepointsset7');
						}
					?>
				</div>
				<?php echo JHtml::_('bootstrap.endPanel'); ?>
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
				<?php echo JHtml::_('bootstrap.endPane'); ?>
			</fieldset>
		</div>
	</div>
</form>