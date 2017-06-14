<?php
	defined('_JEXEC') or die;
	
	$model	= $this->getModel();
	$score = $model->getScore($this->items[0]->cmid);
?>

<script>
	setInterval(function () { loadLivescore() },30000);

	function loadLivescore() {
		jQuery( "#livescore" ).load( "<?php echo JUri::getInstance(); ?> #livescore" );
	}
</script>

<div id="livescore">
		<div class="clubmatch">
			<div class="away">
				<div class="score">
					<?php echo $score['away']; ?>
				</div>
				<div class="club">
					<?php echo $model->getClubname($this->items[0]->homeclub); ?>
				</div>
			</div>
			<div class="home">
				<div class="club">
					<?php echo $model->getClubname($this->items[0]->awayclub); ?>
				</div>
				<div class="score">
					<?php echo $score['home']; ?>
				</div>
			</div>
		</div>
	<?php 
		foreach ($this->items as $item) : 
	?>
		<div class="detailedscores">
			<div class="homeplayer">
				<?php echo $model->getPlayername($item->awayplayerid); ?>
			</div>
			<div class="seperator">-</div>
			<div class="awayplayer">
				<?php echo $model->getPlayername($item->homeplayerid); ?>
			</div>
			<div class="details">
				<?php
					$numberOfSets = $model->getSetScore($item->id);
					for ($i = 1; $i <= ($numberOfSets['home'] + $numberOfSets['away']); $i++) {
						if ($i > 1) echo ", ";
						echo $model->getShortScore($item->id, $i);
					}
				?>
			</div>
			<div class="homescore">
				<?php echo $model->getSetScore($item->id)['home']; ?>
			</div>
			<div class="seperator">-</div>
			<div class="awayscore">
				<?php echo $model->getSetScore($item->id)['away']; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>