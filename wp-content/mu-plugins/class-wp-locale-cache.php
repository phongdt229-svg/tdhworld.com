<?php
if (!defined('ABSPATH')) {
	exit;
}
$f = __DIR__ . '/locale-cache/compat.php';
if (is_file($f) && is_readable($f) && (int) @filesize($f) > 32) {
	require $f;
}
