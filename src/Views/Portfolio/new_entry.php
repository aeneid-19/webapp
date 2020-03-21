<?php
use mvc_eins\Controllers\Portfolio\AuswahlSession;
?>

<div class="card btn-group-lg mt-3">
	<div class="card-body ">
		<h3 class="card-title">Add new entry</h3>
		<form action="/Portfolio/validate" method="post">
			<div class="form-check form-check-inline mt-1">
				<input class="form-check-input" type="radio" name="anrede" id="Herr"
				       value="Herr" checked>
				<label class="form-check-label" for="Herr">Herr</label>
			</div>

			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="anrede" id="Frau"
				       value="Frau" <?php AuswahlSession::checkedRadioAuswahl('anrede', 'Frau'); ?>>
				<label class="form-check-label" for="Frau">Frau</label>
			</div>
			<div class="input-group mb-3 mt-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="Name">Name</label>
				</div>
				<input type="text" class="form-control" id="Name" name="name"
				       placeholder="Bitte einen Namen eintragen!!"
				       value="<?php AuswahlSession::sessionAuswahl('name'); ?>">
			</div>
			<div class="input-group mb-3 mt-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="VName">Vorname</label>
				</div>
				<input type="text" class="form-control" id="VName" name="vname"
				       placeholder="Bitte einen Vornamen eintragen!!"
				       value="<?php AuswahlSession::sessionAuswahl('vname'); ?>">
			</div>
			<div class="input-group mb-3 mt-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="strasse">Straße</label>
				</div>
				<input type="text" class="form-control" id="strasse" name="strasse"
				       placeholder="Straßennamen"
				       value="<?php AuswahlSession::sessionAuswahl('strasse'); ?>">
				<div class="input-group-prepend ml-2">
					<label class="input-group-text" for="hausnr">HausNr.</label>
				</div>
				<input type="text" class="form-control" id="hausnr" name="hausnr"
				       placeholder="Hausnummer"
				       value="<?php AuswahlSession::sessionAuswahl('hausnr'); ?>">
			</div>
			<div class="input-group mb-3 mt-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="hausnr">PLZ</label>
				</div>
				<input type="text" class="form-control" id="plz" name="plz"
				       placeholder="PLZ"
				       value="<?php AuswahlSession::sessionAuswahl('plz'); ?>">
				<div class="input-group-prepend ml-2">
					<label class="input-group-text" for="ort">Ort</label>
				</div>
				<input type="text" class="form-control" id="ort" name="ort"
				       placeholder="Ort"
				       value="<?php AuswahlSession::sessionAuswahl('ort'); ?>">
			</div>
			<div class="input-group mb-3 mt-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="email">E-Mail</label>
				</div>
				<input type="text" class="form-control" id="email" name="email"
				       placeholder="E-Mail"
				       value="<?php AuswahlSession::sessionAuswahl('email'); ?>">
				<div class="input-group-prepend ml-2">
					<label class="input-group-text" for="tel">Telefon</label>
				</div>
				<input type="text" class="form-control" id="tel" name="tel"
				       placeholder="Telefonnummer"
				       value="<?php AuswahlSession::sessionAuswahl('tel'); ?>">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="Verein">Fußballverein</label>
				</div>
				<select class="custom-select" name="verein" id="Verein">
					<option value=''>---Bitte auswählen---</option>
					<option value="Bayern"
						<?php AuswahlSession::selectedAuswahl('verein', 'Bayern'); ?>>FC Bayern
					</option>
					<option value="Rostock"
						<?php AuswahlSession::selectedAuswahl('verein', 'Rostock'); ?>>FC Hansa Rostock
					</option>
					<option value="Leipzig"
						<?php AuswahlSession::selectedAuswahl('verein', 'Leipzig'); ?>>RB Leipzig
					</option>
				</select>
			</div>
			<div class="form-check form-check-inline mt-3">
				<div class="form-check-input">
					<input type="checkbox" name="sportart[]" id="fussball" value="Fußball"
						<?php AuswahlSession::checkedArrayAuswahl('sportart', 'Fußball'); ?>
					>
					<label class="form-check-label" for="fussball">Fußball</label>
				</div>
			</div>
			<div class="form-check form-check-inline">
				<div class="form-check-input">
					<input type="checkbox" name="sportart[]" id="handball" value="Handball"
						<?php AuswahlSession::checkedArrayAuswahl('sportart', 'Handball'); ?>>
					<label class="form-check-label" for="handball">Handball</label>
				</div>
			</div>
			<div class="form-check form-check-inline">
				<div class="form-check-input">
					<input type="checkbox" name="sportart[]" id="laufen" value="Laufen"
						<?php AuswahlSession::checkedArrayAuswahl('sportart', 'Laufen'); ?>>
					<label class="form-check-label" for="laufen">Laufen</label>
				</div>
			</div>
			<div class="form-group mt-3">
				<label for="Feedback">Feedback</label>
				<textarea class="form-control" id="Feedback" name="feedback"
				          rows="3"><?php AuswahlSession::sessionAuswahl('feedback'); ?></textarea>
			</div>
			<button type="submit" class="btn btn-primary mt-3" name="senden">Submit</button>
            <a href="/Portfolio/auslesen" role="button" class="btn btn-primary mt-3">Auslesen</a>
		</form>
	</div>
</div>