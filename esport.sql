-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: esport
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `achievement`
--

DROP TABLE IF EXISTS `achievement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `achievement` (
  `idachievement` int NOT NULL AUTO_INCREMENT,
  `idteam` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idachievement`),
  KEY `fk_achievement_team1_idx` (`idteam`),
  CONSTRAINT `fk_achievement_team1` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievement`
--

LOCK TABLES `achievement` WRITE;
/*!40000 ALTER TABLE `achievement` DISABLE KEYS */;
INSERT INTO `achievement` VALUES (2,4,'Juara 3 GEF','2024-11-19','Pabji team berhasil menjadi juara 3 event GEF divisi PUBG di Korea'),(6,19,'Champion\'s Victory','2023-09-15','Virtex memenangkan turnamen besar.'),(7,20,'Nomadic Triumph','2023-09-18','Nomads berhasil mempertahankan posisi teratas.'),(8,21,'Ironclad Domination','2023-09-19','Ironclad memimpin kejuaraan dengan sempurna.'),(9,22,'Phantom Blitz','2023-09-20','Phantom mendominasi dalam turnamen regional.'),(10,23,'Plasma\'s Last Stand','2023-09-22','Plasma Guardians bertahan hingga akhir kompetisi.'),(11,24,'Shadow Supremacy','2023-09-25','Shadow Syndicate memimpin turnamen sepanjang jalan.'),(12,25,'Arcane Victory','2023-09-27','Arcane Raiders memenangkan event utama tahun ini.'),(13,26,'Titans Conquer','2023-09-29','Galactic Titans menaklukkan lawan dengan mudah.'),(14,27,'Vortex Vanquish','2023-09-30','Vortex Vanguard menang dalam kompetisi internasional.'),(15,28,'Crimson Havoc Glory','2023-10-01','Crimson Havoc memenangkan pertandingan epik.'),(16,10,'Gaming Cup','2024-10-15','ininini'),(17,1,'International Cup','2024-10-02','ini international cup');
/*!40000 ALTER TABLE `achievement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `idevent` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idevent`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'World Gaming Championship','2024-10-18','WGC adalah festival esports global tahunan.'),(2,'Global Esport Festival','2024-11-12','GEF adalah salah satu ajang esports paling dinamis.'),(3,'Fifa Manager','2024-09-30','Ajang fifa e-football internasional '),(7,'Esports Master Tournament','2024-09-25','Turnamen esports terbesar tahun ini.'),(8,'League of Champions','2024-10-02','Kejuaraan Liga Champions tahunan.'),(9,'International Gaming Expo','2024-10-08','Pameran gaming internasional terbesar.'),(10,'Global Battle Tournament','2024-10-14','Turnamen pertempuran global tahun ini.'),(11,'Virtual Gaming Cup','2024-10-20','Piala Virtual Gaming pertama kali diadakan.'),(12,'Pro Gamers Challenge','2024-10-22','Tantangan bagi para gamer profesional.'),(13,'Ultimate Gaming League','2024-11-01','Liga gaming pamungkas untuk para pro player.'),(14,'World Esports Battle','2024-11-05','Pertempuran esports dunia yang spektakuler.'),(15,'Arena of Valor Tournament','2024-11-10','Turnamen AoV tahunan terbesar.'),(16,'Battle Royale Showdown','2024-11-15','Pertandingan epik Battle Royale antar negara.'),(17,'AFC 2025','2024-10-15','ajang kualifikasi asian gaming');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_teams`
--

DROP TABLE IF EXISTS `event_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_teams` (
  `idevent` int NOT NULL,
  `idteam` int NOT NULL,
  PRIMARY KEY (`idevent`,`idteam`),
  KEY `fk_event_has_team_team1_idx` (`idteam`),
  KEY `fk_event_has_team_event1_idx` (`idevent`),
  CONSTRAINT `fk_event_has_team_event1` FOREIGN KEY (`idevent`) REFERENCES `event` (`idevent`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_event_has_team_team1` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_teams`
--

LOCK TABLES `event_teams` WRITE;
/*!40000 ALTER TABLE `event_teams` DISABLE KEYS */;
INSERT INTO `event_teams` VALUES (3,1),(7,1),(2,2),(1,3),(2,3),(3,7),(1,10),(2,10),(1,11),(7,11),(10,11),(7,19),(12,19),(7,20),(12,20),(8,21),(13,21),(8,22),(13,22),(9,23),(14,23),(9,24),(14,24),(10,25),(15,25),(10,26),(15,26),(11,27),(16,27),(11,28),(16,28);
/*!40000 ALTER TABLE `event_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game` (
  `idgame` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idgame`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'Valorant','Valorant adalah game tembak-menembak taktis berbasis tim yang dikembangkan oleh Riot Games. '),(2,'Dota 2','Dota 2 adalah game MOBA (Multiplayer Online Battle Arena) yang dikembangkan oleh Valve Corporation. '),(5,'Mobile Legend','Mobile Legends: Bang Bang adalah game MOBA yang dikembangkan untuk perangkat mobile oleh Moonton. '),(6,'PUBG','PUBG, atau PlayerUnknown\'s Battlegrounds, adalah game battle royale yang dikembangkan oleh PUBG Corporation. '),(7,'Point Blank','Point Blank adalah permainan komputer daring yang dikembangkan oleh Zepetto untuk platform Windows. Game ini pernah booming di era 2000an'),(12,'Pikmin','Pikmin adalah sebuah game seperti game pokemon dimana user harus berjalan dan menebar bunga'),(14,'Apex Legend','Game battle royale berbasis tim yang menonjolkan karakter dengan kemampuan unik, di mana pemain bekerja sama untuk bertahan hidup di arena yang terus menyusut.'),(15,'Fortnite','Game battle royale dengan elemen membangun struktur pertahanan. Pemain dapat mengumpulkan sumber daya dan membangun tembok, lantai, dan ramp untuk melindungi diri dari serangan.'),(16,'Overwacth 2','Game first-person shooter (FPS) berbasis tim yang menggabungkan elemen MOBA, di mana setiap karakter memiliki peran dan kemampuan spesifik dalam misi berbasis objektif.'),(17,'Call of Duty : Warzone','Versi battle royale dari seri Call of Duty. Pemain bertarung dalam peta besar dengan berbagai senjata dan kendaraan, serta sistem respawn unik melalui \"Gulag\".'),(18,'Rainbow Six Siege','Game tactical FPS yang berfokus pada pertempuran berbasis strategi dan pemanfaatan gadget untuk membongkar pertahanan musuh, dengan mode penyerangan dan pertahanan.'),(19,'Genshin Impact','Game action-RPG open-world dengan grafis bergaya anime, di mana pemain menjelajahi dunia luas sambil memanfaatkan berbagai elemen alam dalam pertempuran.'),(20,'League of Legend','Versi mobile dari League of Legends. MOBA 5v5 ini menonjolkan pertempuran cepat dengan berbagai karakter unik yang memiliki peran berbeda dalam tim.'),(21,'Among Us','Game multiplayer sosial di mana pemain harus menemukan impostor yang mencoba menyabotase misi kru kapal. Impostor harus bersembunyi dan membunuh tanpa ketahuan.'),(22,'Fall Guys','Game party battle royale yang menghadirkan serangkaian mini-game kompetitif dengan karakter-karakter lucu. Pemain harus melewati rintangan dan menjadi yang terakhir bertahan.'),(23,'The Witcher','Game action-RPG open-world yang mengikuti petualangan Geralt, seorang monster hunter. Pemain akan terlibat dalam pertempuran, penyelesaian misi, dan pengambilan keputusan penting.'),(24,'Minecraft','Game sandbox yang menawarkan kebebasan kreatif dalam membangun dunia dari blok-blok, sekaligus menghadapi monster di malam hari dalam mode survival.'),(25,'Cyberpunk 2077','Game action-RPG yang berlatar dunia futuristik di mana pemain dapat menyesuaikan karakter dengan berbagai kemampuan dan teknologi sambil menjelajahi dunia open-world penuh misi.'),(26,'Hades','Game roguelike action-RPG yang mengikuti perjalanan Zagreus, putra Hades, yang berusaha melarikan diri dari Underworld. Game ini menonjolkan gameplay cepat dan cerita menarik.'),(27,'Rocket League','Game olahraga unik yang menggabungkan sepak bola dengan mobil balap. Pemain mengendalikan mobil untuk mencetak gol ke gawang lawan dalam pertandingan cepat.'),(28,'Elden Ring','Game action-RPG open-world yang dikembangkan oleh FromSoftware, hasil kolaborasi dengan George R.R. Martin, penulis Game of Thrones. ');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `join_proposal`
--

DROP TABLE IF EXISTS `join_proposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `join_proposal` (
  `idjoin_proposal` int NOT NULL AUTO_INCREMENT,
  `idmember` int NOT NULL,
  `idteam` int NOT NULL,
  `description` varchar(100) DEFAULT 'role preference: support, attacker, dll',
  `status` enum('waiting','approved','rejected') DEFAULT NULL,
  PRIMARY KEY (`idjoin_proposal`),
  KEY `fk_join_proposal_member1_idx` (`idmember`),
  KEY `fk_join_proposal_team1_idx` (`idteam`),
  CONSTRAINT `fk_join_proposal_member1` FOREIGN KEY (`idmember`) REFERENCES `member` (`idmember`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_join_proposal_team1` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `join_proposal`
--

LOCK TABLES `join_proposal` WRITE;
/*!40000 ALTER TABLE `join_proposal` DISABLE KEYS */;
INSERT INTO `join_proposal` VALUES (21,3,10,'Ingin bergabung dengan Glitch','approved'),(22,7,12,'Ingin bergabung dengan Inferno','rejected'),(23,2,15,'Ingin bergabung dengan Phantom','approved'),(24,8,20,'Ingin bergabung dengan Stormbringers','rejected'),(25,5,11,'Ingin bergabung dengan Nortex','approved'),(26,6,18,'Ingin bergabung dengan Shadow Syndicate','rejected'),(27,10,13,'Ingin bergabung dengan Stellar','approved'),(28,12,22,'Ingin bergabung dengan Zero Blitz','rejected'),(29,9,24,'Ingin bergabung dengan Plasma Guardians','approved'),(30,1,16,'Ingin bergabung dengan Nebula','approved'),(31,4,17,'Ingin bergabung dengan Plasma Guardians','approved'),(32,11,19,'Ingin bergabung dengan Arcane Raiders','rejected'),(33,13,25,'Ingin bergabung dengan Stormbringers','approved'),(34,14,26,'Ingin bergabung dengan Galactic Titans','rejected'),(35,15,27,'Ingin bergabung dengan Vortex Vanquishers','approved'),(36,16,28,'Ingin bergabung dengan Rogue Strikers','rejected'),(37,17,30,'Ingin bergabung dengan Echo Squad','approved'),(38,18,32,'Ingin bergabung dengan Nebula Enforcers','rejected'),(39,19,33,'Ingin bergabung dengan Toxic Predators','approved'),(40,20,35,'Ingin bergabung dengan Rogue Strikers','rejected'),(41,29,10,'Ingin bergabung dengan Glitch','approved'),(42,30,12,'Ingin bergabung dengan Inferno','rejected'),(43,31,22,'Ingin bergabung dengan Phantom','approved'),(44,32,27,'Ingin bergabung dengan Stormbringers','waiting'),(45,33,15,'Ingin bergabung dengan Nortex','waiting'),(46,34,25,'Ingin bergabung dengan Shadow Syndicate','waiting'),(47,35,17,'Ingin bergabung dengan Stellar','waiting'),(48,36,23,'Ingin bergabung dengan Zero Blitz','waiting'),(49,37,24,'Ingin bergabung dengan Plasma Guardians','waiting'),(50,38,18,'Ingin bergabung dengan Nebula','waiting'),(51,39,24,'Ingin bergabung dengan Plasma Guardians','waiting'),(52,40,26,'Ingin bergabung dengan Arcane Raiders','waiting'),(53,41,25,'Ingin bergabung dengan Stormbringers','rejected'),(54,42,28,'Ingin bergabung dengan Galactic Titans','waiting'),(55,43,29,'Ingin bergabung dengan Vortex Vanquishers','waiting'),(56,44,35,'Ingin bergabung dengan Rogue Strikers','waiting'),(57,45,33,'Ingin bergabung dengan Echo Squad','rejected'),(58,1,1,'halo saya ingin join','approved'),(60,1,10,'halo saya ingin join','approved'),(61,41,1,'saya mau join dong','rejected'),(62,41,11,'saya mau join dong','rejected'),(63,41,10,'halo saya ingin join','approved'),(64,41,12,'halo saya ingin join','waiting'),(65,41,2,'join dong','waiting'),(66,45,25,'i want you','approved'),(67,45,27,'please acc me','waiting'),(68,45,28,'please i want join bro','approved'),(69,45,25,'terima dong','approved');
/*!40000 ALTER TABLE `join_proposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `idmember` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `profile` enum('admin','member') DEFAULT NULL,
  PRIMARY KEY (`idmember`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'Salman','Alfarizi','salman','8b6e5dbdcec65258973b02d428cbcecc','member'),(2,'Ferdi','Kusuma','ferdi','8bf4bb0e2efad01abe522bf314504a49','admin'),(3,'Andi','Setiawan','andisetiawan','482c811da5d5b4bc6d497ffa98491e38','member'),(4,'Budi','Suryadi','budisuryadi','482c811da5d5b4bc6d497ffa98491e38','member'),(5,'Citra','Permata','citrapermata','482c811da5d5b4bc6d497ffa98491e38','member'),(6,'Dewi','Anggraini','dewianggraini','482c811da5d5b4bc6d497ffa98491e38','member'),(7,'Eko','Prasetyo','ekoprasetyo','482c811da5d5b4bc6d497ffa98491e38','member'),(8,'Fajar','Santoso','fajarsantoso','482c811da5d5b4bc6d497ffa98491e38','member'),(9,'Gita','Rahmawati','gitarahmawati','482c811da5d5b4bc6d497ffa98491e38','member'),(10,'Hari','Susilo','harisusilo','482c811da5d5b4bc6d497ffa98491e38','member'),(11,'Indah','Putri','indahputri','482c811da5d5b4bc6d497ffa98491e38','member'),(12,'Joko','Wibowo','jokowibowo','482c811da5d5b4bc6d497ffa98491e38','member'),(13,'Kurnia','Sari','kurniasari','482c811da5d5b4bc6d497ffa98491e38','member'),(14,'Lestari','Puspita','lestaripuspita','482c811da5d5b4bc6d497ffa98491e38','member'),(15,'Maya','Wulandari','mayawulandari','482c811da5d5b4bc6d497ffa98491e38','member'),(16,'Andi','Setiawan','andisetiawan','482c811da5d5b4bc6d497ffa98491e38','member'),(17,'Budi','Suryadi','budisuryadi','482c811da5d5b4bc6d497ffa98491e38','member'),(18,'Citra','Permata','citrapermata','482c811da5d5b4bc6d497ffa98491e38','member'),(19,'Dewi','Anggraini','dewianggraini','482c811da5d5b4bc6d497ffa98491e38','member'),(20,'Eko','Prasetyo','ekoprasetyo','482c811da5d5b4bc6d497ffa98491e38','member'),(21,'Fajar','Santoso','fajarsantoso','482c811da5d5b4bc6d497ffa98491e38','member'),(22,'Gita','Rahmawati','gitarahmawati','482c811da5d5b4bc6d497ffa98491e38','member'),(23,'Hari','Susilo','harisusilo','482c811da5d5b4bc6d497ffa98491e38','member'),(24,'Indah','Putri','indahputri','482c811da5d5b4bc6d497ffa98491e38','member'),(25,'Joko','Wibowo','jokowibowo','482c811da5d5b4bc6d497ffa98491e38','member'),(26,'Kurnia','Sari','kurniasari','482c811da5d5b4bc6d497ffa98491e38','member'),(27,'Lestari','Puspita','lestaripuspita','482c811da5d5b4bc6d497ffa98491e38','member'),(28,'Maya','Wulandari','mayawulandari','482c811da5d5b4bc6d497ffa98491e38','member'),(29,'Rizky','Wicaksono','rizkywicaksono','482c811da5d5b4bc6d497ffa98491e38','member'),(30,'Ahmad','Fauzi','ahmadfauzi','482c811da5d5b4bc6d497ffa98491e38','member'),(31,'Siti','Aisyah','sitiaisyah','482c811da5d5b4bc6d497ffa98491e38','member'),(32,'Yusuf','Kurniawan','yusufkurniawan','482c811da5d5b4bc6d497ffa98491e38','member'),(33,'Dian','Saputra','diansaputra','482c811da5d5b4bc6d497ffa98491e38','member'),(34,'Hendra','Wijaya','hendrawijaya','482c811da5d5b4bc6d497ffa98491e38','member'),(35,'Rina','Saraswati','rinasaraswati','482c811da5d5b4bc6d497ffa98491e38','member'),(36,'Bayu','Nugroho','bayunugroho','482c811da5d5b4bc6d497ffa98491e38','member'),(37,'Taufik','Hidayat','taufikhidayat','482c811da5d5b4bc6d497ffa98491e38','member'),(38,'Nina','Kartika','ninakartika','482c811da5d5b4bc6d497ffa98491e38','member'),(39,'Agus','Santoso','agussantoso','482c811da5d5b4bc6d497ffa98491e38','member'),(40,'Wulan','Pertiwi','wulanpertiwi','482c811da5d5b4bc6d497ffa98491e38','member'),(41,'Fikri','Anwar','fikrianwar','482c811da5d5b4bc6d497ffa98491e38','member'),(42,'Lina','Melati','linamelati','482c811da5d5b4bc6d497ffa98491e38','member'),(43,'Irwan','Hidayat','irwanhidayat','482c811da5d5b4bc6d497ffa98491e38','member'),(44,'Samsul','Bahri','samsulbahri','482c811da5d5b4bc6d497ffa98491e38','member'),(45,'Maya','Putri','mayaputri','482c811da5d5b4bc6d497ffa98491e38','member');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team` (
  `idteam` int NOT NULL AUTO_INCREMENT,
  `idgame` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idteam`),
  KEY `fk_team_game1_idx` (`idgame`),
  CONSTRAINT `fk_team_game1` FOREIGN KEY (`idgame`) REFERENCES `game` (`idgame`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (1,1,'Valos Team'),(2,2,'Dots Team'),(3,5,'Mogen Team'),(4,6,'Pabji Team'),(7,6,'Abg Team'),(10,1,'Pixeal'),(11,1,'Ghostly'),(12,2,'Cyber'),(13,2,'Quantum'),(14,5,'Glitch'),(15,5,'Nortex'),(16,6,'Inferno'),(17,6,'Stellar'),(18,6,'Nebula'),(19,7,'Virtex'),(20,12,'Nomads'),(21,14,'Ironclad'),(22,15,'Phantom'),(23,16,'Zero Blitz'),(24,17,'Plasma Guardians'),(25,18,'Shadow Syndicate'),(26,19,'Arcane Raiders'),(27,20,'Stormbringers'),(28,21,'Galactic Titans'),(29,22,'Vortex Vanguard'),(30,23,'Crimson Havoc'),(31,24,'Nebula Enforcers'),(32,25,'Toxic Predators'),(33,26,'Echo Squadron'),(34,27,'Blazing Serpents'),(35,28,'Rogue Strikers');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_members` (
  `idteam` int NOT NULL,
  `idmember` int NOT NULL,
  `description` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`idteam`,`idmember`),
  KEY `fk_team_has_member_member1_idx` (`idmember`),
  KEY `fk_team_has_member_team_idx` (`idteam`),
  CONSTRAINT `fk_team_has_member_member1` FOREIGN KEY (`idmember`) REFERENCES `member` (`idmember`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_team_has_member_team` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,1,'halo saya ingin join'),(10,3,'Ingin bergabung dengan Glitch'),(10,29,'Ingin bergabung dengan Glitch'),(10,41,'halo saya ingin join'),(11,5,'Ingin bergabung dengan Nortex'),(13,10,'Ingin bergabung dengan Stellar'),(15,2,'Ingin bergabung dengan Phantom'),(17,4,'Ingin bergabung dengan Plasma Guardians'),(22,31,'Ingin bergabung dengan Phantom'),(24,9,'Ingin bergabung dengan Plasma Guardians'),(25,13,'Ingin bergabung dengan Stormbringers'),(25,45,'terima dong'),(27,15,'Ingin bergabung dengan Vortex Vanquishers'),(28,45,'please i want join bro'),(30,17,'Ingin bergabung dengan Echo Squad'),(33,19,'Ingin bergabung dengan Toxic Predators');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-15 23:11:52
