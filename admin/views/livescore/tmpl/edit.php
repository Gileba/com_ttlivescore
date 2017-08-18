<?php
	defined('_JEXEC') or die;
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=livescore&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				<?php echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', JText::sprintf('COM_TTLIVESCORE_EDIT_LIVESCORE', $this->item->id, true)); ?>
				<div class="span6 form-horizontal pull-right center">
					<?php
						echo TTLivescoreHelper::getPlayername($this->form->getValue('awayplayerid'));
						
						for ($i = 1; $i <= $this->set; $i++)
						{
							echo '<br />';
							$points = 'awaypointsset' . $i;
							if (
								($this->form->getValue($points) > 0) && 
								(
									($this->set == $i) && 
									(
										($this->form->getValue($points) < 11) && 
										($this->form->getValue('homepointsset' . $i) < 11)
									) || 
									(
										(abs($this->form->getValue($points) - $this->form->getValue('homepointsset' . $i)) < 2)
									)
								) || 
								($this->form->getValue($points) > $this->form->getValue('homepointsset' . $i))
							)
							{
?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value--; Joomla.submitbutton('livescore.apply');" 
									class="btn btn-mini btn-danger">
										<span class="icon-minus-2 icon-white"></span>
								</button>
<?php
							} 					
							echo $this->form->getValue($points);
							if (
								($this->set == $i) && 
								(
									(
										($this->form->getValue($points) < 11) && 
										($this->form->getValue('homepointsset' . $i) < 11)
									) || 
									(
										(abs($this->form->getValue($points) - $this->form->getValue('homepointsset' . $i)) < 2)
									)
								)
							)
							{
?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value++; Joomla.submitbutton('livescore.apply');" 
									class="btn btn-mini btn-success">
										<span class="icon-plus-2 icon-white"></span>
								</button>
<?php
							}
							echo $this->form->renderField($points);
						}
?>
				</div>
				<div class="span6 form-horizontal center">
<?php
						echo TTLivescoreHelper::getPlayername($this->form->getValue('homeplayerid'));
						for ($i = 1; $i <= $this->set; $i++)
						{
							echo '<br />';
							$points = 'homepointsset' . $i;
							if (
								($this->form->getValue($points) > 0) && 
								(
									($this->set == $i) && 
									(
										($this->form->getValue($points) < 11) && 
										($this->form->getValue('awaypointsset' . $i) < 11)
									) || 
									(
										(abs($this->form->getValue($points) - $this->form->getValue('awaypointsset' . $i)) < 2)
									)
								) || 
								($this->form->getValue($points) > $this->form->getValue('awaypointsset' . $i))
							)
							{
?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value--; Joomla.submitbutton('livescore.apply');" 
									class="btn btn-mini btn-danger">
										<span class="icon-minus-2 icon-white"></span>
								</button>
<?php
							} 					
							echo $this->form->getValue($points);
							if (
								($this->set == $i) && 
								(
									(
										($this->form->getValue($points) < 11) && 
										($this->form->getValue('awaypointsset' . $i) < 11)
									) || 
									(
										(abs($this->form->getValue($points) - $this->form->getValue('awaypointsset' . $i)) < 2)
									)
								)
							)
							{
?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value++; Joomla.submitbutton('livescore.apply');" 
									class="btn btn-mini btn-success">
										<span class="icon-plus-2 icon-white"></span>
								</button>
<?php
							}
							echo $this->form->renderField($points);
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