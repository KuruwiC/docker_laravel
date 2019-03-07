CREATE DATABASE test_db;
use test_db;

DROP TABLE IF EXISTS `test_table`;

CREATE TABLE `test_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `test_table` (`id`, `name`) VALUES (1, 'テストユーザー'), (2, 'test user');
