-- Lab8 : Table structure for table `img_favorites` 
--

DROP TABLE IF EXISTS `img_favorites`;
CREATE TABLE `img_favorites` (
  `img_favorites_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_favorites_url` varchar(255) NOT NULL,
  `img_favorites_keyword` varchar(128) NOT NULL,
  PRIMARY KEY (`img_favorites_id`),
  UNIQUE KEY `img_favorites_url` (`img_favorites_url`),
  KEY `img_favorites_id` (`img_favorites_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `img_favorites`
--
-- INSERT INTO `img_favorites` VALUES (1,'https://cdn-images-1.medium.com/max/2600/1*ir3MBJgZwPKAVghEbSdFIg.jpeg','otter');
-- INSERT INTO `img_favorites` VALUES (2,'http://2.bp.blogspot.com/-N_PBhYXHyTA/VIgnlYA-NrI/AAAAAAAAGFU/xDWB4vAjM8w/s1600/Green-Smiley1.png','otter');