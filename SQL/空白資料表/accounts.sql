/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : software

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2017-05-09 14:10:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accounts`
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) CHARACTER SET utf8 NOT NULL,
  `passwd` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `purview` int(11) NOT NULL,
  `sex` enum('男','女') CHARACTER SET utf8 NOT NULL DEFAULT '男',
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` char(255) CHARACTER SET utf8 DEFAULT NULL,
  `register_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_ban` bit(1) NOT NULL DEFAULT b'0' COMMENT '帳號封鎖',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts
-- ----------------------------
