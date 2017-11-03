CREATE TABLE tx_gjotiger_domain_model_productset (

  uid int(11) NOT NULL AUTO_INCREMENT,
  pid int(11) DEFAULT '0' NOT NULL,

  name VARCHAR(150) NOT NULL DEFAULT '',
  is_accessory_kit TINYINT(4) NOT NULL DEFAULT '0',
  description TEXT NULL,
  image int(11) unsigned NOT NULL default '0',
  icon int(11) unsigned NOT NULL default '0',
  show_technicalnots tinyint(4) unsigned DEFAULT '0' NOT NULL,
  maximum_door_weight VARCHAR(150) NOT NULL DEFAULT '',
  height VARCHAR(150) NOT NULL DEFAULT '',
  door_leaf_thickness VARCHAR(150) NOT NULL DEFAULT '',
  minimum_door_width VARCHAR(150) NOT NULL DEFAULT '',
  minimum_door_width_soft_close VARCHAR(150) NOT NULL DEFAULT '',
  minimum_door_width_soft_close_long VARCHAR(150) NOT NULL DEFAULT '',
  minimum_door_width_soft_close_both VARCHAR(150) NOT NULL DEFAULT '',
  maximum_door_width VARCHAR(150) NOT NULL DEFAULT '',
  voltage VARCHAR(150) NOT NULL DEFAULT '',
  show_din tinyint(4) unsigned DEFAULT '0' NOT NULL,
  use_categorie VARCHAR(150) NOT NULL DEFAULT '',
  durability VARCHAR(150) NOT NULL DEFAULT '',
  door_weight VARCHAR(150) NOT NULL DEFAULT '',
  fire_resistance VARCHAR(150) NOT NULL DEFAULT '',
  safety VARCHAR(150) NOT NULL DEFAULT '',
  corrosion_resistance VARCHAR(150) NOT NULL DEFAULT '',
  security VARCHAR(150) NOT NULL DEFAULT '',
  door_type VARCHAR(150) NOT NULL DEFAULT '',
  initial_friction VARCHAR(150) NOT NULL DEFAULT '',
  invitation_to_tender TEXT NULL,
  download int(11) unsigned NOT NULL default '0',
  download_engineering_drawing int(11) unsigned NOT NULL default '0',
  image_engineering_drawing int(11) unsigned NOT NULL default '0',

  product_set_variant_groups int(11) unsigned NOT NULL default '0',
  products int(11) unsigned NOT NULL default '0',
  product_sets INT(11) unsigned NOT NULL DEFAULT '0',
  pages INT(11) unsigned NOT NULL DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

CREATE TABLE tx_gjotiger_domain_model_productgroup (

  uid int(11) NOT NULL AUTO_INCREMENT,
  pid int(11) DEFAULT '0' NOT NULL,

  header VARCHAR(150) NOT NULL DEFAULT '',
  sub_header VARCHAR(150) NOT NULL DEFAULT '',
  description TEXT NULL,
  image int(11) unsigned NOT NULL default '0',
  teaser_header VARCHAR(150) NOT NULL DEFAULT '',
  teaser_description TEXT NULL,
  teaser_image int(11) unsigned NOT NULL default '0',

  product_set_types int(11) unsigned NOT NULL default '0',
  pages INT(11) unsigned NOT NULL DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

CREATE TABLE tx_gjotiger_domain_model_productsettype (

  uid int(11) NOT NULL AUTO_INCREMENT,
  pid int(11) DEFAULT '0' NOT NULL,

  name VARCHAR(150) NOT NULL DEFAULT '',
  description TEXT NULL,

  product_group int(11) unsigned NOT NULL default '0',
  product_sets INT(11) unsigned NOT NULL DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

CREATE TABLE tx_gjotiger_domain_model_product (

  uid int(11) NOT NULL AUTO_INCREMENT,
  pid int(11) DEFAULT '0' NOT NULL,

  name VARCHAR(150) NOT NULL DEFAULT '',
  article_number VARCHAR(150) NOT NULL DEFAULT '',
  additional_information VARCHAR(150) NOT NULL DEFAULT '',
  image int(11) unsigned NOT NULL default '0',

  product_sub_group int(11) unsigned NOT NULL default '0',
  product_sets int(11) unsigned NOT NULL default '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

CREATE TABLE tx_gjotiger_domain_model_productsetvariantgroup (

  uid int(11) NOT NULL AUTO_INCREMENT,
  pid int(11) DEFAULT '0' NOT NULL,

  headline VARCHAR(150) NOT NULL DEFAULT '',
  description TEXT NULL,
  table_headline VARCHAR(150) NOT NULL DEFAULT '',

  product_set int(11) unsigned NOT NULL default '0',
  product_set_variants int(11) unsigned NOT NULL default '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

CREATE TABLE tx_gjotiger_domain_model_productsetvariant (

  uid int(11) NOT NULL AUTO_INCREMENT,
  pid int(11) DEFAULT '0' NOT NULL,

  name VARCHAR(200) NOT NULL DEFAULT '',
  system_set VARCHAR(150) NOT NULL DEFAULT '',
  article_number VARCHAR(150) NOT NULL DEFAULT '',

  product_set_variant_groups int(11) unsigned NOT NULL default '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

CREATE TABLE tx_gjotiger_domain_model_productsubgroup (

  uid int(11) NOT NULL AUTO_INCREMENT,
  pid int(11) DEFAULT '0' NOT NULL,

  name VARCHAR(150) NOT NULL DEFAULT '',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

CREATE TABLE tx_gjotiger_product_productset_mm (
  uid_local int(11) unsigned DEFAULT '0' NOT NULL,
  uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
  sorting int(11) unsigned DEFAULT '0' NOT NULL,
  sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_gjotiger_productset_productset_mm (
  uid_local int(11) unsigned DEFAULT '0' NOT NULL,
  uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
  sorting int(11) unsigned DEFAULT '0' NOT NULL,
  sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_gjotiger_productset_productsettype_mm (
  uid_local int(11) unsigned DEFAULT '0' NOT NULL,
  uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
  sorting int(11) unsigned DEFAULT '0' NOT NULL,
  sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);
