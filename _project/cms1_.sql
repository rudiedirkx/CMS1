-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 02 Dec 2009 om 19:56
-- Serverversie: 5.1.40
-- PHP-Versie: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms1_`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cms_users`
--

CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sitename` varchar(40) DEFAULT NULL,
  `username` varchar(40) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(80) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `user_type` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `is_enabled` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_users`
--

INSERT INTO `cms_users` (`id`, `sitename`, `username`, `password`, `name`, `email`, `user_type`, `is_enabled`) VALUES
(1, NULL, 'root', 'pindakaas', 'root', 'root.cms@hotblocks.nl', 0, '1'),
(2, NULL, 'usager', 'usager', 'Normal Free User', 'rudie@hotblocks.nl', 1, '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `implementation_types`
--

CREATE TABLE IF NOT EXISTS `implementation_types` (
  `name` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(100) NOT NULL DEFAULT '',
  `view_types` text NOT NULL,
  `icon` varchar(100) NOT NULL DEFAULT '',
  `short` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `implementation_types`
--

INSERT INTO `implementation_types` (`name`, `type`, `view_types`, `icon`, `short`) VALUES
('Page', 'page', 'page', 'page', 'PG'),
('Webshop', 'shop', 'shopIndex,productDetails,productCategory,productCategory_1,productCategory_2,productCategory_3,productCategory_4,productCategory_5,productCategory_6,productCategory_7,productCategory_8,productCategory_9', 'shop', 'sh'),
('Guestbook', 'guestbook', 'guestbook,guestbookEntry', 'gb', 'gb'),
('Menu', 'menu', 'menu', 'menu', 'mn'),
('News', 'news', 'newsIndex,newsItem,newsItemImage', 'news', 'nw'),
('Form', 'form', 'form', 'form', 'fr');
