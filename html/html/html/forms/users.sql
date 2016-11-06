/*
MySQL Data Transfer
Source Host: localhost
Source Database: mydb
Target Host: localhost
Target Database: mydb
Date: 2011/6/3 13:59:12
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for users
-- ----------------------------
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(50) default NULL,
  `lastname` varchar(50) default NULL,
  `phone` varchar(200) default NULL,
  `email` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `users` VALUES ('3', 'fname1', 'lname1', '(000)000-0000', 'name1@gmail.com');
INSERT INTO `users` VALUES ('4', 'fname2', 'lname2', '(000)000-0000', 'name2@gmail.com');
INSERT INTO `users` VALUES ('5', 'fname3', 'lname3', '(000)000-0000', 'name3@gmail.com');
INSERT INTO `users` VALUES ('7', 'fname4', 'lname4', '(000)000-0000', 'name4@gmail.com');
INSERT INTO `users` VALUES ('8', 'fname5', 'lname5', '(000)000-0000', 'name5@gmail.com');
INSERT INTO `users` VALUES ('9', 'fname6', 'lname6', '(000)000-0000', 'name6@gmail.com');
INSERT INTO `users` VALUES ('10', 'fname7', 'lname7', '(000)000-0000', 'name7@gmail.com');
INSERT INTO `users` VALUES ('11', 'fname8', 'lname8', '(000)000-0000', 'name8@gmail.com');
INSERT INTO `users` VALUES ('12', 'fname9', 'lname9', '(000)000-0000', 'name9@gmail.com');
INSERT INTO `users` VALUES ('13', 'fname10', 'lname10', '(000)000-0000', 'name10@gmail.com');
