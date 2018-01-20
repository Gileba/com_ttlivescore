<?php
	defined('_JEXEC') or die;
	JHtml::_('behavior.framework', true);

	$document = JFactory::getDocument();
	$document->addStyleDeclaration( 'div.alert { display: none; }' );
	$document->addStyleDeclaration( 'button[disabled], button[disabled]:hover { background-color: silver; }' );
	
	$disablehomeplus = true;
	$disableawayplus = true;
	
	$bigButtons = JComponentHelper::getParams('com_ttlivescore')->get('big_buttons');
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=livescore&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', array('active' => 'details')); ?>
				<?php echo JHtml::_('bootstrap.addPanel', 'myTab', 'details', JText::sprintf('COM_TTLIVESCORE_EDIT_LIVESCORE', $this->item->id, true)); ?>
				<div class="span6 form-horizontal pull-right center">
						<div class="span12 center">
						<?php
							echo '<h3>' . TTLivescoreHelper::getPlayername($this->form->getValue('awayplayerid')) . '</h3>';
							echo '</div>';
						
						for ($i = 1; $i <= $this->set; $i++)
						{
							$points = 'awaypointsset' . $i;
?>
							<div class="span12" style="margin-left: 0px;">
								<?php echo '<div class="span' . ($bigButtons ? '3' : '4') . '"></div>'; ?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value--; Joomla.submitbutton('livescore.apply');" 
									<?php echo 'class="' . ($bigButtons ? 'span2 btn' : 'span1 btn btn-mini') . ' btn-danger"'; ?>
									<?php echo 'style="min-height: 1px;' . ($bigButtons ? 'font-size: 200%; height: 40px;' : '') . '"'; ?>
									<?php if ($this->form->getValue($points) == 0) { echo 'disabled '; } ?>>
										<?php echo '<span class="icon-minus-2 icon-white" ' . ($bigButtons ? 'style="margin-right: .5em; margin-top: 0.1em;"':'') . '></span>'; ?>
								</button>
<?php
							echo '<div class="span2 center" ' . ($bigButtons ? 'style="font-size: 200%; font-weight: bold; height: 40px; margin-top: .4em;"':'') . '>'. $this->form->getValue($points) . '</div>';
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
								$disableawayplus = false;
							}
?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value++; Joomla.submitbutton('livescore.apply');" 
									<?php echo 'class="' . ($bigButtons ? 'span2 btn' : 'span1 btn btn-mini') . ' btn-success"'; ?>
									<?php echo 'style="min-height: 1px;' . ($bigButtons ? 'font-size: 200%; height: 40px;' : '') . '"'; ?>
									<?php if ($disableawayplus) { echo 'disabled '; } ?>>
										<?php echo '<span class="icon-plus-2 icon-white" ' . ($bigButtons ? 'style="margin-right: .5em; margin-top: 0.1em;"':'') . '></span>'; ?>
								</button>
<?php
							echo $this->form->renderField($points);
							echo '<div class="span' . ($bigButtons ? '3' : '4') . '"></div>';
							echo '</div>';
						}
?>
				</div>
				<div class="span6 form-horizontal center">
						<div class="span12 center">
<?php
						echo '<h3>' . TTLivescoreHelper::getPlayername($this->form->getValue('homeplayerid')) . '</h3>';
						echo '</div>';
						for ($i = 1; $i <= $this->set; $i++)
						{
							$points = 'homepointsset' . $i;
?>
							<div class="span12" style="margin-left: 0px;">
								<?php echo '<div class="span' . ($bigButtons ? '3' : '4') . '"></div>'; ?>
							<button 
								onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value--; Joomla.submitbutton('livescore.apply');" 
								<?php echo 'class="' . ($bigButtons ? 'span2 btn' : 'span1 btn btn-mini') . ' btn-danger"'; ?>
								<?php echo 'style="min-height: 1px;' . ($bigButtons ? 'font-size: 200%; height: 40px;' : '') . '"'; ?>
								<?php if ($this->form->getValue($points) == 0) { echo 'disabled '; } ?>>
										<?php echo '<span class="icon-minus-2 icon-white" ' . ($bigButtons ? 'style="margin-right: .5em; margin-top: 0.1em;"':'') . '></span>'; ?>
							</button>
<?php
							echo '<div class="span2 center" ' . ($bigButtons ? 'style="font-size: 200%; font-weight: bold; height: 40px; margin-top: .4em;"':'') . '>'. $this->form->getValue($points) . '</div>';
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
								$disablehomeplus = false;
							}
?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value++; Joomla.submitbutton('livescore.apply');" 
									<?php echo 'class="' . ($bigButtons ? 'span2 btn' : 'span1 btn btn-mini') . ' btn-success"'; ?>
									<?php echo 'style="min-height: 1px;' . ($bigButtons ? 'font-size: 200%; height: 40px;' : '') . '"'; ?>
									<?php if ($disablehomeplus) { echo 'disabled '; } ?>>
										<?php echo '<span class="icon-plus-2 icon-white" ' . ($bigButtons ? 'style="margin-right: .5em; margin-top: 0.1em;"':'') . '></span>'; ?>
								</button>
<?php
							echo $this->form->renderField($points);
							echo '<div class="span' . ($bigButtons ? '3' : '4') . '"></div>';
							echo '</div>';
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