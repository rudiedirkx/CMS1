-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generatie Tijd: 23 Aug 2010 om 05:24
-- Server versie: 5.0.37
-- PHP Versie: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `cms1_default`
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
  `message` text NOT NULL,
  `message_2` text NOT NULL,
  `verified` enum('0','1') NOT NULL default '0',
  `utc` int(10) unsigned NOT NULL default '0',
  `ip` varchar(100) NOT NULL default '',
  `deleted` enum('0','1') NOT NULL default '0',
  `o` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `guestbook_entries`
-- 


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


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `image_dimension_sets`
-- 

CREATE TABLE `image_dimension_sets` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `width` int(10) unsigned NOT NULL default '0',
  `height` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `image_dimension_sets`
-- 


-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `implementations`
-- 

CREATE TABLE `implementations` (
  `id` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL default '',
  `implementation_id` int(10) unsigned NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Gegevens worden uitgevoerd voor tabel `implementations`
-- 


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `logs`
-- 


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `menu_items`
-- 


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
  `image_1` varchar(200) NOT NULL,
  `image_2` varchar(200) NOT NULL,
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
  `o` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `page_implementations`
-- 


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
  `type` text NOT NULL,
  `title` varchar(100) NOT NULL default '',
  `o` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `views`
-- 

