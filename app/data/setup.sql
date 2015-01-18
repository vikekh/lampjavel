CREATE TABLE IF NOT EXISTS `lampjavel_channel_images` (
  `channel_id` varchar(20) NOT NULL,
  `image_id` int(9) NOT NULL,
  KEY `channel_id` (`channel_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `lampjavel_channels` (
  `id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `lampjavel_images` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;