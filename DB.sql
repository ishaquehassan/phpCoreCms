/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.9-MariaDB : Database - php_learning_sess10
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `ban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ban_title` varchar(250) NOT NULL,
  `ban_link` varchar(250) DEFAULT '#',
  `ban_image` varchar(250) DEFAULT '0',
  `ban_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `banners` */

insert  into `banners`(`ban_id`,`ban_title`,`ban_link`,`ban_image`,`ban_status`) values (13,'Banner Ones','','image_13_img1.jpg',1);
insert  into `banners`(`ban_id`,`ban_title`,`ban_link`,`ban_image`,`ban_status`) values (14,'Test Banner','','image_14_4.jpg',1);

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(250) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`cat_id`,`cat_title`) values (1,'Clothing');
insert  into `categories`(`cat_id`,`cat_title`) values (2,'Electronics');

/*Table structure for table `product_gallery` */

DROP TABLE IF EXISTS `product_gallery`;

CREATE TABLE `product_gallery` (
  `gal_id` int(11) NOT NULL AUTO_INCREMENT,
  `gal_prdId` int(11) NOT NULL,
  `gal_image` varchar(250) NOT NULL,
  `gal_status` tinyint(1) DEFAULT '1',
  `gal_main` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`gal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `product_gallery` */

insert  into `product_gallery`(`gal_id`,`gal_prdId`,`gal_image`,`gal_status`,`gal_main`) values (3,3,'image_3_logo.png',1,1);
insert  into `product_gallery`(`gal_id`,`gal_prdId`,`gal_image`,`gal_status`,`gal_main`) values (17,3,'image_5847b2f9b2e87_image_.jpg',1,1);
insert  into `product_gallery`(`gal_id`,`gal_prdId`,`gal_image`,`gal_status`,`gal_main`) values (18,3,'image_5847b2f9b309d_image_.jpg',1,0);
insert  into `product_gallery`(`gal_id`,`gal_prdId`,`gal_image`,`gal_status`,`gal_main`) values (19,3,'image_5847b2f9b3238_image_.jpg',1,0);
insert  into `product_gallery`(`gal_id`,`gal_prdId`,`gal_image`,`gal_status`,`gal_main`) values (20,3,'image_5847b2f9b3459_image_.jpg',1,0);
insert  into `product_gallery`(`gal_id`,`gal_prdId`,`gal_image`,`gal_status`,`gal_main`) values (21,3,'image_5847b2f9b3651_image_.jpg',1,0);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `prd_id` int(11) NOT NULL AUTO_INCREMENT,
  `prd_title` varchar(250) NOT NULL,
  `prd_catId` int(11) NOT NULL,
  `prd_price` double NOT NULL,
  `prd_discount` float DEFAULT '0',
  `prd_descp` longtext,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`prd_id`,`prd_title`,`prd_catId`,`prd_price`,`prd_discount`,`prd_descp`) values (3,'Product 1',2,2000,0,'');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `set_id` int(11) NOT NULL AUTO_INCREMENT,
  `set_title` varchar(250) NOT NULL,
  `set_value` longtext,
  `set_type` varchar(10) DEFAULT 'text',
  `set_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`set_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

insert  into `settings`(`set_id`,`set_title`,`set_value`,`set_type`,`set_status`) values (1,'Company / Site Name','Xyz Companys','text',1);
insert  into `settings`(`set_id`,`set_title`,`set_value`,`set_type`,`set_status`) values (2,'Facebook URL','http://facebook.com/abc','url',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(250) NOT NULL,
  `upass` varchar(250) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`uid`,`uname`,`upass`) values (1,'admin','123456');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
