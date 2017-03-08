<?php
	defined('_JEXEC') or die;
	
	$model = $this->getModel();
?>

<div class="clubmatches">
	<?php 
		foreach ($this->items as $item) : 
			$score = $model->getScore($item->id);
	?>
		<div class="season">
			<?php echo $item->season; ?>
		</div>
		<div class="clubmatch">
			<div class="away">
				<div class="club">
					<?php echo $item->awayclub; ?>
				</div>
				<div class="score">
					<?php echo $score['away']; ?>
				</div>
			</div>
			<div class="home">
				<div class="club">
					<?php echo $item->homeclub; ?>
				</div>
				<div class="score">
					<?php echo $score['home']; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>