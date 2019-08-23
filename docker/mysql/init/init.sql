CREATE DATABASE sample_app_dev;
CREATE DATABASE sample_app_test;
GRANT ALL PRIVILEGES ON sample_app_dev.* TO app;
GRANT ALL PRIVILEGES ON sample_app_test.* TO app;
CREATE DATABASE test_db;
use test_db;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`) VALUES (1, 'テストユーザー'), (2, 'test user');
