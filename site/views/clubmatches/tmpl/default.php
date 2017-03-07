<?php
	defined('_JEXEC') or die;
	
	$model = $this->getModel();
?>

<div class="clubmatches">
	<?php foreach ($this->items as $item) : ?>
		<div class="clubmatch">
			<div class="clubs">
				<?php echo $item->homeclub . ' - ' . $item->awayclub . '(' . $model->getScore($item->id) . ')'; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>