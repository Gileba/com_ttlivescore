<?php
	defined('_JEXEC') or die;
	
	$model	= $this->getModel();
?>

<div id="livescore">
	<?php 
		foreach ($this->items as $item) : 
	?>
		<div class="clubmatch">
			<div class="away">
				<div class="club">
					<?php echo $model->getPlayerName($item->awayplayerid); ?>
				</div>
				<div class="score">
					<?php echo $model->getSetScore($item->id)['away']; ?>
				</div>
			</div>
			<div class="home">
				<div class="club">
					<?php echo $model->getPlayerName($item->homeplayerid); ?>
				</div>
				<div class="score">
					<?php echo $model->getSetScore($item->id)['home']; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>