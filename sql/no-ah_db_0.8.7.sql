# phpMyAdmin SQL Dump
# version 2.5.6-rc1
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Jun 13, 2004 at 07:00 PM
# Server version: 4.0.18
# PHP Version: 4.2.3
# 
# Database : `stareat_test`
# 

# --------------------------------------------------------

#
# Table structure for table `noah_changelog`
#

CREATE TABLE `noah_changelog` (
  `changeid` int(11) NOT NULL auto_increment,
  `change_date` int(11) default NULL,
  `groupid` int(11) default NULL,
  `itemid` int(11) default NULL,
  `change_type` varchar(255) default NULL,
  `userid` int(11) default NULL,
  `change_data` text,
  PRIMARY KEY  (`changeid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Dumping data for table `noah_changelog`
#


# --------------------------------------------------------

#
# Table structure for table `noah_page`
#

CREATE TABLE `noah_page` (
  `pagesid` int(11) NOT NULL auto_increment,
  `nav_name` varchar(255) default NULL,
  `page_title` varchar(255) default NULL,
  `page_script` varchar(255) default NULL,
  `page_template` varchar(255) default NULL,
  `bid` varchar(255) default NULL,
  `page_parent` varchar(255) default NULL,
  `page_shownav` tinyint(1) NOT NULL default '1',
  `page_label` varchar(255) default NULL,
  `page_read` varchar(255) default NULL,
  `page_admin` varchar(255) default NULL,
  `page_options` varchar(255) default NULL,
  `page_type` varchar(255) default NULL,
  `page_weight` varchar(255) default NULL,
  `page_tpl` varchar(255) default NULL,
  `usessl` varchar(255) default '',
  UNIQUE KEY `pagesid` (`pagesid`)
) TYPE=MyISAM AUTO_INCREMENT=36 ;

#
# Dumping data for table `noah_page`
#

INSERT INTO `noah_page` VALUES (1, 'sample', 'Examples showing the basics of building custom pages for NoAh', 'sample.php', 'sample.html', '', '', 0, 'Sample Page', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}', 'a:1:{i:0;s:1:"1";}', '', 'content_page', '99', NULL, '0');

# --------------------------------------------------------

#
# Table structure for table `noah_pref`
#

CREATE TABLE `noah_pref` (
  `prefgroupid` int(11) NOT NULL auto_increment,
  `pref_group` varchar(255) default NULL,
  `pref_group_label` varchar(255) default NULL,
  `pref_group_desc` text,
  `admin_groups` varchar(255) default NULL,
  `read_groups` varchar(255) default NULL,
  `pref_link_name` varchar(255) default NULL,
  UNIQUE KEY `prefgroupid` (`prefgroupid`)
) TYPE=MyISAM AUTO_INCREMENT=21 ;

#
# Dumping data for table `noah_pref`
#

INSERT INTO `noah_pref` VALUES (1, 'img_upload', 'Image Upload Options', 'These settings control the options for the image upload feature. ', 'a:2:{i:0;s:1:"1";i:1;s:1:"5";}', 'a:2:{i:0;s:1:"1";i:1;s:1:"5";}', 'Image Upload Options');
INSERT INTO `noah_pref` VALUES (4, 'noah_admin', 'Noah Admin Options and Settings', 'This preference group defines a set of options for the noah admin stuff', 'a:1:{i:0;s:1:"1";}', 'a:2:{i:0;s:1:"1";i:1;s:1:"5";}', 'Noah Admin');

# --------------------------------------------------------

#
# Table structure for table `noah_prefvalue`
#

CREATE TABLE `noah_prefvalue` (
  `prefvalueid` int(11) NOT NULL auto_increment,
  `prefgroupid` varchar(255) default NULL,
  `pref_name` varchar(255) default NULL,
  `pref_label` text,
  `pref_value` text,
  `pref_field_type` varchar(255) default NULL,
  `pref_default` varchar(255) default NULL,
  `pref_options` varchar(255) default NULL,
  `listid` varchar(255) default NULL,
  `pref_weight` varchar(255) default NULL,
  UNIQUE KEY `prefvalueid` (`prefvalueid`)
) TYPE=MyISAM AUTO_INCREMENT=47 ;

#
# Dumping data for table `noah_prefvalue`
#

INSERT INTO `noah_prefvalue` VALUES (1, '1', 'org_path', 'Path to save original Image to', '/modules/noah/images/products', 'text', '/modules/noah/images/products', '30|255', NULL, '50');
INSERT INTO `noah_prefvalue` VALUES (2, '1', 'med_path', 'Path for default images', '/modules/noah/images/products/med', 'text', '/modules/noah/images/products/med', '30|255', NULL, '51');
INSERT INTO `noah_prefvalue` VALUES (3, '1', 'thumb_path', 'Path to save thumbnails to', '/modules/noah/images/products/thumb', 'text', '/modules/noah/images/products/thumb', '35|255', NULL, '55');
INSERT INTO `noah_prefvalue` VALUES (4, '1', 'icon_path', 'Path to save icon image', '/modules/noah/images/products/icon', 'text', '/modules/noah/images/products/icon', '30|255', NULL, '60');
INSERT INTO `noah_prefvalue` VALUES (5, '1', 'image_width', 'Image Width', '300', 'text', '250', '30|255', NULL, '10');
INSERT INTO `noah_prefvalue` VALUES (6, '1', 'image_height', 'Image Height', '300', 'text', '250', '30|255', NULL, '11');
INSERT INTO `noah_prefvalue` VALUES (7, '1', 'thumb_width', 'Thumbnail Width', '80', 'text', '80', '20|2', NULL, '15');
INSERT INTO `noah_prefvalue` VALUES (8, '1', 'thumb_height', 'Thumbnail Height', '80', 'text', '80', '20|2', NULL, '16');
INSERT INTO `noah_prefvalue` VALUES (9, '1', 'icon_width', 'Icon Width', '25', 'text', '20', '20|2', NULL, '20');
INSERT INTO `noah_prefvalue` VALUES (10, '1', 'icon_height', 'Icon Height', '25', 'text', '20', '20|2', NULL, '21');
INSERT INTO `noah_prefvalue` VALUES (11, '1', 'force_ratio', 'Force Exact Resize', '0', 'checkbox', '0', '', NULL, '8');
INSERT INTO `noah_prefvalue` VALUES (12, '1', 'maxfilesize', 'Maximum File Size', '10000000', 'text', '1000000', '30|255', NULL, '75');
INSERT INTO `noah_prefvalue` VALUES (13, '1', 'maxfilewidth', 'Max File Width', '1800', 'text', '1800', '30|255', NULL, '76');
INSERT INTO `noah_prefvalue` VALUES (14, '1', 'maxfileheight', 'Max File Height', '1800', 'text', '1800', '20|255', NULL, '77');
INSERT INTO `noah_prefvalue` VALUES (15, '1', 'allowed_mimetypes', 'Allowed Mime Types', 'image/gif|image/jpeg|image/pjpeg|image/x-png', 'text', 'image/gif|image/jpeg|image/pjpeg|image/x-png', '30|500', NULL, '80');
INSERT INTO `noah_prefvalue` VALUES (30, '4', 'discover_database', 'Turn On Group/Field discovery', '1', 'checkbox', '0', '', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (29, '4', 'date_format', 'Date Time Format', 'M j, g:i a', 'text', 'm.d.y g:ia', '6|150', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (31, '4', 'page_templates', 'Page Templates Folder', 'templates/pages', 'text', 'templates/pages', '30|255', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (32, '4', 'page_scripts', 'Page Script Folder', 'pages', 'text', 'pages', '30|255', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (33, '4', 'deactivate_locks', 'Deactivate Field Locks', '1', 'checkbox', '0', '', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (34, '4', 'detail_view_templates', 'Detail View Templates Path', 'templates/group_details', 'text', 'templates/group_details', '30|255', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (35, '4', 'group_scripts', 'Group Scripts Folder', 'admin/sub_views', 'text', '', '30|255', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (36, '4', 'form_templates', 'Custom Form Templates', 'templates/form', 'text', 'templates/form', '30|255', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (37, '4', 'list_rows', 'Number of Rows in List', '15', 'text', '15', '30|3', '0', '50');
INSERT INTO `noah_prefvalue` VALUES (38, '4', 'show_help', 'Show Help Tips', '1', 'checkbox', '1', '', NULL, '50');
INSERT INTO `noah_prefvalue` VALUES (39, '4', 'show_verbose', 'Show Verbose echo() messages', '0', 'checkbox', '', '', NULL, '50');
INSERT INTO `noah_prefvalue` VALUES (46, '4', 'logchanges', 'Log Changes', '0', 'text', '', '4|1', NULL, '50');

# --------------------------------------------------------

#
# Table structure for table `noah_relation`
#

CREATE TABLE `noah_relation` (
  `relationid` int(11) NOT NULL auto_increment,
  `relationtype` varchar(255) default NULL,
  `fieldid` int(11) default NULL,
  `listid` int(11) default NULL,
  `jn_table` varchar(255) default NULL,
  `jn_field` varchar(255) default NULL,
  `jn_display` varchar(255) default NULL,
  `allow_null` tinyint(1) NOT NULL default '0',
  `sitelistid` varchar(255) default NULL,
  UNIQUE KEY `relationid` (`relationid`)
) TYPE=MyISAM AUTO_INCREMENT=49 ;

#
# Dumping data for table `noah_relation`
#

INSERT INTO `noah_relation` VALUES (1, 'join', 157, NULL, 'noah_pref', 'prefgroupid', 'pref_group_label', 0, NULL);
INSERT INTO `noah_relation` VALUES (3, 'syslist', 160, 1, NULL, NULL, NULL, 0, NULL);
INSERT INTO `noah_relation` VALUES (4, 'syslist', 149, 6, NULL, NULL, NULL, 0, NULL);
INSERT INTO `noah_relation` VALUES (5, 'syslist', 37, 2, NULL, NULL, NULL, 0, NULL);
INSERT INTO `noah_relation` VALUES (6, 'join', 31, NULL, 'noah_sysgroup', 'groupid', 'group_label', 0, NULL);
INSERT INTO `noah_relation` VALUES (7, 'syslist', 35, 1, NULL, NULL, NULL, 0, NULL);
INSERT INTO `noah_relation` VALUES (8, 'syslist', 187, 9, NULL, NULL, NULL, 0, NULL);
INSERT INTO `noah_relation` VALUES (9, 'join', 12, NULL, 'noah_syslist', 'listid', 'listname', 0, NULL);
INSERT INTO `noah_relation` VALUES (10, 'join', 65, NULL, 'users', 'uid', 'uname', 0, NULL);
INSERT INTO `noah_relation` VALUES (11, 'join', 219, NULL, 'groups', 'groupid', 'name', 0, NULL);
INSERT INTO `noah_relation` VALUES (12, 'join', 218, NULL, 'noah_ufilter', 'filterid', 'filter_name', 0, NULL);
INSERT INTO `noah_relation` VALUES (13, 'syslist', 255, 10, NULL, NULL, NULL, 0, NULL);
INSERT INTO `noah_relation` VALUES (14, 'syslist', 46, 3, '', '', '', 0, '');
INSERT INTO `noah_relation` VALUES (15, 'join', 1463, NULL, 'noah_syslist', 'listid', 'listname', 1, NULL);
INSERT INTO `noah_relation` VALUES (16, 'join', 1464, 0, 'noah_sysgroup', 'table_name', 'table_name', 1, NULL);
INSERT INTO `noah_relation` VALUES (17, 'join', 1462, 0, 'noah_sysfield', 'fieldid', 'fieldid', 1, '0');
INSERT INTO `noah_relation` VALUES (19, 'join', 298, 0, 'noah_sitelist', 'listid', 'listlabel', 1, '0');
INSERT INTO `noah_relation` VALUES (21, 'join', 1538, 0, 'noah_sitelist', 'listid', 'listlabel', 1, '0');
INSERT INTO `noah_relation` VALUES (39, 'join', 1887, NULL, 'kstore_order', 'orderid', 'orderid', 1, NULL);
INSERT INTO `noah_relation` VALUES (43, 'syslist', 1994, 15, '', '', '', 1, '');
INSERT INTO `noah_relation` VALUES (44, 'syslist', 1999, 19, '', '', '', 1, '');
INSERT INTO `noah_relation` VALUES (45, 'syslist', 2001, 16, '', '', '', 1, '');
INSERT INTO `noah_relation` VALUES (46, 'join', 2005, 0, 'art_artists', 'artistid', 'artist_lname', 1, '');
INSERT INTO `noah_relation` VALUES (47, 'syslist', 2010, 17, '', '', '', 1, '');
INSERT INTO `noah_relation` VALUES (48, 'syslist', 2011, 18, '', '', '', 1, '');

# --------------------------------------------------------

#
# Table structure for table `noah_sfilter`
#

CREATE TABLE `noah_sfilter` (
  `sharedfiltersid` int(11) NOT NULL auto_increment,
  `filterid` varchar(255) default NULL,
  `groupid` varchar(255) default NULL,
  UNIQUE KEY `sharedfiltersid` (`sharedfiltersid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Dumping data for table `noah_sfilter`
#


# --------------------------------------------------------

#
# Table structure for table `noah_sitelist`
#

CREATE TABLE `noah_sitelist` (
  `listid` int(11) NOT NULL auto_increment,
  `listname` varchar(55) NOT NULL default '',
  `listdesc` varchar(255) default NULL,
  `Label for list` varchar(255) default NULL,
  `listlabel` varchar(255) default NULL,
  UNIQUE KEY `listid` (`listid`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `noah_sitelist`
#

INSERT INTO `noah_sitelist` VALUES (1, 'samplelist', 'This is my list description', NULL, 'Sample List');
INSERT INTO `noah_sitelist` VALUES (2, 'passquestions', 'Questions which can be asked asked of a person and then used as a password hint', NULL, 'Password Questions');
INSERT INTO `noah_sitelist` VALUES (3, 'humangenders', 'A list of genders. Testing change', NULL, 'Genders');
INSERT INTO `noah_sitelist` VALUES (5, 'contact_response_templates', 'This is a list of templates which can be used to send \'canned responses to users who have submitted messages via the \'contact form\'', NULL, 'Contact Response Templates');

# --------------------------------------------------------

#
# Table structure for table `noah_sitevalue`
#

CREATE TABLE `noah_sitevalue` (
  `valueid` int(11) NOT NULL auto_increment,
  `listid` int(11) NOT NULL default '0',
  `value` varchar(50) NOT NULL default '',
  `valuedesc` varchar(255) default NULL,
  `valuelabel` varchar(255) default NULL,
  `langconst` varchar(255) default NULL,
  UNIQUE KEY `valueid` (`valueid`)
) TYPE=MyISAM AUTO_INCREMENT=12 ;

#
# Dumping data for table `noah_sitevalue`
#

INSERT INTO `noah_sitevalue` VALUES (1, 1, 'sample', 'sample value this is just for your notes', 'Sample Value', NULL);
INSERT INTO `noah_sitevalue` VALUES (2, 2, 'quest_maiden', 'question number one', '', '_PASSQUESTION_MOTHER_MAIDEN');
INSERT INTO `noah_sitevalue` VALUES (3, 2, 'quest_father', '', '', '_PASSQUESTION_FATHER_BIRTH_PLACE');
INSERT INTO `noah_sitevalue` VALUES (4, 2, 'quest_highschool', '', '', '_PASSQUESTION_HIGHSCHOOL');
INSERT INTO `noah_sitevalue` VALUES (5, 2, 'quest_firstpet', '', '', '_PASSQUESTION_FIRST_PET');
INSERT INTO `noah_sitevalue` VALUES (6, 3, '2', 'male gender', '', '_GENDER_MALE');
INSERT INTO `noah_sitevalue` VALUES (7, 3, '1', '', '', '_GENDER_FEMALE');
INSERT INTO `noah_sitevalue` VALUES (10, 5, 'tpl_thanksforsubmission', '', 'Thanks For The Submission', '_TPL_MSG_THANKSFORSUBMISSION');
INSERT INTO `noah_sitevalue` VALUES (11, 5, 'tpl_needmoreinfo', '', 'Need More Info', '_TPL_MSG_NEEDMOREINFO');

# --------------------------------------------------------

#
# Table structure for table `noah_sysfield`
#

CREATE TABLE `noah_sysfield` (
  `fieldid` int(11) NOT NULL auto_increment,
  `groupid` int(11) NOT NULL default '0',
  `is_prim` tinyint(1) default '0',
  `fieldlabel` varchar(150) NOT NULL default '',
  `help_info` varchar(255) default NULL,
  `fieldtype` varchar(50) NOT NULL default '',
  `db_field` varchar(150) NOT NULL default '',
  `db_class` varchar(50) NOT NULL default '',
  `show_form` tinyint(1) NOT NULL default '0',
  `show_list` tinyint(1) NOT NULL default '0',
  `show_search` tinyint(1) NOT NULL default '0',
  `fielddefault` varchar(255) default NULL,
  `link_type` varchar(50) default NULL,
  `error_msg` varchar(255) default NULL,
  `field_options` text,
  `field_validation` varchar(255) default NULL,
  `fieldweight` varchar(4) default '10',
  `allow_sort` varchar(255) default '',
  UNIQUE KEY `fieldid` (`fieldid`)
) TYPE=MyISAM AUTO_INCREMENT=2024 ;

#
# Dumping data for table `noah_sysfield`
#

INSERT INTO `noah_sysfield` VALUES (7, 1, 0, 'Name', 'Enter a name for this system list. A system list can be used to store \'semi-static\' content that can be joined to system fields. ( no spaces or odd characters )', 'text', 'listname', 'var', 1, 1, 1, '', 'details', '', '30|255', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (217, 43, 1, 'ID KEY', 'ID Key for this table', 'auto', 'sharedfiltersid', '', 0, 1, 0, NULL, NULL, NULL, NULL, NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (218, 43, 0, 'User Filter', 'Select the user filter which is to be shared', 'select', 'filterid', 'var', 1, 1, 1, '', '0', '', 'noah_user_filters|filterid|filter_name', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (149, 4, 0, 'Content Group Type', 'Select a suitable category for this content group. You can adjust the values seen here by adding System Values to the System List \'group_types\'', 'syslist', 'group_type', 'var', 1, 1, 1, '', '0', '', '', '0', '12', '1');
INSERT INTO `noah_sysfield` VALUES (146, 4, 0, 'Read Access', 'Select the user group(s) who should be allowed to view content in this content group.', 'group_select', 'group_read', 'var', 1, 0, 0, 'a:1:{i:0;s:1:"1";}', '0', '', '', '0', '50', '1');
INSERT INTO `noah_sysfield` VALUES (144, 4, 0, 'Admin Access', 'Select the user group(s) who should be allowed admin control over this  content group.', 'group_select', 'group_admin', 'var', 1, 0, 0, 'a:1:{i:0;s:1:"1";}', '0', '', '', '0', '50', '1');
INSERT INTO `noah_sysfield` VALUES (150, 17, 1, 'prefid', 'ID Key for this preference group', 'auto', 'prefgroupid', 'int', 0, 0, 0, '', '0', '', '', NULL, '00', '1');
INSERT INTO `noah_sysfield` VALUES (151, 17, 0, 'Preference Group Name', 'Provide a unique name which can be used to access the values of this preference group. (no spaces or special characters)', 'text', 'pref_group', 'var', 1, 1, 1, '', 'details', '', '30|255', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (152, 17, 0, 'Preference Group Label', 'Provide a label for this preference group which can be used on the main form used to edit the groups values.', 'text', 'pref_group_label', 'var', 1, 1, 1, '', '0', '', '30|255', '0', '11', '1');
INSERT INTO `noah_sysfield` VALUES (153, 17, 0, 'Preference Group Desc', 'Provide a friendly description for this preference group', 'textarea', 'pref_group_desc', 'var', 1, 1, 1, '', '0', '', '3|30', '0', '12', '1');
INSERT INTO `noah_sysfield` VALUES (154, 17, 0, 'Admin Groups', 'Select the user groups who should be allowed to edit the values assigned to this preference group.', 'group_select', 'admin_groups', 'var', 1, 0, 0, 'a:1:{i:0;s:1:"1";}', '0', '', '', NULL, '15', '1');
INSERT INTO `noah_sysfield` VALUES (155, 17, 0, 'Visible Groups', '99 This field is not active.', 'group_select', 'read_groups', 'var', 1, 0, 0, 'a:1:{i:0;s:1:"1";}', '0', '', '', NULL, '16', '1');
INSERT INTO `noah_sysfield` VALUES (156, 18, 1, 'auto id', 'ID Key for this table', 'auto', 'prefvalueid', 'int', 0, 0, 0, '', '0', '', '', NULL, '00', '1');
INSERT INTO `noah_sysfield` VALUES (157, 18, 0, 'Prefrence Group', 'Select the preference group this config parameter belongs to', 'select', 'prefgroupid', 'int', 1, 1, 0, '', '0', '', 'noah_sysprefs|prefgroupid|pref_group_label', NULL, '15', '1');
INSERT INTO `noah_sysfield` VALUES (158, 18, 0, 'Config Name', 'Enter a name for this config parameter that can be used to reference the stored value (no spaces or special characters other than _ )', 'text', 'pref_name', 'var', 1, 1, 1, '', '0', '', '30|255', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (159, 18, 0, 'Value', 'Enter the value for this config parameter', 'text', 'pref_value', 'var', 1, 1, 1, '', '0', '', '30|255', '0', '11', '1');
INSERT INTO `noah_sysfield` VALUES (160, 18, 0, 'Input Field Type', 'Select the input field type that should be used when editing the config value', 'syslist', 'pref_field_type', 'var', 1, 1, 0, '', '0', '', 'noah_syslists|listid|listname|allow_null', NULL, '12', '1');
INSERT INTO `noah_sysfield` VALUES (161, 18, 0, 'Weight', 'Select the order for this config as it should appear in a form for all configuration values in the associated preference group', 'text', 'pref_weight', 'var', 1, 1, 0, '50', '0', '', '30|255', '0', '60', '1');
INSERT INTO `noah_sysfield` VALUES (162, 18, 0, 'Default Value', '99 this field is redundant and will be removed.', 'text', 'pref_default', 'var', 1, 0, 0, '', '0', '', '30|255', NULL, '99', '1');
INSERT INTO `noah_sysfield` VALUES (163, 18, 0, 'Options', 'Provide input field options for the select input field here', 'text', 'pref_options', 'var', 1, 1, 0, '', '0', '', '30|255', NULL, '13', '1');
INSERT INTO `noah_sysfield` VALUES (164, 18, 0, 'Prefrence Label', 'Provide a friendly label for this config which can be used in the form when this value is being edited.', 'text', 'pref_label', 'var', 1, 1, 1, '', '0', '', '30|255', NULL, '14', '1');
INSERT INTO `noah_sysfield` VALUES (165, 17, 0, 'Preference Link Name', 'Provide a short name for this preference group which can be used in menus and navigation', 'text', 'pref_link_name', 'var', 1, 0, 1, '', '0', '', '30|255', '0', '13', '1');
INSERT INTO `noah_sysfield` VALUES (166, 5, 0, 'Field Options', 'Depending on the field type you can provide some optional handlers for your field here. (need to include more specifics somewhere else)', 'text', 'field_options', 'var', 1, 1, 0, '', '', '', '30|255', '', '17', '1');
INSERT INTO `noah_sysfield` VALUES (1460, 248, 1, 'ID', 'Unique ID Key for this table', 'auto', 'relationid', 'int', 0, 0, 0, '', '0', '', '', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (1461, 248, 0, 'relationtype', 'Select the type of relationship. Select join if making relationship with other NoAh group. Select syslist if you want to join the selected field with the a system list.', 'text', 'relationtype', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '12', '1');
INSERT INTO `noah_sysfield` VALUES (6, 1, 1, 'ID', 'ID Key for the list', 'auto', 'listid', 'int', 0, 0, 0, '', '0', '', '', '0', '00', '1');
INSERT INTO `noah_sysfield` VALUES (8, 1, 0, 'Description', 'Provide a friendly description for this list.', 'textarea', 'listdesc', 'var', 1, 1, 1, '', '0', '', '3|30', NULL, '20', '1');
INSERT INTO `noah_sysfield` VALUES (9, 2, 1, 'ID', 'ID Key for this table', 'auto', 'valueid', 'int', 0, 0, 0, '', '0', '', '', '0', '00', '1');
INSERT INTO `noah_sysfield` VALUES (10, 2, 0, 'Value', 'Enter a value to be used as an optioni in the associated system list', 'text', 'value', 'var', 1, 1, 1, '', 'details', '', '30|255', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (11, 2, 0, 'Description', 'Enter a friendly description for this value', 'textarea', 'valuedesc', 'var', 1, 1, 0, '', '0', '', '3|30', NULL, '20', '1');
INSERT INTO `noah_sysfield` VALUES (12, 2, 0, 'List', 'Select the system list this value is assigned to.', 'select', 'listid', 'int', 1, 1, 1, '', '0', '', 'noah_syslists|listid|listname', NULL, '15', '1');
INSERT INTO `noah_sysfield` VALUES (20, 4, 1, 'ID', 'NoAh Content Group ID Key', 'auto', 'groupid', 'int', 0, 0, 0, '', '0', '', '', NULL, '00', '1');
INSERT INTO `noah_sysfield` VALUES (21, 4, 0, 'Nav Name', 'Provide a unique name which will be used to access this content group in page URLs. (no spaces or special characters)', 'text', 'group_name', 'var', 1, 1, 1, '', '0', 'name already in use', '30|255', 'unique_value', '11', '1');
INSERT INTO `noah_sysfield` VALUES (22, 4, 0, 'Content Group Label', 'Provide a label for your content group. This label will be used in navigation menus and other places which reference or link to this content group.', 'text', 'group_label', 'var', 1, 1, 1, '', 'details', 'Please add a label', '30|255', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (23, 4, 0, 'DB Table Name', 'This is the name of the database table which stores all the content in this group. This group supports relationships with other content groups. My Edit', 'text', 'table_name', 'var', 1, 0, 1, 'noah_', '0', 'table already in use', '30|255', 'unique_value', '13', '1');
INSERT INTO `noah_sysfield` VALUES (24, 4, 0, 'Detail Template', 'Select a custom SMARTY template for use when displaying this group\'s content. ( files stored in noah/tempaltes/item/ )', 'detail_templates', 'detail_tpl', 'var', 1, 1, 0, '', '0', '', 'allow_null', '0', '30', '1');
INSERT INTO `noah_sysfield` VALUES (27, 4, 0, 'ValidationScr', 'not active, possible use for additional validation when extending content groups.', 'text', 'validation_script', 'var', 1, 0, 0, '', '0', '', '30|255', NULL, '99', '1');
INSERT INTO `noah_sysfield` VALUES (29, 4, 0, 'Sub Processing Scr', ' Sub processing script allow a php script to extend the admin side for individual content groups.  Just upload scripts to pages (consider another local for these as is the same folder for public pages)', 'page_scripts', 'sub_processor', 'var', 1, 0, 0, '', '0', '', 'allow_null', '0', '42', '1');
INSERT INTO `noah_sysfield` VALUES (30, 5, 1, 'ID', 'NoAh Field ID', 'auto', 'fieldid', 'int', 0, 0, 0, '', '0', '', '', NULL, '00', '1');
INSERT INTO `noah_sysfield` VALUES (31, 5, 0, 'Content Group', 'Select the content group this field belongs to. This should be the content group which also defines the database table where this fields content is stored', 'select', 'groupid', 'int', 1, 1, 1, '', '0', '', 'noah_sysgroups|groupid|name', '0', '15', '1');
INSERT INTO `noah_sysfield` VALUES (32, 5, 0, '99Prime', 'This flag is set to true if this field is also the primary field for content group and table this field is assigned to.', 'checkbox', 'is_prim', 'int', 1, 0, 0, '0', '0', '', '', NULL, '99', '1');
INSERT INTO `noah_sysfield` VALUES (33, 5, 0, 'Label', 'Enter a label which can be used a column header or field label when this field is displayed in forms or in a list of content records.', 'text', 'fieldlabel', 'var', 1, 1, 1, '', '0', '', '30|255', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (34, 5, 0, 'Help Tip', 'Provide a helpful tip which can be displayed when a user needs possible assistance. ( You are reading a help tip now )', 'textarea', 'help_info', 'var', 1, 0, 0, '', '0', '', '2|20', '0', '14', '1');
INSERT INTO `noah_sysfield` VALUES (35, 5, 0, 'Input Field Type (html)', 'Select the type of input field which should be used when this field is being displayed in a html form.', 'syslist', 'fieldtype', 'var', 1, 1, 0, '', '0', '', '', NULL, '13', '1');
INSERT INTO `noah_sysfield` VALUES (36, 5, 0, 'DB Field Name', 'Enter the field name for this field as it is defined in the database table', 'text', 'db_field', 'var', 1, 1, 1, '', '0', '', '30|255', NULL, '12', '1');
INSERT INTO `noah_sysfield` VALUES (37, 5, 0, '99 DB Field Class', 'This field is no longer needed, just ignore.', 'syslist', 'db_class', 'var', 1, 0, 0, 'var', '0', '', '', NULL, '60', '1');
INSERT INTO `noah_sysfield` VALUES (38, 5, 0, 'Show Form', 'Check this box to have this field visible when adding or editing records for the assigned content group', 'checkbox', 'show_form', 'int', 1, 1, 1, '1', '0', '', '', NULL, '60', '1');
INSERT INTO `noah_sysfield` VALUES (39, 5, 0, 'Show List', 'Check this box to have this field visible when viewing a list of records for the assigned content group', 'checkbox', 'show_list', 'int', 1, 1, 1, '1', '0', '', '', '0', '60', '1');
INSERT INTO `noah_sysfield` VALUES (40, 5, 0, 'Show Search', 'Check this box to have this field visible when filtering the records of the assigned content group', 'checkbox', 'show_search', 'int', 1, 1, 1, '1', '', '', '', '', '60', '1');
INSERT INTO `noah_sysfield` VALUES (41, 5, 0, 'Weight', 'Enter the order or weight for this field.', 'text', 'fieldweight', 'var', 1, 1, 0, '50', '0', '', '30|255', '0', '20', '1');
INSERT INTO `noah_sysfield` VALUES (46, 5, 0, 'Link To ..', 'Select a link type for this field. ( selecting \'detail\' will link the content stored in this field to the \'detailed noah\' view for that complete record)', 'syslist', 'link_type', 'var', 1, 0, 0, '', '0', '', 'allow_null', NULL, '60', '1');
INSERT INTO `noah_sysfield` VALUES (47, 5, 0, 'Error Msg', 'Enter the generic error message that should display when there is a problem validating this field.', 'text', 'error_msg', 'var', 1, 1, 0, '', '0', '', '30|255', '0', '18', '1');
INSERT INTO `noah_sysfield` VALUES (60, 5, 0, 'Default Value', 'Enter the default value for this field.', 'text', 'fielddefault', 'var', 1, 0, 0, '', '0', '', '30|255', NULL, '16', '1');
INSERT INTO `noah_sysfield` VALUES (61, 6, 1, 'ID', 'ID Key for this table', 'auto', 'filterid', 'int', 0, 0, 0, '', '0', '', '', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (62, 6, 0, 'Name', 'Provide a friendly name for this filter', 'text', 'filter_name', 'var', 1, 1, 1, '', '0', '', '30|255', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (63, 6, 0, 'where_str', 'Provide SQL syntax for WHERE statement (typically generated by system, but can be manually updated here for unique requirements)', 'textarea', 'where_str', 'var', 1, 1, 0, '', '0', '', '3|30', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (64, 6, 0, 'Group', 'the name of the content group this filter is applied against', 'text', 'filter_group', 'var', 1, 1, 0, '', '0', '', '30|255', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (65, 6, 0, 'User', 'Select the user who owns ( or created ) this filter', 'select', 'userid', 'int', 1, 1, 1, '', '0', '', 'users|uid|uname', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (294, 51, 1, 'ID KEY', '', 'auto', 'listid', 'var', 0, 0, 0, '', '0', '', '', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (295, 51, 0, 'listname', '', 'text', 'listname', 'var', 1, 1, 1, '', '0', 'Each name here must be unique', '30|255', 'unique_value', '10', '1');
INSERT INTO `noah_sysfield` VALUES (296, 51, 0, 'listdesc', '', 'textarea', 'listdesc', 'var', 1, 1, 1, '', '0', '', '3|30', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (297, 52, 1, 'ID KEY', '', 'auto', 'valueid', 'var', 0, 0, 0, '', '0', '', '', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (298, 52, 0, 'listid', '', 'select', 'listid', 'var', 1, 1, 1, '', '0', '', 'noah_sitelists|listid|listname', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (299, 52, 0, 'value', 'keep it simple. should be unique to assigned list', 'text', 'value', 'var', 1, 1, 1, '', '0', '', '30|255', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (300, 52, 0, 'valuedesc', NULL, 'text', 'valuedesc', 'var', 1, 1, 1, NULL, NULL, NULL, '30|255', NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (107, 4, 0, 'Weight / Order', 'Enter number to define the order this content group should fall under when being displayed in menus', 'text', 'group_weight', 'var', 1, 1, 0, '50', '0', '', '30|255', '0', '20', '1');
INSERT INTO `noah_sysfield` VALUES (108, 4, 0, 'Show in Noah Index', 'Select this to have this content group appear in the main NoAh index page', 'checkbox', 'show_nav', 'int', 1, 0, 0, '1', '0', '', '', NULL, '21', '1');
INSERT INTO `noah_sysfield` VALUES (116, 4, 0, 'Content Group Desc', 'Provide a description for this content group', 'textarea', 'groupdesc', 'var', 1, 0, 0, '', '0', '', '3|30', NULL, '15', '1');
INSERT INTO `noah_sysfield` VALUES (187, 5, 0, 'Validation Requirements', 'if field has validation requirements you can select from these standard types.', 'syslist', 'field_validation', 'var', 1, 1, 0, '', '0', '', 'allow_null', 'email_address', '19', '1');
INSERT INTO `noah_sysfield` VALUES (211, 4, 0, 'Custom Form Template', 'Select a custom SMARTY template for use when displaying a form to edit or add records in this content group. ( files stored in noah/tempaltes/form/ )', 'form_templates', 'form_template', 'var', 1, 0, 0, '', '0', '', 'allow_null', '0', '22', '1');
INSERT INTO `noah_sysfield` VALUES (219, 43, 0, 'Group', 'Select the user groups who should be given access to this filter', 'select', 'groupid', 'var', 1, 1, 1, '', '0', '', 'groups|groupid|name', '0', '10', '1');
INSERT INTO `noah_sysfield` VALUES (220, 44, 1, 'ID KEY', 'ID Key for this table', 'auto', 'pagesid', 'int', 0, 0, 0, '', '0', '', '', '0', '00', '1');
INSERT INTO `noah_sysfield` VALUES (221, 44, 0, 'Nav Name', 'Enter a suitable name for this page which will be used to access this page in a URL ( no spaces or special characters other than \'_\')', 'text', 'nav_name', 'var', 1, 1, 1, '', '0', 'this nav name may be restricted or already in use.', '30|255', 'unique_value', '10', '1');
INSERT INTO `noah_sysfield` VALUES (222, 44, 0, 'Page Title', 'Enter a page title for this page.', 'text', 'page_title', 'var', 1, 1, 1, '', '0', 'You have to provide a page title', '30|255', 'filled_in', '12', '1');
INSERT INTO `noah_sysfield` VALUES (223, 44, 0, 'Page Script', 'You can use a custom php script for this page. Your scripts can make use of any Xoops or Noah classes.  Upload scripts to noah/page/', 'page_scripts', 'page_script', 'var', 1, 0, 1, '', '0', '', 'allow_null', '0', '20', '1');
INSERT INTO `noah_sysfield` VALUES (226, 44, 0, 'Static Block', 'If you don\'t need dynamic content for your page and only want to display html, you can select any static blocks used in xoops. You can use Xoops Blocks area of the control panel to create more xoops blocks.', 'static_blocks', 'bid', 'var', 1, 1, 1, '', '0', '', 'allow_null', '0', '18', '1');
INSERT INTO `noah_sysfield` VALUES (225, 44, 0, 'Smarty Template', 'Provide a custom SMARTY template for this page. Upload files to noah/templates/page/', 'page_templates', 'page_template', 'var', 1, 0, 1, '', '0', '', 'allow_null', '0', '19', '1');
INSERT INTO `noah_sysfield` VALUES (236, 44, 0, 'Parent Page', 'Select a parent page ( note:: I got some bugs with doing \'self joins\' so having issues joining this table to itself, you can manually assign a pagesid key here)', 'text', 'page_parent', 'var', 1, 0, 1, '', '0', '', 'noah_pages|pagesid|page_label|allow_null', '0', '16', '1');
INSERT INTO `noah_sysfield` VALUES (239, 44, 0, 'Show nav', 'Check if you want this page to display in the Pages Menu xoops block.', 'checkbox', 'page_shownav', 'var', 1, 1, 1, '1', '0', '', '', '0', '17', '1');
INSERT INTO `noah_sysfield` VALUES (240, 44, 0, 'Label', 'Enter a name that can be used in menu links and other references to this page', 'text', 'page_label', 'var', 1, 1, 1, '', '0', '', '30|255', '0', '13', '1');
INSERT INTO `noah_sysfield` VALUES (252, 44, 0, 'Read Access', 'Select the user groups who should be allowed to see this page', 'group_select', 'page_read', 'var', 1, 0, 1, '', '0', '', '', '0', '25', '1');
INSERT INTO `noah_sysfield` VALUES (253, 44, 0, 'Admin Access', 'Select the user groups who should be allowed to edit the content of this page * ( this can be set and then referenced in your custom pages )', 'group_select', 'page_admin', 'var', 1, 0, 0, '', '0', '', '', '0', '25', '1');
INSERT INTO `noah_sysfield` VALUES (254, 44, 0, 'Page Options', 'enter URL here if page type = External or Internal', 'text', 'page_options', 'var', 1, 0, 1, '', '0', '', '30|255', '0', '15', '1');
INSERT INTO `noah_sysfield` VALUES (255, 44, 0, 'Page Type', 'External (link to other site) Internal (link to url in your own site) Content (load content according to settings above)', 'syslist', 'page_type', 'var', 1, 1, 1, '', '0', '', '', '0', '11', '1');
INSERT INTO `noah_sysfield` VALUES (256, 44, 0, 'Weight', 'Set the order of this page as it should appear in menu lisitings', 'text', 'page_weight', 'var', 1, 1, 1, '', '0', '', '30|10', '0', '22', '1');
INSERT INTO `noah_sysfield` VALUES (1467, 248, 0, 'allow_null', 'Select if this relationship is optional', 'checkbox', 'allow_null', 'var', 1, 1, 0, '0', '0', '', '30|255', '0', '18', '1');
INSERT INTO `noah_sysfield` VALUES (1466, 248, 0, 'jn_display', 'Enter the name of the field we should be displayed as joined content. This can be any field in our joined table.', 'text', 'jn_display', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '16', '1');
INSERT INTO `noah_sysfield` VALUES (1464, 248, 0, 'jn_table', 'Enter the name of our join table. This is the the database table which holds the field we are joining with.', 'text', 'jn_table', 'var', 1, 1, 0, '', '0', '', '30|255', '0', '14', '1');
INSERT INTO `noah_sysfield` VALUES (1465, 248, 0, 'jn_field', 'Enter the name of the database field which we want to join with. (This should typically be a unique field or key from the joined table.', 'text', 'jn_field', 'var', 1, 1, 0, '', '0', '', '30|255', '0', '15', '1');
INSERT INTO `noah_sysfield` VALUES (1463, 248, 0, 'listid', 'If you have selected the relationship type \'syslist\' then select the system list which has the content you want to join your field with.', 'select', 'listid', 'var', 1, 1, 0, '', '0', '', 'allow_null', '0', '17', '1');
INSERT INTO `noah_sysfield` VALUES (1462, 248, 0, 'fieldid', 'Select the field you want to join. A \'joined\' field is a field which stores information or content from another content group. (note: fields should be specifically created to for the purpose of making a join, do not create a join on an existing field. cre', 'select', 'fieldid', 'var', 1, 1, 0, '', '0', '', '30|255', '0', '11', '1');
INSERT INTO `noah_sysfield` VALUES (1534, 51, 0, 'List Label', '', 'text', 'listlabel', 'var', 1, 1, 0, '', '0', '', '20|255', '0', '50', '1');
INSERT INTO `noah_sysfield` VALUES (1535, 52, 0, 'Value Label', 'label for your value, this is what is displayed', 'text', 'valuelabel', 'var', 1, 1, 1, '', '0', '', '30|255', '0', '50', '1');
INSERT INTO `noah_sysfield` VALUES (1538, 248, 0, 'Site List', 'select a site list. Requres relation type \'sitelist\'', 'select', 'sitelistid', 'var', 1, 1, 1, '', '0', '', '', '0', '50', '1');
INSERT INTO `noah_sysfield` VALUES (1791, 52, 0, 'Language Constant', '', 'text', 'langconst', 'var', 1, 1, 1, '', '0', '', '30|255', '0', '50', '1');
INSERT INTO `noah_sysfield` VALUES (1865, 44, 0, 'Use SSL', 'if checked then links to this page should use the prefix https://  instead of http://', 'checkbox', 'usessl', 'var', 1, 1, 1, '0', '0', '', '', '0', '50', '1');
INSERT INTO `noah_sysfield` VALUES (1925, 296, 1, 'ID', NULL, 'auto', 'bid', 'int', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '10', '1');
INSERT INTO `noah_sysfield` VALUES (1926, 296, 0, 'mid', NULL, 'text', 'mid', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1927, 296, 0, 'func_num', NULL, 'text', 'func_num', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1928, 296, 0, 'options', NULL, 'text', 'options', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1929, 296, 0, 'name', NULL, 'text', 'name', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1930, 296, 0, 'title', NULL, 'text', 'title', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1931, 296, 0, 'content', '', 'wysiwyg', 'content', 'var', 1, 0, 0, '', '', '', '650|650', '', '50', '1');
INSERT INTO `noah_sysfield` VALUES (1932, 296, 0, 'side', NULL, 'text', 'side', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1933, 296, 0, 'weight', NULL, 'text', 'weight', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1934, 296, 0, 'visible', NULL, 'text', 'visible', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1935, 296, 0, 'block_type', NULL, 'text', 'block_type', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1936, 296, 0, 'c_type', NULL, 'text', 'c_type', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1937, 296, 0, 'isactive', NULL, 'text', 'isactive', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1938, 296, 0, 'dirname', NULL, 'text', 'dirname', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1939, 296, 0, 'func_file', NULL, 'text', 'func_file', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1940, 296, 0, 'show_func', NULL, 'text', 'show_func', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1941, 296, 0, 'edit_func', NULL, 'text', 'edit_func', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1942, 296, 0, 'template', NULL, 'text', 'template', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1943, 296, 0, 'bcachetime', NULL, 'text', 'bcachetime', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (1944, 296, 0, 'last_modified', NULL, 'text', 'last_modified', 'var', 1, 1, 0, NULL, NULL, NULL, '30|255', NULL, '50', '1');
INSERT INTO `noah_sysfield` VALUES (2023, 5, 0, 'Allow Sort', '', 'checkbox', 'allow_sort', 'var', 1, 1, 1, '1', '', '', '', '', '50', '1');
INSERT INTO `noah_sysfield` VALUES (2016, 302, 1, 'ID', NULL, 'auto', 'changeid', 'int', 0, 0, 0, NULL, NULL, '', '', '', '10', '1');
INSERT INTO `noah_sysfield` VALUES (2017, 302, 0, 'change_date', NULL, 'timestamp', 'change_date', 'var', 1, 1, 0, NULL, NULL, '', 'once', '', '50', '1');
INSERT INTO `noah_sysfield` VALUES (2018, 302, 0, 'groupid', NULL, 'text', 'groupid', 'var', 1, 1, 0, NULL, NULL, '', '30|255', '', '50', '1');
INSERT INTO `noah_sysfield` VALUES (2019, 302, 0, 'itemid', NULL, 'text', 'itemid', 'var', 1, 1, 0, NULL, NULL, '', '30|255', '', '50', '1');
INSERT INTO `noah_sysfield` VALUES (2020, 302, 0, 'change_type', NULL, 'text', 'change_type', 'var', 1, 1, 0, NULL, NULL, '', '30|255', '', '50', '1');
INSERT INTO `noah_sysfield` VALUES (2021, 302, 0, 'userid', NULL, 'text', 'userid', 'var', 1, 1, 0, NULL, NULL, '', '30|255', '', '50', '1');
INSERT INTO `noah_sysfield` VALUES (2022, 302, 0, 'change_data', NULL, 'textarea', 'change_data', 'var', 1, 1, 0, NULL, NULL, '', '6|30', '', '50', '1');

# --------------------------------------------------------

#
# Table structure for table `noah_sysgroup`
#

CREATE TABLE `noah_sysgroup` (
  `groupid` int(11) NOT NULL auto_increment,
  `group_name` varchar(150) NOT NULL default '',
  `group_label` varchar(150) NOT NULL default '',
  `table_name` varchar(150) NOT NULL default '',
  `detail_tpl` varchar(150) NOT NULL default '',
  `detail_labels` varchar(150) NOT NULL default '',
  `list_template` varchar(255) default NULL,
  `validation_script` varchar(150) NOT NULL default '',
  `sub_processor` varchar(255) default NULL,
  `group_weight` int(11) NOT NULL default '50',
  `show_nav` tinyint(1) NOT NULL default '0',
  `groupdesc` text,
  `group_admin` varchar(255) default NULL,
  `group_read` varchar(255) default NULL,
  `group_type` varchar(255) default NULL,
  `form_template` varchar(255) default NULL,
  UNIQUE KEY `groupid` (`groupid`)
) TYPE=MyISAM AUTO_INCREMENT=303 ;

#
# Dumping data for table `noah_sysgroup`
#

INSERT INTO `noah_sysgroup` VALUES (1, 'syslists', 'System Lists', 'noah_syslist', '0', 'detail_labels.php', '0', '', '0', 50, 1, 'System lists are groups of \\\\\\\'pick lists\\\\\\\' which can be used throughout the system to define selectable values.', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}', 'core', '0');
INSERT INTO `noah_sysgroup` VALUES (2, 'sysvalues', 'System List Values', 'noah_sysvalue', '0', '', '0', '', '0', 50, 0, 'This group defines the information which is stored about system list values.', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'core', '0');
INSERT INTO `noah_sysgroup` VALUES (4, 'sysgroups', 'Content Groups (Tables)', 'noah_sysgroup', '0', 'detail_labels.php', '0', '', '0', 50, 0, 'This is the main content group used by the system. It defines all the information that is stored about each content group.', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'core', '0');
INSERT INTO `noah_sysgroup` VALUES (5, 'sysfield', 'Content Fields', 'noah_sysfield', '0', 'detail_labels.php', '0', '', '0', 50, 0, 'this group defines all the details we need to manage about a single piece of data. This group is rather large at the moment. There are several fields here which can be replaced with dynamic functions. In time I will remove these but until then they at least need to be stored here.', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'core', '0');
INSERT INTO `noah_sysgroup` VALUES (6, 'userfilter', 'Saved User Filters', 'noah_ufilter', '0', '', '0', '', '0', 50, 0, 'This group defines the data which is captured when a user saves a search. A user can assign names to searches and then easily access them later. User filters can be shared with User Groups, thus providing a way to give an entire group quick access to the search results.', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'sub', '0');
INSERT INTO `noah_sysgroup` VALUES (51, 'sitelists', 'Site Lists', 'noah_sitelist', '0', 'detail_labels.php', '0', '', '0', 50, 1, 'These are the same as system lists but for none core features.', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'sub', '0');
INSERT INTO `noah_sysgroup` VALUES (52, 'sitevalues', 'Site Values', 'noah_sitevalue', '0', 'detail_labels.php', '0', '', '0', 50, 1, 'these are the values that make up the site lists.', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}', 'sub', '0');
INSERT INTO `noah_sysgroup` VALUES (17, 'sysprefs', 'System Preference Groups', 'noah_pref', '0', 'detail_labels.php', '0', '', '0', 50, 1, 'This group defines lists of system prefrences which can then be used in functions or pages and easily maintained with the no-ah admin.', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'core', '0');
INSERT INTO `noah_sysgroup` VALUES (18, 'sysprefvalues', 'System Preference Values', 'noah_prefvalue', '0', 'detail_labels.php', '0', '', '0', 50, 1, 'These are the actual system prefrences. Each Value will contain full details on how to display the info as well as the value being captured.', 'a:1:{i:0;s:1:"1";}', 'a:2:{i:0;s:1:"1";i:1;s:1:"5";}', 'core', 'noah_form_base.html');
INSERT INTO `noah_sysgroup` VALUES (43, 'sharedfilters', 'Shared Filters', 'noah_sfilter', '0', 'detail_labels.php', '0', '', '0', 50, 1, 'filters shared across groups.', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'sub', 'noah_form_base.html');
INSERT INTO `noah_sysgroup` VALUES (44, 'pages', 'Site Map / Pages', 'noah_page', '0', 'detail_labels.php', '0', '', '0', 50, 1, 'this group defines various pages in the site.', 'a:1:{i:0;s:1:"1";}', 'a:3:{i:0;s:1:"1";i:1;s:1:"4";i:2;s:1:"5";}', 'sub', '0');
INSERT INTO `noah_sysgroup` VALUES (248, 'relations', 'Content Relationships', 'noah_relation', '0', '', NULL, '', NULL, 10, 1, 'This group defines relationships between NoAh groups.', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'core', '0');
INSERT INTO `noah_sysgroup` VALUES (296, 'xblocks', 'Xoops Blocks', 'newblocks', '0', '', NULL, '', '0', 50, 1, '', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'sub', '0');
INSERT INTO `noah_sysgroup` VALUES (302, 'changelog', 'Change Log', 'noah_changelog', '0', '', NULL, '', '0', 50, 1, '', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:1:"1";}', 'core', '0');

# --------------------------------------------------------

#
# Table structure for table `noah_syslist`
#

CREATE TABLE `noah_syslist` (
  `listid` int(11) NOT NULL auto_increment,
  `listname` varchar(55) NOT NULL default '',
  `listdesc` varchar(255) default NULL,
  `dfsdfsf` varchar(255) default '',
  `address_st_num` varchar(255) default NULL,
  UNIQUE KEY `listid` (`listid`)
) TYPE=MyISAM AUTO_INCREMENT=20 ;

#
# Dumping data for table `noah_syslist`
#

INSERT INTO `noah_syslist` VALUES (1, 'sys_field_types', 'These are the different field types supported by the system', '', NULL);
INSERT INTO `noah_syslist` VALUES (2, 'db_class', 'The type of db_field to assist in managing sql statements', '', NULL);
INSERT INTO `noah_syslist` VALUES (3, 'link_types', 'types of links used by noah system lists.', '', NULL);
INSERT INTO `noah_syslist` VALUES (6, 'group_types', 'This defines a list of group types to help define their main purpose.', '', NULL);
INSERT INTO `noah_syslist` VALUES (9, 'validation_types', 'a list of different validation functions.', '', NULL);
INSERT INTO `noah_syslist` VALUES (10, 'page_types', 'types of pages for use with the sites pages.', '', NULL);
INSERT INTO `noah_syslist` VALUES (15, 'artist_categories', 'Artist Categories', '', NULL);
INSERT INTO `noah_syslist` VALUES (16, 'art_status', 'status of art work', '', NULL);
INSERT INTO `noah_syslist` VALUES (17, 'art_medium', '', '', NULL);
INSERT INTO `noah_syslist` VALUES (18, 'art_categories', '', '', NULL);
INSERT INTO `noah_syslist` VALUES (19, 'art_subject', '', '', NULL);

# --------------------------------------------------------

#
# Table structure for table `noah_sysvalue`
#

CREATE TABLE `noah_sysvalue` (
  `valueid` int(11) NOT NULL auto_increment,
  `listid` int(11) NOT NULL default '0',
  `value` varchar(50) NOT NULL default '',
  `valuedesc` varchar(255) default NULL,
  UNIQUE KEY `valueid` (`valueid`)
) TYPE=MyISAM AUTO_INCREMENT=98 ;

#
# Dumping data for table `noah_sysvalue`
#

INSERT INTO `noah_sysvalue` VALUES (1, 1, 'auto', 'intended for an auto increamented field which is the primary ID for the group assigned.');
INSERT INTO `noah_sysvalue` VALUES (2, 1, 'text', 'a text field');
INSERT INTO `noah_sysvalue` VALUES (3, 1, 'textarea', 'a text area');
INSERT INTO `noah_sysvalue` VALUES (4, 1, 'select', 'a select field, requires jn_*  information added.');
INSERT INTO `noah_sysvalue` VALUES (5, 2, 'int', 'integer type data no special treatment in sql');
INSERT INTO `noah_sysvalue` VALUES (6, 2, 'var', 'varchar or other field type needing slash stripping for special characters');
INSERT INTO `noah_sysvalue` VALUES (7, 3, 'details', 'links field to the details or edit view of group');
INSERT INTO `noah_sysvalue` VALUES (8, 1, 'checkbox', 'this can be used for a simple boolean yes-no check box. 1 active, 0 not active.');
INSERT INTO `noah_sysvalue` VALUES (9, 1, 'syslist', 'map to a system list');
INSERT INTO `noah_sysvalue` VALUES (20, 1, 'group_select', 'This is a special multiple select list which allows user to select system groups. Stored in an array.');
INSERT INTO `noah_sysvalue` VALUES (21, 1, 'upload', 'Creates an upload form field.');
INSERT INTO `noah_sysvalue` VALUES (22, 6, 'core', 'These are the core groups which govern the system.');
INSERT INTO `noah_sysvalue` VALUES (23, 6, 'main', 'These are all top level content groups. Like Products, Customers, Categories ect.');
INSERT INTO `noah_sysvalue` VALUES (24, 6, 'sub', 'These groups make up sub content elements in the system. They are usually edited through the Main Content Groups as sub content. They may also represent join groups.');
INSERT INTO `noah_sysvalue` VALUES (25, 1, 'timestamp', 'time stamp field');
INSERT INTO `noah_sysvalue` VALUES (32, 9, 'email_address', 'validate item as email address');
INSERT INTO `noah_sysvalue` VALUES (33, 9, 'filled_in', 'validate that form is filled in');
INSERT INTO `noah_sysvalue` VALUES (34, 9, 'unique_value', 'validate that the data provided in this field is unique.');
INSERT INTO `noah_sysvalue` VALUES (38, 1, 'hidden', 'Hidden field');
INSERT INTO `noah_sysvalue` VALUES (39, 1, 'static_blocks', 'a listing of all static blocks (custom blocks) in the db');
INSERT INTO `noah_sysvalue` VALUES (49, 6, 'xoops', 'these are all xoops core tables.');
INSERT INTO `noah_sysvalue` VALUES (40, 10, 'content_page', 'used for static or dynamic pages.');
INSERT INTO `noah_sysvalue` VALUES (41, 10, 'internal_page', 'this links to a page using the site URL as the base href');
INSERT INTO `noah_sysvalue` VALUES (42, 10, 'external_page', 'use this links to a url not part of the site domain');
INSERT INTO `noah_sysvalue` VALUES (43, 1, 'page_templates', 'a select list of page templates.');
INSERT INTO `noah_sysvalue` VALUES (44, 1, 'page_scripts', 'this shows a pic list of page scripts files from the page script folder');
INSERT INTO `noah_sysvalue` VALUES (45, 1, 'site_list', 'this maps to a values from sitelists');
INSERT INTO `noah_sysvalue` VALUES (46, 1, 'detail_templates', 'provides a select list of templates from details template folder');
INSERT INTO `noah_sysvalue` VALUES (47, 1, 'group_scripts', 'this will provide a pick list of scripts from the group scripts folder.');
INSERT INTO `noah_sysvalue` VALUES (48, 1, 'form_templates', 'this provides a list of uploaded custom form templates.');
INSERT INTO `noah_sysvalue` VALUES (53, 6, 'XoopsCore', 'XoopsCore is a set of NoAh groups built for the core xoops tables.  These groups should be used mostly for reviewing data or extending available fields.');
INSERT INTO `noah_sysvalue` VALUES (56, 1, 'password', 'a password field');
INSERT INTO `noah_sysvalue` VALUES (57, 15, 'Gallery Artists', 'A grouping of gallery artists');
INSERT INTO `noah_sysvalue` VALUES (58, 15, 'Historical Canadian', 'Historical Canadian Artists');
INSERT INTO `noah_sysvalue` VALUES (59, 16, 'Available', '');
INSERT INTO `noah_sysvalue` VALUES (60, 16, 'Sold', '');
INSERT INTO `noah_sysvalue` VALUES (61, 16, 'Hold', '');
INSERT INTO `noah_sysvalue` VALUES (62, 17, 'Acrylic', '');
INSERT INTO `noah_sysvalue` VALUES (63, 17, 'Aluminum', '');
INSERT INTO `noah_sysvalue` VALUES (64, 17, 'Bronze', '');
INSERT INTO `noah_sysvalue` VALUES (65, 17, 'Ceramic', '');
INSERT INTO `noah_sysvalue` VALUES (66, 17, 'Etching', '');
INSERT INTO `noah_sysvalue` VALUES (67, 17, 'Fiberglass', '');
INSERT INTO `noah_sysvalue` VALUES (68, 17, 'Giclee', '');
INSERT INTO `noah_sysvalue` VALUES (69, 17, 'Gouache', '');
INSERT INTO `noah_sysvalue` VALUES (70, 17, 'Lino-cut Prints', '');
INSERT INTO `noah_sysvalue` VALUES (71, 17, 'Marble', '');
INSERT INTO `noah_sysvalue` VALUES (72, 17, 'Mixed Media', '');
INSERT INTO `noah_sysvalue` VALUES (73, 17, 'Oil', '');
INSERT INTO `noah_sysvalue` VALUES (74, 17, 'Oil-Pastel', '');
INSERT INTO `noah_sysvalue` VALUES (75, 17, 'Pastel', '');
INSERT INTO `noah_sysvalue` VALUES (76, 17, 'Pencil / Pen / Ink', '');
INSERT INTO `noah_sysvalue` VALUES (77, 17, 'Stencile Print', '');
INSERT INTO `noah_sysvalue` VALUES (78, 17, 'Tempra', '');
INSERT INTO `noah_sysvalue` VALUES (79, 17, 'Watercolour', '');
INSERT INTO `noah_sysvalue` VALUES (80, 17, 'Wood', '');
INSERT INTO `noah_sysvalue` VALUES (81, 17, 'Wood Block Prints', '');
INSERT INTO `noah_sysvalue` VALUES (82, 17, 'Wood Engraving', '');
INSERT INTO `noah_sysvalue` VALUES (83, 18, 'Drawings', '');
INSERT INTO `noah_sysvalue` VALUES (84, 18, 'Original Prints', '');
INSERT INTO `noah_sysvalue` VALUES (85, 18, 'Paintings', '');
INSERT INTO `noah_sysvalue` VALUES (86, 18, 'Reproductions', '');
INSERT INTO `noah_sysvalue` VALUES (87, 18, 'Sculpture', '');
INSERT INTO `noah_sysvalue` VALUES (88, 19, 'Canadian Landscape', '');
INSERT INTO `noah_sysvalue` VALUES (89, 19, 'European Landscape', '');
INSERT INTO `noah_sysvalue` VALUES (90, 19, 'Figurative Works', '');
INSERT INTO `noah_sysvalue` VALUES (91, 19, 'Floral', '');
INSERT INTO `noah_sysvalue` VALUES (92, 19, 'Portraiture', '');
INSERT INTO `noah_sysvalue` VALUES (93, 19, 'Seascape', '');
INSERT INTO `noah_sysvalue` VALUES (94, 19, 'Still Life', '');
INSERT INTO `noah_sysvalue` VALUES (95, 19, 'Street Scene', '');
INSERT INTO `noah_sysvalue` VALUES (96, 19, 'Wildlife', '');
INSERT INTO `noah_sysvalue` VALUES (97, 1, 'wysiwyg', 'Uses a Wysiwyg editor');

# --------------------------------------------------------

#
# Table structure for table `noah_ufilter`
#

CREATE TABLE `noah_ufilter` (
  `filterid` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `where_str` blob,
  `filter_name` varchar(50) default NULL,
  `filter_group` varchar(250) default NULL,
  `group_share` varchar(255) default NULL,
  PRIMARY KEY  (`filterid`),
  UNIQUE KEY `filterid` (`filterid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Dumping data for table `noah_ufilter`
#

