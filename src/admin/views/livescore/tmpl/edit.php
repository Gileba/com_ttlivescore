<?php
	defined('_JEXEC') or die;
	JHtml::_('behavior.framework', true);
	JHtml::stylesheet('com_ttlivescore/admin.stylesheet.css', array(), true);

	$disablehomeplus = true;
	$disableawayplus = true;
	
	$bigButtons = JComponentHelper::getParams('com_ttlivescore')->get('big_buttons');
?>

<form action="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=livescore&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate ttlivescore">
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
									<?php echo 'class="btn btn-danger' . ($bigButtons ? ' span2 bigbutton' : ' span1 btn-mini') . '"'; ?>
									<?php if ($this->form->getValue($points) == 0) { echo 'disabled '; 
                                    } ?>>
										<?php echo '<span class="icon-minus-2 icon-white"></span>'; ?>
								</button>
<?php
							echo '<div class="span2 center score' . ($bigButtons ? ' bigbutton':'') . '">'. $this->form->getValue($points) . '</div>';
							if (($this->set == $i)  
								&& (                                (                                ($this->form->getValue($points) < 11)  
                                && ($this->form->getValue('homepointsset' . $i) < 11)                                )  
                                || (                                (abs($this->form->getValue($points) - $this->form->getValue('homepointsset' . $i)) < 2)                                ))
							)
							{
								$disableawayplus = false;
							}
?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value++; Joomla.submitbutton('livescore.apply');" 
									<?php echo 'class="btn btn-success' . ($bigButtons ? ' span2 bigbutton' : ' span1 btn-mini') . '"'; ?>
									<?php if ($disableawayplus) { echo 'disabled '; 
                                    } ?>>
										<?php echo '<span class="icon-plus-2 icon-white"></span>'; ?>
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
								<?php echo 'class="btn btn-danger' . ($bigButtons ? ' span2 bigbutton' : ' span1 btn-mini') . '"'; ?>
								<?php if ($this->form->getValue($points) == 0) { echo 'disabled '; 
                                } ?>>
										<?php echo '<span class="icon-minus-2 icon-white"></span>'; ?>
							</button>
<?php
							echo '<div class="span2 center score' . ($bigButtons ? ' bigbutton':'') . '">'. $this->form->getValue($points) . '</div>';
							if (($this->set == $i)  
								&& (                                (                                ($this->form->getValue($points) < 11)  
                                && ($this->form->getValue('awaypointsset' . $i) < 11)                                )  
                                || (                                (abs($this->form->getValue($points) - $this->form->getValue('awaypointsset' . $i)) < 2)                                ))
							)
							{
								$disablehomeplus = false;
							}
?>
								<button 
									onclick="document.getElementById('<?php echo 'jform_' . $points; ?>').value++; Joomla.submitbutton('livescore.apply');" 
									<?php echo 'class="btn btn-success' . ($bigButtons ? ' span2 bigbutton' : 'span1 btn-mini') . '"'; ?>
									<?php if ($disablehomeplus) { echo 'disabled '; 
                                    } ?>>
										<?php echo '<span class="icon-plus-2 icon-white"></span>'; ?>
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
