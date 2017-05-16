/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : software

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2017-05-16 14:29:03
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES ('1', 'superadmin', '202cb962ac59075b964b07152d234b70', '超級管理員', '4', '男', 'superadmin@cc.c', null, '2017-05-09 14:34:04', '');
INSERT INTO `accounts` VALUES ('2', 'admin', '202cb962ac59075b964b07152d234b70', '管理員', '3', '男', 'admin@cc.c', null, '2017-05-14 13:43:22', '');
INSERT INTO `accounts` VALUES ('3', 'service', '202cb962ac59075b964b07152d234b70', '服務員', '2', '男', 'service@cc.c', null, '2017-05-09 14:34:06', '');
INSERT INTO `accounts` VALUES ('4', 'member', '202cb962ac59075b964b07152d234b70', '一般會員', '1', '男', 'member@cc.c', null, '2017-05-09 14:33:57', '');

-- ----------------------------
-- Table structure for `chat`
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `order_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `message` text CHARACTER SET utf8,
  `message_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of chat
-- ----------------------------

-- ----------------------------
-- Table structure for `customer_service_message`
-- ----------------------------
DROP TABLE IF EXISTS `customer_service_message`;
CREATE TABLE `customer_service_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8,
  `status` tinyint(4) DEFAULT NULL,
  `message_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `rely_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer_service_message
-- ----------------------------

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `receive_uid` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '訂單狀態\r\n1= 等待接收;\r\n2 = 處理中;\r\n3 = 運送中;\r\n4 = 完成;\r\n5 = 取消;',
  `order_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for `order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_detail
-- ----------------------------

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

-- ----------------------------
-- Table structure for `store_info`
-- ----------------------------
DROP TABLE IF EXISTS `store_info`;
CREATE TABLE `store_info` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `describe` text CHARACTER SET utf8,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of store_info
-- ----------------------------

-- ----------------------------
-- Table structure for `store_product`
-- ----------------------------
DROP TABLE IF EXISTS `store_product`;
CREATE TABLE `store_product` (
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of store_product
-- ----------------------------

-- ----------------------------
-- Table structure for `taiwan_area`
-- ----------------------------
DROP TABLE IF EXISTS `taiwan_area`;
CREATE TABLE `taiwan_area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `area_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `zipcode` char(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of taiwan_area
-- ----------------------------
INSERT INTO `taiwan_area` VALUES ('1', '1', '中山區', '104');
INSERT INTO `taiwan_area` VALUES ('2', '1', '中正區', '100');
INSERT INTO `taiwan_area` VALUES ('3', '1', '信義區', '110');
INSERT INTO `taiwan_area` VALUES ('4', '1', '內湖區', '114');
INSERT INTO `taiwan_area` VALUES ('5', '1', '北投區', '112');
INSERT INTO `taiwan_area` VALUES ('6', '1', '南港區', '115');
INSERT INTO `taiwan_area` VALUES ('7', '1', '士林區', '111');
INSERT INTO `taiwan_area` VALUES ('8', '1', '大同區', '103');
INSERT INTO `taiwan_area` VALUES ('9', '1', '大安區', '106');
INSERT INTO `taiwan_area` VALUES ('10', '1', '文山區', '116');
INSERT INTO `taiwan_area` VALUES ('11', '1', '松山區', '105');
INSERT INTO `taiwan_area` VALUES ('12', '1', '萬華區', '108');
INSERT INTO `taiwan_area` VALUES ('13', '2', '七堵區', '206');
INSERT INTO `taiwan_area` VALUES ('14', '2', '中山區', '203');
INSERT INTO `taiwan_area` VALUES ('15', '2', '中正區', '202');
INSERT INTO `taiwan_area` VALUES ('16', '2', '仁愛區', '200');
INSERT INTO `taiwan_area` VALUES ('17', '2', '信義區', '201');
INSERT INTO `taiwan_area` VALUES ('18', '2', '安樂區', '204');
INSERT INTO `taiwan_area` VALUES ('19', '2', '暖暖區', '205');
INSERT INTO `taiwan_area` VALUES ('20', '3', '三峽區', '237');
INSERT INTO `taiwan_area` VALUES ('21', '3', '三芝區', '252');
INSERT INTO `taiwan_area` VALUES ('22', '3', '三重區', '241');
INSERT INTO `taiwan_area` VALUES ('23', '3', '中和區', '235');
INSERT INTO `taiwan_area` VALUES ('24', '3', '五股區', '248');
INSERT INTO `taiwan_area` VALUES ('25', '3', '八里區', '249');
INSERT INTO `taiwan_area` VALUES ('26', '3', '土城區', '236');
INSERT INTO `taiwan_area` VALUES ('27', '3', '坪林區', '232');
INSERT INTO `taiwan_area` VALUES ('28', '3', '平溪區', '226');
INSERT INTO `taiwan_area` VALUES ('29', '3', '新店區', '231');
INSERT INTO `taiwan_area` VALUES ('30', '3', '新莊區', '242');
INSERT INTO `taiwan_area` VALUES ('31', '3', '板橋區', '220');
INSERT INTO `taiwan_area` VALUES ('32', '3', '林口區', '244');
INSERT INTO `taiwan_area` VALUES ('33', '3', '樹林區', '238');
INSERT INTO `taiwan_area` VALUES ('34', '3', '永和區', '234');
INSERT INTO `taiwan_area` VALUES ('35', '3', '汐止區', '221');
INSERT INTO `taiwan_area` VALUES ('36', '3', '泰山區', '243');
INSERT INTO `taiwan_area` VALUES ('37', '3', '淡水區', '251');
INSERT INTO `taiwan_area` VALUES ('38', '3', '深坑區', '222');
INSERT INTO `taiwan_area` VALUES ('39', '3', '烏來區', '233');
INSERT INTO `taiwan_area` VALUES ('40', '3', '瑞芳區', '224');
INSERT INTO `taiwan_area` VALUES ('41', '3', '石碇區', '223');
INSERT INTO `taiwan_area` VALUES ('42', '3', '石門區', '253');
INSERT INTO `taiwan_area` VALUES ('43', '3', '萬里區', '207');
INSERT INTO `taiwan_area` VALUES ('44', '3', '蘆洲區', '247');
INSERT INTO `taiwan_area` VALUES ('45', '3', '貢寮區', '228');
INSERT INTO `taiwan_area` VALUES ('46', '3', '金山區', '208');
INSERT INTO `taiwan_area` VALUES ('47', '3', '雙溪區', '227');
INSERT INTO `taiwan_area` VALUES ('48', '3', '鶯歌區', '239');
INSERT INTO `taiwan_area` VALUES ('49', '4', '三星鄉', '266');
INSERT INTO `taiwan_area` VALUES ('50', '4', '五結鄉', '268');
INSERT INTO `taiwan_area` VALUES ('51', '4', '冬山鄉', '269');
INSERT INTO `taiwan_area` VALUES ('52', '4', '南澳鄉', '272');
INSERT INTO `taiwan_area` VALUES ('53', '4', '員山鄉', '264');
INSERT INTO `taiwan_area` VALUES ('54', '4', '壯圍鄉', '263');
INSERT INTO `taiwan_area` VALUES ('55', '4', '大同鄉', '267');
INSERT INTO `taiwan_area` VALUES ('56', '4', '宜蘭市', '260');
INSERT INTO `taiwan_area` VALUES ('57', '4', '礁溪鄉', '262');
INSERT INTO `taiwan_area` VALUES ('58', '4', '羅東鎮', '265');
INSERT INTO `taiwan_area` VALUES ('59', '4', '蘇澳鎮', '270');
INSERT INTO `taiwan_area` VALUES ('60', '4', '釣魚台列嶼', '290');
INSERT INTO `taiwan_area` VALUES ('61', '4', '頭城鎮', '261');
INSERT INTO `taiwan_area` VALUES ('62', '5', '北區', '300');
INSERT INTO `taiwan_area` VALUES ('63', '5', '東區', '300');
INSERT INTO `taiwan_area` VALUES ('64', '5', '香山區', '300');
INSERT INTO `taiwan_area` VALUES ('65', '6', '五峰鄉', '311');
INSERT INTO `taiwan_area` VALUES ('66', '6', '北埔鄉', '314');
INSERT INTO `taiwan_area` VALUES ('67', '6', '寶山鄉', '308');
INSERT INTO `taiwan_area` VALUES ('68', '6', '尖石鄉', '313');
INSERT INTO `taiwan_area` VALUES ('69', '6', '峨眉鄉', '315');
INSERT INTO `taiwan_area` VALUES ('70', '6', '新埔鎮', '305');
INSERT INTO `taiwan_area` VALUES ('71', '6', '新豐鄉', '304');
INSERT INTO `taiwan_area` VALUES ('72', '6', '橫山鄉', '312');
INSERT INTO `taiwan_area` VALUES ('73', '6', '湖口鄉', '303');
INSERT INTO `taiwan_area` VALUES ('74', '6', '竹北市', '302');
INSERT INTO `taiwan_area` VALUES ('75', '6', '竹東鎮', '310');
INSERT INTO `taiwan_area` VALUES ('76', '6', '芎林鄉', '307');
INSERT INTO `taiwan_area` VALUES ('77', '6', '關西鎮', '306');
INSERT INTO `taiwan_area` VALUES ('78', '7', '中壢市', '320');
INSERT INTO `taiwan_area` VALUES ('79', '7', '八德市', '334');
INSERT INTO `taiwan_area` VALUES ('80', '7', '大園鄉', '337');
INSERT INTO `taiwan_area` VALUES ('81', '7', '大溪鎮', '335');
INSERT INTO `taiwan_area` VALUES ('82', '7', '平鎮市', '324');
INSERT INTO `taiwan_area` VALUES ('83', '7', '復興鄉', '336');
INSERT INTO `taiwan_area` VALUES ('84', '7', '新屋鄉', '327');
INSERT INTO `taiwan_area` VALUES ('85', '7', '桃園市', '330');
INSERT INTO `taiwan_area` VALUES ('86', '7', '楊梅市', '326');
INSERT INTO `taiwan_area` VALUES ('87', '7', '蘆竹鄉', '338');
INSERT INTO `taiwan_area` VALUES ('88', '7', '觀音鄉', '328');
INSERT INTO `taiwan_area` VALUES ('89', '7', '龍潭鄉', '325');
INSERT INTO `taiwan_area` VALUES ('90', '7', '龜山鄉', '333');
INSERT INTO `taiwan_area` VALUES ('91', '8', '三灣鄉', '352');
INSERT INTO `taiwan_area` VALUES ('92', '8', '三義鄉', '367');
INSERT INTO `taiwan_area` VALUES ('93', '8', '公館鄉', '363');
INSERT INTO `taiwan_area` VALUES ('94', '8', '卓蘭鎮', '369');
INSERT INTO `taiwan_area` VALUES ('95', '8', '南庄鄉', '353');
INSERT INTO `taiwan_area` VALUES ('96', '8', '大湖鄉', '364');
INSERT INTO `taiwan_area` VALUES ('97', '8', '後龍鎮', '356');
INSERT INTO `taiwan_area` VALUES ('98', '8', '泰安鄉', '365');
INSERT INTO `taiwan_area` VALUES ('99', '8', '獅潭鄉', '354');
INSERT INTO `taiwan_area` VALUES ('100', '8', '竹南鎮', '350');
INSERT INTO `taiwan_area` VALUES ('101', '8', '苑裡鎮', '358');
INSERT INTO `taiwan_area` VALUES ('102', '8', '苗栗市', '360');
INSERT INTO `taiwan_area` VALUES ('103', '8', '西湖鄉', '368');
INSERT INTO `taiwan_area` VALUES ('104', '8', '通霄鎮', '357');
INSERT INTO `taiwan_area` VALUES ('105', '8', '造橋鄉', '361');
INSERT INTO `taiwan_area` VALUES ('106', '8', '銅鑼鄉', '366');
INSERT INTO `taiwan_area` VALUES ('107', '8', '頭份鎮', '351');
INSERT INTO `taiwan_area` VALUES ('108', '8', '頭屋鄉', '362');
INSERT INTO `taiwan_area` VALUES ('109', '9', '中區', '400');
INSERT INTO `taiwan_area` VALUES ('110', '9', '北區', '404');
INSERT INTO `taiwan_area` VALUES ('111', '9', '北屯區', '406');
INSERT INTO `taiwan_area` VALUES ('112', '9', '南區', '402');
INSERT INTO `taiwan_area` VALUES ('113', '9', '南屯區', '408');
INSERT INTO `taiwan_area` VALUES ('114', '9', '后里區', '421');
INSERT INTO `taiwan_area` VALUES ('115', '9', '和平區', '424');
INSERT INTO `taiwan_area` VALUES ('116', '9', '外埔區', '438');
INSERT INTO `taiwan_area` VALUES ('117', '9', '大安區', '439');
INSERT INTO `taiwan_area` VALUES ('118', '9', '大甲區', '437');
INSERT INTO `taiwan_area` VALUES ('119', '9', '大肚區', '432');
INSERT INTO `taiwan_area` VALUES ('120', '9', '大里區', '412');
INSERT INTO `taiwan_area` VALUES ('121', '9', '大雅區', '428');
INSERT INTO `taiwan_area` VALUES ('122', '9', '太平區', '411');
INSERT INTO `taiwan_area` VALUES ('123', '9', '新社區', '426');
INSERT INTO `taiwan_area` VALUES ('124', '9', '東勢區', '423');
INSERT INTO `taiwan_area` VALUES ('125', '9', '東區', '401');
INSERT INTO `taiwan_area` VALUES ('126', '9', '梧棲區', '435');
INSERT INTO `taiwan_area` VALUES ('127', '9', '沙鹿區', '433');
INSERT INTO `taiwan_area` VALUES ('128', '9', '清水區', '436');
INSERT INTO `taiwan_area` VALUES ('129', '9', '潭子區', '427');
INSERT INTO `taiwan_area` VALUES ('130', '9', '烏日區', '414');
INSERT INTO `taiwan_area` VALUES ('131', '9', '石岡區', '422');
INSERT INTO `taiwan_area` VALUES ('132', '9', '神岡區', '429');
INSERT INTO `taiwan_area` VALUES ('133', '9', '西區', '403');
INSERT INTO `taiwan_area` VALUES ('134', '9', '西屯區', '407');
INSERT INTO `taiwan_area` VALUES ('135', '9', '豐原區', '420');
INSERT INTO `taiwan_area` VALUES ('136', '9', '霧峰區', '413');
INSERT INTO `taiwan_area` VALUES ('137', '9', '龍井區', '434');
INSERT INTO `taiwan_area` VALUES ('138', '10', '二林鎮', '526');
INSERT INTO `taiwan_area` VALUES ('139', '10', '二水鄉', '530');
INSERT INTO `taiwan_area` VALUES ('140', '10', '伸港鄉', '509');
INSERT INTO `taiwan_area` VALUES ('141', '10', '北斗鎮', '521');
INSERT INTO `taiwan_area` VALUES ('142', '10', '和美鎮', '508');
INSERT INTO `taiwan_area` VALUES ('143', '10', '員林鎮', '510');
INSERT INTO `taiwan_area` VALUES ('144', '10', '埔心鄉', '513');
INSERT INTO `taiwan_area` VALUES ('145', '10', '埔鹽鄉', '516');
INSERT INTO `taiwan_area` VALUES ('146', '10', '埤頭鄉', '523');
INSERT INTO `taiwan_area` VALUES ('147', '10', '大城鄉', '527');
INSERT INTO `taiwan_area` VALUES ('148', '10', '大村鄉', '515');
INSERT INTO `taiwan_area` VALUES ('149', '10', '彰化市', '500');
INSERT INTO `taiwan_area` VALUES ('150', '10', '永靖鄉', '512');
INSERT INTO `taiwan_area` VALUES ('151', '10', '溪州鄉', '524');
INSERT INTO `taiwan_area` VALUES ('152', '10', '溪湖鎮', '514');
INSERT INTO `taiwan_area` VALUES ('153', '10', '田中鎮', '520');
INSERT INTO `taiwan_area` VALUES ('154', '10', '田尾鄉', '522');
INSERT INTO `taiwan_area` VALUES ('155', '10', '社頭鄉', '511');
INSERT INTO `taiwan_area` VALUES ('156', '10', '福興鄉', '506');
INSERT INTO `taiwan_area` VALUES ('157', '10', '秀水鄉', '504');
INSERT INTO `taiwan_area` VALUES ('158', '10', '竹塘鄉', '525');
INSERT INTO `taiwan_area` VALUES ('159', '10', '線西鄉', '507');
INSERT INTO `taiwan_area` VALUES ('160', '10', '芬園鄉', '502');
INSERT INTO `taiwan_area` VALUES ('161', '10', '花壇鄉', '503');
INSERT INTO `taiwan_area` VALUES ('162', '10', '芳苑鄉', '528');
INSERT INTO `taiwan_area` VALUES ('163', '10', '鹿港鎮', '505');
INSERT INTO `taiwan_area` VALUES ('164', '11', '中寮鄉', '541');
INSERT INTO `taiwan_area` VALUES ('165', '11', '仁愛鄉', '546');
INSERT INTO `taiwan_area` VALUES ('166', '11', '信義鄉', '556');
INSERT INTO `taiwan_area` VALUES ('167', '11', '南投市', '540');
INSERT INTO `taiwan_area` VALUES ('168', '11', '名間鄉', '551');
INSERT INTO `taiwan_area` VALUES ('169', '11', '國姓鄉', '544');
INSERT INTO `taiwan_area` VALUES ('170', '11', '埔里鎮', '545');
INSERT INTO `taiwan_area` VALUES ('171', '11', '水里鄉', '553');
INSERT INTO `taiwan_area` VALUES ('172', '11', '竹山鎮', '557');
INSERT INTO `taiwan_area` VALUES ('173', '11', '草屯鎮', '542');
INSERT INTO `taiwan_area` VALUES ('174', '11', '集集鎮', '552');
INSERT INTO `taiwan_area` VALUES ('175', '11', '魚池鄉', '555');
INSERT INTO `taiwan_area` VALUES ('176', '11', '鹿谷鄉', '558');
INSERT INTO `taiwan_area` VALUES ('177', '12', '二崙鄉', '649');
INSERT INTO `taiwan_area` VALUES ('178', '12', '元長鄉', '655');
INSERT INTO `taiwan_area` VALUES ('179', '12', '北港鎮', '651');
INSERT INTO `taiwan_area` VALUES ('180', '12', '口湖鄉', '653');
INSERT INTO `taiwan_area` VALUES ('181', '12', '古坑鄉', '646');
INSERT INTO `taiwan_area` VALUES ('182', '12', '四湖鄉', '654');
INSERT INTO `taiwan_area` VALUES ('183', '12', '土庫鎮', '633');
INSERT INTO `taiwan_area` VALUES ('184', '12', '大埤鄉', '631');
INSERT INTO `taiwan_area` VALUES ('185', '12', '崙背鄉', '637');
INSERT INTO `taiwan_area` VALUES ('186', '12', '斗六市', '640');
INSERT INTO `taiwan_area` VALUES ('187', '12', '斗南鎮', '630');
INSERT INTO `taiwan_area` VALUES ('188', '12', '東勢鄉', '635');
INSERT INTO `taiwan_area` VALUES ('189', '12', '林內鄉', '643');
INSERT INTO `taiwan_area` VALUES ('190', '12', '水林鄉', '652');
INSERT INTO `taiwan_area` VALUES ('191', '12', '臺西鄉', '636');
INSERT INTO `taiwan_area` VALUES ('192', '12', '莿桐鄉', '647');
INSERT INTO `taiwan_area` VALUES ('193', '12', '虎尾鎮', '632');
INSERT INTO `taiwan_area` VALUES ('194', '12', '褒忠鄉', '634');
INSERT INTO `taiwan_area` VALUES ('195', '12', '西螺鎮', '648');
INSERT INTO `taiwan_area` VALUES ('196', '12', '麥寮鄉', '638');
INSERT INTO `taiwan_area` VALUES ('197', '13', '東區', '600');
INSERT INTO `taiwan_area` VALUES ('198', '14', '中埔鄉', '606');
INSERT INTO `taiwan_area` VALUES ('199', '14', '六腳鄉', '615');
INSERT INTO `taiwan_area` VALUES ('200', '14', '大埔鄉', '607');
INSERT INTO `taiwan_area` VALUES ('201', '14', '大林鎮', '622');
INSERT INTO `taiwan_area` VALUES ('202', '14', '太保市', '612');
INSERT INTO `taiwan_area` VALUES ('203', '14', '布袋鎮', '625');
INSERT INTO `taiwan_area` VALUES ('204', '14', '新港鄉', '616');
INSERT INTO `taiwan_area` VALUES ('205', '14', '朴子市', '613');
INSERT INTO `taiwan_area` VALUES ('206', '14', '東石鄉', '614');
INSERT INTO `taiwan_area` VALUES ('207', '14', '梅山鄉', '603');
INSERT INTO `taiwan_area` VALUES ('208', '14', '民雄鄉', '621');
INSERT INTO `taiwan_area` VALUES ('209', '14', '水上鄉', '608');
INSERT INTO `taiwan_area` VALUES ('210', '14', '溪口鄉', '623');
INSERT INTO `taiwan_area` VALUES ('211', '14', '番路鄉', '602');
INSERT INTO `taiwan_area` VALUES ('212', '14', '竹崎鄉', '604');
INSERT INTO `taiwan_area` VALUES ('213', '14', '義竹鄉', '624');
INSERT INTO `taiwan_area` VALUES ('214', '14', '阿里山鄉', '605');
INSERT INTO `taiwan_area` VALUES ('215', '14', '鹿草鄉', '611');
INSERT INTO `taiwan_area` VALUES ('216', '15', '七股區', '724');
INSERT INTO `taiwan_area` VALUES ('217', '15', '下營區', '735');
INSERT INTO `taiwan_area` VALUES ('218', '15', '中西區', '700');
INSERT INTO `taiwan_area` VALUES ('219', '15', '仁德區', '717');
INSERT INTO `taiwan_area` VALUES ('220', '15', '佳里區', '722');
INSERT INTO `taiwan_area` VALUES ('221', '15', '六甲區', '734');
INSERT INTO `taiwan_area` VALUES ('222', '15', '北區', '704');
INSERT INTO `taiwan_area` VALUES ('223', '15', '北門區', '727');
INSERT INTO `taiwan_area` VALUES ('224', '15', '南化區', '716');
INSERT INTO `taiwan_area` VALUES ('225', '15', '南區', '702');
INSERT INTO `taiwan_area` VALUES ('226', '15', '善化區', '741');
INSERT INTO `taiwan_area` VALUES ('227', '15', '大內區', '742');
INSERT INTO `taiwan_area` VALUES ('228', '15', '學甲區', '726');
INSERT INTO `taiwan_area` VALUES ('229', '15', '安南區', '709');
INSERT INTO `taiwan_area` VALUES ('230', '15', '安定區', '745');
INSERT INTO `taiwan_area` VALUES ('231', '15', '安平區', '708');
INSERT INTO `taiwan_area` VALUES ('232', '15', '官田區', '720');
INSERT INTO `taiwan_area` VALUES ('233', '15', '將軍區', '725');
INSERT INTO `taiwan_area` VALUES ('234', '15', '山上區', '743');
INSERT INTO `taiwan_area` VALUES ('235', '15', '左鎮區', '713');
INSERT INTO `taiwan_area` VALUES ('236', '15', '後壁區', '731');
INSERT INTO `taiwan_area` VALUES ('237', '15', '新化區', '712');
INSERT INTO `taiwan_area` VALUES ('238', '15', '新市區', '744');
INSERT INTO `taiwan_area` VALUES ('239', '15', '新營區', '730');
INSERT INTO `taiwan_area` VALUES ('240', '15', '東區', '701');
INSERT INTO `taiwan_area` VALUES ('241', '15', '東山區', '733');
INSERT INTO `taiwan_area` VALUES ('242', '15', '柳營區', '736');
INSERT INTO `taiwan_area` VALUES ('243', '15', '楠西區', '715');
INSERT INTO `taiwan_area` VALUES ('244', '15', '歸仁區', '711');
INSERT INTO `taiwan_area` VALUES ('245', '15', '永康區', '710');
INSERT INTO `taiwan_area` VALUES ('246', '15', '玉井區', '714');
INSERT INTO `taiwan_area` VALUES ('247', '15', '白河區', '732');
INSERT INTO `taiwan_area` VALUES ('248', '15', '西港區', '723');
INSERT INTO `taiwan_area` VALUES ('249', '15', '關廟區', '718');
INSERT INTO `taiwan_area` VALUES ('250', '15', '鹽水區', '737');
INSERT INTO `taiwan_area` VALUES ('251', '15', '麻豆區', '721');
INSERT INTO `taiwan_area` VALUES ('252', '15', '龍崎區', '719');
INSERT INTO `taiwan_area` VALUES ('253', '16', '三民區', '807');
INSERT INTO `taiwan_area` VALUES ('254', '16', '仁武區', '814');
INSERT INTO `taiwan_area` VALUES ('255', '16', '內門區', '845');
INSERT INTO `taiwan_area` VALUES ('256', '16', '六龜區', '844');
INSERT INTO `taiwan_area` VALUES ('257', '16', '前金區', '801');
INSERT INTO `taiwan_area` VALUES ('258', '16', '前鎮區', '806');
INSERT INTO `taiwan_area` VALUES ('259', '16', '大寮區', '831');
INSERT INTO `taiwan_area` VALUES ('260', '16', '大樹區', '840');
INSERT INTO `taiwan_area` VALUES ('261', '16', '大社區', '815');
INSERT INTO `taiwan_area` VALUES ('262', '16', '小港區', '812');
INSERT INTO `taiwan_area` VALUES ('263', '16', '岡山區', '820');
INSERT INTO `taiwan_area` VALUES ('264', '16', '左營區', '813');
INSERT INTO `taiwan_area` VALUES ('265', '16', '彌陀區', '827');
INSERT INTO `taiwan_area` VALUES ('266', '16', '新興區', '800');
INSERT INTO `taiwan_area` VALUES ('267', '16', '旗山區', '842');
INSERT INTO `taiwan_area` VALUES ('268', '16', '旗津區', '805');
INSERT INTO `taiwan_area` VALUES ('269', '16', '杉林區', '846');
INSERT INTO `taiwan_area` VALUES ('270', '16', '林園區', '832');
INSERT INTO `taiwan_area` VALUES ('271', '16', '桃源區', '848');
INSERT INTO `taiwan_area` VALUES ('272', '16', '梓官區', '826');
INSERT INTO `taiwan_area` VALUES ('273', '16', '楠梓區', '811');
INSERT INTO `taiwan_area` VALUES ('274', '16', '橋頭區', '825');
INSERT INTO `taiwan_area` VALUES ('275', '16', '永安區', '828');
INSERT INTO `taiwan_area` VALUES ('276', '16', '湖內區', '829');
INSERT INTO `taiwan_area` VALUES ('277', '16', '燕巢區', '824');
INSERT INTO `taiwan_area` VALUES ('278', '16', '田寮區', '823');
INSERT INTO `taiwan_area` VALUES ('279', '16', '甲仙區', '847');
INSERT INTO `taiwan_area` VALUES ('280', '16', '美濃區', '843');
INSERT INTO `taiwan_area` VALUES ('281', '16', '苓雅區', '802');
INSERT INTO `taiwan_area` VALUES ('282', '16', '茂林區', '851');
INSERT INTO `taiwan_area` VALUES ('283', '16', '茄萣區', '852');
INSERT INTO `taiwan_area` VALUES ('284', '16', '路竹區', '821');
INSERT INTO `taiwan_area` VALUES ('285', '16', '那瑪夏區', '849');
INSERT INTO `taiwan_area` VALUES ('286', '16', '阿蓮區', '822');
INSERT INTO `taiwan_area` VALUES ('287', '16', '鳥松區', '833');
INSERT INTO `taiwan_area` VALUES ('288', '16', '鳳山區', '830');
INSERT INTO `taiwan_area` VALUES ('289', '16', '鹽埕區', '803');
INSERT INTO `taiwan_area` VALUES ('290', '16', '鼓山區', '804');
INSERT INTO `taiwan_area` VALUES ('291', '17', '南沙', '819');
INSERT INTO `taiwan_area` VALUES ('292', '17', '東沙', '817');
INSERT INTO `taiwan_area` VALUES ('293', '18', '七美鄉', '883');
INSERT INTO `taiwan_area` VALUES ('294', '18', '望安鄉', '882');
INSERT INTO `taiwan_area` VALUES ('295', '18', '湖西鄉', '885');
INSERT INTO `taiwan_area` VALUES ('296', '18', '白沙鄉', '884');
INSERT INTO `taiwan_area` VALUES ('297', '18', '西嶼鄉', '881');
INSERT INTO `taiwan_area` VALUES ('298', '18', '馬公市', '880');
INSERT INTO `taiwan_area` VALUES ('299', '19', '三地門鄉', '901');
INSERT INTO `taiwan_area` VALUES ('300', '19', '九如鄉', '904');
INSERT INTO `taiwan_area` VALUES ('301', '19', '佳冬鄉', '931');
INSERT INTO `taiwan_area` VALUES ('302', '19', '來義鄉', '922');
INSERT INTO `taiwan_area` VALUES ('303', '19', '內埔鄉', '912');
INSERT INTO `taiwan_area` VALUES ('304', '19', '南州鄉', '926');
INSERT INTO `taiwan_area` VALUES ('305', '19', '屏東市', '900');
INSERT INTO `taiwan_area` VALUES ('306', '19', '崁頂鄉', '924');
INSERT INTO `taiwan_area` VALUES ('307', '19', '恆春鄉', '946');
INSERT INTO `taiwan_area` VALUES ('308', '19', '新園鄉', '932');
INSERT INTO `taiwan_area` VALUES ('309', '19', '新埤鄉', '925');
INSERT INTO `taiwan_area` VALUES ('310', '19', '春日鄉', '942');
INSERT INTO `taiwan_area` VALUES ('311', '19', '東港鄉', '928');
INSERT INTO `taiwan_area` VALUES ('312', '19', '枋寮鄉', '940');
INSERT INTO `taiwan_area` VALUES ('313', '19', '枋山鄉', '941');
INSERT INTO `taiwan_area` VALUES ('314', '19', '林邊鄉', '927');
INSERT INTO `taiwan_area` VALUES ('315', '19', '泰武鄉', '921');
INSERT INTO `taiwan_area` VALUES ('316', '19', '滿州鄉', '947');
INSERT INTO `taiwan_area` VALUES ('317', '19', '潮州鎮', '920');
INSERT INTO `taiwan_area` VALUES ('318', '19', '牡丹鄉', '945');
INSERT INTO `taiwan_area` VALUES ('319', '19', '獅子鄉', '943');
INSERT INTO `taiwan_area` VALUES ('320', '19', '琉球鄉', '929');
INSERT INTO `taiwan_area` VALUES ('321', '19', '瑪家鄉', '903');
INSERT INTO `taiwan_area` VALUES ('322', '19', '竹田鄉', '911');
INSERT INTO `taiwan_area` VALUES ('323', '19', '萬丹鄉', '913');
INSERT INTO `taiwan_area` VALUES ('324', '19', '萬巒鄉', '923');
INSERT INTO `taiwan_area` VALUES ('325', '19', '車城鄉', '944');
INSERT INTO `taiwan_area` VALUES ('326', '19', '里港鄉', '905');
INSERT INTO `taiwan_area` VALUES ('327', '19', '長治鄉', '908');
INSERT INTO `taiwan_area` VALUES ('328', '19', '霧臺鄉', '902');
INSERT INTO `taiwan_area` VALUES ('329', '19', '高樹鄉', '906');
INSERT INTO `taiwan_area` VALUES ('330', '19', '鹽埔鄉', '907');
INSERT INTO `taiwan_area` VALUES ('331', '19', '麟洛鄉', '909');
INSERT INTO `taiwan_area` VALUES ('332', '20', '卑南鄉', '954');
INSERT INTO `taiwan_area` VALUES ('333', '20', '大武鄉', '965');
INSERT INTO `taiwan_area` VALUES ('334', '20', '太麻里鄉', '963');
INSERT INTO `taiwan_area` VALUES ('335', '20', '延平鄉', '953');
INSERT INTO `taiwan_area` VALUES ('336', '20', '成功鎮', '961');
INSERT INTO `taiwan_area` VALUES ('337', '20', '東河鄉', '959');
INSERT INTO `taiwan_area` VALUES ('338', '20', '池上鄉', '958');
INSERT INTO `taiwan_area` VALUES ('339', '20', '海端鄉', '957');
INSERT INTO `taiwan_area` VALUES ('340', '20', '綠島鄉', '951');
INSERT INTO `taiwan_area` VALUES ('341', '20', '臺東市', '950');
INSERT INTO `taiwan_area` VALUES ('342', '20', '蘭嶼鄉', '952');
INSERT INTO `taiwan_area` VALUES ('343', '20', '達仁鄉', '966');
INSERT INTO `taiwan_area` VALUES ('344', '20', '金峰鄉', '964');
INSERT INTO `taiwan_area` VALUES ('345', '20', '長濱鄉', '962');
INSERT INTO `taiwan_area` VALUES ('346', '20', '關山鎮', '956');
INSERT INTO `taiwan_area` VALUES ('347', '20', '鹿野鄉', '955');
INSERT INTO `taiwan_area` VALUES ('348', '21', '光復鄉', '976');
INSERT INTO `taiwan_area` VALUES ('349', '21', '卓溪鄉', '982');
INSERT INTO `taiwan_area` VALUES ('350', '21', '吉安鄉', '973');
INSERT INTO `taiwan_area` VALUES ('351', '21', '壽豐鄉', '974');
INSERT INTO `taiwan_area` VALUES ('352', '21', '富里鄉', '983');
INSERT INTO `taiwan_area` VALUES ('353', '21', '新城鄉', '971');
INSERT INTO `taiwan_area` VALUES ('354', '21', '玉里鎮', '981');
INSERT INTO `taiwan_area` VALUES ('355', '21', '瑞穗鄉', '978');
INSERT INTO `taiwan_area` VALUES ('356', '21', '秀林鄉', '972');
INSERT INTO `taiwan_area` VALUES ('357', '21', '花蓮市', '970');
INSERT INTO `taiwan_area` VALUES ('358', '21', '萬榮鄉', '979');
INSERT INTO `taiwan_area` VALUES ('359', '21', '豐濱鄉', '977');
INSERT INTO `taiwan_area` VALUES ('360', '21', '鳳林鎮', '975');
INSERT INTO `taiwan_area` VALUES ('361', '22', '烈嶼鄉', '894');
INSERT INTO `taiwan_area` VALUES ('362', '22', '烏坵鄉', '896');
INSERT INTO `taiwan_area` VALUES ('363', '22', '金城鎮', '893');
INSERT INTO `taiwan_area` VALUES ('364', '22', '金寧鄉', '892');
INSERT INTO `taiwan_area` VALUES ('365', '22', '金沙鎮', '890');
INSERT INTO `taiwan_area` VALUES ('366', '22', '金湖鎮', '891');
INSERT INTO `taiwan_area` VALUES ('367', '23', '北竿鄉', '210');
INSERT INTO `taiwan_area` VALUES ('368', '23', '南竿鄉', '209');
INSERT INTO `taiwan_area` VALUES ('369', '23', '東引鄉', '212');
INSERT INTO `taiwan_area` VALUES ('370', '23', '莒光鄉', '211');
INSERT INTO `taiwan_area` VALUES ('371', '13', '西區', '600');

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
