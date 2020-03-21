<div class="card btn-group-lg mt-3">
	<div class="card-body ">
		<h3 class="card-title">Portfolio</h3>
		<ul class="list-group">
			<?php
			/** @var array $indexNameArray */
			foreach ($indexNameArray['nameArray'] as $item => $value) {

				/** @var array $datensatz */
				$datensatz[$item] = str_replace(UB, NL, $datensatz[$item]);
				echo '<li class="list-group-item d-flex justify-content-between align-items-center"><b class="col-4">' .
					$value . ':</b>' . '<span class="badge-success col-8">' . $datensatz[$item] . '</span></li>';
			}
			?>
		</ul>
		<div class="row mt-2">
			<div class="col-4">
				<a href="/Portfolio/index" role="button"
				   class="btn btn-success btn-large">Zum Formular</a>
			</div>
			<div class="col-2">
				<a href="/Portfolio/next" role="button"
				   class="btn btn-success btn-large">Next</a>
			</div>
			<div class="col-2">
				<a href="/Portfolio/back" role="button"
				   class="btn btn-success btn-large">Back</a>
			</div>
			<div class="col-2">
				<a href="/Portfolio/delete" role="button"
                   class="btn btn-success btn-large">Löschen</a>
			</div>
		</div>
	</div>
</div>

