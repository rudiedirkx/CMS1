-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generatie Tijd: 23 Aug 2010 om 05:23
-- Server versie: 5.0.37
-- PHP Versie: 5.2.3

CREATE DATABASE IF NOT EXISTS `cms1_`;

USE `cms1_`;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `cms1_`
-- 

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `cms_users`
-- 

CREATE TABLE `cms_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sitename` varchar(40) default NULL,
  `username` varchar(40) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `name` varchar(80) NOT NULL default '',
  `email` varchar(200) NOT NULL default '',
  `user_type` tinyint(4) unsigned NOT NULL default '1',
  `is_enabled` enum('1','0') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Gegevens worden uitgevoerd voor tabel `cms_users`
-- 

INSERT INTO `cms_users` VALUES (1, NULL, 'rudie', 'pindakaas', 'Rudie', 'rudie.cms@hotblocks.nl', 0, '1');
INSERT INTO `cms_users` VALUES (2, NULL, 'usager', 'usager', 'Normal Free User', 'rudie@hotblocks.nl', 1, '1');
INSERT INTO `cms_users` VALUES (7, 'mozaiekgrime', 'cees', 'mozaiek', 'Cees Oomens', 'cees.oomens@gmail.com', 1, '1');
INSERT INTO `cms_users` VALUES (8, 'ireservations', 'roger', 'pindakaas', 'Roger Meijer', 'roger@i-reservations.nl', 2, '1');
INSERT INTO `cms_users` VALUES (9, 'ireservations', 'david', 'pindakaas', 'David Lagewaard', 'david@i-reservations.nl', 1, '1');

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `implementation_types`
-- 

CREATE TABLE `implementation_types` (
  `name` varchar(100) NOT NULL default '',
  `type` varchar(100) NOT NULL default '',
  `view_types` text NOT NULL,
  `icon` varchar(100) NOT NULL default '',
  `short` varchar(100) NOT NULL default '',
  `enabled` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Gegevens worden uitgevoerd voor tabel `implementation_types`
-- 

INSERT INTO `implementation_types` VALUES ('Page', 'page', 'page', 'page', 'PG', 1);
INSERT INTO `implementation_types` VALUES ('Webshop', 'shop', 'shopIndex,productDetails,productCategory,productCategory_1,productCategory_2,productCategory_3,productCategory_4,productCategory_5,productCategory_6,productCategory_7,productCategory_8,productCategory_9', 'shop', 'sh', 0);
INSERT INTO `implementation_types` VALUES ('Guestbook', 'guestbook', 'guestbook,guestbookEntry', 'gb', 'gb', 1);
INSERT INTO `implementation_types` VALUES ('Menu', 'menu', 'menu', 'menu', 'mn', 1);
INSERT INTO `implementation_types` VALUES ('News', 'news', 'newsIndex,newsItem,newsItemImage', 'news', 'nw', 1);
INSERT INTO `implementation_types` VALUES ('Form', 'form', 'form', 'form', 'fr', 1);
