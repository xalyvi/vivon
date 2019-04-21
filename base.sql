-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: std_226
-- ------------------------------------------------------
-- Server version	5.7.25-1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `approved`
--

DROP TABLE IF EXISTS `approved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approved` (
  `user_id` int(11) unsigned NOT NULL,
  `pic` text,
  `full_name` text,
  `course` varchar(11) NOT NULL DEFAULT '—',
  `project_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approved`
--

LOCK TABLES `approved` WRITE;
/*!40000 ALTER TABLE `approved` DISABLE KEYS */;
INSERT INTO `approved` VALUES (11,'temp.png','test test test','1 course',1),(12,'temp.png','test1 test1 test1','2 course',1),(13,'temp.png','Vafsa Agfsdgs ASfsdgsdfsfs','3 course',1);
/*!40000 ALTER TABLE `approved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `fam` text NOT NULL,
  `name` text NOT NULL,
  `patronymic` text NOT NULL,
  `gender` text NOT NULL,
  `born_date` date NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `e_mail` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (1,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(10,'Авчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(11,'Овчинников','Наксим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(12,'Овчинников','Максим','Фладиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(13,'Овчинников','Максим','Владиславович','female','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(14,'Овчинников','Максим','Владиславович','male','1997-08-25','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(15,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237324','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(16,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','not secret','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(17,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','baxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(18,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта 2'),(19,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(20,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(22,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(23,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(24,'Овчинников','Максим','Владиславович','male','1997-08-26','79161237323','secret information','maxim.ovchinnikov97@gmail.com','Создатель этого сайта'),(25,'Карман','Ан','Андрее','male','1967-06-11','+89005553535','Улица Пушкина','example@mail.com','Для примера'),(30,'test','tes','tedt','female','1997-08-09','23235','dfwer','','sdfsdf');
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `head` text NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `fac` text NOT NULL,
  `creator_id` int(11) NOT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'jotaro.jpeg','VR energetics','Савельев Илья Леонидович','VR ENERGETICS это проект, направленный на повышение эффективности проектирования зданий, коммуникаций и инфраструктуры города в целом. Основными задачами проекта является разработка оптимальной технологии работы с 3D моделями, внедрение BIM и CIM технологий в процесс проектирования в таких областях как строительство, энергетика, и др. Одной из неотъемлемых частей проекта должна стать разработка VR проекта т.к. данная технология позволяет значительно расширить возможности как проектировщика, так и конечного пользователя разрабатываемого продукта.',6,'energ',14,'2019-04-19 16:05:55'),(3,'giorno.jpeg','Биодизель','Апелинский Дмитрий Викторович','ООО НПП \"Агродизель\" занимается организацией строительства первого отечественного промышленного производства биоэтанола и метиловых (этиловых) эфиров растительного масла. Подготовлен пилотный проект. С целью участия в выставках требуется разработать и изготовить действующую модель установки для получения метиловых (этиловых) эфиров растительного масла. Наличие производства этих возобновляемых, экологически чистых топлив позволит заместить бензин и дизельное топливо. Тем самым уменьшится выброс углекислого газа и вредных веществ с отработавшими газами двигателя, сократится потребление топлива нефтяного происхождения.',6,'transport',21,'2019-04-19 16:05:47'),(4,'dio.jpg','PUSHKAforum','Храповицкий Виктор Алексеевич','Конкурсный проект для Международного форума инноваций в промышленном дизайне PUSHKA. В первую очередь проекты будут интересны для студентов обучающихся по направлениям «Промышленный дизайн» и «Дизайн средств транспорта». Проекты могут выполняться согласно методике «Production design» – проектирование промышленно производимого продукта; и по методике «Advanced design» - проектирование продвинутых, перспективных продуктов, для реализации потребностей пользователя.',8,'tech',16,'2019-04-19 16:05:29');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `course` varchar(11) NOT NULL DEFAULT '—',
  `role` text NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (27,14,'Иван','Иванов','2','сапорт',6),(28,14,'Иван','Иванов','2','test',10),(39,9,'','','0','Хуй',3);
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `type` text NOT NULL,
  `course` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `patronymic` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'admin','admin','temp.png','admin',0,'admin','admin',NULL),(14,'test','test','jotaro.png','leader',2,'Илья','Савельев','Леонидович'),(16,'aaaa','bbbb','dio.png','leader',3,'Виктор','Храповицкий','Алексеевич'),(21,'temp','1234','giorno.jpeg','leader',1,'Дмитрий','Апелинский','Викторович');
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

-- Dump completed on 2019-04-22  2:55:53
