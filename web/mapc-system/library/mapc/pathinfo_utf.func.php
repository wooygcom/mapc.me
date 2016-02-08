<?php
function mapc_pathinfo_utf($path) {
	if (strpos($path, '/') !== false) {
		$basename = end(explode('/', $path));
	} elseif (strpos($path, '\\') !== false) {
		$basename = end(explode('\\', $path));
	} else {
		return false;
	}

	if (empty($basename)) {
		return false;
	}

	$dirname = substr($path, 0, strlen($path) - strlen($basename) - 1);

	if (strpos($basename, '.') !== false) {
		$extension = end(explode('.', $path));
		$filename = substr($basename, 0, strlen($basename) - strlen($extension) - 1);
	} else {
		$extension = '';
		$filename = $basename;
	}

	return array
		(
		'dirname' => $dirname,
		'basename' => $basename,
		'extension' => $extension,
		'filename' => $filename
		);
}

// end of file
