CREATE TABLE `users` (
	`user_id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`config_id`	integer NOT NULL,
	`name`	varchar(20) NOT NULL,
	`email`	varchar(40) NOT NULL,
	`birthday`	date NOT NULL,
	FOREIGN KEY (config_id) REFERENCES config(config_id)
)
