<?php

/**
 * Removes ambiguous class resolution warnings by patching Composer autoload files:
 * - Excludes Laravel Pint's App/Database from PSR-4 and classmap (so only project's App is used).
 * - Makes League\Flysystem\ not resolve Local\* from main flysystem (only flysystem-local is used).
 *
 * Run automatically after: composer dump-autoload
 */

$vendorDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor';
$composerDir = $vendorDir . DIRECTORY_SEPARATOR . 'composer';

if (!is_dir($composerDir)) {
    echo "Composer autoload dir not found, skipping fix.\n";
    exit(0);
}

$psr4File = $composerDir . DIRECTORY_SEPARATOR . 'autoload_psr4.php';
$classmapFile = $composerDir . DIRECTORY_SEPARATOR . 'autoload_classmap.php';
$staticFile = $composerDir . DIRECTORY_SEPARATOR . 'autoload_static.php';

// --- 1) Fix autoload_psr4.php: remove Pint paths ---
if (is_readable($psr4File)) {
    $content = file_get_contents($psr4File);
    $content = str_replace(", \$vendorDir . '/laravel/pint/app'", '', $content);
    $content = str_replace(", \$vendorDir . '/laravel/pint/database/seeders'", '', $content);
    $content = str_replace(", \$vendorDir . '/laravel/pint/database/factories'", '', $content);
    file_put_contents($psr4File, $content);
}

// --- 2) Fix autoload_classmap.php: remove Pint classmap entries ---
if (is_readable($classmapFile)) {
    $lines = file($classmapFile, FILE_IGNORE_NEW_LINES);
    $out = [];
    foreach ($lines as $line) {
        if (strpos($line, 'laravel/pint') !== false) {
            continue;
        }
        $out[] = $line;
    }
    file_put_contents($classmapFile, implode("\n", $out));
}

// --- 3) Fix autoload_static.php: remove Pint and restrict Flysystem\Local ---
if (!is_readable($staticFile)) {
    exit(0);
}

$content = file_get_contents($staticFile);

// Remove Pint from PSR-4 arrays
$content = str_replace(
    "1 => __DIR__ . '/..' . '/laravel/pint/app',",
    '',
    $content
);
$content = str_replace(
    "1 => __DIR__ . '/..' . '/laravel/pint/database/seeders',",
    '',
    $content
);
$content = str_replace(
    "1 => __DIR__ . '/..' . '/laravel/pint/database/factories',",
    '',
    $content
);

// Remove Pint entries from classMap (each line like 'App\...' => __DIR__ . '/..' . '/laravel/pint/...')
$content = preg_replace(
    "/\s*'App\\\\[^']+' => __DIR__ \. '\/\.\.' \. '\/laravel\/pint\/[^']+',\n/",
    '',
    $content
);

// League\Flysystem\: point to subdirs of flysystem/src excluding Local so Local\* is only from flysystem-local
$flysystemSrc = $vendorDir . DIRECTORY_SEPARATOR . 'league' . DIRECTORY_SEPARATOR . 'flysystem' . DIRECTORY_SEPARATOR . 'src';
$flysystemLocalDirs = [];
if (is_dir($flysystemSrc)) {
    foreach (new DirectoryIterator($flysystemSrc) as $fi) {
        if ($fi->isDir() && !$fi->isDot() && $fi->getFilename() !== 'Local') {
            $flysystemLocalDirs[] = $fi->getFilename();
        }
    }
    sort($flysystemLocalDirs);
}

// Output 'League\\Flysystem\\' in file (each \\ is one backslash in PHP source)
$flysystemReplacement = "        'League\\\\\\\\Flysystem\\\\\\\\' =>\n        array (\n";
if (count($flysystemLocalDirs) > 0) {
    $idx = 0;
    foreach ($flysystemLocalDirs as $dir) {
        $flysystemReplacement .= "            " . $idx . " => __DIR__ . '/..' . '/league/flysystem/src/" . $dir . "',\n";
        $idx++;
    }
} else {
    // Fallback: keep single path (ambiguity may remain)
    $flysystemReplacement .= "            0 => __DIR__ . '/..' . '/league/flysystem/src',\n";
}
$flysystemReplacement .= "        ),";

// In static file the namespace is written as 'League\\Flysystem\\' (each \\ is one backslash)
$content = preg_replace(
    "/        'League\\\\\\\\Flysystem\\\\\\\\' =>\s*\n\s*array \\(\s*\n\s*0 => __DIR__ \\. '\\/\\.\\.' \\. '\\/league\\/flysystem\\/src',\s*\n\s*\\),/",
    $flysystemReplacement,
    $content,
    1
);

file_put_contents($staticFile, $content);

echo "Autoload ambiguity fix applied (Pint excluded, Flysystem Local preferred from flysystem-local).\n";
