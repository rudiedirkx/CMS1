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
-- Database: `cms1_subumbra`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `custom_configs`
--

CREATE TABLE IF NOT EXISTS `custom_configs` (
  `table_name` varchar(80) NOT NULL,
  `object_id` int(11) NOT NULL,
  `config_key` varchar(60) NOT NULL,
  `config_value` varchar(250) NOT NULL,
  PRIMARY KEY (`table_name`,`object_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `custom_configs`
--

INSERT INTO `custom_configs` (`table_name`, `object_id`, `config_key`, `config_value`) VALUES
('', 0, 'default_path', '/index');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `guestbook_entries`
--

INSERT INTO `guestbook_entries` (`id`, `guestbook_implementation_id`, `name`, `email`, `website`, `subject`, `message`, `message_2`, `verified`, `utc`, `ip`, `deleted`, `o`) VALUES
(4, 1, 'test 2', '', 'http://', '', 'sla op kut!', '', '0', 1259708798, '88.159.160.229', '0', 2),
(3, 1, 'rudie', '', 'http://', '', 'Bericht 1 om te laten zien dat het wow is...', '', '0', 1259708669, '88.159.160.229', '0', 1),
(5, 1, 'thankgod', '', 'http://', '', 'gelukkig maar :)', '', '0', 1259708807, '88.159.160.229', '0', 3);

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
(1, '', '<p>\r\n	<span style="background-color:#ffa500;">Neem even de tijd om in ons gastenboek te schrijven.</span></p>\r\n', '', 'Title', 'Page', '.', '.', '0', '1', '1', '1', '0', 'Bericht 2', '0', '1', 'Naam', 'E-mail', 'Website', 'Onderwerp', 'Bericht', 'Versturen', '1', '0', '0', '1', '0', '/gastenboek?submitted=1');

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
('index', 'page', 2, 'HARMONIE "SUB UMBRA"'),
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
('footer', 'snippet', 4, 'footer');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `logs`
--

INSERT INTO `logs` (`id`, `action`, `table_name`, `pk_value`, `utc`, `user_id`) VALUES
(1, 'login', NULL, NULL, 1259779748, 1),
(2, 'update', 'page_implementations', 2, 1259779902, 1),
(3, 'update', 'page_implementations', 2, 1259779918, 1),
(4, 'login', NULL, NULL, 1259779998, 2);

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
(1, 1, 'Dit is het hoofdmenu');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Gegevens worden uitgevoerd voor tabel `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_implementation_id`, `parent_menu_item_id`, `code`, `title`, `link`, `title_2`, `content_1`, `image_1`, `image_2`, `o`) VALUES
(1, 1, NULL, 'index', 'Index', '/index', '', '', '', '', 0),
(2, 1, NULL, 'jp2009', 'Jaarplanning 2009', '/jaarplanning/2009', '', '', '', '', 2),
(3, 1, NULL, 'jp2010', 'Jaarplanning 2010', '/jaarplanning/2010', '', '', '', '', 1),
(4, 1, NULL, 'nieuws', 'Nieuws', '/nieuws', '', '', '', '', 3),
(5, 1, NULL, 'fotoboek', 'Fotoboek', '/fotoboek', '', '', '', '', 4),
(6, 1, NULL, 'activiteiten', 'Activiteiten', '/activiteiten', '', '', '', '', 5),
(7, 1, NULL, 'orkesten', 'De orkesten', '/de-orkesten', '', '', '', '', 6),
(8, 1, NULL, 'leerlingen', 'De leerlingen', '/de-leerlingen', '', '', '', '', 7),
(9, 1, NULL, 'bestuur', 'Het bestuur', '/het-bestuur', '', '', '', '', 8),
(10, 1, NULL, 'geschiedenis', 'Geschiedenis', '/geschiedenis', '', '', '', '', 9),
(11, 1, NULL, 'info', 'Ledeninformatie', '/ledeninformatie', '', '', '', '', 11),
(12, 1, NULL, 'sites', 'Andere sites', '/andere-sites', '', '', '', '', 12),
(13, 1, NULL, 'aanmelden', 'Lid worden', '/lid-worden', '', '', '', '', 13),
(14, 1, NULL, 'gastenboek', 'Gastenboek', '/gastenboek', '', '', '', '', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news_implementations`
--

CREATE TABLE IF NOT EXISTS `news_implementations` (
  `implementation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_1` text NOT NULL,
  `title_2` varchar(200) NOT NULL DEFAULT '',
  `content_2` text NOT NULL,
  `use_image` enum('1','0') NOT NULL DEFAULT '1',
  `allow_types` set('story','gallery') NOT NULL DEFAULT 'story',
  `label_for_title_1` varchar(40) NOT NULL DEFAULT 'Title',
  `label_for_content_1` varchar(40) NOT NULL DEFAULT 'Content',
  `label_for_title_2` varchar(40) NOT NULL DEFAULT 'Title 2',
  `label_for_content_2` varchar(40) NOT NULL DEFAULT 'Content 2',
  PRIMARY KEY (`implementation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `news_implementations`
--

INSERT INTO `news_implementations` (`implementation_id`, `content_1`, `title_2`, `content_2`, `use_image`, `allow_types`, `label_for_title_1`, `label_for_content_1`, `label_for_title_2`, `label_for_content_2`) VALUES
(1, '<p>\r\n	Ziehier, luister hard!</p>\r\n', 'twee', 'tweeeeeee', '0', 'story,gallery', 'Title', 'Content', '.Title 2', '.Content 2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news_items`
--

CREATE TABLE IF NOT EXISTS `news_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_implementation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `title_2` varchar(255) NOT NULL,
  `content_1` text NOT NULL,
  `content_2` text NOT NULL,
  `image_1` varchar(4) NOT NULL DEFAULT '',
  `created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `news_items`
--

INSERT INTO `news_items` (`id`, `news_implementation_id`, `title`, `title_2`, `content_1`, `content_2`, `image_1`, `created`) VALUES
(1, 1, 'Vernieuwde ''SubUmbra'' website # 3', 'De SubUmbra website is vernieuwd. Voor ons, voor jullie, voor iedereen. Nu beter, makkelijker en interactiever dan ooit!', '<p>\r\n	De website is vernieuwd.</p>\r\n', '', '', 1259534584),
(2, 1, 'Geboorte', '', '<p>\r\n	Luuk is geboren!</p>\r\n', '<p>\r\n	&nbsp;</p>\r\n<div style="font-family: Arial, Verdana, sans-serif; font-size: 12px; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); ">\r\n	<p>\r\n		<span class="Apple-style-span" style="color: rgb(0, 0, 0); font-family: ''Times New Roman''; font-size: medium; "><img alt="luuk 1" height="339" src="/images/Luuk01-1.jpg" style="cursor: default; " width="343" /><br />\r\n		</span></p>\r\n	<p>\r\n		<span class="Apple-style-span" style="color: rgb(0, 0, 0); font-family: ''Times New Roman''; font-size: medium; "><img alt="luuk 2" height="339" src="/images/Luuk02-1.jpg" style="cursor: default; " width="650" /></span></p>\r\n</div>\r\n', '', 1259536120);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `news_item_images`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `page_implementations`
--

INSERT INTO `page_implementations` (`implementation_id`, `parent_page_id`, `title_2`, `content_1`, `content_2`, `label_for_title_1`, `label_for_content_1`, `label_for_title_2`, `label_for_content_2`, `o`) VALUES
(1, NULL, '', 'Dit is de website van de Harmonie Sub Umbra. Als u dit leest, heeft u geen frames.', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0),
(2, NULL, '', '<h1>\r\n	Meerveldhoven</h1>\r\n<table border="0" cellpadding="1" cellspacing="1" style="width: 200px; ">\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan="3">\r\n				<span class="Apple-style-span" style="-webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; "><img height="250" src="http://subumbra.nl/images/SU-nov2003-2.gif" style="cursor: default; " width="624" /></span></td>\r\n			<td style="text-align: center; ">\r\n				<img alt="" height="80" src="http://subumbra.nl/images/jub-concert.jpg" width="168" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align: center; ">\r\n				<img alt="" height="80" src="http://subumbra.nl/images/Italie_vlag-3.JPG" width="135" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align: center; ">\r\n				<img alt="" height="80" src="http://subumbra.nl/images/meifeest.jpg" width="120" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<h1>\r\n	&nbsp;</h1>\r\n<p>\r\n	Heb je op- of aanmerkingen over deze website, <a href="mailto:webmaster@subumbra.nl">mail dan naar de webmaster</a> of <a href="/gastenboek">maak een melding in het gastenboek</a>.</p>\r\n', '', 'Title 1', 'Content 1', '.Title 2', '.Content 2', 0),
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
(13, 4, '', '<p>\r\n	Jaarplanning 2010</p>\r\n', '', 'Title 1', 'Content 1', 'Title 2', 'Content 2', 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `shop_implementations`
--


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
  `parent_category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content_1` text NOT NULL,
  `image_1` varchar(4) NOT NULL DEFAULT '',
  `image_2` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `shop_product_categories`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `snippet_implementations`
--

INSERT INTO `snippet_implementations` (`implementation_id`, `content_type`, `modified_time`) VALUES
(1, 'text/css', 1259709572),
(2, 'text/html', 1259709221),
(3, 'image/x-icon', 1259521104),
(4, 'text/html', 1259521091);

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
('frames', 'page', 3);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `views`
--

INSERT INTO `views` (`id`, `type`, `title`, `o`) VALUES
(4, 'page', 'Standaard pagina', 0),
(7, 'guestbook', 'Gastenboek', 2),
(9, 'newsIndex,newsItem,newsItemImage', 'Nieuws', 1);
