
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cos10026_group3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `cos10026_group3`;
DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about` (
  `student_id` char(9) NOT NULL,
  `member_name` varchar(60) NOT NULL,
  `part1_contribution` text NOT NULL,
  `part2_contribution` text NOT NULL,
  `quote_vietnamese` varchar(150) NOT NULL,
  `quote_english` varchar(200) NOT NULL,
  `display_order` int(11) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` VALUES ('105716425','Bui Dang Minh','index.html and its CSS; shared styles.css sections (base, header, navigation, footer and responsive layout); images; GitHub repository and GitHub Pages deployment.','index.php; shared header.inc, nav.inc and footer.inc; settings.php and the database connection; users table, login.php, logout.php and manage.php; SQL export and final packaging.','Có công mài sắt, có ngày nên kim.','If you keep grinding an iron bar, one day it becomes a needle. Hard work always pays off.',1),('106202475','Nguyen Quang Thang','apply.html and its CSS; assistance and support with assignments, offering ideas.','apply.php and process_eoi.php; eoi table; server-side validation and sanitising of applications.','Không thầy đố mày làm nên.','Teachers guide us towards success. Good guidance is important for learning.',3),('106229050','Le Ho Hoang Lan','jobs.html and its CSS; assistance and support with assignments, offering ideas.','jobs.php and search.php; jobs table and its job data; the job search bar.','Đi một ngày đàng, học một sàng khôn.','A day of travelling brings a wealth of knowledge. New experiences help us learn and grow.',2),('106233462','Tran Vo Nhat Minh','about.html and its CSS; assistance and support with assignments, offering ideas.','about.php; about table and the member contribution records; group presentation slides.','Học đi đôi với hành.','Learning goes together with practice. Knowledge is more useful when applied in practice.',4);
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `eoi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL AUTO_INCREMENT,
  `job_ref` char(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `street` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skill_html` tinyint(1) NOT NULL DEFAULT 0,
  `skill_css` tinyint(1) NOT NULL DEFAULT 0,
  `other_skills` text NOT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New',
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`EOInumber`),
  KEY `job_ref` (`job_ref`),
  CONSTRAINT `eoi_ibfk_1` FOREIGN KEY (`job_ref`) REFERENCES `jobs` (`job_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `eoi` WRITE;
/*!40000 ALTER TABLE `eoi` DISABLE KEYS */;
INSERT INTO `eoi` VALUES (1,'AFE26','Alex','Tran','1999-03-12','male','12 George St','Sydney','NSW','2000','alex.tran@example.com','0412000111',1,1,'Git, GitHub and Jira','New','2026-11-07 12:51:37'),(2,'AUX26','Mai','Pham','1997-08-24','female','8 Collins St','Melbourne','VIC','3000','mai.pham@example.com','0412000222',1,1,'Usability testing with screen readers','Current','2026-11-07 12:51:39'),(3,'AFE26','Sam','Nguyen','2001-11-05','not-stated','30 Queen St','Brisbane','QLD','4000','sam.nguyen@example.com','0412000333',1,1,'','New','2026-11-07 12:51:41'),(4,'AUX26','Linh','Vo','1995-01-17','non-binary','4 King St','Perth','WA','6000','linh.vo@example.com','0412000444',1,1,'Accessibility audits','Final','2026-11-07 12:51:43');
/*!40000 ALTER TABLE `eoi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `job_ref` char(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `summary` text NOT NULL,
  `salary` varchar(100) NOT NULL,
  `reports_to` varchar(100) NOT NULL,
  `location` varchar(60) NOT NULL,
  `work_type` varchar(40) NOT NULL,
  `closing_date` date NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_requirements` text NOT NULL,
  `preferable_requirements` text NOT NULL,
  `benefits` text NOT NULL,
  PRIMARY KEY (`job_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES ('AFE26','Front-End Web Developer, Apple Online Store','Build and improve the pages customers use to explore, compare and buy Apple products online. You will turn designs into fast, standards-based and accessible HTML and CSS that works on every screen size, from iPhone to Pro Display XDR.','AUD $115,000 to $135,000 per year, plus superannuation','Engineering Manager, Online Store Web Team','Sydney, NSW (hybrid)','Full time, permanent','2027-01-31','Build product and checkout pages in semantic HTML5 and CSS3 from design files.\nMake every layout responsive and test it on phones, tablets and desktop browsers.\nCheck pages against accessibility guidelines and fix issues found with tools such as WAVE.\nKeep code valid using the W3C HTML and CSS validators.\nReview other developers\' code and share what you learn with the team.','Strong skills in HTML5 and CSS3, including Flexbox, Grid and media queries.\nExperience building accessible websites, including forms and tables.\nExperience with Git and GitHub in a team.\nClear written and spoken communication in English.','A degree or diploma in IT, computer science or a related field.\nExperience with e-commerce or retail websites.\nExperience working in an Agile team using Jira.','Discounts on Apple products\nEducation and training reimbursement\nHybrid work: three days a week in the office\nPaid parental leave\nWellbeing and volunteering days'),('AUX26','Accessibility and UX Designer, Apple Online Store','Help make shopping with Apple simple for every customer, including people who use screen readers, keyboards, voice control or larger text. You will design page layouts, test them with real users and work with developers to turn the results into improvements.','AUD $105,000 to $125,000 per year, plus superannuation','Design Lead, Online Store Experience','Sydney, NSW (hybrid)','Full time, permanent','2027-01-31','Design page layouts, forms and navigation for the online store.\nRun usability tests with customers, including people with disability.\nCheck colour contrast, heading order, alternative text and form labels in every design.\nWrite clear, plain-language content for product and help pages.\nMake sure designs avoid dark patterns such as hidden costs or trick questions.','Examples of user-centred and accessible design work, from a portfolio or from study, work or community projects.\nGood knowledge of web accessibility guidelines (WCAG).\nExperience planning and running usability tests.\nBasic understanding of HTML and CSS.','Experience testing with screen readers such as VoiceOver.\nExperience designing for e-commerce or retail.\nA qualification in design, human-computer interaction or a related field.','Discounts on Apple products\nEducation and training reimbursement\nHybrid work: three days a week in the office\nPaid parental leave\nWellbeing and volunteering days');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `failed_attempts` int(11) NOT NULL DEFAULT 0,
  `locked_until` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$24WqzorqPKHrtN13sbWu4eTEv3nSA7pQpvlqy0kHmn2DcjrPDpAsq',0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

