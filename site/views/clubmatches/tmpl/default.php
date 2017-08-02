<?php
	defined('_JEXEC') or die;
	
	$model	= $this->getModel();
	$season	= '';
?>

<script>
	setInterval(function () { loadLivescore() },60000);

	function loadLivescore() {
		jQuery( "#livescore-wrapper" ).load( "index.php?option=com_ttlivescore&view=clubmatches .livescore" );
	}
</script>

<div id="livescore-wrapper">
	<div class="livescore">
		<?php 
			foreach ($this->items as $item) : 
				$score = $model->getScore($item->id);
		?>
		<div class="season">
		<?php 
			if ($season != $item->season)
			{
				$season = $item->season;
				echo $season; 
			}
		?>
		</div>
		<div class="clubmatch">
			<div class="away">
				<div class="score">
					<?php echo $score['away']; ?>
				</div>
				<div class="club">
					<a href="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=clubmatch&id="'. (int) $item->id); ?>"><?php echo $item->awayclub; ?></a>
				</div>
			</div>
			<div class="home">
				<div class="club">
					<a href="<?php echo JRoute::_('index.php?option=com_ttlivescore&view=clubmatch&id="'. (int) $item->id); ?>"><?php echo $item->homeclub; ?></a>
				</div>
				<div class="score">
					<?php echo $score['home']; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>