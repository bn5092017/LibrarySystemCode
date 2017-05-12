-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: library
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `isbn` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `catagory` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (64400557,'Charlotte\'s Web','E. B. White','HarperCollins',2012,'children','A farmyard story of a girl, a pig and a spider'),(141007338,'About a Boy','Nick Hornby','Penguin Books Ltd',2002,'fiction','A book about a man who hasn\'t grown up and a boy who doesn\'t know how to be young'),(141439572,'The Picture of Dorian Gray','Oscar Wilde','Penguin Books',2003,'fiction','A cautionary tale of excess and the perils associated with it'),(151008116,'Life of Pi','Yann Martel','Houghton Mifflin',2002,'fiction','A novel about a boy stuck on a lifeboat with a tiger in the middle of the ocean'),(241003008,'The Very Hungry Caterpillar','Eric Carle','Penguin Books',2001,'children','Picture board book teaching numbers and colours'),(345453743,'The Ultimate Hitchhiker\'s Guide to the Galaxy','Douglas Adams','Random House Publishing',2009,'sci-fi and fantasy','All five volumes of the Hitchhiker\'s Guide series in one book.  The story of earthman Arthur Dent and his alien friend Ford Prefect and their adventures after the demolition of the Earth'),(380973650,'American Gods','Neil Gaiman','HarperCollins',2001,'sci-fi and fantasy','The old gods, brought to America by immigrants, face the new gods of technology and media.  Shadow Moon, the central character, is brought into the war between the gods by an old man he meets by chance'),(393976041,'Pride and Prejudice','Jane Austen','WW Norton',2000,'fiction','A story of five sisters and their social and family situation'),(435123009,'Boy','Roald Dahl','Pearson Education',1990,'biography','Entertaining and educational tales from the schooldays of the author'),(552140287,'Men at Arms','Terry Pratchett','Transworld Publishers',2001,'sci-fi and fantasy','A Discworld novel.  The City Watch is recruiting in Ankh-Morpork, and the men of the watch are joined by a dwarf, a troll and a woman, so both new and old members have to learn to cooperate with hilarious results'),(747532699,'Harry Potter and the Philosopher\'s Stone','J. K. Rowling','Bloomsbury Publishing',2000,'children','A story of magic, bravery and friendship.  The first in the Harry Potter series'),(857381113,'The King\'s Speech','Mark Logue and Peter Conrad','Quercus Publishing',2011,'biography','Based on the diaries of the man who worked with King George VI to correct his stammer, a personal story of the relationship between the future monarch and his speech therapist');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `book_isbn` int(11) NOT NULL,
  `dateOut` datetime NOT NULL,
  `dateDueBack` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_82C24DBCA76ED395` (`user_id`),
  CONSTRAINT `FK_82C24DBCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
INSERT INTO `loans` VALUES (1,10,64400557,'2017-04-10 00:00:00','2017-05-30 00:00:00'),(2,4,141439572,'2017-04-12 00:00:00','2017-05-16 00:00:00'),(3,5,151008116,'2017-04-14 00:00:00','2017-05-19 00:00:00'),(4,6,241003008,'2017-04-16 00:00:00','2017-05-20 00:00:00'),(5,7,345453743,'2017-04-18 00:00:00','2017-05-26 00:00:00'),(6,8,380973650,'2017-04-19 00:00:00','2017-05-29 00:00:00'),(7,5,393976041,'2017-04-19 00:00:00','2017-05-23 00:00:00'),(8,9,552140287,'2017-04-24 00:00:00','2017-05-28 00:00:00'),(9,7,857381113,'2017-05-06 15:40:09','2017-05-27 15:40:09'),(10,8,435123009,'2017-05-06 16:01:42','2017-05-27 16:01:42');
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'guy','Guy','Garvey','40a Leixlip House Leixlip','guyg@email.com','$2y$13$WxlymIsHsO6ph98daerFKup/luA4jjc6FADhUog9BI1ZYILMrwb3i','[]'),(5,'mahobbs','Maryanne','Hobbs','123 Green Lane Leixlip','mahobbs@email.com','$2y$13$YAE31HrnMzPMhQUfcPSwMuGcyDYOCDg1HxAyq6Hu6JVQFY0sxoXUa','[]'),(6,'craig6','Craig','Charles','16 Dunboyne Road Maynooth','craig6@email.com','$2y$13$/Vm/0jbC0eP2nHaKMotSi.2MUtoo4EXYmvgQ.aQtqZJ9UANzrI.V6','[]'),(7,'toni','Antonio','Firenze','64 Abbeyview Clane','tonino@email.com','$2y$13$NQvn2JOCYobcQi56eJ/wRu3hIzoYtLMgq3SjY6s9DFW546./vfzGa','[]'),(8,'fred','Fred','Smith','1 Main Street Maynooth','fred@libsys.ie','$2y$13$CYQ7ekmQ59e5Kig.PnH.4OxtcwfvwiOzqrp264.QGonE3gk9DNMeG','[\"ROLE_STAFF\"]'),(9,'maryp','Mary','Parsons','32 High Road Leixlip','maryp@libsys.ie','$2y$13$ARMPdxmUJBfWE5upI.IRYuAY.b062my4VsEtX8RIw.yAblwd646Ka','[\"ROLE_STAFF\"]'),(10,'joe1','Joe','Ryan','45 Upper Street Clane','joe@libsys.ie','$2y$13$RqQY6Ia/OE8rD.R6Xt5f5OnrZMEOtLrk/IJdWWwJMsyNn3qoZBg5q','[\"ROLE_STAFF\"]');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-11 22:35:54
