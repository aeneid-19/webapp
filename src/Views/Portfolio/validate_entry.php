<div class="card btn-group-lg mt-3">
	<div class="card-body ">
		<h3 class="card-title">Validate your submission</h3>
		<ul class="list-group">
			<?php
			/** @var array $indexNameArray */
			foreach ($indexNameArray['nameArray'] as $item => $value) {

				$_SESSION['ueberpruefung'][$item] = str_replace(UB, NL, $_SESSION['ueberpruefung'][$item]);
				echo '<li class="list-group-item d-flex justify-content-between align-items-center"><b class="col-4">' .
					$value . ':</b>' . '<span class="badge-success col-8">' . $_SESSION['ueberpruefung'][$item] . '</span></li>';
			}
			?>
		</ul>

		<div class="col-6">
			<div class="row mt-2">
				<div class="col-6">
					<a href="<?= '/Portfolio/save' ?>" role="button"
					   class="btn btn-success btn-large">Speichern</a>
				</div>
				<div class="col-6">
					<a href="<?= '/Portfolio/index' ?>" role="button"
					   class="btn btn-success btn-large">Zurück</a>
				</div>
			</div>
		</div>
	</div>
</div>
