-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generatie Tijd: 21 Apr 2010 om 19:53
-- Server versie: 5.0.37
-- PHP Versie: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `cms1_mozaiekgrime`
-- 

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `custom_configs`
-- 

CREATE TABLE `custom_configs` (
  `table_name` varchar(80) default NULL,
  `object_id` int(11) default NULL,
  `config_key` varchar(60) NOT NULL default '',
  `config_value` text NOT NULL,
  UNIQUE KEY `table_name` (`table_name`,`object_id`,`config_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Gegevens worden uitgevoerd voor tabel `custom_configs`
-- 

INSERT INTO `custom_configs` VALUES ('menu_items', 2, 'Color', '');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `form_fields`
-- 

CREATE TABLE `form_fields` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `form_implementation_id` int(10) unsigned NOT NULL default '0',
  `type` enum('label','textbox','email','textarea','checkbox','checkboxes','radiobuttons','select','specialtextbox') NOT NULL default 'textbox',
  `label_1` varchar(255) NOT NULL default '',
  `maxlength` int(10) unsigned NOT NULL default '0',
  `label_2` varchar(255) NOT NULL default '',
  `label_3` varchar(255) NOT NULL default '',
  `options` text NOT NULL,
  `is_enabled` enum('1','0') NOT NULL default '1',
  `is_required` enum('1','0') NOT NULL default '0',
  `o` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `form_fields`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `form_implementations`
-- 

CREATE TABLE `form_implementations` (
  `implementation_id` int(10) unsigned NOT NULL auto_increment,
  `content_1` varchar(100) NOT NULL default '',
  `send_to_email` varchar(100) NOT NULL default '',
  `send_from_email` varchar(100) NOT NULL default '',
  `send_from_name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`implementation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `form_implementations`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `guestbook_entries`
-- 

CREATE TABLE `guestbook_entries` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `guestbook_implementation_id` int(10) unsigned NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `website` varchar(100) NOT NULL default '',
  `subject` varchar(100) NOT NULL default '',
  `message` varchar(100) NOT NULL default '',
  `message_2` varchar(100) NOT NULL default '',
  `verified` enum('0','1') NOT NULL default '0',
  `utc` int(10) unsigned NOT NULL default '0',
  `ip` varchar(100) NOT NULL default '',
  `deleted` enum('0','1') NOT NULL default '0',
  `o` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `guestbook_entries`
-- 

INSERT INTO `guestbook_entries` VALUES (1, 1, 'rudie', 'test@test.nl', '', '', 'dit is een test.\r\nmet een enter', '', '0', 1271190761, '87.209.48.1', '0', 1);
INSERT INTO `guestbook_entries` VALUES (2, 1, 'rudie', 'test2@test2.nl', '', '', 'Oele\r\nboele\r\ntra-la-la', '06 1234 5678', '0', 1271191446, '87.209.48.1', '0', 2);
INSERT INTO `guestbook_entries` VALUES (3, 1, 'Cees Oomens', 'c.w.j.oomens@tue.nl', '', '', 'Hi Rudy,\r\n\r\nZiet er leuk uit maar ik snap er nog niks van', '', '0', 1271706578, '80.126.128.131', '0', 3);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `guestbook_implementations`
-- 

CREATE TABLE `guestbook_implementations` (
  `implementation_id` int(10) unsigned NOT NULL auto_increment,
  `title_2` varchar(100) NOT NULL default '',
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `label_for_title_1` varchar(100) NOT NULL default 'Title',
  `label_for_content_1` varchar(100) NOT NULL default 'Content',
  `label_for_title_2` varchar(100) NOT NULL default 'Title 2',
  `label_for_content_2` varchar(100) NOT NULL default 'Content 2',
  `must_verify` varchar(100) NOT NULL default '',
  `use_name` enum('0','1') NOT NULL default '1',
  `use_email` enum('0','1') NOT NULL default '1',
  `use_website` enum('0','1') NOT NULL default '1',
  `use_subject` enum('0','1') NOT NULL default '1',
  `label_for_message_2` varchar(100) NOT NULL default '1',
  `use_message_2` enum('0','1') NOT NULL default '1',
  `check_email_regexp` enum('0','1') NOT NULL default '1',
  `label_for_name` varchar(100) NOT NULL default 'Name',
  `label_for_email` varchar(100) NOT NULL default 'E-mail',
  `label_for_website` varchar(100) NOT NULL default 'Website',
  `label_for_subject` varchar(100) NOT NULL default 'Subject',
  `label_for_message` varchar(100) NOT NULL default 'Message',
  `label_for_submit_button` varchar(100) NOT NULL default 'Send',
  `mandatory_name` enum('0','1') NOT NULL default '1',
  `mandatory_email` enum('0','1') NOT NULL default '1',
  `mandatory_website` enum('0','1') NOT NULL default '1',
  `mandatory_subject` enum('0','1') NOT NULL default '1',
  `mandatory_message_2` enum('0','1') NOT NULL default '1',
  `return_url` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `guestbook_implementations`
-- 

INSERT INTO `guestbook_implementations` VALUES (1, '', '<p>\r\n	Laat een berichtje achter...</p>\r\n', '<p>\r\n	De laatste 5 berichten:</p>\r\n', 'Title', 'Content', 'Title 2', 'Content 2', '0', '1', '1', '0', '0', 'Telefoonnummer (wordt niet getoond!)', '1', '1', 'Name', 'E-mail', 'Website', 'Subject', 'Message', 'Send', '1', '1', '0', '0', '0', '/gastenboek');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `implementations`
-- 

CREATE TABLE `implementations` (
  `id` varchar(120) NOT NULL default '',
  `type` varchar(100) NOT NULL default '',
  `implementation_id` int(10) unsigned NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Gegevens worden uitgevoerd voor tabel `implementations`
-- 

INSERT INTO `implementations` VALUES ('index', 'page', 1, 'Welkom bij Mozaiek');
INSERT INTO `implementations` VALUES ('hoofdmenu', 'menu', 1, 'Hoofdmenu');
INSERT INTO `implementations` VALUES ('gastenboek', 'guestbook', 1, 'Gastenboek');
INSERT INTO `implementations` VALUES ('wie-we-zijn', 'page', 2, 'Wie zijn we?');
INSERT INTO `implementations` VALUES ('wat-we-doen', 'page', 3, 'Wat kunnen we?');
INSERT INTO `implementations` VALUES ('contact', 'page', 4, 'Contact');
INSERT INTO `implementations` VALUES ('links', 'menu', 2, 'Leuke websites');
INSERT INTO `implementations` VALUES ('wat-we-doen/kinderschmink', 'page', 5, 'Kinderschmink');
INSERT INTO `implementations` VALUES ('wat-we-doen/halloween-en-themafeesten', 'page', 6, 'halloween-en-themafeesten');
INSERT INTO `implementations` VALUES ('wat-we-doen/sint-en-piet', 'page', 7, 'sint-en-piet');
INSERT INTO `implementations` VALUES ('wat-we-doen/bodypaint', 'page', 8, 'bodypaint');
INSERT INTO `implementations` VALUES ('wat-we-doen/bellypaint', 'page', 9, 'bellypaint');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `logs`
-- 

CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `action` varchar(20) NOT NULL default '',
  `table_name` varchar(60) default NULL,
  `pk_value` int(10) unsigned default NULL,
  `utc` int(10) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL default '0',
  `extra` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `logs`
-- 

INSERT INTO `logs` VALUES (1, 'insert', 'page_implementations', 1, 1270995388, 1, '');
INSERT INTO `logs` VALUES (2, 'login', NULL, NULL, 1270996976, 7, '87.209.48.1');
INSERT INTO `logs` VALUES (3, 'login', NULL, NULL, 1271003980, 7, '80.126.128.131');
INSERT INTO `logs` VALUES (4, 'login', NULL, NULL, 1271006422, 1, '87.209.48.1');
INSERT INTO `logs` VALUES (5, 'insert', 'page_implementations', 2, 1271007997, 1, '');
INSERT INTO `logs` VALUES (6, 'insert', 'page_implementations', 3, 1271008002, 1, '');
INSERT INTO `logs` VALUES (7, 'insert', 'page_implementations', 4, 1271008010, 1, '');
INSERT INTO `logs` VALUES (8, 'update', 'page_implementations', 2, 1271009311, 1, '');
INSERT INTO `logs` VALUES (9, 'update', 'page_implementations', 2, 1271010410, 1, '');
INSERT INTO `logs` VALUES (10, 'update', 'page_implementations', 2, 1271010425, 1, '');
INSERT INTO `logs` VALUES (11, 'insert', 'page_implementations', 5, 1271010668, 1, '');
INSERT INTO `logs` VALUES (12, 'login', NULL, NULL, 1271010942, 7, '80.126.128.131');
INSERT INTO `logs` VALUES (13, 'insert', 'page_implementations', 6, 1271011587, 1, '');
INSERT INTO `logs` VALUES (14, 'insert', 'page_implementations', 7, 1271011612, 1, '');
INSERT INTO `logs` VALUES (15, 'insert', 'page_implementations', 8, 1271011629, 1, '');
INSERT INTO `logs` VALUES (16, 'insert', 'page_implementations', 9, 1271011644, 1, '');
INSERT INTO `logs` VALUES (17, 'login', NULL, NULL, 1271160255, 1, '83.161.22.180');
INSERT INTO `logs` VALUES (18, 'login', NULL, NULL, 1271189773, 1, '87.209.48.1');
INSERT INTO `logs` VALUES (19, 'login', NULL, NULL, 1271189814, 1, '87.209.48.1');
INSERT INTO `logs` VALUES (20, 'login', NULL, NULL, 1271359559, 7, '80.126.128.131');
INSERT INTO `logs` VALUES (21, 'login', NULL, NULL, 1271436407, 1, '87.209.48.1');
INSERT INTO `logs` VALUES (22, 'login', NULL, NULL, 1271857493, 1, '83.161.22.180');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `menu_implementations`
-- 

CREATE TABLE `menu_implementations` (
  `implementation_id` int(10) unsigned NOT NULL auto_increment,
  `max_depth` int(10) unsigned NOT NULL default '0',
  `content_1` text NOT NULL,
  PRIMARY KEY  (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `menu_implementations`
-- 

INSERT INTO `menu_implementations` VALUES (1, 10, '');
INSERT INTO `menu_implementations` VALUES (2, 10, '&nbsp;<br />\r\n<h1 style="color:white;">Interessante websites:</h1>\r\n');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `menu_items`
-- 

CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `menu_implementation_id` int(10) unsigned NOT NULL default '0',
  `parent_menu_item_id` int(10) unsigned default NULL,
  `code` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `link` varchar(100) NOT NULL default '',
  `title_2` varchar(100) NOT NULL default '',
  `content_1` text NOT NULL,
  `image_1` varchar(4) NOT NULL default '',
  `image_2` varchar(4) NOT NULL default '',
  `o` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `menu_items`
-- 

INSERT INTO `menu_items` VALUES (1, 1, NULL, '', 'Home', '/index', '', '', '', '', 1);
INSERT INTO `menu_items` VALUES (2, 1, NULL, '', 'Wie zijn we?', '/wie-we-zijn', '', '', '', '', 2);
INSERT INTO `menu_items` VALUES (3, 1, NULL, '', 'Wat kunnen we?', '/wat-we-doen', '', '', '', '', 3);
INSERT INTO `menu_items` VALUES (4, 1, NULL, '', 'Contact', '/contact', '', '', '', '', 4);
INSERT INTO `menu_items` VALUES (5, 1, NULL, '', 'Gastenboek', '/gastenboek', '', '', '', '', 5);
INSERT INTO `menu_items` VALUES (6, 1, NULL, '', 'Links', '/links', '', '', '', '', 6);
INSERT INTO `menu_items` VALUES (8, 2, NULL, '', 'Uit De Kom entertainment & theater', 'http://www.uitdekom.nl/', '', '', '', '', 1);
INSERT INTO `menu_items` VALUES (9, 2, NULL, '', 'Sengas feestjes', 'http://sengasfeestjes.nl/', '', '', '', '', 2);
INSERT INTO `menu_items` VALUES (10, 1, 3, '', 'Kinderschmink', '/wat-we-doen/kinderschmink', '', '', '', '', 7);
INSERT INTO `menu_items` VALUES (11, 1, 3, '', 'Halloween en themafeesten', '/wat-we-doen/halloween-en-themafeesten', '', '', '', '', 8);
INSERT INTO `menu_items` VALUES (12, 1, 3, '', 'Sint en piet', '/wat-we-doen/sint-en-piet', '', '', '', '', 9);
INSERT INTO `menu_items` VALUES (13, 1, 3, '', 'Body paint', '/wat-we-doen/bodypaint', '', '', '', '', 10);
INSERT INTO `menu_items` VALUES (14, 1, 3, '', 'Belly paint', '/wat-we-doen/bellypaint', '', '', '', '', 11);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `news_implementations`
-- 

CREATE TABLE `news_implementations` (
  `implementation_id` int(10) unsigned NOT NULL auto_increment,
  `content_1` text NOT NULL,
  `title_2` varchar(200) NOT NULL default '',
  `content_2` text NOT NULL,
  `ni_label_for_title_1` varchar(100) NOT NULL default 'Title',
  `ni_label_for_content_1` varchar(100) NOT NULL default 'Content',
  `ni_label_for_title_2` varchar(100) NOT NULL default 'Title 2',
  `ni_label_for_content_2` varchar(100) NOT NULL default 'Content 2',
  `ni_label_for_image_1` varchar(100) NOT NULL default 'Image 1',
  `ni_label_for_image_2` varchar(100) NOT NULL default 'Image 2',
  PRIMARY KEY  (`implementation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `news_implementations`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `news_items`
-- 

CREATE TABLE `news_items` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `news_implementation_id` int(10) unsigned NOT NULL default '0',
  `type` enum('story','gallery') NOT NULL default 'story',
  `title` varchar(255) NOT NULL default '',
  `title_2` varchar(255) NOT NULL default '',
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `image_1` varchar(4) NOT NULL default '',
  `image_2` varchar(4) NOT NULL default '',
  `created` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `news_items`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `news_item_images`
-- 

CREATE TABLE `news_item_images` (
  `id` int(11) NOT NULL auto_increment,
  `news_item_id` int(11) NOT NULL default '0',
  `image` varchar(4) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `content_1` text NOT NULL,
  `o` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `news_item_images`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `page_implementations`
-- 

CREATE TABLE `page_implementations` (
  `implementation_id` int(10) unsigned NOT NULL auto_increment,
  `parent_page_id` int(10) unsigned default NULL,
  `title_2` varchar(100) NOT NULL default '',
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `label_for_title_1` varchar(100) NOT NULL default 'Title 1',
  `label_for_content_1` varchar(100) NOT NULL default 'Content 1',
  `label_for_title_2` varchar(100) NOT NULL default 'Title 2',
  `label_for_content_2` varchar(100) NOT NULL default 'Content 2',
  `o` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `page_implementations`
-- 

INSERT INTO `page_implementations` VALUES (1, NULL, '', '', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0);
INSERT INTO `page_implementations` VALUES (2, NULL, '', '<p>\r\n	<img alt="" src="/images/groepsfoto 555.jpg" /></p>\r\n', '<p>\r\n	Moza&iuml;ek is een schmink- en grimeergroep die in 1990 is gestart.<br />\r\n	Wij zijn ontstaan uit een groep die in dat jaar deelnam aan de cursus schminken en grimeren bij de Volksuniversiteit in Valkenswaard.</p>\r\n<p>\r\n	Wij zijn een enthousiaste groep, die het leuk vindt om van alles te schminken, vari&euml;rend van het schminken van kinderen op braderie&euml;n en ander festiviteiten tot grimewerk bij toneel- en dansuitvoeringen.</p>\r\n<p>\r\n	Wij ontwikkelen ons voortdurend door nieuwe ontwerpen te volgen en uit te proberen.</p>\r\n', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0);
INSERT INTO `page_implementations` VALUES (3, NULL, '', '', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0);
INSERT INTO `page_implementations` VALUES (4, NULL, '', '', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0);
INSERT INTO `page_implementations` VALUES (5, 3, '', 'Kinderschmink', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 1);
INSERT INTO `page_implementations` VALUES (6, 3, '', 'halloween-en-themafeesten', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 2);
INSERT INTO `page_implementations` VALUES (7, 3, '', 'sint-en-piet', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 3);
INSERT INTO `page_implementations` VALUES (8, 3, '', 'bodypaint', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 4);
INSERT INTO `page_implementations` VALUES (9, 3, '', 'bellypaint', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 5);

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `routes`
-- 

CREATE TABLE `routes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `path_from` varchar(255) NOT NULL default '',
  `path_to` varchar(255) NOT NULL default '',
  `forward` enum('0','1') NOT NULL default '0',
  `use_new_path` enum('0','1') NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  `o` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `routes`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shop_implementations`
-- 

CREATE TABLE `shop_implementations` (
  `implementation_id` int(10) unsigned NOT NULL auto_increment,
  `content_1` text NOT NULL,
  `title_2` varchar(100) NOT NULL default '',
  `content_2` text NOT NULL,
  `label_for_title_1` varchar(100) NOT NULL default '',
  `label_for_content_1` varchar(100) NOT NULL default '',
  `label_for_title_2` varchar(100) NOT NULL default '',
  `label_for_content_2` varchar(100) NOT NULL default '',
  `min_images_required` int(10) unsigned NOT NULL default '0',
  `max_images_required` int(10) unsigned NOT NULL default '0',
  `use_articles` enum('0','1') NOT NULL default '1',
  `use_stock` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`implementation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `shop_implementations`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shop_products`
-- 

CREATE TABLE `shop_products` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `shop_implementation_id` int(10) unsigned NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `image_1` varchar(4) NOT NULL default '',
  `image_2` varchar(4) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `shop_products`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shop_products_in_categories`
-- 

CREATE TABLE `shop_products_in_categories` (
  `shop_product_id` int(10) unsigned NOT NULL default '0',
  `shop_category_id` int(10) unsigned NOT NULL default '0',
  `o` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`shop_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Gegevens worden uitgevoerd voor tabel `shop_products_in_categories`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shop_product_categories`
-- 

CREATE TABLE `shop_product_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `url_id` varchar(100) NOT NULL default '',
  `shop_implementation_id` int(10) unsigned NOT NULL default '0',
  `parent_category_id` int(10) unsigned default NULL,
  `title` varchar(100) NOT NULL default '',
  `content_1` text NOT NULL,
  `image_1` varchar(4) NOT NULL default '',
  `image_2` varchar(4) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `shop_product_categories`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shop_product_images`
-- 

CREATE TABLE `shop_product_images` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `shop_product_id` int(10) unsigned NOT NULL default '0',
  `image` varchar(4) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `content_1` text NOT NULL,
  `o` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `shop_product_images`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shop_product_sizes`
-- 

CREATE TABLE `shop_product_sizes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `size_name` varchar(12) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `shop_product_sizes`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `shop_product_stock`
-- 

CREATE TABLE `shop_product_stock` (
  `shop_product_id` int(10) unsigned NOT NULL default '0',
  `shop_product_size_id` int(10) unsigned NOT NULL default '0',
  `sku` varchar(12) NOT NULL default '',
  `stock` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`shop_product_id`,`shop_product_size_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Gegevens worden uitgevoerd voor tabel `shop_product_stock`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `snippet_implementations`
-- 

CREATE TABLE `snippet_implementations` (
  `implementation_id` int(10) unsigned NOT NULL auto_increment,
  `content_type` varchar(100) NOT NULL default '',
  `modified_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`implementation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `snippet_implementations`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `specific_view_selections`
-- 

CREATE TABLE `specific_view_selections` (
  `object_id` varchar(200) NOT NULL default '',
  `view_type` varchar(40) NOT NULL default '0',
  `view_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`object_id`,`view_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Gegevens worden uitgevoerd voor tabel `specific_view_selections`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `views`
-- 

CREATE TABLE `views` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `type` varchar(40) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `o` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `views`
-- 

INSERT INTO `views` VALUES (2, 'guestbook,menu,page', 'Homepage', 1);
