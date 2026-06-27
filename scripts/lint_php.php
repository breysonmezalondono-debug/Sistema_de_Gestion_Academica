<?php
$root = __DIR__ . '/..';
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
$errors = [];
foreach ($rii as $file) {
    if ($file->isDir()) continue;
    $path = $file->getPathname();
    if (!preg_match('/\\.php$/i', $path)) continue;
    // skip vendor
    if (strpos($path, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR) !== false) continue;
    // skip storage compiled views
    if (strpos($path, DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR) !== false) continue;
    // run lint
    $cmd = "php -l " . escapeshellarg($path);
    exec($cmd, $out, $ret);
    if ($ret !== 0) {
        $errors[$path] = implode("\n", $out);
    }
}
if (empty($errors)) {
    echo "No syntax errors detected.\n";
    exit(0);
}
foreach ($errors as $file => $msg) {
    echo "ERROR in: $file\n";
    echo $msg . "\n\n";
}
exit(1);
