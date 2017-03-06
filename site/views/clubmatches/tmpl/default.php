<?php
	defined(_'JEXEC') or die;
?>

<div class="clubmatches">
	<?php foreach ($this->items as $item) : ?>
		<div class="clubmatch">
			<div class="clubs">
				<?php echo $item->homeclub . ' - ' . $item->awayclub; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>