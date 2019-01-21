CREATE TABLE "config" (
	`config_id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`config_name`	varchar(80) NOT NULL,
	`from_name`	varchar(80) NOT NULL,
	`from_address`	varchar(80) NOT NULL,
	`bcc_address`	varchar(80) NOT NULL,
	`topic`	varchar(80) NOT NULL,
	`line1`	varchar(80) NOT NULL,
	`age_line`	varchar(80) NOT NULL,
	`noage_line`	varchar(80) NOT NULL,
	`picture_file`	varchar(80) NOT NULL
)
