<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="iso-8859-1" />
<!-- add responsive css and js resources -->
<title>Tasks Mgt App | Recursive Function</title>
</head>
<body>

<?php //  github project?

require_once('functions/functions.php');
include('includes/db.inc');

$db_connect_error_message = "Unable to connect to localhost database named test.";
//  db connect
$dbc = @mysqli_connect ( 'localhost','dbuser','dbpass', 'test') OR die($db_connect_error_message); 

//  check form states {submit,view}
if ( (isset($_POST['submitted'])) && !empty($_POST['task']) ) {

  if (isset($_POST['parent_id'])) { $parent_id = (int) $_POST['parent_id'] ; } else { $parent_id = 0; } // parent_id must be integer

  //  escape the task string, assumes magic quotes off
  $task = mysqli_real_escape_string($dbc, $_POST['task']);
  
  //  execute INSERT and add task to database
  $q = "INSERT INTO tasks.tasks (parent_id, task) VALUES ($parent_id, '$task');";
  
  $r = mysqli_query($dbc, $r);

  // report on query execution metadata
  if (mysqli_affected_rows($dbc) == 1) { echo "The task has been added."; } else { echo "The task could not be added."; }

} // end form state = submit

//  display form
echo '<form action="'.__FILE__.'" method="post">
<fieldset>
<legend>Add a Task</legend>

<p>Task: <input name="task" size="60" maxlength="100" />
<p>Parent Task: <select name="parent_id"><option value="0">None</option>
';

//  retrieve all uncompleted tasks
  $q = 'SELECT task_id, parent_id, task FROM tasks.tasks WHERE date_completed="0000-00-00 00:00:00" ORDER BY date_added ASC';

  $r = mysqli_query($dbc, $r);

//  also store tasks in array for use later
$tasks = array();

while (list($task_id, $parent_id, $task) = mysqli_fetch_array($r, MYSQLI_NUM) {

		echo "<option value=\"$task_id\">$task</option>\n";
		
		$tasks[] = array('task_id' => $task_id, 'parent_id' => $parent_id, 'task' => $task); }

echo '</select><p>
<input name="submitted" type="hidden" value="true" />
<input name="submit" type="submit" value="Add This Task" />
</form>
</fieldset>
';

//  sort tasks by parent_id
function parent_sort($x, $y) { return ($x['parent_id'] > $y['parent_id']); }

usort($tasks, 'parent_sort');

// display all tasks
echo '<h3>Current To Do List</h3><ul>';

foreach ($tasks as $task) { echo "<li>{$task['task']}</li>\n"; }

echo '</ul>';

//  PROPOSED ENHANCEMENTS:
//  -- $output      gathered
//  -- user_id		int unsigned,  depends upon user table with role and group hierarchies similarly built-in would be great
?>
</body>
</html>