--
-- Table structure for table `picture_gallery`
--

-- DROP TABLE IF EXISTS `picture_gallery`;
-- CREATE TABLE `picture_gallery` (
--   `gallery_picture_id` int(11) NOT NULL AUTO_INCREMENT,
--   `gallery_picture_user_email` varchar(128) NOT NULL,
--   `gallery_picture_media` MEDIUMBLOB NOT NULL,
--   'gallery_picutre_timestamp' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
-- ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `picture_gallery`;
CREATE TABLE `picture_gallery` (
  `gallery_picture_user_email` varchar(128) NOT NULL,
  `gallery_picture_caption` varchar(300),
  `gallery_picture_mime` varchar(50) NOT NULL,
  `gallery_picture_media` MEDIUMBLOB NOT NULL,
  `gallery_picutre_timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_gallery`
--
-- INSERT INTO `picture_gallery` (`gallery_picture_user_email`, `gallery_picture_caption`) VALUES ("juhipark@csumb.edu", "Picture of something", );
