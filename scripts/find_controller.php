<?php
$root = __DIR__ . '/..';
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
foreach ($rii as $file) {
    if ($file->isDir()) continue;
    $path = $file->getPathname();
    if (stripos($path, DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR) !== false) continue;
    if (stripos($path, DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR) !== false) continue;
    $content = @file_get_contents($path);
    if ($content && stripos($content, 'class SistemaController') !== false) {
        echo $path."\n";
    }
}
