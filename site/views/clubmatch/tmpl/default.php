<?php
	defined('_JEXEC') or die;
	
	$model	= $this->getModel();
?>

<div id="livescore">
		<div class="clubmatch">
			<div class="away">
				<div class="club">
					<?php echo $model->getClubname($this->items[0]->homeclub); ?>
				</div>
			</div>
			<div class="home">
				<div class="club">
					<?php echo $model->getClubname($this->items[0]->awayclub); ?>
				</div>
			</div>
		</div>
	<?php 
		foreach ($this->items as $item) : 
	?>
		<div class="clubmatch">
			<div class="away">
				<div class="score">
					<?php echo $model->getSetScore($item->id)['away']; ?>
				</div>
				<div class="club">
					<?php echo $model->getPlayername($item->awayplayerid); ?>
				</div>
			</div>
			<div class="home">
				<div class="club">
					<?php echo $model->getPlayername($item->homeplayerid); ?>
				</div>
				<div class="score">
					<?php echo $model->getSetScore($item->id)['home']; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>