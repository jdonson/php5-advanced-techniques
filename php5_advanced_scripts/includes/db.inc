// http://stackoverflow.com/questions/3302476/mysql-1050-error-table-already-exists-when-in-fact-it-does-not
$mysql_schema_create_statement = "CREATE DATABASE IF NOT EXISTS `tasks` /*!40100 DEFAULT CHARACTER SET utf8 */;";

$mysql_table_create_statement = "
USE tasks; SHOW TABLES;
IF NOT EXISTS CREATE TABLE tasks.tasks(
task_id			int unsigned not null auto_increment,
parent_id		int unsigned not null DEFAULT 0,
task			varchar(100) NOT NULL,
date_added		timestamp NOT NULL,
date_accepted	timestamp, //  tasking whom?
date_completed	timestamp,
primary 		key(task_id),
INDEX 			added(date_added),
INDEX 			accepted(date_accepted),
INDEX 			completed(date_completed)

-- , ENGINE=\"InnoDB\"
)
;";

$mysql_table_test = "USE tasks; INSERT INTO tasks.tasks(task) VALUES (\'Must do this!\'); SELECT * FROM tasks.tasks; TRUNCATE tasks;";

