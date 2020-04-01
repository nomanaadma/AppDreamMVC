/*
 Navicat Premium Data Transfer

 Source Server         : PHP Local Connection
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : dreamappdb

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 01/04/2020 22:23:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `body` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (1, 1, 'test post', 'test boy', '2020-04-01 15:31:35');
INSERT INTO `posts` VALUES (2, 1, 'test post 2', 'test body 2', '2020-04-01 15:31:53');
INSERT INTO `posts` VALUES (3, 2, 'test post 3', 'test post body 3', '2020-04-01 15:32:35');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Noman Shoukat', 'nomanaadma@gmail.com', '$2y$10$zpupiE6SYG2iShkfWFVsbuPMwiCkXDryskuZAbiBEizrLZ2H3Nra.', '2020-04-01 01:43:28');
INSERT INTO `users` VALUES (2, 'Amin Shoukat', 'aminshoukat4@gmail.com', '$2y$10$7JfcRbq6jn5vUNbS.zdBhesR5PV/rpHnMSYdiBR4s6FNW7ZqL0972', '2020-04-01 15:32:16');

SET FOREIGN_KEY_CHECKS = 1;
