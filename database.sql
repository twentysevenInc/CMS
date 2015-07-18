SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-general` (
  `key` varchar(256) NOT NULL,
  `value` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cms-general` (`key`, `value`) VALUES
('CMS_ROOT', '/var/www/cms');

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `guestmode` tinyint(1) NOT NULL,
  `profile` tinyint(1) NOT NULL,
  `notification` tinyint(1) NOT NULL,
  `plugin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `cms-group` (`id`, `name`, `admin`, `guestmode`) VALUES
(1, 'Admin', 1, 0, 1, 1, 1),
(2, 'Moderator', 1, 0, 1, 0, 1),
(3, 'User', 0, 0, 1, 0, 1);

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-groupEnablesPlugin` (
  `groupId` int(11) NOT NULL,
  `pluginId` int(11) NOT NULL,
  PRIMARY KEY (`groupId`,`pluginId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cms-groupEnablesPlugin` (`groupId`, `pluginId`) VALUES
(1, 1);

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-groupEnablesService` (
  `groupId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  PRIMARY KEY (`groupId`,`serviceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `version` varchar(20) NOT NULL,
  `pushId` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

INSERT INTO `cms-plugin` (`id`, `name`, `author`, `version`, `pushId`, `visible`) VALUES
(1, 'Default', 'Twentyseven', '0.1', 3, 0);

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `ip` varchar(22) NOT NULL,
  `pushId` int(11) NOT NULL,
  `importance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `user` int(11) NOT NULL,
  `done` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pushid` varchar(255) NOT NULL UNIQUE,
  `name` varchar(30) NOT NULL UNIQUE,
  `pass` varchar(128) NOT NULL,
  `groupId` int(11) NOT NULL,
  `avatar` varchar(256) NOT NULL DEFAULT 'img/default.jpg',
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

INSERT INTO `cms-user` (`id`, `pushid`, `name`, `pass`, `groupId`, `avatar`, `email`) VALUES
(1, '', 'kimjongun', 'fd37ca5ca8763ae077a5e9740212319591603c42a08a60dcc91d12e7e457b024f6bdfdc10cdc1383e1602ff2092b4bc1bb8cac9306a9965eb352435f5dfe8bb0', 1, 'img/avatars/kimjongun.jpg', 'kim.jong@un.nk');

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-userActivatedPush` (
  `usreId` int(11) NOT NULL,
  `pushId` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `activeMobile` int(11) NOT NULL,
  `activeCMS` int(11) NOT NULL,
  PRIMARY KEY (`usreId`,`pushId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-userDashboard` (
  `userId` int(11) NOT NULL,
  `widgetId` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cms-widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pluginId` int(11) NOT NULL,
  `reload` int(11) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

INSERT INTO `cms-widget` (`id`, `name`, `pluginId`, `reload`, `width`, `height`) VALUES
(1, 'Welcome', 1, 0, 3, 2),
(2, 'Stats', 1, 0, 2, 2),
(3, 'Todo', 1, 0, 2, 4),
(4, 'Weather', 1, 0, 1, 2),
(5, 'Cocktail', 1, 0, 1, 4),
(6, 'Unsplash', 1, 0, 2, 2),
(7, 'Date', 1, 0, 1, 2);
