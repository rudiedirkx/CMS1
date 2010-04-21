-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 21 Apr 2010 om 19:56
-- Serverversie: 5.1.36
-- PHP-Versie: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms1_subumbra`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `custom_configs`
--

CREATE TABLE IF NOT EXISTS `custom_configs` (
  `table_name` varchar(80) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `config_key` varchar(60) NOT NULL DEFAULT '',
  `config_value` text NOT NULL,
  UNIQUE KEY `table_name` (`table_name`,`object_id`,`config_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `custom_configs`
--

INSERT INTO `custom_configs` (`table_name`, `object_id`, `config_key`, `config_value`) VALUES
(NULL, NULL, 'ck_styles', 'CKEDITOR.addStylesSet( ''my_styles'', [\r\n    // Block Styles\r\n    { name : ''Blue Title'', element : ''h2'', styles : { ''color'' : ''Blue'' } },\r\n    { name : ''Red Title'' , element : ''h3'', styles : { ''color'' : ''Red'' } },\r\n\r\n    // Inline Styles\r\n    { name : ''CSS Style'', element : ''span'', attributes : { ''class'' : ''my_style'' } },\r\n    { name : ''Marker: Yellow'', element : ''span'', styles : { ''background-color'' : ''Yellow'' } }\r\n]);'),
(NULL, NULL, 'ck_stylesheet', ''),
('menu_implementations', 1, 'special_1', 'important'),
('menu_items', 17, 'important', '1'),
('news_implementations', 1, 'use_image_2', '0'),
('news_implementations', 1, 'use_image_1', '0'),
('news_implementations', 1, 'label_for_title_1', 'Title'),
('news_implementations', 1, 'label_for_content_1', 'Content'),
('news_implementations', 1, 'label_for_title_2', '..Title 2'),
('news_implementations', 1, 'label_for_content_2', '..Content 2'),
('news_implementations', 2, 'label_for_title_1', ''),
('news_implementations', 2, 'label_for_content_1', ''),
('news_implementations', 2, 'label_for_title_2', ''),
('news_implementations', 2, 'label_for_content_2', ''),
('news_implementations', 2, 'use_image_1', '0'),
('news_implementations', 2, 'use_image_2', '0'),
('news_implementations', 1, 'special_1', 'align_right'),
('news_items', 2, 'align_right', '1'),
('form_implementations', 1, 'special_1', 'bgcolor='),
('page_implementations', 3, 'title_3', 'Oele, boele :)'),
('form_implementations', 1, 'special_2', 'lelijk'),
('form_fields', 10, 'bgcolor', 'green'),
('form_implementations', 1, 'special_3', 'align:|left|center|right'),
('form_fields', 10, 'lelijk', '1'),
('form_fields', 9, 'bgcolor', ''),
('form_fields', 9, 'align', ''),
('menu_items', 16, 'important', '1'),
('menu_implementations', 1, 'special_2', 'subs='),
('menu_implementations', 1, 'special_3', 'size:|1|2|3'),
('menu_items', 26, 'subs', '1'),
('menu_items', 26, 'size', '1'),
('menu_items', 27, 'subs', '1'),
('menu_items', 27, 'size', '1'),
('menu_items', 18, 'subs', '1'),
('menu_items', 18, 'size', '1'),
('menu_items', 1, 'subs', '1'),
('menu_items', 1, 'size', '1'),
('menu_items', 25, 'subs', '1'),
('menu_items', 25, 'size', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `form_fields`
--

CREATE TABLE IF NOT EXISTS `form_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_implementation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('label','textbox','email','textarea','checkbox','checkboxes','radiobuttons','select','specialtextbox') NOT NULL DEFAULT 'textbox',
  `label_1` varchar(255) NOT NULL DEFAULT '',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0',
  `label_2` varchar(255) NOT NULL DEFAULT '',
  `label_3` varchar(255) NOT NULL DEFAULT '',
  `options` text NOT NULL,
  `is_enabled` enum('1','0') NOT NULL DEFAULT '1',
  `is_required` enum('1','0') NOT NULL DEFAULT '0',
  `o` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `form_fields`
--

INSERT INTO `form_fields` (`id`, `form_implementation_id`, `type`, `label_1`, `maxlength`, `label_2`, `label_3`, `options`, `is_enabled`, `is_required`, `o`) VALUES
(1, 1, 'textbox', 'Uw naam', 0, '', 'BE HONEST!', '', '1', '0', 1),
(3, 1, 'email', 'Uw e-mail', 0, '', '', '', '1', '0', 2),
(4, 1, 'textbox', 'Onderwerp', 0, '', '', '', '1', '0', 0),
(5, 1, 'textarea', 'Uw commentaar', 0, '', '', '', '1', '1', 3),
(6, 1, 'checkbox', 'I agree to the terms', 0, ' (<a href="">read terms</a>)', '', 'Yes:No', '1', '1', 4),
(7, 1, 'checkboxes', 'Van toepassing zijn:', 0, '', '', 'auto:Ik heb een auto\r\nbrommer:Ik heb een brommer\r\nfiets:Ik heb een fiets\r\npoes:Ik houd van poezen', '1', '0', 5),
(8, 1, 'radiobuttons', 'I agree (2)', 0, '', '', 'Y:I do :)\r\nN:I don''t!', '1', '0', 6),
(9, 1, 'textbox', 'tst 2', 0, '', '', '', '1', '1', 7),
(10, 1, 'textbox', 'tst', 0, '', '', '', '1', '0', 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `form_implementations`
--

CREATE TABLE IF NOT EXISTS `form_implementations` (
  `implementation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_1` varchar(100) NOT NULL DEFAULT '',
  `send_to_email` varchar(100) NOT NULL DEFAULT '',
  `send_from_email` varchar(100) NOT NULL DEFAULT '',
  `send_from_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `form_implementations`
--

INSERT INTO `form_implementations` (`implementation_id`, `content_1`, `send_to_email`, `send_from_email`, `send_from_name`) VALUES
(1, 'Reageer op de website, op de harmonie, op de planning, op het verleden, op alles.', 'rudie@hotblocks.nl', 'form@subumbra.nl', 'SubUmbra FORM');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `guestbook_entries`
--

CREATE TABLE IF NOT EXISTS `guestbook_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guestbook_implementation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `website` varchar(100) NOT NULL DEFAULT '',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `message` varchar(100) NOT NULL DEFAULT '',
  `message_2` varchar(100) NOT NULL DEFAULT '',
  `verified` enum('0','1') NOT NULL DEFAULT '0',
  `utc` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(100) NOT NULL DEFAULT '',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `o` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `guestbook_entries`
--

INSERT INTO `guestbook_entries` (`id`, `guestbook_implementation_id`, `name`, `email`, `website`, `subject`, `message`, `message_2`, `verified`, `utc`, `ip`, `deleted`, `o`) VALUES
(4, 1, 'test 2', '', 'spele.nl', '', 'sla uw boodschap op !', '', '0', 1259708798, '88.159.160.229', '0', 2),
(3, 1, 'rudie', '', '', '', 'Bericht 1 om te laten zien dat het wow is...', '', '0', 1259708669, '88.159.160.229', '0', 1),
(5, 1, 'thankgod', '', 'http://', '', 'gelukkig maar :)', '', '0', 1259708807, '88.159.160.229', '0', 3),
(6, 1, 'Arn Dekker', 'Arn@nlgb.fsnet.co.uk', '', '', 'Mijn email address wordt toch niet gepubliceerd zeker he ?', '', '0', 1269615586, '95.148.119.201', '0', 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `guestbook_implementations`
--

CREATE TABLE IF NOT EXISTS `guestbook_implementations` (
  `implementation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_2` varchar(100) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `label_for_title_1` varchar(100) NOT NULL DEFAULT 'Title',
  `label_for_content_1` varchar(100) NOT NULL DEFAULT 'Content',
  `label_for_title_2` varchar(100) NOT NULL DEFAULT 'Title 2',
  `label_for_content_2` varchar(100) NOT NULL DEFAULT 'Content 2',
  `must_verify` varchar(100) NOT NULL DEFAULT '',
  `use_name` enum('0','1') NOT NULL DEFAULT '1',
  `use_email` enum('0','1') NOT NULL DEFAULT '1',
  `use_website` enum('0','1') NOT NULL DEFAULT '1',
  `use_subject` enum('0','1') NOT NULL DEFAULT '1',
  `label_for_message_2` varchar(100) NOT NULL DEFAULT '1',
  `use_message_2` enum('0','1') NOT NULL DEFAULT '1',
  `check_email_regexp` enum('0','1') NOT NULL DEFAULT '1',
  `label_for_name` varchar(100) NOT NULL DEFAULT 'Name',
  `label_for_email` varchar(100) NOT NULL DEFAULT 'E-mail',
  `label_for_website` varchar(100) NOT NULL DEFAULT 'Website',
  `label_for_subject` varchar(100) NOT NULL DEFAULT 'Subject',
  `label_for_message` varchar(100) NOT NULL DEFAULT 'Message',
  `label_for_submit_button` varchar(100) NOT NULL DEFAULT 'Send',
  `mandatory_name` enum('0','1') NOT NULL DEFAULT '1',
  `mandatory_email` enum('0','1') NOT NULL DEFAULT '1',
  `mandatory_website` enum('0','1') NOT NULL DEFAULT '1',
  `mandatory_subject` enum('0','1') NOT NULL DEFAULT '1',
  `mandatory_message_2` enum('0','1') NOT NULL DEFAULT '1',
  `return_url` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `guestbook_implementations`
--

INSERT INTO `guestbook_implementations` (`implementation_id`, `title_2`, `content_1`, `content_2`, `label_for_title_1`, `label_for_content_1`, `label_for_title_2`, `label_for_content_2`, `must_verify`, `use_name`, `use_email`, `use_website`, `use_subject`, `label_for_message_2`, `use_message_2`, `check_email_regexp`, `label_for_name`, `label_for_email`, `label_for_website`, `label_for_subject`, `label_for_message`, `label_for_submit_button`, `mandatory_name`, `mandatory_email`, `mandatory_website`, `mandatory_subject`, `mandatory_message_2`, `return_url`) VALUES
(1, '', '<p>\r\n	<span style="color:#000;"><span style="background-color:#ffa07a;">Neem even de tijd om in ons gastenboek te schrijven</span></span></p>\r\n', '', 'Title', 'Page', '.', '.', '0', '1', '1', '1', '0', 'Bericht 2', '0', '1', 'Uw naam', 'Uw e-mailadres', 'Uw homepage', 'Onderwerp', 'Uw boodschap', 'Versturen', '1', '0', '0', '1', '0', '/gastenboek?submitted=1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `implementations`
--

CREATE TABLE IF NOT EXISTS `implementations` (
  `id` varchar(120) NOT NULL DEFAULT '',
  `type` varchar(100) NOT NULL DEFAULT '',
  `implementation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `implementations`
--

INSERT INTO `implementations` (`id`, `type`, `implementation_id`, `title`) VALUES
('frames', 'page', 1, 'Harmonie Sub Umbra'),
('menu', 'menu', 1, 'Hoofdmenu'),
('index', 'page', 2, 'HARMONIE "SUB UMBRA" wenst u prettige Paasdagen.'),
('style.css', 'snippet', 1, 'style.css'),
('activiteiten', 'page', 3, 'Activiteiten'),
('jaarplanning', 'page', 4, 'Jaarplannings'),
('jaarplanning/2009', 'page', 5, 'Jaarplanning 2009'),
('feedback', 'form', 1, 'Feedback'),
('geschiedenis', 'page', 6, 'Geschiedenis'),
('de-orkesten', 'page', 7, 'De orkesten'),
('de-leerlingen', 'page', 8, 'De leerlingen'),
('het-bestuur', 'page', 9, 'Het bestuur'),
('ledeninformatie', 'page', 10, 'Ledeninformatie'),
('andere-sites', 'page', 11, 'Andere sites'),
('lid-worden', 'page', 12, 'Lid worden'),
('jaarplanning/2010', 'page', 13, 'Jaarplanning 2010'),
('gastenboek', 'guestbook', 1, 'Gastenboek'),
('header', 'snippet', 2, 'header'),
('favicon.ico', 'snippet', 3, 'favicon.ico'),
('nieuws', 'news', 1, 'Het nieuwste nieuws'),
('footer', 'snippet', 4, 'footer'),
('test', 'page', 14, 'New view test'),
('tsnip', 'snippet', 6, 'test snippet'),
('meimarkt', 'page', 15, 'Meimarkt'),
('fotoboek', 'news', 2, 'Fotoboek'),
('tests', 'shop', 1, 'Onderzoeken'),
('contact_information', 'snippet', 7, 'Contact information');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(20) NOT NULL DEFAULT '',
  `table_name` varchar(60) DEFAULT NULL,
  `pk_value` int(10) unsigned DEFAULT NULL,
  `utc` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `extra` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Gegevens worden uitgevoerd voor tabel `logs`
--

INSERT INTO `logs` (`id`, `action`, `table_name`, `pk_value`, `utc`, `user_id`, `extra`) VALUES
(72, 'update', 'page_implementations', 2, 1261250303, 1, ''),
(71, 'update', 'page_implementations', 2, 1261250207, 1, ''),
(70, 'update', 'page_implementations', 2, 1261250104, 1, ''),
(69, 'update', 'page_implementations', 2, 1261250086, 1, ''),
(68, 'update', 'page_implementations', 2, 1261250060, 1, ''),
(67, 'update', 'page_implementations', 2, 1261250036, 1, ''),
(66, 'update', 'page_implementations', 2, 1261250032, 1, ''),
(65, 'update', 'page_implementations', 2, 1261250018, 1, ''),
(64, 'update', 'page_implementations', 2, 1261250001, 1, ''),
(63, 'update', 'page_implementations', 2, 1261249959, 1, ''),
(62, 'update', 'page_implementations', 2, 1261249943, 1, ''),
(61, 'login', NULL, NULL, 1261249846, 1, '88.159.160.229'),
(60, 'login', NULL, NULL, 1261242044, 1, '88.159.160.229'),
(59, 'login', NULL, NULL, 1261240158, 3, '77.254.95.77'),
(58, 'login', NULL, NULL, 1261236572, 1, '88.159.160.229'),
(57, 'login', NULL, NULL, 1261196602, 1, '88.159.160.229'),
(56, 'login', NULL, NULL, 1261191869, 1, '88.159.160.229'),
(55, 'login', NULL, NULL, 1261176921, 1, '88.159.160.229'),
(54, 'login', NULL, NULL, 1260918672, 1, '88.159.160.229'),
(53, 'login', NULL, NULL, 1260824275, 1, '88.159.160.229'),
(52, 'login', NULL, NULL, 1260810575, 1, '88.159.160.229'),
(51, 'login', NULL, NULL, 1260785475, 1, '83.161.22.180'),
(50, 'login', NULL, NULL, 1260641845, 1, '88.159.160.229'),
(49, 'login', NULL, NULL, 1260636968, 1, '88.159.160.229'),
(48, 'login', NULL, NULL, 1260585086, 1, '88.159.160.229'),
(47, 'login', NULL, NULL, 1260573104, 1, '88.159.160.229'),
(46, 'update', 'page_implementations', 15, 1260570858, 1, ''),
(45, 'update', 'page_implementations', 15, 1260570837, 1, ''),
(44, 'update', 'page_implementations', 15, 1260570822, 1, ''),
(43, 'update', 'page_implementations', 15, 1260570805, 1, ''),
(42, 'login', NULL, NULL, 1260569104, 1, '88.159.160.229'),
(41, 'login', NULL, NULL, 1260551386, 1, '88.159.160.229'),
(40, 'login', NULL, NULL, 1260486423, 1, '88.159.160.229'),
(39, 'login', NULL, NULL, 1260477628, 1, '88.159.160.229'),
(38, 'login', NULL, NULL, 1260399773, 1, '88.159.160.229'),
(37, 'login', NULL, NULL, 1260390620, 1, '88.159.160.229'),
(36, 'login', NULL, NULL, 1260389471, 1, '88.159.160.229'),
(35, 'update', 'page_implementations', 15, 1260200212, 3, ''),
(34, 'login', NULL, NULL, 1260199974, 3, ''),
(33, 'update', 'page_implementations', 15, 1260199901, 3, ''),
(32, 'login', NULL, NULL, 1260199747, 3, ''),
(31, 'insert', 'page_implementations', 15, 1260199040, 3, ''),
(30, 'login', NULL, NULL, 1260198357, 3, ''),
(29, 'login', NULL, NULL, 1260116120, 1, ''),
(28, 'login', NULL, NULL, 1260114114, 1, ''),
(27, 'login', NULL, NULL, 1260034392, 3, ''),
(26, 'login', NULL, NULL, 1260033859, 3, ''),
(25, 'login', NULL, NULL, 1260027007, 3, ''),
(24, 'login', NULL, NULL, 1260019763, 1, ''),
(23, 'login', NULL, NULL, 1259977730, 1, ''),
(22, 'login', NULL, NULL, 1259971888, 1, ''),
(21, 'login', NULL, NULL, 1259966503, 4, ''),
(20, 'login', NULL, NULL, 1259964062, 1, ''),
(19, 'login', NULL, NULL, 1259960341, 1, ''),
(18, 'login', NULL, NULL, 1259954171, 3, ''),
(17, 'login', NULL, NULL, 1259954042, 3, ''),
(16, 'login', NULL, NULL, 1259953586, 3, ''),
(15, 'login', NULL, NULL, 1259937874, 3, ''),
(14, 'login', NULL, NULL, 1259937573, 1, ''),
(13, 'update', 'page_implementations', 14, 1259880975, 1, ''),
(12, 'insert', 'page_implementations', 14, 1259879977, 1, ''),
(11, 'login', NULL, NULL, 1259879954, 1, ''),
(10, 'login', NULL, NULL, 1259876172, 1, ''),
(9, 'login', NULL, NULL, 1259867053, 2, ''),
(8, 'login', NULL, NULL, 1259795158, 1, ''),
(7, 'update', 'page_implementations', 2, 1259793560, 1, ''),
(6, 'login', NULL, NULL, 1259787752, 1, ''),
(5, 'login', NULL, NULL, 1259784284, 1, ''),
(4, 'login', NULL, NULL, 1259779998, 2, ''),
(3, 'update', 'page_implementations', 2, 1259779918, 1, ''),
(2, 'update', 'page_implementations', 2, 1259779902, 1, ''),
(1, 'login', NULL, NULL, 1259779748, 1, ''),
(73, 'login', NULL, NULL, 1261682842, 1, '88.159.160.229'),
(74, 'login', NULL, NULL, 1262215762, 1, '88.159.160.229'),
(75, 'login', NULL, NULL, 1262303581, 1, '88.159.160.229'),
(76, 'login', NULL, NULL, 1262701423, 5, '134.58.253.55'),
(77, 'login', NULL, NULL, 1262701509, 4, '83.161.22.180'),
(78, 'update', 'page_implementations', 2, 1262701576, 4, ''),
(79, 'login', NULL, NULL, 1262701640, 1, '83.161.22.180'),
(80, 'update', 'page_implementations', 3, 1262701863, 5, ''),
(81, 'login', NULL, NULL, 1262998054, 1, '88.159.160.229'),
(82, 'login', NULL, NULL, 1264013063, 1, '88.159.160.229'),
(83, 'login', NULL, NULL, 1264525744, 1, '88.159.160.229'),
(84, 'login', NULL, NULL, 1264629400, 1, '88.159.160.229'),
(85, 'login', NULL, NULL, 1264631520, 1, '88.159.160.229'),
(86, 'login', NULL, NULL, 1264633823, 1, '88.159.160.229'),
(87, 'login', NULL, NULL, 1264668674, 1, '83.161.22.180'),
(88, 'login', NULL, NULL, 1268140865, 3, '130.138.227.10'),
(89, 'login', NULL, NULL, 1268141690, 3, '88.159.173.124'),
(90, 'update', 'page_implementations', 2, 1268143295, 3, ''),
(91, 'update', 'page_implementations', 2, 1268143331, 3, ''),
(92, 'login', NULL, NULL, 1268144100, 3, '88.159.173.124'),
(93, 'login', NULL, NULL, 1268533631, 1, '127.0.0.1'),
(94, 'login', NULL, NULL, 1269187658, 1, '127.0.0.1'),
(95, 'login', NULL, NULL, 1269379205, 1, '127.0.0.1'),
(96, 'login', NULL, NULL, 1271003570, 1, '127.0.0.1'),
(97, 'login', NULL, NULL, 1271187981, 1, '127.0.0.1'),
(98, 'login', NULL, NULL, 1271437836, 1, '127.0.0.1'),
(99, 'login', NULL, NULL, 1271440726, 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menu_implementations`
--

CREATE TABLE IF NOT EXISTS `menu_implementations` (
  `implementation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `max_depth` int(10) unsigned NOT NULL DEFAULT '0',
  `content_1` text NOT NULL,
  PRIMARY KEY (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `menu_implementations`
--

INSERT INTO `menu_implementations` (`implementation_id`, `max_depth`, `content_1`) VALUES
(1, 10, 'Dit is het hoofdmenu');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_implementation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_menu_item_id` int(10) unsigned DEFAULT NULL,
  `code` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `link` varchar(100) NOT NULL DEFAULT '',
  `title_2` varchar(100) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `image_1` varchar(4) NOT NULL DEFAULT '',
  `image_2` varchar(4) NOT NULL DEFAULT '',
  `o` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Gegevens worden uitgevoerd voor tabel `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_implementation_id`, `parent_menu_item_id`, `code`, `title`, `link`, `title_2`, `content_1`, `image_1`, `image_2`, `o`) VALUES
(1, 1, NULL, 'index', 'Index', '/index', '', '', 'jpg', 'jpg', 0),
(2, 1, NULL, 'jp2009', 'Jaarplanning 2009', '/jaarplanning/2009', '', '', '', '', 3),
(3, 1, NULL, 'jp2010', 'Jaarplanning 2010', '/jaarplanning/2010', '', '', '', '', 2),
(4, 1, NULL, 'nieuws', 'Nieuws', '/nieuws', '', '', '', '', 4),
(5, 1, NULL, 'fotoboek', 'Fotoboek', '/fotoboek', '', '', '', '', 5),
(6, 1, NULL, 'activiteiten', 'Activiteiten', '/activiteiten', '', 'oele', 'jpg', '', 6),
(7, 1, NULL, 'orkesten', 'De orkesten', '/de-orkesten', '', '', '', '', 7),
(8, 1, NULL, 'leerlingen', 'De leerlingen', '/de-leerlingen', '', '', '', '', 8),
(9, 1, NULL, 'bestuur', 'Het bestuur', '/het-bestuur', '', '', '', '', 9),
(10, 1, NULL, 'geschiedenis', 'Geschiedenis', '/geschiedenis', '', '', '', '', 10),
(11, 1, NULL, 'info', 'Ledeninformatie', '/ledeninformatie', '', '', '', '', 12),
(12, 1, NULL, 'sites', 'Andere sites', '/andere-sites', '', '', '', '', 13),
(13, 1, NULL, 'aanmelden', 'Lid worden', '/lid-worden', '', '', '', '', 14),
(14, 1, NULL, 'gastenboek', 'Gastenboek', '/gastenboek', '', '', '', '', 11),
(16, 1, NULL, 'admin', 'Admin', '/admin/', '', '', '', '', 16),
(17, 1, NULL, 'meimarkt', 'Meimarkt', '/meimarkt', '', '', '', '', 1),
(18, 1, NULL, '', '-', '', '', '', '', '', 15);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news_implementations`
--

CREATE TABLE IF NOT EXISTS `news_implementations` (
  `implementation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_1` text NOT NULL,
  `title_2` varchar(200) NOT NULL DEFAULT '',
  `content_2` text NOT NULL,
  `ni_label_for_title_1` varchar(100) NOT NULL DEFAULT 'Title',
  `ni_label_for_content_1` varchar(100) NOT NULL DEFAULT 'Content',
  `ni_label_for_title_2` varchar(100) NOT NULL DEFAULT 'Title 2',
  `ni_label_for_content_2` varchar(100) NOT NULL DEFAULT 'Content 2',
  `ni_label_for_image_1` varchar(100) NOT NULL DEFAULT 'Image 1',
  `ni_label_for_image_2` varchar(100) NOT NULL DEFAULT 'Image 2',
  PRIMARY KEY (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `news_implementations`
--

INSERT INTO `news_implementations` (`implementation_id`, `content_1`, `title_2`, `content_2`, `ni_label_for_title_1`, `ni_label_for_content_1`, `ni_label_for_title_2`, `ni_label_for_content_2`, `ni_label_for_image_1`, `ni_label_for_image_2`) VALUES
(1, '', 'twee', 'tweeeeeee', 'Title', 'Content', 'Title 2', 'Content 2', 'Image 1', 'Image 2'),
(2, '<p>\r\n	Hieronder alle hoofdstukken:</p>\r\n', '', '', 'Title', 'Content', 'Title 2', 'Content 2', 'Image 1', 'Image 2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news_items`
--

CREATE TABLE IF NOT EXISTS `news_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_implementation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('story','gallery') NOT NULL DEFAULT 'story',
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_2` varchar(255) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `image_1` varchar(4) NOT NULL DEFAULT '',
  `image_2` varchar(4) NOT NULL DEFAULT '',
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `news_items`
--

INSERT INTO `news_items` (`id`, `news_implementation_id`, `type`, `title`, `title_2`, `content_1`, `content_2`, `image_1`, `image_2`, `created`) VALUES
(1, 1, 'story', 'Vernieuwde ''SubUmbra'' website # 3', 'De SubUmbra website is vernieuwd. Voor ons, voor jullie, voor iedereen. Nu beter, makkelijker en interactiever dan ooit!', '<p>\r\n	De website is vernieuwd.</p>\r\n', '<p>\r\n	Dus we kunnen allemaal los. Tweede content blokje. Onbekend hoeveelste P.</p>\r\n', '', '', 1259534584),
(2, 1, 'story', 'Geboorte', '', '<p>\r\n	Luuk is geboren!</p>\r\n', '<p>\r\n	<img alt="luuk 1" src="/images/Luuk01-1.jpg" /></p>\r\n<p>\r\n	<img alt="luuk 2" src="/images/Luuk02-1.jpg" /></p>\r\n', 'jpg', '', 1259536120),
(5, 1, 'gallery', 'Wat een instrumenten', 'De mooiste instrumenten zijn altijd van de lelijkste mensen.', '<p>\r\n	Kijk deze instrumenten gaafjes zijn!!</p>\r\n', '<p>\r\n	plaatje</p>\r\n', '', '', 1259964102),
(6, 2, 'gallery', 'Sint Nikolaas - foto''s Sinterklaas - 28 november 2009', '', '', '', '', '', 1260570159),
(7, 2, 'gallery', 'Jubileumconcert - foto''s Gert Verhagen - 15 november 2009', '', '', '', '', '', 1260570371),
(8, 1, 'story', 'Meerveldhoven', '', '', '', '', '', 1262303600);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news_item_images`
--

CREATE TABLE IF NOT EXISTS `news_item_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_item_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(4) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `o` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `news_item_images`
--

INSERT INTO `news_item_images` (`id`, `news_item_id`, `image`, `title`, `content_1`, `o`) VALUES
(3, 5, 'jpg', 'Schitterende blauwe tuba', '<p>Ha ha ha</p>', 2),
(2, 5, 'jpg', 'groene trompet', '<p>Mooi groen trompetje. Artistieke shit, die "tattoos".</p>', 1),
(4, 6, 'jpg', 'Zwarte piet de dirigent?', '', 1),
(5, 6, 'jpg', 'Muziekjes', '', 2),
(6, 6, 'jpg', 'Da''s eng', '', 3),
(7, 6, 'jpg', 'Zwarte piet gaat ervandoor!?', '', 4),
(8, 6, 'jpg', 'De goede, oude heiligman zelf', '', 5),
(9, 6, 'jpg', 'Vol verwachting klopte hun hartjes', '', 6),
(10, 7, 'jpg', 'De flyer', '', 1),
(11, 7, 'jpg', 'Voorbereiding', '', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `page_implementations`
--

CREATE TABLE IF NOT EXISTS `page_implementations` (
  `implementation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_page_id` int(10) unsigned DEFAULT NULL,
  `title_2` varchar(100) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `label_for_title_1` varchar(100) NOT NULL DEFAULT 'Title 1',
  `label_for_content_1` varchar(100) NOT NULL DEFAULT 'Content 1',
  `label_for_title_2` varchar(100) NOT NULL DEFAULT 'Title 2',
  `label_for_content_2` varchar(100) NOT NULL DEFAULT 'Content 2',
  `o` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Gegevens worden uitgevoerd voor tabel `page_implementations`
--

INSERT INTO `page_implementations` (`implementation_id`, `parent_page_id`, `title_2`, `content_1`, `content_2`, `label_for_title_1`, `label_for_content_1`, `label_for_title_2`, `label_for_content_2`, `o`) VALUES
(1, NULL, '', 'Dit is de website van de Harmonie Sub Umbra. Als u dit leest, heeft u geen frames.', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(2, NULL, '', '<table border="0" cellpadding="1" cellspacing="1">\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan="3">\r\n				<img height="192" src="/images/SU-nov2003-2.gif" style="cursor: default" width="600" /></td>\r\n			<td style="text-align: center">\r\n				<img alt="" height="80" src="/images/jub-concert.jpg" width="168" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align: center">\r\n				<img alt="" height="80" src="/images/Italie_vlag-3.JPG" width="135" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align: center">\r\n				<img alt="" height="80" src="/images/meifeest.jpg" width="120" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<h1>\r\n	&nbsp;</h1>\r\n<p>\r\n	Heb je op- of aanmerkingen over deze website, <a href="mailto:webmaster@subumbra.nl">mail dan naar de webmaster</a> of <a href="/gastenboek">maak een melding in het gastenboek</a>.</p>\r\n', '', 'Title 1', 'Content 1', 'Subtitel', '.Content 2', 0),
(3, NULL, '', '<p>\r\n	Dit gaan we allemaal nog doen:</p>\r\n<p>\r\n	Eeuuh</p>\r\n', '', 'Title 1', 'Content 1', '.Title 2', '.Content 2', 0),
(4, NULL, '', '<p>\r\n	Alle jaarplanningen</p>\r\n', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(5, 4, '', '<p>\r\n	Jaarplanning 2009</p>\r\n', '', 'Title 1', 'Content 1', '.Title 2', '.Content 2', 1),
(6, NULL, '', 'Geschiedenis', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(7, NULL, '', '', '', 'Title 1', 'Content 1', '.Title 2', '.Content 2', 0),
(8, NULL, '', '<p>\r\n	We hebben 24 leerlingen. Van slecht tot goed en andersom.</p>\r\n<p>\r\n	Elke leerling krijgt maandelijks een punt van 1 - 10.&nbsp;<strong>Goede leerlingen</strong> krijgen een hoger punt dan <strong>slechte leerlingen</strong>. Om het gezellig te houden, laten we <strong>alle leerlingen</strong> ook <strong>alle leerlingen</strong> punten geven.</p>\r\n', '', 'Title 1', 'Content 1', '.Title 2', '.Content 2', 0),
(9, NULL, '', '', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(10, NULL, '', '', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(11, NULL, '', '', '', 'Title 1', 'Content 1', '.Title 2', '.Content 2', 0),
(12, NULL, '', '', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(13, 4, '', '<p>\r\n	Jaarplanning 2010</p>\r\n', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(14, NULL, '', '<p>\r\n	Just testing the new view :)</p>\r\n', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(15, NULL, '', '<p>\r\n	<strong>Meimarkt Meerveldhoven 30 mei 2010</strong></p>\r\n<p>\r\n	Geachte heer, mevrouw,</p>\r\n<p>\r\n	bij deze nodigen wij u uit om deel te nemen aan onze jaarlijkse Meimarkt die wij op zondag,&nbsp;30 mei 2010, in (Meer)Veldhoven organiseren.&nbsp;Om in te schrijven kunt u van het bijgevoegde inschrijfformulier gebruik maken.&nbsp;De Meimarkt is een gezellige familiemarkt, die naast een grote verscheidenheid aan koopwaar&nbsp;ook diverse attracties biedt voor jong en oud. Voor bezoekers van de markt is de toegang gratis.</p>\r\n<p>\r\n	De huur voor u bedraagt:</p>\r\n<ul>\r\n	<li>\r\n		<strong>huur van &eacute;&eacute;n kraam, inclusief tentzeilen dak &euro; 45,-</strong></li>\r\n	<li>\r\n		<strong>huur van elke volgende kraam, inclusief tentzeilen dak &euro; 40,-</strong></li>\r\n	<li>\r\n		<strong>huur van &eacute;&eacute;n grondplaats van 4 meter ( &euro; 9,- / meter) &euro; 36,-</strong></li>\r\n</ul>\r\n<p>\r\n	Met speciale wensen, zoals elektriciteit, water e.d., kan rekening worden gehouden indien vooraf ..?</p>\r\n', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path_from` varchar(255) NOT NULL DEFAULT '',
  `path_to` varchar(255) NOT NULL DEFAULT '',
  `forward` enum('0','1') NOT NULL DEFAULT '0',
  `use_new_path` enum('0','1') NOT NULL DEFAULT '0',
  `enabled` enum('0','1') NOT NULL DEFAULT '1',
  `o` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `routes`
--

INSERT INTO `routes` (`id`, `path_from`, `path_to`, `forward`, `use_new_path`, `enabled`, `o`) VALUES
(1, '/', '/index', '0', '0', '1', 0),
(2, '/leden/#%', '/fotoboek/7/$1', '0', '0', '1', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_implementations`
--

CREATE TABLE IF NOT EXISTS `shop_implementations` (
  `implementation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_1` text NOT NULL,
  `title_2` varchar(100) NOT NULL DEFAULT '',
  `content_2` text NOT NULL,
  `label_for_title_1` varchar(100) NOT NULL DEFAULT '',
  `label_for_content_1` varchar(100) NOT NULL DEFAULT '',
  `label_for_title_2` varchar(100) NOT NULL DEFAULT '',
  `label_for_content_2` varchar(100) NOT NULL DEFAULT '',
  `min_images_required` int(10) unsigned NOT NULL DEFAULT '0',
  `max_images_required` int(10) unsigned NOT NULL DEFAULT '0',
  `use_articles` enum('0','1') NOT NULL DEFAULT '1',
  `use_stock` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `shop_implementations`
--

INSERT INTO `shop_implementations` (`implementation_id`, `content_1`, `title_2`, `content_2`, `label_for_title_1`, `label_for_content_1`, `label_for_title_2`, `label_for_content_2`, `min_images_required`, `max_images_required`, `use_articles`, `use_stock`) VALUES
(1, '<p>Bla bla bla</p>', '', '', 'Title', 'Content', 'Title 2', 'Content 2', 0, 0, '1', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_products`
--

CREATE TABLE IF NOT EXISTS `shop_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_implementation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `image_1` varchar(4) NOT NULL DEFAULT '',
  `image_2` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `shop_products`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_products_in_categories`
--

CREATE TABLE IF NOT EXISTS `shop_products_in_categories` (
  `shop_product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `shop_category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `o` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`shop_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `shop_products_in_categories`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_product_categories`
--

CREATE TABLE IF NOT EXISTS `shop_product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url_id` varchar(100) NOT NULL DEFAULT '',
  `shop_implementation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_category_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `image_1` varchar(4) NOT NULL DEFAULT '',
  `image_2` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `shop_product_categories`
--

INSERT INTO `shop_product_categories` (`id`, `url_id`, `shop_implementation_id`, `parent_category_id`, `title`, `content_1`, `image_1`, `image_2`) VALUES
(1, 'ik', 1, NULL, 'Ik', '', '', ''),
(2, 'capaciteiten', 1, NULL, 'Capaciteiten', '', '', ''),
(3, 'kwaliteiten', 1, NULL, 'Kwaliteiten', '', '', ''),
(4, 'cat', 1, NULL, 'cat', '', '', ''),
(5, 'werk', 1, 4, 'Werk', '', '', ''),
(6, 'school', 1, 4, 'School', '', '', ''),
(7, 'lorem', 1, 4, 'Lorem', '', '', ''),
(8, 'ipsum', 1, 4, 'Ipsum', '', '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_product_images`
--

CREATE TABLE IF NOT EXISTS `shop_product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(4) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `o` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `shop_product_images`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_product_sizes`
--

CREATE TABLE IF NOT EXISTS `shop_product_sizes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `size_name` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `shop_product_sizes`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shop_product_stock`
--

CREATE TABLE IF NOT EXISTS `shop_product_stock` (
  `shop_product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `shop_product_size_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sku` varchar(12) NOT NULL DEFAULT '',
  `stock` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`shop_product_id`,`shop_product_size_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `shop_product_stock`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `snippet_implementations`
--

CREATE TABLE IF NOT EXISTS `snippet_implementations` (
  `implementation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_type` varchar(100) NOT NULL DEFAULT '',
  `modified_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `snippet_implementations`
--

INSERT INTO `snippet_implementations` (`implementation_id`, `content_type`, `modified_time`) VALUES
(1, 'text/css', 1261177180),
(2, 'text/html', 1261250328),
(3, 'image/x-icon', 1259954828),
(4, 'text/html', 1259521091),
(6, 'text/html', 1259884224),
(7, 'text/html', 1264633100);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `specific_view_selections`
--

CREATE TABLE IF NOT EXISTS `specific_view_selections` (
  `object_id` varchar(200) NOT NULL DEFAULT '',
  `view_type` varchar(40) NOT NULL DEFAULT '0',
  `view_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`view_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `specific_view_selections`
--

INSERT INTO `specific_view_selections` (`object_id`, `view_type`, `view_id`) VALUES
('frames', 'page', 3),
('test', 'page', 11),
('fotoboek', 'newsIndex', 13);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `o` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `o` (`o`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Gegevens worden uitgevoerd voor tabel `views`
--

INSERT INTO `views` (`id`, `type`, `title`, `o`) VALUES
(13, 'newsIndex', 'fotoboek index', 6),
(4, 'newsItemImage,page', 'Standaard pagina + news image', 0),
(7, 'guestbook', 'Gastenboek', 2),
(9, 'newsIndex', 'Nieuws', 1),
(12, 'newsItem', 'Nieuwsbericht + images', 5),
(10, 'form', 'Form', 3),
(11, 'page', 'Test', 4),
(14, 'shopIndex', 'shop index', 7),
(15, 'productCategory', 'shop category', 8),
(16, 'menu', 'menu', 9);
