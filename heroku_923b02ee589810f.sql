/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.21-MariaDB : Database - heroku_923b02ee589810f
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`heroku_923b02ee589810f` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `heroku_923b02ee589810f`;

/*Table structure for table `emergency_event` */

DROP TABLE IF EXISTS `emergency_event`;

CREATE TABLE `emergency_event` (
  `ee_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_body` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  PRIMARY KEY (`ee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `emergency_event` */

insert  into `emergency_event`(`ee_id`,`event_title`,`event_date`,`event_body`,`event_name`) values 
(1,'wind','2021-11-19','erwqerwerqwerewr','wind!~~~'),
(3,'volcano','2021-11-24','yhyhyhjnyjkuikiukiu','volcano!~~'),
(5,'変更','2021-11-19','dddd','volcano!~~7777'),
(7,'volcano777','2021-12-04','dddd','volcano!~~7777'),
(8,'fffff','2021-11-29','fffff','adfadf'),
(9,'fffff','2021-11-17','adfasdf','dddd'),
(10,'volcanorrruu','2021-11-26','fffff','ffffff'),
(11,'fffff','2021-11-30','you','hurricon'),
(12,'ddd','2021-11-17','adfasdf','adfadf');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2021_11_20_133554_emergency_event',1),
(6,'2021_11_20_183507_site_url',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `site_url` */

DROP TABLE IF EXISTS `site_url`;

CREATE TABLE `site_url` (
  `site_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ee_id` varchar(255) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `event_tag` varchar(255) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

/*Data for the table `site_url` */

insert  into `site_url`(`site_id`,`ee_id`,`URL`,`registration_date`,`event_tag`,`site_name`,`site_title`) values 
(1,'1','1544','2021-11-17','1','new wind','winding'),
(2,'2','2677','2021-11-26','1','new huricon','wow'),
(4,'4','4','2021-11-19','1','new rain','raining'),
(5,'5','5','2021-11-20','2','new ppp','ppping'),
(6,'6','6','2021-11-09','2','new bbb','bbbing'),
(7,'7','7','2021-11-16','3','new destory','destoring'),
(53,'1','willy','2021-11-26','3','2344','willy'),
(65,'1','45','2021-11-26','1','6y6y','willy'),
(66,'1','2','2021-11-05','3','1','3'),
(67,'1','4','2021-11-25','2','3','5'),
(68,'1','35','2021-11-13','2','2344','y6y6y6y'),
(69,'1','35','2021-11-18','2','2344','wwwww'),
(70,'1','45','2021-11-25','3','2344','234'),
(71,'1','23','2021-11-19','2','34','444');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
