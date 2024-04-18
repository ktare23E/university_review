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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `colleges` */

insert  into `colleges`(`college_id`,`college_name`,`college_description`) values 
(1,'College of Information Communication Technology','This is the CICT'),
(2,'College of Arts and Sciences','This is the CAS'),
(3,'College of Agricultural And Environment Science','This is the CAES'),
(4,'College of Business Administration Management','This is the CBAM'),
(5,'College of Teacher Education','This is the CTE'),
(6,'College Of Engineer Update','College ni edited');

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
(5,'Bachelor of Science in Biology','Course ni Phoebe');

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
(3,'James','Probitso','james@msu.edu.ph','$2y$10$AXBsPdNgUvOcv5COH5mb5OnZl91SPpE6efy4PHE1E/c2WY1T4bl4u',1),
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
  `university_tuition` decimal(10,2) DEFAULT NULL,
  `university_image` varchar(225) NOT NULL,
  PRIMARY KEY (`university_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university` */

insert  into `university`(`university_id`,`university_name`,`university_address`,`university_email`,`university_status`,`university_description`,`university_type`,`university_tuition`,`university_image`) values 
(1,'NMSC','Labuyo,Tangub City','nmsc@nmsc.edu.ph','Active','skwela na','Public',NULL,'nmsc.jpg'),
(2,'GADTC','Maloro,Tangub City','gadtc@gadtc.edu.ph','Active','skwela ta dre ','Public',NULL,'gadtc.jpg'),
(3,'La Salle Edited','Ozamis City Edited','lassale@gmail.com','Active','La Salle University','Private',50000.00,'la salle.jpg'),
(4,'OLT','Ozamis City','olt@olt.edu.ph','Active','OLT ','Private',NULL,'olt.jpg'),
(5,'MU','Ozamis City','mu@mu.edu.ph','Active','MU','Private',NULL,'mu.jpg'),
(6,'MIT','Ozamis City','mit@mit.edu.ph','Active','MIT','Private',NULL,'mit.jpg'),
(7,'MEdina College','Sapang Dalaga','medin@medina.edu.ph','Active','MEdina','Priavate',NULL,'medina.png');

/*Table structure for table `university_colleges` */

DROP TABLE IF EXISTS `university_colleges`;

CREATE TABLE `university_colleges` (
  `university_college_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `status` varchar(75) NOT NULL,
  PRIMARY KEY (`university_college_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_colleges` */

insert  into `university_colleges`(`university_college_id`,`university_id`,`college_id`,`status`) values 
(1,2,2,'Inactive');

/*Table structure for table `university_course` */

DROP TABLE IF EXISTS `university_course`;

CREATE TABLE `university_course` (
  `university_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `university_id` int(11) NOT NULL,
  `university_college_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(75) NOT NULL,
  `tution_per_sem` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`university_course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_course` */

insert  into `university_course`(`university_course_id`,`university_id`,`university_college_id`,`course_id`,`status`,`tution_per_sem`) values 
(1,2,0,3,'Inactive',NULL),
(2,1,0,2,'Active',NULL),
(3,1,0,1,'Active',NULL),
(9,2,0,1,'Active',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_course_rating` */

insert  into `university_course_rating`(`university_course_rating_id`,`university_course_id`,`student_id`,`course_rating`,`course_rating_description`,`date_occurred`) values 
(1,3,1,5,'Update ang duha','2024-04-10'),
(3,9,2,1,'Bati ni nga course','2024-04-15'),
(4,2,4,3,'Sakto lang sya','2024-04-15'),
(5,3,4,2,'Bati man sya','2024-04-15'),
(6,3,4,1,'','0000-00-00'),
(7,3,1,1,'','0000-00-00');

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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `university_rating` */

insert  into `university_rating`(`university_rating_id`,`university_id`,`student_id`,`university_rating_description`,`rating`,`date_occurred`) values 
(84,1,1,'Update ang duha',5,'2024-04-10'),
(88,2,2,'Good Job',4,'2024-04-10'),
(89,1,3,'Bati sya',1,'2024-04-14'),
(91,1,4,'Lame School',1,'2024-04-15');

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
 `status` varchar(75) 
)*/;

/*Table structure for table `university_course_rating_view` */

DROP TABLE IF EXISTS `university_course_rating_view`;

/*!50001 DROP VIEW IF EXISTS `university_course_rating_view` */;
/*!50001 DROP TABLE IF EXISTS `university_course_rating_view` */;

/*!50001 CREATE TABLE  `university_course_rating_view`(
 `university_course_rating_id` int(11) ,
 `university_course_id` int(11) ,
 `university_id` int(11) ,
 `university_name` varchar(75) ,
 `course_id` int(11) ,
 `course_name` varchar(75) ,
 `student_id` int(11) ,
 `student_firstname` varchar(75) ,
 `student_lastname` varchar(75) ,
 `course_rating` int(11) ,
 `course_rating_description` varchar(225) ,
 `date_occurred` date 
)*/;

/*Table structure for table `university_course_view` */

DROP TABLE IF EXISTS `university_course_view`;

/*!50001 DROP VIEW IF EXISTS `university_course_view` */;
/*!50001 DROP TABLE IF EXISTS `university_course_view` */;

/*!50001 CREATE TABLE  `university_course_view`(
 `university_course_id` int(11) ,
 `university_college_id` int(11) ,
 `university_id` int(11) ,
 `university_name` varchar(75) ,
 `college_id` int(11) ,
 `college_name` varchar(75) ,
 `college_description` varchar(75) ,
 `status` varchar(75) ,
 `course_id` int(11) ,
 `course_name` varchar(75) ,
 `course_description` varchar(75) ,
 `university_course_status` varchar(75) ,
 `tution_per_sem` decimal(10,2) 
)*/;

/*View structure for view university_colleges_view */

/*!50001 DROP TABLE IF EXISTS `university_colleges_view` */;
/*!50001 DROP VIEW IF EXISTS `university_colleges_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `university_colleges_view` AS select `university_colleges`.`university_college_id` AS `university_college_id`,`university`.`university_id` AS `university_id`,`university`.`university_name` AS `university_name`,`colleges`.`college_id` AS `college_id`,`colleges`.`college_name` AS `college_name`,`colleges`.`college_description` AS `college_description`,`university_colleges`.`status` AS `status` from ((`university_colleges` join `university` on(`university_colleges`.`university_id` = `university`.`university_id`)) join `colleges` on(`university_colleges`.`college_id` = `colleges`.`college_id`)) */;

/*View structure for view university_course_rating_view */

/*!50001 DROP TABLE IF EXISTS `university_course_rating_view` */;
/*!50001 DROP VIEW IF EXISTS `university_course_rating_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `university_course_rating_view` AS select `university_course_rating`.`university_course_rating_id` AS `university_course_rating_id`,`university_course_view`.`university_course_id` AS `university_course_id`,`university_course_view`.`university_id` AS `university_id`,`university_course_view`.`university_name` AS `university_name`,`university_course_view`.`course_id` AS `course_id`,`university_course_view`.`course_name` AS `course_name`,`student`.`student_id` AS `student_id`,`student`.`student_firstname` AS `student_firstname`,`student`.`student_lastname` AS `student_lastname`,`university_course_rating`.`course_rating` AS `course_rating`,`university_course_rating`.`course_rating_description` AS `course_rating_description`,`university_course_rating`.`date_occurred` AS `date_occurred` from ((`university_course_rating` join `university_course_view` on(`university_course_rating`.`university_course_id` = `university_course_view`.`university_course_id`)) join `student` on(`university_course_rating`.`student_id` = `student`.`student_id`)) */;

/*View structure for view university_course_view */

/*!50001 DROP TABLE IF EXISTS `university_course_view` */;
/*!50001 DROP VIEW IF EXISTS `university_course_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `university_course_view` AS select `university_course`.`university_course_id` AS `university_course_id`,`university_colleges_view`.`university_college_id` AS `university_college_id`,`university_colleges_view`.`university_id` AS `university_id`,`university_colleges_view`.`university_name` AS `university_name`,`university_colleges_view`.`college_id` AS `college_id`,`university_colleges_view`.`college_name` AS `college_name`,`university_colleges_view`.`college_description` AS `college_description`,`university_colleges_view`.`status` AS `status`,`course`.`course_id` AS `course_id`,`course`.`course_name` AS `course_name`,`course`.`course_description` AS `course_description`,`university_course`.`status` AS `university_course_status`,`university_course`.`tution_per_sem` AS `tution_per_sem` from ((`university_course` join `university_colleges_view` on(`university_course`.`university_college_id` = `university_colleges_view`.`university_college_id`)) join `course` on(`university_course`.`course_id` = `course`.`course_id`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
