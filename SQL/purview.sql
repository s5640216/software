/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : software

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2017-05-01 23:26:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `purview`
-- ----------------------------
DROP TABLE IF EXISTS `purview`;
CREATE TABLE `purview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `describe` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purview
-- ----------------------------
INSERT INTO `purview` VALUES ('1', 'member', '一般會員');
INSERT INTO `purview` VALUES ('2', 'service', '服務員');
INSERT INTO `purview` VALUES ('3', 'admin', '管理員');
INSERT INTO `purview` VALUES ('4', 'superadmin', '超級管理員');
