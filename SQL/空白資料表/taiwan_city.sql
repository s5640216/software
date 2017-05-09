/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : software

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2017-05-09 14:08:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `taiwan_city`
-- ----------------------------
DROP TABLE IF EXISTS `taiwan_city`;
CREATE TABLE `taiwan_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of taiwan_city
-- ----------------------------
INSERT INTO `taiwan_city` VALUES ('1', '台北市');
INSERT INTO `taiwan_city` VALUES ('2', '基隆市');
INSERT INTO `taiwan_city` VALUES ('3', '新北市');
INSERT INTO `taiwan_city` VALUES ('4', '宜蘭縣');
INSERT INTO `taiwan_city` VALUES ('5', '新竹市');
INSERT INTO `taiwan_city` VALUES ('6', '新竹縣');
INSERT INTO `taiwan_city` VALUES ('7', '桃園縣');
INSERT INTO `taiwan_city` VALUES ('8', '苗栗縣');
INSERT INTO `taiwan_city` VALUES ('9', '台中市');
INSERT INTO `taiwan_city` VALUES ('10', '彰化縣');
INSERT INTO `taiwan_city` VALUES ('11', '南投縣');
INSERT INTO `taiwan_city` VALUES ('12', '雲林縣');
INSERT INTO `taiwan_city` VALUES ('13', '嘉義市');
INSERT INTO `taiwan_city` VALUES ('14', '嘉義縣');
INSERT INTO `taiwan_city` VALUES ('15', '台南市');
INSERT INTO `taiwan_city` VALUES ('16', '高雄市');
INSERT INTO `taiwan_city` VALUES ('17', '南海諸島');
INSERT INTO `taiwan_city` VALUES ('18', '澎湖縣');
INSERT INTO `taiwan_city` VALUES ('19', '屏東縣');
INSERT INTO `taiwan_city` VALUES ('20', '台東縣');
INSERT INTO `taiwan_city` VALUES ('21', '花蓮縣');
INSERT INTO `taiwan_city` VALUES ('22', '金門縣');
INSERT INTO `taiwan_city` VALUES ('23', '連江縣');
