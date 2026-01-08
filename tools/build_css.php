<?php
// tools/build_css.php - simple builder to concatenate and minify CSS
$files = [__DIR__.'/../assets/css/style.css', __DIR__.'/../assets/css/theme.css'];
$out = __DIR__.'/../assets/css/styles.min.css';
$combined = '';
foreach($files as $f){ if(file_exists($f)) $combined .= "\n/* file: " . basename($f) . " */\n" . file_get_contents($f); }
// basic minify: remove comments, newlines, and extra spaces
$min = preg_replace('!/\*.*?\*/!s','',$combined);
$min = preg_replace('/\s+/', ' ', $min);
$min = str_replace([' ;',': '],' ;',$min);
file_put_contents($out, trim($min));
echo "Built: $out\n";