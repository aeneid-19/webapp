<?php
declare(strict_types=1);
$bezeichnung = ['Mrd. €', 'Anteil', 'Dynamik'];
?>

<div>
	<table class="content-table">
		<thead>
		<tr>
			<th style="width: 200px">Jahr</th>
			<?php
			foreach ($jahre as $item => $value) { ?>
				<th colspan="3" style="text-align: center">
					<?= $value ?>
				</th>
			<?php } ?>
		</tr>
		<tr>
			<th>Wirtschaftsbereich</th>
			<?php
			for ($i = 0, $iMax = count($jahre); $i < $iMax; $i++) {
				foreach ($bezeichnung as $item => $value) { ?>
					<th style="text-align: center">
						<?= $value ?>
					</th>
				<?php }
			} ?>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($datensatz as $index => $value) {
			if (next($datensatz)) { ?>
				<tr style="border-left: 3px solid #353a3f; border-right: 4px solid #353a3f">
			<?php } else { ?>
				<tr style="border-left: 3px solid #353a3f; border-right: 4px solid #353a3f; font-weight: bold">
			<?php } ?>
			<td>
				<?= $index ?>
			</td>
			<?php
			foreach ($value as $wert) {
				?>
				<td style="text-align: right; padding-right: 5px">
					<?= $wert ?>
				</td>
			<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
