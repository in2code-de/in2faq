CREATE TABLE tx_in2faq_domain_model_question (
	question text NOT NULL,
	answer text NOT NULL,
	question_from varchar(255) DEFAULT '' NOT NULL,
	related_links varchar(255) DEFAULT '' NOT NULL,
	path_segment varchar(255) DEFAULT '' NOT NULL,

	expert int(11) unsigned DEFAULT '0' NOT NULL,
	categories int(11) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE tx_in2faq_domain_model_category (
	title varchar(255) DEFAULT '' NOT NULL,
	uri varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_in2faq_question_category_mm (
	uid_local int(11) NOT NULL DEFAULT '0',
	uid_foreign int(11) NOT NULL DEFAULT '0',
	tablenames varchar(30) NOT NULL DEFAULT '',
	sorting int(11) DEFAULT '0' NOT NULL,
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
