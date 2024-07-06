$URI = getcwd().'/assets/app';
$iterator = new FilesystemIterator($URI);
foreach($iterator as $entry) {
    $arrFiles[] = $entry->getFilename();
}