-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: std_226
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.19.04.1

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
  `image` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `curator` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(2) DEFAULT NULL,
  `type` varchar(32) NOT NULL,
  `curator_id` int(11) NOT NULL,
  `status` int(2) unsigned NOT NULL DEFAULT '0',
  `team/students` varchar(64) NOT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'jotaro.jpeg','VR energetics','Савельев Илья Леонидович','VR ENERGETICS это проект, направленный на повышение эффективности проектирования зданий, коммуникаций и инфраструктуры города в целом. Основными задачами проекта является разработка оптимальной технологии работы с 3D моделями, внедрение BIM и CIM технологий в процесс проектирования в таких областях как строительство, энергетика, и др. Одной из неотъемлемых частей проекта должна стать разработка VR проекта т.к. данная технология позволяет значительно расширить возможности как проектировщика, так и конечного пользователя разрабатываемого продукта.',6,'Энергетика',14,2,'3/5','2019-04-19 16:05:55'),(3,'giorno.jpeg','Биодизель','Апелинский Дмитрий Викторович','ООО НПП \"Агродизель\" занимается организацией строительства первого отечественного промышленного производства биоэтанола и метиловых (этиловых) эфиров растительного масла. Подготовлен пилотный проект. С целью участия в выставках требуется разработать и изготовить действующую модель установки для получения метиловых (этиловых) эфиров растительного масла. Наличие производства этих возобновляемых, экологически чистых топлив позволит заместить бензин и дизельное топливо. Тем самым уменьшится выброс углекислого газа и вредных веществ с отработавшими газами двигателя, сократится потребление топлива нефтяного происхождения.',6,'Транспорт',21,2,'3/5','2019-04-19 16:05:47'),(4,'dio.jpg','PUSHKAforum','Храповицкий Виктор Алексеевич','Конкурсный проект для Международного форума инноваций в промышленном дизайне PUSHKA. В первую очередь проекты будут интересны для студентов обучающихся по направлениям «Промышленный дизайн» и «Дизайн средств транспорта». Проекты могут выполняться согласно методике «Production design» – проектирование промышленно производимого продукта; и по методике «Advanced design» - проектирование продвинутых, перспективных продуктов, для реализации потребностей пользователя.',8,'Технология',16,2,'3/5','2019-04-19 16:05:29');
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
  `pswd` varchar(256) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `type` varchar(16) DEFAULT NULL,
  `position` text,
  `project_type` varchar(32) DEFAULT NULL,
  `p_type_des` text,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `patronymic` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'admin','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec','temp.png','admin',NULL,NULL,NULL,'admin','admin',NULL),(14,'test','ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff','jotaro.png','leader',NULL,'Энергетика','Отрасль техники, разрабатывающая способы получения и применения разных видов энергии','Илья','Савельев','Леонидович'),(16,'aaaa','1b86355f13a7f0b90c8b6053c0254399994dfbb3843e08d603e292ca13b8f672ed5e58791c10f3e36daec9699cc2fbdc88b4fe116efa7fce016938b787043818','dio.png','leader',NULL,'Технология','совокупность методов и инструментов для достижения желаемого результата[1]; в широком смысле — применение научного знания для решения практических задач[1][2]. Технология включает в себя способы работы, её режим, последовательность действий[3].','Виктор','Храповицкий','Алексеевич'),(21,'temp','777c534fd04b2cc000819eaf0a63bfa135a62b42777ea4650c2743ca297b3ac6d33c001c664485c7cb3cd3a08475cd80c434be670c01f16d61218f7f9fe0bde5','giorno.jpeg','leader',NULL,'Транспорт','совокупность всех видов путей сообщения, транспортных средств, технических устройств и сооружений на путях сообщения, обеспечивающих процесс перемещения людей и грузов различного назначения из одного места в другое[2]. В данной статье раскрывается понятие транспорта именно в этом значении.','Дмитрий','Апелинский','Викторович'),(29,'new','7e2feac95dcd7d1df803345e197369af4b156e4e7a95fcb2955bdbbb3a11afd8bb9d35931bf15511370b18143e38b01b903f55c5ecbded4af99934602fcdf38c','temp.png','leader',NULL,NULL,NULL,'Максим','Авиныкав','Влус'),(30,'ruslan','2eb90a92b2147fcb362d55db23a83cea739efaa182d86e694be943a6ac81051f4f5b7a35412c982c497d68e0c82e74a1e48d0b0ab22e4c5bd8a7b3bca030b1ce','temp.png','student','Студент Веб',NULL,NULL,'Руслан','Рахимов','Бахтиёрович'),(31,'ilya','fb4579611a1c7831f69aebf64363d69ef69f8d9b74c9fe595448403542a43d4367ec727a01d0db7da9245e12373c105d6e6cebeb73dbd70b6f7e5a13e0cf8c9a','temp.png','expert','Препод',NULL,NULL,'Илья','Муковнин','Отчествович'),(32,'coolesya','d38447a8f7b5f849e0c355d13da59c799e13d8acc8846f93e73a2d600a91744e763234b00ce2a10263b935fdf86e07c892379a654a8e07a1ad5cf9c9db746e90','temp.png','curator','Препод',NULL,NULL,'Олеся','Сердобинцева','Отчествовна');
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

-- Dump completed on 2019-06-06  0:39:22
