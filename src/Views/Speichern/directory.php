<?php
declare(strict_types=1);
/**
 * @var string $directory
 * @var array  $fileList
 * @var string $info
 */
$directory;
$fileList;
$info;

if (!empty($info)) {
	echo $info;
	echo NL;
}

foreach ($fileList as $item) { ?>
    <img src="<?= '/imglibrary' . DS . $directory . DS . $item ?>" alt="<?= $item ?>"><br>

<?php } ?>

<form action="/Speichern/imgupload" method="post" enctype="multipart/form-data" style="margin: 1em">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
