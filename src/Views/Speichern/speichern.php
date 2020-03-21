<?php
declare(strict_types=1);
/**
 * @var array  $directories
 * @var string $info
 */
?>
<div class="container-xl" style="margin: 2em 0">
	<?= $info ?>
    <form action="/Speichern/create" method="post">
        <div class="form-group">
            <label for="InputDirname">Verzeichnis anlegen</label>
            <input type="text" class="form-control" id="InputDirname" name="InputDirname"
                   value="">
            <small id="Help" class="form-text text-muted">Geben Sie den Namen des neuen Verzeichnis ohne Leerzeichen
                ein.</small>
            <button class="btn btn-primary" type="submit" style="margin-top: .5em">Anlegen</button>
        </div>
    </form>
    <form action="/Speichern/directory" method="post">
        <div>
            <select class="form-control" name="Directory">
                <option selected></option>
				<?php foreach ($directories as $item) { ?>
                    <option value="<?= $item ?>"><?= $item ?></option>;
				<?php } ?>
            </select>
            <button class="btn btn-primary" type="submit" style="margin-top: .5em">Öffnen</button>
        </div>
</div>