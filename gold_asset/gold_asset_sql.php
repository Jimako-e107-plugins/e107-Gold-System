CREATE TABLE gold_asset_cat (
  gasset_cat_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  gasset_cat_name VARCHAR(25) DEFAULT NULL,
  gasset_cat_class INT(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY  (gasset_cat_id)
) ENGINE=MyISAM;


CREATE TABLE gold_asset (
  gpresy_id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  gasset_user_id int(11) UNSIGNED NOT NULL DEFAULT '0',
  gasset_asset varchar(100) NOT NULL DEFAULT '',
  gasset_bought int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (gpresy_id),
  KEY gasset_Asset (gasset_asset),
  KEY gasset_User (gasset_user_id) 
) ENGINE=MyISAM;



