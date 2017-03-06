<?php
	defined(_'JEXEC') or die;
?>

<div class="clubmatches">
	<?php foreach ($this->items as $item) : ?>
		<div class="clubmatch">
			<div class="clubs">
				<?php echo $item->homeclubid . ' - ' . $item->awayclubid; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>