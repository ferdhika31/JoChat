/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50620
Source Host           : 127.0.0.1:3306
Source Database       : db_jochat

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2015-11-01 13:56:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for chats
-- ----------------------------
DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats` (
  `userId` int(11) NOT NULL,
  `randomUserId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of chats
-- ----------------------------
INSERT INTO `chats` VALUES ('1', '2');
INSERT INTO `chats` VALUES ('2', '1');

-- ----------------------------
-- Table structure for msgs
-- ----------------------------
DROP TABLE IF EXISTS `msgs`;
CREATE TABLE `msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `randomUserId` int(11) DEFAULT NULL,
  `msg` text,
  `sentdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of msgs
-- ----------------------------
INSERT INTO `msgs` VALUES ('1', '2', '0', 'Ha', '2015-11-01 13:51:21');

-- ----------------------------
-- Table structure for oldmsgs
-- ----------------------------
DROP TABLE IF EXISTS `oldmsgs`;
CREATE TABLE `oldmsgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `randomUserId` int(11) NOT NULL,
  `msg` text NOT NULL,
  `archivedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of oldmsgs
-- ----------------------------
INSERT INTO `oldmsgs` VALUES ('1', '1', '2', 'hey', '2015-11-01 13:53:16');
INSERT INTO `oldmsgs` VALUES ('2', '1', '2', 'dari mana?', '2015-11-01 13:53:23');
INSERT INTO `oldmsgs` VALUES ('3', '2', '1', 'dika web id bukan?', '2015-11-01 13:53:38');
INSERT INTO `oldmsgs` VALUES ('4', '1', '2', 'Iyaaa', '2015-11-01 13:53:45');

-- ----------------------------
-- Table structure for typing
-- ----------------------------
DROP TABLE IF EXISTS `typing`;
CREATE TABLE `typing` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of typing
-- ----------------------------
INSERT INTO `typing` VALUES ('1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inchat` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

