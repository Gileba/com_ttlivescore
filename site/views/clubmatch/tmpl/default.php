<?php
	defined('_JEXEC') or die;
	
	JLoader::register('TTLivescoreHelper', JPATH_ADMINISTRATOR . '/components/com_ttlivescore/helpers/ttlivescore.php');
	
	$active				= false;
	$model				= $this->getModel();
	$score 				= TTLivescoreHelper::getScore($this->items[0]->cmid);
	$currentMatch		= $model->getCurrentMatch($this->items[0]->cmid) - 1;
	if ($currentMatch < $this->items[0]->matches) {
		$active = true;
		$currentMatchId		= $this->items[$currentMatch]->id;
		$currentSetScore	= $model->getSetScore($currentMatchId);
		$currentSet			= $currentSetScore['home'] + $currentSetScore['away'];
		$currentPoints		= $model->getLivescore($currentMatchId);
	}
	
	$app = JFactory::getApplication();
	$currentMenuItem = $app->getMenu()->getActive();
	$params = $currentMenuItem->params;
	$refreshRate = (int) $params->get('refreshDetail');

?>

<script>
	setInterval(function () { loadLivescore() }, <?php echo $refreshRate * 1000; ?>);

	function loadLivescore() {
		jQuery( "#livescore-wrapper" ).load( "<?php echo JUri::getInstance(); ?> .livescore" );
	}
</script>

<div id="livescore-wrapper">
	<div class="livescore">
		<div class="clubmatch">
			<div class="home">
				<div class="club">
					<?php echo $model->getClubname($this->items[0]->homeclub); ?>
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
					<?php echo $model->getClubname($this->items[0]->awayclub); ?>
				</div>
			</div>
		</div>
		<?php
			if ($active) {
		?>
		<div class="currentmatch">
			<div class="home">
				<div class="player">
					<?php echo TTLivescoreHelper::getPlayername($this->items[$currentMatch]->homeplayerid); ?>
				</div>
			</div>
			<div class="away">
				<div class="player">
					<?php echo TTLivescoreHelper::getPlayername($this->items[$currentMatch]->awayplayerid); ?>
				</div>
			</div>
			<div class="home">
				<div class="points">
					<div><?php echo $currentPoints['home'][$currentSet]; ?></div>
				</div>
				<div class="score">
					<?php echo $currentSetScore['home']; ?>
				</div>
			</div>
			<div class="away">
				<div class="score">
					<?php echo $currentSetScore['away']; ?>
				</div>
				<div class="points">
					<div><?php echo $currentPoints['away'][$currentSet]; ?></div>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	<?php 
		$j = 0;
		foreach ($this->items as $item) : 
	?>
		<div class="detailedscores<?php if ($j == $currentMatch) {?> active<?php ; } ?>">
			<div class="homeplayer">
				<?php echo TTLivescoreHelper::getPlayername($item->homeplayerid); ?>
			</div>
			<div class="seperator">-</div>
			<div class="awayplayer">
				<?php echo TTLivescoreHelper::getPlayername($item->awayplayerid); ?>
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
	<?php 
			$j++;
		endforeach;
	?>
	</div>
</div>
