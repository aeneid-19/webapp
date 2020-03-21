<div class="row">
	<div class="col-12 mt-5">
		<table id="myTable" class="display" style="width:100%">
			<thead>
			<?php
			/** @var array $dataset */
			echo '<tr>';
			foreach ($dataset[0] as $item => $value) {
				echo '<th>' . $item . '</th>';
			}
			echo '</tr>';
			?>
			</thead>
			<tbody>
			<?php
			/** @var array $dataset */
			foreach ($dataset as $data) {
				echo '<tr>';
				foreach ($data as $item => $value) {
					echo '<td>' . $value . '</td>';
				}
				echo '</tr>';
			}
			?>
			</tbody>
		</table>
	</div>

</div>