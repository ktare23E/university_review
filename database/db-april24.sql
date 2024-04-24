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
  `admin_email` varchar(75) NOT NULL,
  `admin_password` varchar(75) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admin` */

insert  into `admin`(`admin_id`,`admin_name`,`admin_email`,`admin_password`) values 
(1,'Admin Tras','admin@gmail.com','123');

/*Table structure for table `colleges` */

DROP TABLE IF EXISTS `colleges`;

CREATE TABLE `colleges` (
  `college_id` int(11) NOT NULL AUTO_INCREMENT,
  `college_name` varchar(75) NOT NULL,
  `college_description` varchar(75) NOT NULL,
  PRIMARY KEY (`college_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `colleges` */

insert  into `colleges`(`college_id`,`college_name`,`college_description`) values 
(1,'College of Information Communication Technology','This is the CICT'),
(2,'College of Arts and Sciences Edited','This is the CAS Edited'),
(3,'College of Agricultural And Environment Science','This is the CAES'),
(4,'College of Business Administration Management','This is the CBAM'),
(5,'College of Teacher Education','This is the CTE'),
(6,'College Of Engineer Update','College ni edited'),
(7,'Institute of Criminal Justice Education','This is the crim and bla2');

/*Table structure for table `course` */

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(75) NOT NULL,
  `course_description` varchar(75) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `course` */

insert  into `course`(`course_id`,`course_name`,`course_description`) values 
(1,'BS-IT','COURSE JD NI SYA SA IT'),
(2,'BS-HM','Course ni sya sa mga Hm'),
(3,'BS-ED Math Edited','Edited Course ni sya'),
(4,'Bachelor of Science in Criminology EDIT','This is the crim eDIT'),
(5,'Bachelor of Science in Biology Edit','Course ni Phoebe Edit');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `student` */

insert  into `student`(`student_id`,`student_firstname`,`student_lastname`,`student_email`,`student_password`,`university_id`) values 
(1,'Hazel','Larita','hazel@nmsc.edu.ph','$2y$10$AXBsPdNgUvOcv5COH5mb5OnZl91SPpE6efy4PHE1E/c2WY1T4bl4u',1),
(2,'Rosendo Edited','Debalocos Edited','rosendo@gadtc.edu.ph','123Edited',2),
(3,'James Edit','ProbitsoEdit','jamesEdit@msu.edu.ph','$2y$10$AXBsPdNgUvOcv5COH5mb5OnZl91SPpE6efy4PHE1E/c2WY1T4bl4u',4),
(4,'Febb','Edanio','febb.edano@nmsc.edu.ph','$2y$10$AXBsPdNgUvOcv5COH5mb5OnZl91SPpE6efy4PHE1E/c2WY1T4bl4u',1);

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
  `university_image` varchar(225) NOT NULL,
  `region` varchar(75) DEFAULT NULL,
  `province` varchar(75) DEFAULT NULL,
  `city` varchar(75) DEFAULT NULL,
  `barangay` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`university_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university` */

insert  into `university`(`university_id`,`university_name`,`university_address`,`university_email`,`university_status`,`university_description`,`university_type`,`university_image`,`region`,`province`,`city`,`barangay`) values 
(1,'NMSC','Labuyo,Tangub City','nmsc@nmsc.edu.ph','Active','skwela na','Public','nmsc.jpg','Region X (Northern Mindanao)','Misamis Occidental','Tangub City','Labuyo'),
(2,'GADTC','Maloro,Tangub City','gadtc@gadtc.edu.ph','Active','skwela ta dre ','Public','gadtc.jpg','Region X (Northern Mindanao)','Misamis Occidental','Tangub City','Maloro'),
(3,'La Salle Edited','Ozamis City Edited','lassale@gmail.com','Active','La Salle University','Private','la salle.jpg','Region X (Northern Mindanao)','Misamis Occidental','Ozamis City','Aguada (Pob.)'),
(4,'OLT','Ozamis City','olt@olt.edu.ph','Active','OLT ','Private','olt.jpg',NULL,NULL,NULL,NULL),
(5,'MU','Ozamis City','mu@mu.edu.ph','Active','MU','Private','mu.jpg',NULL,NULL,NULL,NULL),
(6,'MIT','Ozamis City','mit@mit.edu.ph','Active','MIT','Private','mit.jpg',NULL,NULL,NULL,NULL),
(7,'MEdina College','Sapang Dalaga','medin@medina.edu.ph','Active','MEdina','Priavate','medina.png',NULL,NULL,NULL,NULL),
(8,'test Edited','Misamis Occidental Tangub City Banglay','testEdited@test.edu.ph','Active','test Edited','Public','','Region X (Northern Mindanao)','Lanao Del Norte','Maigo','Balagatasa'),
(9,'test2 Edited','','test2edited@test2.edu.ph','Inactive','test2 edited','Private','','Region XI (Davao Region)','Davao Del Sur','Davao City','Agdao'),
(15,'wow1','','wow1@gmail.com','Active','wow1','Private','1713608946_wow1.jpg','Region X (Northern Mindanao)','Misamis Occidental','Ozamis City','Tinago'),
(16,'test3','','test3@test2.edu.ph','Active','test3','Public','1713752375_325253741_1817147958660286_413414627798237429_n.jpg','Region X (Northern Mindanao)','Misamis Occidental','Ozamis City','Cavinte');

/*Table structure for table `university_colleges` */

DROP TABLE IF EXISTS `university_colleges`;

CREATE TABLE `university_colleges` (
  `university_college_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `status` varchar(75) NOT NULL,
  `logo` varchar(75) NOT NULL,
  PRIMARY KEY (`university_college_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_colleges` */

insert  into `university_colleges`(`university_college_id`,`university_id`,`college_id`,`status`,`logo`) values 
(3,2,4,'Active','1713690565_sbam.jpg'),
(4,2,1,'Active','1713696353_sict.jpg'),
(5,2,5,'Active','1713783498_educ.png'),
(6,2,7,'Active','1713783564_crim.jpg');

/*Table structure for table `university_course` */

DROP TABLE IF EXISTS `university_course`;

CREATE TABLE `university_course` (
  `university_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_id` int(11) NOT NULL,
  `university_college_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(75) NOT NULL,
  `tuition_per_sem` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`university_course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_course` */

insert  into `university_course`(`university_course_id`,`university_id`,`university_college_id`,`course_id`,`status`,`tuition_per_sem`) values 
(1,2,0,3,'Inactive',NULL),
(2,1,0,2,'Active',NULL),
(3,1,0,1,'Active',NULL),
(9,2,0,1,'Active',NULL),
(10,0,3,3,'Active',25000.00),
(11,0,4,1,'Inactive',20001.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_course_rating` */

insert  into `university_course_rating`(`university_course_rating_id`,`university_course_id`,`student_id`,`course_rating`,`course_rating_description`,`date_occurred`) values 
(1,3,1,5,'Update ang duha','2024-04-10'),
(3,9,2,1,'Bati ni nga course','2024-04-15'),
(4,2,4,3,'Sakto lang sya','2024-04-15'),
(5,3,4,2,'Bati man sya','2024-04-15'),
(6,3,4,1,'','0000-00-00'),
(7,3,1,1,'','0000-00-00'),
(9,11,1,5,'Wow','2024-04-24');

/*Table structure for table `university_images` */

DROP TABLE IF EXISTS `university_images`;

CREATE TABLE `university_images` (
  `university_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_id` int(11) NOT NULL,
  `university_image` varchar(75) NOT NULL,
  PRIMARY KEY (`university_image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_images` */

insert  into `university_images`(`university_image_id`,`university_id`,`university_image`) values 
(6,2,'1713789259_gadtc3.jpg'),
(7,2,'1713789259_gadtc2.jpg'),
(8,2,'1713789259_gadtc1.jpg'),
(10,2,'1713790031_educ.png'),
(11,2,'1713790031_sbam.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_rating` */

insert  into `university_rating`(`university_rating_id`,`university_id`,`student_id`,`university_rating_description`,`rating`,`date_occurred`) values 
(84,1,1,'Update ang duha',5,'2024-04-10'),
(88,2,2,'Good Job',4,'2024-04-10'),
(89,1,3,'Bati sya',1,'2024-04-14'),
(91,1,4,'Lame School',1,'2024-04-15'),
(92,2,4,'wow',3,'2024-04-23');

/*Table structure for table `student_view` */

DROP TABLE IF EXISTS `student_view`;

/*!50001 DROP VIEW IF EXISTS `student_view` */;
/*!50001 DROP TABLE IF EXISTS `student_view` */;

/*!50001 CREATE TABLE  `student_view`(
 `student_id` int(11) ,
 `student_firstname` varchar(75) ,
 `student_lastname` varchar(75) ,
 `student_email` varchar(75) ,
 `student_password` varchar(75) ,
 `university_id` int(11) ,
 `university_name` varchar(75) 
)*/;

/*Table structure for table `university_colleges_view` */

DROP TABLE IF EXISTS `university_colleges_view`;

/*!50001 DROP VIEW IF EXISTS `university_colleges_view` */;
/*!50001 DROP TABLE IF EXISTS `university_colleges_view` */;

/*!50001 CREATE TABLE  `university_colleges_view`(
 `university_college_id` int(11) ,
 `university_id` int(11) ,
 `university_name` varchar(75) ,
 `college_id` int(11) ,
 `college_name` varchar(75) ,
 `college_description` varchar(75) ,
 `status` varchar(75) ,
 `logo` varchar(75) 
)*/;

/*Table structure for table `university_college_courses_view` */

DROP TABLE IF EXISTS `university_college_courses_view`;

/*!50001 DROP VIEW IF EXISTS `university_college_courses_view` */;
/*!50001 DROP TABLE IF EXISTS `university_college_courses_view` */;

/*!50001 CREATE TABLE  `university_college_courses_view`(
 `university_course_id` int(11) ,
 `university_college_id` int(11) ,
 `university_id` int(11) ,
 `university_name` varchar(75) ,
 `college_id` int(11) ,
 `college_name` varchar(75) ,
 `course_id` int(11) ,
 `course_name` varchar(75) ,
 `status` varchar(75) ,
 `tuition_per_sem` decimal(10,2) 
)*/;

/*Table structure for table `university_college_course_rating_view` */

DROP TABLE IF EXISTS `university_college_course_rating_view`;

/*!50001 DROP VIEW IF EXISTS `university_college_course_rating_view` */;
/*!50001 DROP TABLE IF EXISTS `university_college_course_rating_view` */;

/*!50001 CREATE TABLE  `university_college_course_rating_view`(
 `university_course_rating_id` int(11) ,
 `university_course_id` int(11) ,
 `university_college_id` int(11) ,
 `university_id` int(11) ,
 `university_name` varchar(75) ,
 `college_id` int(11) ,
 `college_name` varchar(75) ,
 `course_id` int(11) ,
 `course_name` varchar(75) ,
 `student_id` int(11) ,
 `student_firstname` varchar(75) ,
 `student_lastname` varchar(75) ,
 `course_rating` int(11) ,
 `course_rating_description` varchar(225) ,
 `date_occurred` date 
)*/;

/*View structure for view student_view */

/*!50001 DROP TABLE IF EXISTS `student_view` */;
/*!50001 DROP VIEW IF EXISTS `student_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `student_view` AS select `student`.`student_id` AS `student_id`,`student`.`student_firstname` AS `student_firstname`,`student`.`student_lastname` AS `student_lastname`,`student`.`student_email` AS `student_email`,`student`.`student_password` AS `student_password`,`university`.`university_id` AS `university_id`,`university`.`university_name` AS `university_name` from (`student` join `university` on(`student`.`university_id` = `university`.`university_id`)) */;

/*View structure for view university_colleges_view */

/*!50001 DROP TABLE IF EXISTS `university_colleges_view` */;
/*!50001 DROP VIEW IF EXISTS `university_colleges_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `university_colleges_view` AS select `university_colleges`.`university_college_id` AS `university_college_id`,`university`.`university_id` AS `university_id`,`university`.`university_name` AS `university_name`,`colleges`.`college_id` AS `college_id`,`colleges`.`college_name` AS `college_name`,`colleges`.`college_description` AS `college_description`,`university_colleges`.`status` AS `status`,`university_colleges`.`logo` AS `logo` from ((`university_colleges` join `university` on(`university_colleges`.`university_id` = `university`.`university_id`)) join `colleges` on(`university_colleges`.`college_id` = `colleges`.`college_id`)) */;

/*View structure for view university_college_courses_view */

/*!50001 DROP TABLE IF EXISTS `university_college_courses_view` */;
/*!50001 DROP VIEW IF EXISTS `university_college_courses_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `university_college_courses_view` AS select `university_course`.`university_course_id` AS `university_course_id`,`university_colleges`.`university_college_id` AS `university_college_id`,`university`.`university_id` AS `university_id`,`university`.`university_name` AS `university_name`,`colleges`.`college_id` AS `college_id`,`colleges`.`college_name` AS `college_name`,`course`.`course_id` AS `course_id`,`course`.`course_name` AS `course_name`,`university_course`.`status` AS `status`,`university_course`.`tuition_per_sem` AS `tuition_per_sem` from ((((`university_course` join `university_colleges` on(`university_course`.`university_college_id` = `university_colleges`.`university_college_id`)) join `university` on(`university_colleges`.`university_id` = `university`.`university_id`)) join `colleges` on(`university_colleges`.`college_id` = `colleges`.`college_id`)) join `course` on(`university_course`.`course_id` = `course`.`course_id`)) */;

/*View structure for view university_college_course_rating_view */

/*!50001 DROP TABLE IF EXISTS `university_college_course_rating_view` */;
/*!50001 DROP VIEW IF EXISTS `university_college_course_rating_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `university_college_course_rating_view` AS select `university_course_rating`.`university_course_rating_id` AS `university_course_rating_id`,`university_course`.`university_course_id` AS `university_course_id`,`university_colleges`.`university_college_id` AS `university_college_id`,`university`.`university_id` AS `university_id`,`university`.`university_name` AS `university_name`,`colleges`.`college_id` AS `college_id`,`colleges`.`college_name` AS `college_name`,`course`.`course_id` AS `course_id`,`course`.`course_name` AS `course_name`,`student`.`student_id` AS `student_id`,`student`.`student_firstname` AS `student_firstname`,`student`.`student_lastname` AS `student_lastname`,`university_course_rating`.`course_rating` AS `course_rating`,`university_course_rating`.`course_rating_description` AS `course_rating_description`,`university_course_rating`.`date_occurred` AS `date_occurred` from ((((((`university_course_rating` join `university_course` on(`university_course_rating`.`university_course_id` = `university_course`.`university_course_id`)) join `university_colleges` on(`university_course`.`university_college_id` = `university_colleges`.`university_college_id`)) join `university` on(`university_colleges`.`university_id` = `university`.`university_id`)) join `colleges` on(`university_colleges`.`college_id` = `colleges`.`college_id`)) join `course` on(`university_course`.`course_id` = `course`.`course_id`)) join `student` on(`university_course_rating`.`student_id` = `student`.`student_id`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
