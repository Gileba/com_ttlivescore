<?php
	defined('_JEXEC') or die;
	
	JLoader::register('TTLivescoreHelper', JPATH_ADMINISTRATOR . '/components/com_ttlivescore/helpers/ttlivescore.php');
	
	$app = JFactory::getApplication();
	$currentMenuItem = $app->getMenu()->getActive();
	$params = $currentMenuItem->params;
	$refreshrate = 60;
	if ((int) $params->get('refreshGlobal') !== 0) {
		$refreshRate = (int) $params->get('refreshGlobal');
	}
	
	$season	= '';
?>

<script>
	setInterval(function () { loadLivescore() },<?php echo $refreshRate * 1000; ?>);

	function loadLivescore() {
		jQuery( "#livescore-wrapper" ).load( "index.php?option=com_ttlivescore&view=clubmatches .livescore" );
	}
</script>

<div id="livescore-wrapper">
	<div class="livescore">
		<?php 
			if (empty($this->items)) {
				echo '<div class="season">' . JText::_('COM_TTLIVESCORE_NO_ACTIVE_LIVESCORE') . '</div>';
			}

			foreach ($this->items as $item) : 
				$score = TTLivescoreHelper::getScore($item->id);
		?>
		<?php 
			if ($season != $item->season)
			{
				$season = $item->season;
				echo '<div class="season">' . $season . '</div>'; 
			}
		?>		
		<div class="clubmatch">
			<div class="home">
				<div class="club">
					<a href="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=clubmatch&id='. (int) $item->id); ?>"><?php echo $item->homeclub; ?></a>
				</div>
				<div class="score">
					<?php echo $score['home']; ?>
				</div>
			</div>
			<div class="away">
				<div class="score">
					<?php echo $score['away']; ?>
				</div>
				<div class="club">
					<a href="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=clubmatch&id='. (int) $item->id); ?>"><?php echo $item->awayclub; ?></a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>
