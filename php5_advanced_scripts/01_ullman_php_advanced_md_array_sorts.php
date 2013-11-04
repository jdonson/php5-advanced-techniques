<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="iso-8859-1" />
<title>Sorting Multidimensional Arrays Using uasort()</title>
</head>
<body>
<?php

//  build array ((ID => 1) 'name' => 'Jon', 'grade' => 76 )
$students = array (
256 => array('name' => 'Jon', 'grade' => 98.5),
2 => array('name' => 'Vance', 'grade' => 85.1),
9 => array('name' => 'Stephen', 'grade' => 94.0),
364 => array('name' => 'Steve', 'grade' => 85.1),
68 => array('name' => 'Rob', 'grade' => 74.6)
);

// Name sorting function
function name_sort($x, $y) { return strcasecmp($x['name'], $y['name']); }

// Grade sorting function
function grade_sort($x, $y) { return ($x['grade'] < $y['grade']); }

echo "\nMultidimensional Array Is: ((ID => 1) 'name' => 'Jon', 'grade' => 76 )\n==================\n\n<pre>", print_r($students, 1), "</pre>\n";

uasort($students, 'name_sort');

echo "\nSorted By Names\n==================\n\n<pre>", print_r($students, 1). "</pre>\n";

uasort($students, 'grade_sort');

echo "\nSorted By Grades\n==================\n\n<pre>", print_r($students, 1). "</pre>\n";

// Proposed Enhancements:  num sort on ID ASCENDING

?>
</body>
</html>