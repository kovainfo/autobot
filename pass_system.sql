/*
 Navicat Premium Data Transfer

 Source Server         : bot
 Source Server Type    : MySQL
 Source Server Version : 100331
 Source Host           : 192.168.10.44:3306
 Source Schema         : pass_system

 Target Server Type    : MySQL
 Target Server Version : 100331
 File Encoding         : 65001

 Date: 02/02/2022 17:07:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for reg_car
-- ----------------------------
DROP TABLE IF EXISTS `reg_car`;
CREATE TABLE `reg_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `num_car` varchar(12) NOT NULL,
  `add_info` varchar(255) NOT NULL,
  `data_time` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_numbers` decimal(11,0) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` varchar(64) NOT NULL DEFAULT 'Ожидается',
  `approved` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of reg_car
-- ----------------------------
BEGIN;
INSERT INTO `reg_car` VALUES (24, 59, 'A123AВ', 'Желтая машина', '2021-12-26 00:09:00', 'dszdsczdzs', 'Иванова Иван Иванович', 79812311223, 'Я хочу заехать', 'На парковке', NULL);
INSERT INTO `reg_car` VALUES (27, 13, 'П100ПВ', 'Синяя машина', '2021-12-21 00:32:00', 'фывфывфывфыв', 'Серый Сергей Сергеевич', 78945612345, 'Я хочу заехать', 'Завершена', NULL);
INSERT INTO `reg_car` VALUES (28, 13, 'П100ПП', 'Зеленая машина', '2021-12-21 00:32:00', 'фывфывфывфыв', 'Серый Сергей Сергеевич', 78945612345, 'Я хочу заехать', 'Завершена', NULL);
INSERT INTO `reg_car` VALUES (30, 13, 'A123AA', 'фывфывфы', '2022-01-21 11:12:00', 'фывфывфыв', 'Иванова Иван Иванович', 78945612345, ' Я хочу заехать', 'Завершена', NULL);
INSERT INTO `reg_car` VALUES (32, 59, 'A123AA', 'Синяя машина', '2022-01-21 11:13:00', 'fghfhkjkj', 'Серый Сергей Сергеевич', 79812311223, ' sdfgsdfg', 'На парковке', NULL);
INSERT INTO `reg_car` VALUES (33, 61, 'П100КК', 'Красная машина', '2022-01-25 07:16:00', 'rsdfgh', 'Серый Сергей Сергеевич', 79812311223, ' Я хочу заехать', 'Ожидается', NULL);
INSERT INTO `reg_car` VALUES (35, 13, 'П100ПП', 'Красная машина', '2022-01-24 23:19:00', 'ваыпываыва', 'Серый Сергей Сергеевич', 79812311223, ' Я хочу заехать', 'На парковке', NULL);
INSERT INTO `reg_car` VALUES (36, 0, 'П100ПП', 'Синяя машина', '2022-01-23 23:21:00', 'ыфв', 'Иванова Иван Иванович', 79812311223, ' Я хочу заехать', 'Завершена', NULL);
INSERT INTO `reg_car` VALUES (37, 61, 'П100ПП', '', '2022-01-23 23:23:00', '', 'Валерий Иванов Валерьевич', 0, '', 'Завершена', NULL);
INSERT INTO `reg_car` VALUES (38, 0, 'ASDAS123', '', '2022-01-13 00:53:00', '', 'Валерий Иванов Валерьевич', 0, '', 'Завершена', NULL);
INSERT INTO `reg_car` VALUES (39, 61, 'asdas', 'Синяя машина', '2022-01-26 06:15:00', 'фывфыв', 'Иванова Иван Иванович', 79812311223, ' ', 'Ожидается', NULL);
INSERT INTO `reg_car` VALUES (40, 61, 'A123AA', '', '2022-01-02 01:04:00', '', 'Валерий Иванов Валерьевич', 0, '', 'Отменена', NULL);
INSERT INTO `reg_car` VALUES (41, 61, 'A123AA', '', '2022-01-25 05:41:00', '', 'Валерий Иванов Валерьевич', 0, '', 'Отменена', NULL);
INSERT INTO `reg_car` VALUES (42, 61, 'фывфыв', '', '2022-01-28 05:46:00', '', 'Сергей', 0, '', 'Отменена', NULL);
INSERT INTO `reg_car` VALUES (43, 0, 'П100ПП', 'Синяя машина', '2022-01-25 06:21:00', 'Csaqwsad', 'Серый Сергей Сергеевич', 99999999999, ' ', 'Ожидается', NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `lot_number` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_telegramm` int(11) DEFAULT NULL,
  `approved` int(2) DEFAULT 0,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `user_id` (`id_telegramm`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=247963960 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('Евгений', '79654321111', 'Ул Длинная дом 10 кв 60', 59, 214748364, 1);
INSERT INTO `users` VALUES ('Васильев Владимир Викторович', '78945612345', 'Ул Длинная дом 12 кв 11', 60, 83523165, 1);
INSERT INTO `users` VALUES ('Охрана', '79176524509', 'Ул Длинная дом', 61, 111222112, 1);
INSERT INTO `users` VALUES ('Антон', '89176524508', 'Ул Длинная дом 10 кв 54', 73, 533873224, 1);
INSERT INTO `users` VALUES ('Фамилия Имя Отчество', '+7 925 507-25-34', ' 19', 247963959, 247963948, 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
