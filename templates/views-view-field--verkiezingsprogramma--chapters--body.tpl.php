<?php
$output = preg_replace('/(<img.*?)src/', '$1data-src', $output);
$output = preg_replace('/(<iframe.*?)src/', '$1data-src', $output);
print $output;
?>
