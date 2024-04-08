/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - university_rating
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`university_rating` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `university_rating`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(75) NOT NULL,
  `admin_username` varchar(75) NOT NULL,
  `admin_password` varchar(75) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admin` */

/*Table structure for table `course` */

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(75) NOT NULL,
  `course_description` varchar(75) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `course` */

insert  into `course`(`course_id`,`course_name`,`course_description`) values 
(1,'BS-IT','COURSE JD NI SYA SA IT'),
(2,'BS-HM','Course ni sya sa mga Hm'),
(3,'BS-ED Math','Course ni sya sa math educ');

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_firstname` varchar(75) NOT NULL,
  `student_lastname` varchar(75) NOT NULL,
  `student_email` varchar(75) NOT NULL,
  `student_password` varchar(75) NOT NULL,
  `university_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `student` */

insert  into `student`(`student_id`,`student_firstname`,`student_lastname`,`student_email`,`student_password`,`university_id`) values 
(1,'Hazel','Larita','hazel@nmsc.edu.ph','123',1),
(2,'Rosendo','Debalocos','rosendo@gadtc.edu.ph','123',2);

/*Table structure for table `university` */

DROP TABLE IF EXISTS `university`;

CREATE TABLE `university` (
  `university_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_name` varchar(75) NOT NULL,
  `university_address` varchar(75) NOT NULL,
  `university_email` varchar(75) NOT NULL,
  `university_status` varchar(75) NOT NULL,
  `university_description` varchar(75) NOT NULL,
  `university_type` varchar(75) NOT NULL,
  `unniversity_tuition` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`university_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university` */

insert  into `university`(`university_id`,`university_name`,`university_address`,`university_email`,`university_status`,`university_description`,`university_type`,`unniversity_tuition`) values 
(1,'NMSC','Labuyo,Tangub City','nmsc@nmsc.edu.ph','Active','skwela na','',NULL),
(2,'GADTC','Maloro,Tangub City','gadtc@gadtc.edu.ph','Active','skwela ta dre ','',NULL),
(3,'La Salle','Ozamis City','lsulasalle@lassale@edu.ph','Active','Green Archers','',NULL);

/*Table structure for table `university_course` */

DROP TABLE IF EXISTS `university_course`;

CREATE TABLE `university_course` (
  `university_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(75) NOT NULL,
  PRIMARY KEY (`university_course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_course` */

insert  into `university_course`(`university_course_id`,`university_id`,`course_id`,`status`) values 
(1,0,1,'Active'),
(2,1,1,'Active'),
(3,1,1,'Active');

/*Table structure for table `university_course_rating` */

DROP TABLE IF EXISTS `university_course_rating`;

CREATE TABLE `university_course_rating` (
  `university_course_rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_rating` int(11) NOT NULL,
  `course_rating_description` varchar(225) NOT NULL,
  `date_occurred` date NOT NULL,
  PRIMARY KEY (`university_course_rating_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_course_rating` */

insert  into `university_course_rating`(`university_course_rating_id`,`university_course_id`,`student_id`,`course_rating`,`course_rating_description`,`date_occurred`) values 
(1,3,1,3,'Bati ning IT','2024-04-07'),
(2,3,1,3,'Bati ning IT','2024-04-08');

/*Table structure for table `university_rating` */

DROP TABLE IF EXISTS `university_rating`;

CREATE TABLE `university_rating` (
  `university_rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_rating_description` varchar(75) NOT NULL,
  `rating` int(11) NOT NULL,
  `date_occurred` date NOT NULL,
  PRIMARY KEY (`university_rating_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_rating` */

insert  into `university_rating`(`university_rating_id`,`university_id`,`student_id`,`university_rating_description`,`rating`,`date_occurred`) values 
(84,1,1,'lindot',2,'2024-04-05'),
(87,1,1,'bati sya',3,'2024-04-07');

/*Table structure for table `university_course_view` */

DROP TABLE IF EXISTS `university_course_view`;

/*!50001 DROP VIEW IF EXISTS `university_course_view` */;
/*!50001 DROP TABLE IF EXISTS `university_course_view` */;

/*!50001 CREATE TABLE  `university_course_view`(
 `university_course_id` int(11) ,
 `university_id` int(11) ,
 `university_name` varchar(75) ,
 `university_email` varchar(75) ,
 `course_id` int(11) ,
 `course_name` varchar(75) ,
 `course_description` varchar(75) ,
 `status` varchar(75) 
)*/;

/*View structure for view university_course_view */

/*!50001 DROP TABLE IF EXISTS `university_course_view` */;
/*!50001 DROP VIEW IF EXISTS `university_course_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `university_course_view` AS select `university_course`.`university_course_id` AS `university_course_id`,`university`.`university_id` AS `university_id`,`university`.`university_name` AS `university_name`,`university`.`university_email` AS `university_email`,`course`.`course_id` AS `course_id`,`course`.`course_name` AS `course_name`,`course`.`course_description` AS `course_description`,`university_course`.`status` AS `status` from ((`university_course` join `university` on(`university_course`.`university_id` = `university`.`university_id`)) join `course` on(`university_course`.`course_id` = `course`.`course_id`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
