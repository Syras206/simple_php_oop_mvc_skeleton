<?php if (!defined('APP')) { exit; } ?>

<?php for ($i = 0; $i < $times; $i++) : ?>
	<p>Hello <?= $name; ?></p>
<?php endfor; ?>