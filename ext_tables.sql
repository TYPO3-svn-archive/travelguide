#
# Table structure for table 'tx_travelguide_main'
#
CREATE TABLE tx_travelguide_main (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	name tinytext NOT NULL,
	cat int(11) unsigned DEFAULT '0' NOT NULL,
	logo blob NOT NULL,
	address text NOT NULL,
	place int(11) unsigned DEFAULT '0' NOT NULL,
	tel tinytext NOT NULL,
	fax tinytext NOT NULL,
	email tinytext NOT NULL,
	site tinytext NOT NULL,
	type tinyint(4) unsigned DEFAULT '0' NOT NULL,
	par1 text NOT NULL,
	par1alt text NOT NULL,
	foto1 blob NOT NULL,
	foto1alttext tinytext NOT NULL,
	par2 text NOT NULL,
	par2alt text NOT NULL,
	foto2 blob NOT NULL,
	foto2alttext tinytext NOT NULL,
	par3 text NOT NULL,
	par3alt text NOT NULL,
	foto3 blob NOT NULL,
	foto3alttext tinytext NOT NULL,
	par4 text NOT NULL,
	par4alt text NOT NULL,
	map blob NOT NULL,
	mapalttext tinytext NOT NULL,
	par5 text NOT NULL,
	par5alt text NOT NULL,
	desc_clicks int(11) DEFAULT '0' NOT NULL,
	map_clicks int(11) DEFAULT '0' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_travelguide_cat'
#
CREATE TABLE tx_travelguide_cat (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,
	titlealt tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_travelguide_place'
#
CREATE TABLE tx_travelguide_place (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	placename tinytext NOT NULL,
	cap tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);