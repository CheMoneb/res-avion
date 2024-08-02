-- MySQL dump 10.13  Distrib 8.3.0, for macos14.2 (arm64)
--
-- Host: localhost    Database: reservation_vols
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `airports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ident` varchar(10) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `latitude_deg` double DEFAULT NULL,
  `longitude_deg` double DEFAULT NULL,
  `elevation_ft` int DEFAULT NULL,
  `continent` varchar(2) DEFAULT NULL,
  `iso_country` varchar(2) DEFAULT NULL,
  `iso_region` varchar(7) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `scheduled_service` varchar(3) DEFAULT NULL,
  `gps_code` varchar(10) DEFAULT NULL,
  `iata_code` varchar(10) DEFAULT NULL,
  `local_code` varchar(10) DEFAULT NULL,
  `home_link` varchar(255) DEFAULT NULL,
  `wikipedia_link` varchar(255) DEFAULT NULL,
  `keywords` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=529871 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airports`
--

LOCK TABLES `airports` WRITE;
/*!40000 ALTER TABLE `airports` DISABLE KEYS */;
INSERT INTO `airports` VALUES (4650,'03N','small_airport','Utirik Airport',11.222219,169.851429,4,'OC','MH','MH-UTI','Utirik Island','yes','03N','UTK','03N','','https://en.wikipedia.org/wiki/Utirik_Airport',''),(6523,'00A','heliport','Total RF Heliport',40.070985,-74.933689,11,'NA','US','US-PA','Bensalem','no','K00A','','00A','https://www.penndot.pa.gov/TravelInPA/airports-pa/Pages/Total-RF-Heliport.aspx','',''),(6524,'00AK','small_airport','Lowell Field',59.947733,-151.692524,450,'NA','US','US-AK','Anchor Point','no','00AK','','00AK','','',''),(6525,'00AL','small_airport','Epps Airpark',34.86479949951172,-86.77030181884766,820,'NA','US','US-AL','Harvest','no','00AL','','00AL','','',''),(6526,'00AR','closed','Newport Hospital & Clinic Heliport',35.6087,-91.254898,237,'NA','US','US-AR','Newport','no','','','','','','00AR'),(6527,'00AZ','small_airport','Cordes Airport',34.305599212646484,-112.16500091552734,3810,'NA','US','US-AZ','Cordes','no','00AZ','','00AZ','','',''),(6528,'00CA','small_airport','Goldstone (GTS) Airport',35.35474,-116.885329,3038,'NA','US','US-CA','Barstow','no','00CA','','00CA','','https://en.wikipedia.org/wiki/Goldstone_Gts_Airport',''),(6529,'00CO','closed','Cass Field',40.622202,-104.344002,4830,'NA','US','US-CO','Briggsdale','no','','','','','','00CO'),(6530,'01ID','small_airport','Lava Hot Springs Airport',42.6082,-112.031998,5268,'NA','US','US-ID','Lava Hot Springs','no','01ID','','01ID','','','Formerly 00E, ID26'),(6531,'00FA','small_airport','Grass Patch Airport',28.64550018310547,-82.21900177001953,53,'NA','US','US-FL','Bushnell','no','00FA','','00FA','','',''),(6532,'00FD','closed','Ringhaver Heliport',28.8466,-82.345398,25,'NA','US','US-FL','Riverview','no','','','','','','00FD'),(6533,'00FL','small_airport','River Oak Airport',27.230899810791016,-80.96920013427734,35,'NA','US','US-FL','Okeechobee','no','00FL','','00FL','','',''),(6534,'00GA','small_airport','Lt World Airport',33.76750183105469,-84.06829833984375,700,'NA','US','US-GA','Lithonia','no','00GA','','00GA','','',''),(6535,'00GE','heliport','Caffrey Heliport',33.887982,-84.736983,957,'NA','US','US-GA','Hiram','no','00GE','','00GE','','',''),(6536,'00HI','heliport','Kaupulehu Heliport',19.832881,-155.978347,43,'OC','US','US-HI','Kailua-Kona','no','00HI','','00HI','','',''),(6537,'00ID','small_airport','Delta Shores Airport',48.145301818847656,-116.21399688720703,2064,'NA','US','US-ID','Clark Fork','no','00ID','','00ID','','',''),(6538,'00II','closed','Bailey Generation Station Heliport',41.644501,-87.122803,600,'NA','US','US-IN','Chesterton','no','','','','','','00II'),(6539,'00IL','small_airport','Hammer Airport',41.978401,-89.560402,840,'NA','US','US-IL','Polo','no','00IL','','00IL','','','Radio Ranch'),(6540,'00IN','heliport','St Mary Medical Center Heliport',41.51139831542969,-87.2605972290039,634,'NA','US','US-IN','Hobart','no','00IN','','00IN','','',''),(6541,'00IS','small_airport','Hayenga\'s Cant Find Farms Airport',40.02560043334961,-89.1229019165039,820,'NA','US','US-IL','Kings','no','00IS','','00IS','','',''),(6542,'00KS','small_airport','Hayden Farm Airport',38.72779846191406,-94.93049621582031,1100,'NA','US','US-KS','Gardner','no','00KS','','00KS','','',''),(6543,'00KY','small_airport','Robbins Roost Airport',37.409400939941406,-84.61969757080078,1265,'NA','US','US-KY','Stanford','no','00KY','','00KY','','',''),(6544,'00LL','heliport','Ac & R Components Heliport',39.66529846191406,-89.70559692382812,600,'NA','US','US-IL','Chatham','no','00LL','','00LL','','',''),(6545,'00LS','small_airport','Lejeune Airport',30.136299,-92.429398,12,'NA','US','US-LA','Crowley','no','00LS','','00LS','','',''),(6546,'00MD','small_airport','Slater Field',38.75709915161133,-75.75379943847656,45,'NA','US','US-MD','Federalsburg','no','00MD','','00MD','','',''),(6547,'00MI','heliport','Dow Chemical Heliport',43.94940185546875,-86.41670227050781,588,'NA','US','US-MI','Ludington','no','00MI','','00MI','','',''),(6548,'00MN','small_airport','Battle Lake Municipal Airport',46.29999923706055,-95.70030212402344,1365,'NA','US','US-MN','Battle Lake','no','00MN','','00MN','','',''),(6549,'00MO','small_airport','Cooper Flying Service Airport',37.202800750732,-94.412399291992,970,'NA','US','US-MO','Alba','no','00MO','','00MO','','','5K8'),(6551,'00N','small_airport','Bucks Airport',39.472998,-75.184346,105,'NA','US','US-NJ','Bridgeton','no','K00N','','00N','','https://en.wikipedia.org/wiki/Bucks_Airport',''),(6552,'00NC','small_airport','North Raleigh Airport',36.085201263427734,-78.37139892578125,348,'NA','US','US-NC','Louisburg','no','00NC','','00NC','','',''),(6553,'00NJ','heliport','Colgate-Piscataway Heliport',40.52090072631836,-74.47460174560547,78,'NA','US','US-NJ','New Brunswick','no','00NJ','','00NJ','','',''),(6554,'00NY','small_airport','Weiss Airfield',42.89576,-77.495263,1000,'NA','US','US-NY','West Bloomfield','no','00NY','','00NY','','',''),(6555,'00OH','closed','Exit 3 Airport',41.590476,-84.141583,785,'NA','US','US-OH','Wauseon','no','','','','','','64D, 00OH'),(6556,'00OI','heliport','Miami Valley Hospital Heliport',39.745091,-84.187278,905,'NA','US','US-OH','Dayton','no','00OI','','00OI','','',''),(6557,'00OR','heliport','Steel Systems Heliport',44.932899475097656,-123.12999725341797,195,'NA','US','US-OR','Salem','no','00OR','','00OR','','',''),(6558,'00PA','heliport','R J D Heliport',39.94889831542969,-75.74690246582031,402,'NA','US','US-PA','Coatesville','no','00PA','','00PA','','',''),(6559,'00PS','closed','Thomas Field',40.3778,-77.365303,815,'NA','US','US-PA','Loysville','no','','','','','','00PS'),(6560,'00S','small_airport','McKenzie Bridge State Airport',44.181466,-122.086,1620,'NA','US','US-OR','Blue River','no','K00S','','00S','','https://en.wikipedia.org/wiki/McKenzie_Bridge_State_Airport',''),(6561,'00SC','small_airport','Flying O Airport',34.0093994140625,-80.26719665527344,150,'NA','US','US-SC','Sumter','no','00SC','','00SC','','',''),(6562,'00TA','closed','SW Region FAA Heliport',32.8269,-97.305801,598,'NA','US','US-TX','Fort Worth','no','','','','','','00TA'),(6563,'00TE','heliport','Tcjc-Northeast Campus Heliport',32.847599029541016,-97.18949890136719,600,'NA','US','US-TX','Fort Worth','no','00TE','','00TE','','',''),(6564,'00TN','closed','Ragsdale Road Airport',35.515618,-85.954256,1100,'NA','US','US-TN','Manchester','no','','','','','','00TN'),(6565,'00TS','small_airport','Alpine Range Airport',32.607601165771484,-97.24199676513672,670,'NA','US','US-TX','Everman','no','00TS','','00TS','','',''),(6566,'00TX','closed','San Jacinto Methodist Hospital Heliport',29.7377,-94.980201,19,'NA','US','US-TX','Baytown','no','','','','','','00TX'),(6567,'00UT','closed','Clear Creek Ranch Airport',37.24777,-112.822981,6138,'NA','US','US-UT','Kanab','no','','','','','','00UT, U21'),(6568,'00VA','small_airport','Vaughan Airport',36.574964,-78.998437,551,'NA','US','US-VA','Alton','no','00VA','','00VA','','',''),(6569,'00VI','small_airport','Groundhog Mountain Airport',36.663299560546875,-80.49949645996094,2680,'NA','US','US-VA','Hillsville','no','00VI','','00VI','','',''),(6570,'00W','small_airport','Lower Granite State Airport',46.672884,-117.441933,719,'NA','US','US-WA','Colfax','no','K00W','','00W','http://www.wsdot.wa.gov/aviation/AllStateAirports/Colfax_LowerGraniteState.htm','','0WA0'),(6571,'00WA','small_airport','Howell Airport',47.17839813232422,-122.77200317382812,150,'NA','US','US-WA','Longbranch','no','00WA','','00WA','','',''),(6572,'00WI','small_airport','Northern Lite Airport',44.304298400878906,-89.05010223388672,860,'NA','US','US-WI','Waupaca','no','00WI','','00WI','','',''),(6573,'00WN','small_airport','Hawks Run Airport',46.25,-117.2490005493164,2900,'NA','US','US-WA','Asotin','no','00WN','','00WN','','',''),(6574,'00WV','small_airport','Lazy J. Aerodrome',38.82889938354492,-79.86609649658203,2060,'NA','US','US-WV','Beverly','no','00WV','','00WV','','',''),(6575,'00XS','closed','L P Askew Farms Airport',33.033401,-101.933998,3110,'NA','US','US-TX','O\'Donnell','no','','','','','','00XS'),(6576,'01A','small_airport','Purkeypile Airport',62.940833,-152.269722,2041,'NA','US','US-AK','Purkeypile','no','K01A','','01A','','',''),(6577,'01AK','heliport','Providence Seward Medical Center Heliport',60.105873975399994,-149.446249008,120,'NA','US','US-AK','Seward','no','01AK','','01AK','','',''),(6578,'01AL','small_airport','Ware Island Airport',32.94599914550781,-86.51390075683594,344,'NA','US','US-AL','Clanton','no','01AL','','01AL','','',''),(6579,'01AR','heliport','DeQueen Medical Center Heliport',34.047456,-94.354023,440,'NA','US','US-AR','DeQueen','no','01AR','','01AR','','','Community Hospital of DeQueen Heliport'),(6580,'01AZ','heliport','Yat Heliport',34.607406,-111.8609,3300,'NA','US','US-AZ','Camp Verde','no','01AZ','','01AZ','','',''),(6581,'01C','closed','Grant Airport',43.341701507568,-85.775001525879,815,'NA','US','US-MI','Grant','no','','','','','https://en.wikipedia.org/wiki/Grant_Airport','01C, 01C, 01C'),(6582,'01CA','heliport','SCE Lugo Substation Heliport',34.368241,-117.370059,3733,'NA','US','US-CA','Hesperia','no','01CA','','01CA','','',''),(6583,'01CL','small_airport','Swansboro Country Airport',38.7999,-120.734001,2594,'NA','US','US-CA','Placerville','no','01CL','','01CL','','https://en.wikipedia.org/wiki/Swansboro_Country_Airport',''),(6584,'01CN','closed','Los Angeles County Sheriff\'s Department Heliport',34.0378,-118.153999,300,'NA','US','US-CA','Los Angeles','no','','','','','','01CN'),(6585,'01CO','heliport','St Vincent General Hospital Heliport',39.24530029296875,-106.24600219726562,10175,'NA','US','US-CO','Leadville','no','01CO','','01CO','','',''),(6586,'01CT','heliport','Berlin Fairgrounds Heliport',41.62730026245117,-72.72750091552734,60,'NA','US','US-CT','Berlin','no','01CT','','01CT','','',''),(6587,'01FA','small_airport','Rybolt Ranch Airport',28.589399337768555,-81.14420318603516,55,'NA','US','US-FL','Orlando','no','01FA','','01FA','','',''),(6588,'01FD','heliport','Advent Health Altamonte Springs Heliport',28.666639,-81.3697,86,'NA','US','US-FL','Altamonte Springs','no','01FD','','01FD','','','Florida Hospital-Altamonte'),(6589,'01FL','small_airport','Cedar Knoll Flying Ranch Airport',28.78190040588379,-81.1592025756836,19,'NA','US','US-FL','Geneva','no','01FL','','01FL','','',''),(6590,'01GA','heliport','Medical Center Heliport',32.47930145263672,-84.9791030883789,319,'NA','US','US-GA','Columbus','no','01GA','','01GA','','',''),(6591,'01GE','small_airport','The Farm Airport',32.675106,-82.771055,375,'NA','US','US-GA','Wrightsville','no','01GE','','01GE','','',''),(6592,'01IA','closed','Stender Airport',41.661098,-90.741302,725,'NA','US','US-IA','Maysville','no','','','','','','01IA'),(6593,'01II','small_airport','Myers Field',39.8849983215332,-86.50669860839844,950,'NA','US','US-IN','Lizton','no','01II','','01II','','',''),(6594,'01IL','heliport','Hoopeston Community Memorial Hospital Heliport',40.45859909057617,-87.65950012207031,583,'NA','US','US-IL','Hoopeston','no','01IL','','01IL','','',''),(6595,'01IN','heliport','Community Hospital Heliport',40.13090133666992,-85.69580078125,890,'NA','US','US-IN','Anderson','no','01IN','','01IN','','',''),(6596,'01IS','small_airport','William E. Koenig Airport',39.01620101928711,-90.31819915771484,670,'NA','US','US-IL','Dow','no','01IS','','01IS','','',''),(6597,'01J','small_airport','Hilliard Airpark',30.685568,-81.906346,59,'NA','US','US-FL','Hilliard','no','K01J','','01J','','https://en.wikipedia.org/wiki/Hilliard_Airpark',''),(6598,'01K','small_airport','Caldwell Municipal Airport',37.036132,-97.58533,1157,'NA','US','US-KS','Caldwell','no','K01K','','01K','','https://en.wikipedia.org/wiki/Caldwell_Municipal_Airport_(Kansas)',''),(6599,'01KS','small_airport','Flying N Ranch Airport',38.54059982299805,-97.00330352783203,1485,'NA','US','US-KS','Lost Springs','no','01KS','','01KS','','',''),(6600,'01KY','heliport','Lourdes Hospital Heliport',37.051700592041016,-88.64689636230469,419,'NA','US','US-KY','Paducah','no','01KY','','01KY','','',''),(6601,'01LA','small_airport','Barham Airport',32.638999938964844,-91.77369689941406,90,'NA','US','US-LA','Oak Ridge','no','01LA','','01LA','','',''),(6602,'01LL','small_airport','Schumaier Restricted Landing Area',38.12580108642578,-89.46389770507812,555,'NA','US','US-IL','Pinckneyville','no','01LL','','01LL','','',''),(6603,'01LS','small_airport','Country Breeze Airport',30.722478,-91.077372,125,'NA','US','US-LA','Slaughter','no','01LS','','01LS','','',''),(6604,'01MA','heliport','Compaq Andover Heliport',42.625099182128906,-71.18009948730469,140,'NA','US','US-MA','Andover','no','01MA','','01MA','','',''),(6606,'01ME','seaplane_base','Saint Peter\'s Seaplane Base',46.778900146484375,-68.50029754638672,608,'NA','US','US-ME','Portage Lake','no','01ME','','01ME','','',''),(6607,'01MI','heliport','Flow Through Terminal Heliport',43.04949951171875,-83.67970275878906,736,'NA','US','US-MI','Flint','no','01MI','','01MI','','',''),(6608,'01MN','seaplane_base','Barnes Seaplane Base',47.899600982666016,-92.55740356445312,1358,'NA','US','US-MN','Cook','no','01MN','','01MN','','',''),(6609,'01MO','heliport','Highway Patrol Troop C Headquarters Heliport',38.641700744628906,-90.48429870605469,615,'NA','US','US-MO','Town and Country','no','01MO','','01MO','','',''),(6610,'01MT','small_airport','Crystal Lakes Resort Airport',48.789100646972656,-114.87999725341797,3141,'NA','US','US-MT','Fortine','no','01MT','','01MT','','',''),(6611,'01NC','small_airport','Topsail Airpark',34.47529983520508,-77.5813980102539,65,'NA','US','US-NC','Holly Ridge','no','01NC','','01NC','','',''),(6612,'01NE','closed','Detour Airport',40.843619,-100.651503,3000,'NA','US','US-NE','Wellfleet','no','','','','','','01NE'),(6613,'01NH','small_airport','Moore Airfield',43.6445,-72.086998,835,'NA','US','US-NH','Canaan','no','01NH','','01NH','','','Enfield'),(6614,'01NJ','heliport','Albert Guido Memorial Heliport',40.739956,-74.136128,10,'NA','US','US-NJ','Newark','no','01NJ','','01NJ','','',''),(6615,'01NV','small_airport','Lantana Ranch Airport',38.76390075683594,-119.0270004272461,4600,'NA','US','US-NV','Yerington','no','01NV','','01NV','','',''),(6616,'01NY','heliport','Vassar Hospital Heliport',41.692415,-73.93683,100,'NA','US','US-NY','Poughkeepsie','no','01NY','','01NY','','',''),(6617,'01OI','heliport','Avita Health System Galion Hospital Heliport',40.730267,-82.802022,1140,'NA','US','US-OH','Galion','no','01OI','','01OI','','','Galion Community Hospital Heliport'),(6618,'01OK','closed','Lawrence Airport',35.294498,-98.636496,1525,'NA','US','US-OK','Eakly','no','','','','','','01OK'),(6619,'01OR','closed','Red & White Flying Service Airport',43.119301,-121.044997,4346,'NA','US','US-OR','Silver Lake','no','','','','','','01OR'),(6620,'01PA','closed','Pine Heliport',40.655602,-80.050903,1215,'NA','US','US-PA','Mars','no','','','','','','01PA'),(6621,'01PN','small_airport','Bierly(Personal Use) Airport',40.930599212646484,-77.73889923095703,960,'NA','US','US-PA','Bellefonte','no','01PN','','01PN','','',''),(6622,'01PS','small_airport','Nort\'s Resort Airport',41.59590148925781,-76.02960205078125,1040,'NA','US','US-PA','Meshoppen','no','01PS','','01PS','','',''),(6623,'01SC','small_airport','York Airport',35.032100677490234,-81.25279998779297,779,'NA','US','US-SC','York','no','01SC','','01SC','','',''),(6624,'01TA','heliport','Thirty Thirty Matlock Office Center Heliport',32.69419860839844,-97.11579895019531,630,'NA','US','US-TX','Arlington','no','01TA','','01TA','','',''),(6625,'01TE','small_airport','Smith Field',32.737598,-96.428001,505,'NA','US','US-TX','Forney','no','01TE','','01TE','','','02F'),(6626,'01TN','small_airport','Colonial Air Park',34.99589920043945,-89.73059844970703,370,'NA','US','US-TN','Collierville','no','01TN','','01TN','','',''),(6627,'01TS','closed','St Joseph Hospital Heliport',32.7285,-97.324501,675,'NA','US','US-TX','Fort Worth','no','','','','','','01TS'),(6628,'01TX','closed','Mims Farm Ultralightport',32.388115,-96.877398,610,'NA','US','US-TX','Waxahachie','no','','','','','','01TX'),(6629,'01U','small_airport','Duckwater Airport',38.849785,-115.634987,5124,'NA','US','US-NV','Duckwater','no','K01U','','01U','','',''),(6630,'01UT','small_airport','La Sal Junction Airport',38.30830001831055,-109.39600372314453,6000,'NA','US','US-UT','La Sal','no','01UT','','01UT','','',''),(6631,'01VA','small_airport','Pickles Airport',39.125,-77.9250030518,500,'NA','US','US-VA','Berryville','no','01VA','','01VA','','',''),(6632,'01WA','heliport','Willapa Harbor Heliport',46.66320037841797,-123.81199645996094,154,'NA','US','US-WA','South Bend','no','01WA','','01WA','','',''),(6633,'01WI','small_airport','Prehn Cranberry Company Airport',44.0099983215332,-90.38919830322266,930,'NA','US','US-WI','Tomah','no','01WI','','01WI','','',''),(6634,'01WN','heliport','Whidbey General Hospital Heliport',48.213401794433594,-122.68499755859375,103,'NA','US','US-WA','Coupeville','no','01WN','','01WN','','',''),(6635,'01WY','small_airport','Keyhole Airport',44.348312,-104.8106,4250,'NA','US','US-WY','Pine Haven','no','01WY','','01WY','','',''),(6636,'01XS','heliport','Meadowood Ranch Heliport',32.020198822021484,-95.74549865722656,500,'NA','US','US-TX','Athens','no','01XS','','01XS','','',''),(6637,'02AK','small_airport','Rustic Wilderness Airport',61.876907,-150.097626,190,'NA','US','US-AK','Willow','no','02AK','','02AK','','',''),(6638,'02AL','small_airport','Bass Field',30.37150001525879,-87.76439666748047,61,'NA','US','US-AL','Foley','no','02AL','','02AL','','',''),(6640,'02AZ','closed','Winchester Farm Airstrip',32.376401,-109.936996,4200,'NA','US','US-AZ','Willcox','no','','','','','','02AZ'),(6641,'02CA','heliport','Swepi Beta Platform Ellen Heliport',33.58250045776367,-118.12899780273438,122,'NA','US','US-CA','Huntington Beach','no','02CA','','02CA','','',''),(6642,'02CD','small_airport','Shannon Field',34.129600524902344,-90.52400207519531,165,'NA','US','US-MS','Clarksdale','no','02CD','','02CD','','',''),(6643,'02CL','small_airport','Conover Air Lodge Airport',34.761101,-119.058998,5160,'NA','US','US-CA','Frazier Park','no','02CL','','02CL','','','04L'),(6644,'02CO','small_airport','Mc Cullough Airport',37.64329910279999,-106.04699707,7615,'NA','US','US-CO','Monte Vista','no','02CO','','02CO','','',''),(6645,'02CT','heliport','Strangers Point Heliport',41.91960144042969,-72.44450378417969,540,'NA','US','US-CT','Ellington','no','02CT','','02CT','','',''),(6646,'02FA','small_airport','Osborn Airfield',28.526699,-81.874802,121,'NA','US','US-FL','Groveland','no','02FA','','02FA','','https://en.wikipedia.org/wiki/Osborn_Airfield',''),(6648,'02GA','small_airport','Doug Bolton Field',34.202598571777344,-83.42900085449219,884,'NA','US','US-GA','Commerce','no','02GA','','02GA','','',''),(6649,'02GE','small_airport','Etowah Fields Airport',34.17530059814453,-84.92440032958984,710,'NA','US','US-GA','Euharlee','no','02GE','','02GE','','',''),(6650,'02HI','heliport','K3 Helipad Heliport',21.35839,-157.94789,9,'OC','US','US-HI','Honolulu','no','02HI','','02HI','','',''),(6651,'02IA','heliport','Boone County Hospital Heliport',42.05609893798828,-93.87799835205078,1160,'NA','US','US-IA','Boone','no','02IA','','02IA','','',''),(6652,'02ID','small_airport','Morgan Ranch Airport',44.55550003051758,-115.30500030517578,5634,'NA','US','US-ID','Cascade','no','02ID','','02ID','','',''),(6653,'02II','small_airport','King Ultralightport',40.06230163574219,-86.21050262451172,925,'NA','US','US-IN','Westfield','no','02II','','02II','','',''),(6654,'02IN','small_airport','Diamond P. Field',40.208900451660156,-85.54080200195312,904,'NA','US','US-IN','Muncie','no','02IN','','02IN','','',''),(6655,'02IS','heliport','Condell Medical Center Heliport',42.274600982666016,-87.9572982788086,762,'NA','US','US-IL','Libertyville','no','02IS','','02IS','','',''),(6656,'02KS','small_airport','Jmj Landing Airport',39.222198486328125,-96.0552978515625,1170,'NA','US','US-KS','St Marys','no','02KS','','02KS','','',''),(6657,'02KY','heliport','Boone National Guard Heliport',38.190282,-84.906442,760,'NA','US','US-KY','Frankfort','no','02KY','','02KY','','',''),(6658,'02LA','heliport','Louisiana State Police Troop G Heliport',32.531491,-93.659939,168,'NA','US','US-LA','Bossier City','no','02LA','','02LA','','',''),(6659,'02LS','heliport','Windy Hill Heliport',30.148300170898438,-91.91899871826172,25,'NA','US','US-LA','Broussard','no','02LS','','02LS','','',''),(6660,'02MA','heliport','Cuttyhunk Heliport',41.419601,-70.927002,9,'NA','US','US-MA','Cuttyhunk','no','02MA','','02MA','','',''),(6661,'02ME','small_airport','Nadeau\'s Airfield',43.537467,-70.930685,700,'NA','US','US-ME','Acton','no','02ME','','02ME','','','Mellion Airport, Old Acton Airfield'),(6662,'02MI','small_airport','Fairplains Airpark',43.157100677490234,-85.14849853515625,850,'NA','US','US-MI','Greenville','no','02MI','','02MI','','',''),(6663,'02MN','closed','Greenbush Municipal Airport',48.686527,-96.191976,1070,'NA','US','US-MN','Greenbush','no','','','','','','02MN, 02Y'),(6664,'02MO','small_airport','Troy Airpark',39.04999923706055,-91.03350067138672,650,'NA','US','US-MO','Troy','no','02MO','','02MO','','',''),(6665,'02MS','small_airport','Watts Field',34.095701,-90.846131,153,'NA','US','US-MS','Rochdale','no','02MS','','02MS','','',''),(6666,'02MT','closed','Barrett Field',47.234035,-111.750592,3350,'NA','US','US-MT','Cascade','no','','','','','','02MT'),(6667,'02MU','closed','Timber Line Airpark',36.655612,-93.802387,1550,'NA','US','US-MO','Cassville','no','','','','','','02MU'),(6668,'02NE','small_airport','Benes Service Airport',41.074501037597656,-96.90450286865234,1550,'NA','US','US-NE','Valparaiso','no','02NE','','02NE','','',''),(6669,'02NH','seaplane_base','Iroquois Landing Seaplane Base',44.657100677490234,-71.21910095214844,1180,'NA','US','US-NH','Dummer','no','02NH','','02NH','','',''),(6670,'02NJ','heliport','Penske Heliport',40.55730056762695,-74.46710205078125,78,'NA','US','US-NJ','Piscataway','no','02NJ','','02NJ','','',''),(6671,'02NV','small_airport','Paiute Meadows Airport',41.299551,-118.926709,4443,'NA','US','US-NV','Winnemucca','no','02NV','','02NV','','',''),(6672,'02NY','heliport','Hansen Heliport',43.132598876953125,-75.65550231933594,435,'NA','US','US-NY','Durhamville','no','02NY','','02NY','','',''),(6673,'02OH','small_airport','Zimmerman Airport',41.376399993896484,-83.08329772949219,614,'NA','US','US-OH','Fremont','no','02OH','','02OH','','',''),(6674,'02OI','small_airport','Murtha Airport',41.801998138427734,-80.56539916992188,950,'NA','US','US-OH','Conneaut','no','02OI','','02OI','','',''),(6675,'02OK','closed','Canon Heliport',35.458401,-97.525297,1191,'NA','US','US-OK','Oklahoma City','no','','','','','','02OK, 02OK'),(6676,'02OR','small_airport','Rowena Dell Airport',45.68149948120117,-121.31600189208984,705,'NA','US','US-OR','The Dalles','no','02OR','','02OR','','',''),(6677,'02P','heliport','Stottle Memorial Heliport',40.403596,-77.556602,591,'NA','US','US-PA','Honey Grove','no','26PA','','26PA','','','02P, EWT 4'),(6678,'02PA','heliport','Lag III Heliport',40.438301,-79.769997,1070,'NA','US','US-PA','Monroeville','no','02PA','','02PA','','',''),(6679,'02PN','heliport','Peco Berwyn Heliport',40.06959915161133,-75.4552001953125,390,'NA','US','US-PA','Berwyn','no','02PN','','02PN','','',''),(6680,'02PR','small_airport','Cuylers Airport',18.464924,-66.363773,15,'NA','PR','PR-U-A','Vega Baja','no','02PR','','02PR','','',''),(6681,'02PS','closed','Hughes Ultralightport',41.90063,-77.230025,1700,'NA','US','US-PA','Tioga','no','','','','','','02PS'),(6682,'02SC','small_airport','Harpers Airport',32.760211,-81.225872,111,'NA','US','US-SC','Estill','no','02SC','','02SC','','',''),(6683,'02T','small_airport','Wise River Airport',45.769100189208984,-112.98200225830078,5830,'NA','US','US-MT','Wise River','no','02T','','02T','','',''),(6684,'02TA','heliport','Matagorda Shore Facility Heliport',28.722177,-95.875813,5,'NA','US','US-TX','Matagorda','no','02TA','','02TA','','',''),(6685,'02TE','heliport','Baylor Medical Center Heliport',32.39540100097656,-96.86419677734375,560,'NA','US','US-TX','Waxahachie','no','02TE','','02TE','','',''),(6686,'02TN','small_airport','Ellis Field',35.780355,-86.585521,840,'NA','US','US-TN','Rockvale','no','02TN','','02TN','','',''),(6687,'02TS','closed','FWOMC Heliport',32.747601,-97.370003,684,'NA','US','US-TX','Fort Worth','no','','','','','','02TS'),(6688,'02TX','closed','The Palms At Kitty Hawk Airport',33.370403,-101.922882,3235,'NA','US','US-TX','New Home','no','','','','','','02TX, OLD02TX'),(6689,'02UT','small_airport','Lucin Airport',41.369336,-113.841019,4412,'NA','US','US-UT','Lucin','no','02UT','','02UT','','',''),(6690,'02VA','small_airport','The Greenhouse Airport',38.435699462890625,-77.8572006225586,320,'NA','US','US-VA','Culpeper','no','02VA','','02VA','','',''),(6691,'02VG','heliport','Northstar Aviation Heliport',36.63880157470703,-82.11669921875,1850,'NA','US','US-VA','Bristol','no','02VG','','02VG','','',''),(6692,'02WA','small_airport','Cawleys South Prairie Airport',47.15230178833008,-122.09400177001953,690,'NA','US','US-WA','South Prairie','no','02WA','','02WA','','',''),(6693,'02WI','small_airport','Beer Airport',45.031898498535156,-92.65579986572266,920,'NA','US','US-WI','Hudson','no','02WI','','02WI','','',''),(6694,'02WN','small_airport','Fowler Field',48.74580001831055,-119.31900024414062,2150,'NA','US','US-WA','Tonasket','no','02WN','','02WN','','',''),(6695,'02XS','closed','Seidel Ranch Airport',30.100941,-97.672607,510,'NA','US','US-TX','Austin','no','','','','','','02XS, 02XS, 02XS'),(6696,'03AK','seaplane_base','Joe Clouds Seaplane Base',60.72722244262695,-151.13278198242188,150,'NA','US','US-AK','Kenai','no','03AK','','03AK','','',''),(6697,'03AL','heliport','Highland Medical Center Heliport',34.662604,-86.046774,628,'NA','US','US-AL','Scottsboro','no','03AL','','03AL','','','Jackson County Hospital Heliport'),(6698,'03AR','heliport','Hscmh Heliport',34.357601165771484,-92.78849792480469,350,'NA','US','US-AR','Malvern','no','03AR','','03AR','','',''),(6699,'03AZ','small_airport','Thompson International Aviation Airport',31.430971,-110.088087,4275,'NA','US','US-AZ','Hereford','no','03AZ','','03AZ','','',''),(6700,'03CA','heliport','Grossmont Hospital Heliport',32.779484,-117.006952,634,'NA','US','US-CA','La Mesa','no','03CA','','03CA','','',''),(6701,'03CO','small_airport','Kugel-Strong Airport',40.211608,-104.744781,4950,'NA','US','US-CO','Platteville','no','03CO','','03CO','','',''),(6702,'03FA','small_airport','Lake Persimmon Airstrip',27.353099822998047,-81.40809631347656,70,'NA','US','US-FL','Lake Placid','no','03FA','','03FA','','',''),(6703,'03FD','closed','Tharpe Airport',30.8288,-85.731003,115,'NA','US','US-FL','Bonifay','no','','','','','','03FD'),(6704,'03FL','heliport','Ranger Heliport',26.683716,-80.186561,20,'NA','US','US-FL','West Palm Beach','no','03FL','','03FL','','',''),(6705,'03I','closed','Clarks Dream Strip',39.644199,-83.018204,680,'NA','US','US-OH','Circleville','no','','','','','','03I'),(6706,'03IA','closed','East Field',41.581902,-92.461304,954,'NA','US','US-IA','Montezuma','no','','','','','','03IA'),(6707,'03ID','small_airport','Flying Y Ranch Airport',44.793965,-116.531543,3180,'NA','US','US-ID','Council','no','03ID','','03ID','','',''),(6708,'03II','small_airport','Davis Field Ultralightport',37.9620018005,-87.7789001465,465,'NA','US','US-IN','Mount Vernon','no','03II','','03II','','',''),(6709,'03IL','small_airport','Wix Airport',41.40230178833008,-87.81670379638672,750,'NA','US','US-IL','Monee','no','03IL','','03IL','','',''),(6710,'03IN','small_airport','Heinzman Airport',40.18000030517578,-86.01249694824219,850,'NA','US','US-IN','Arcadia','no','03IN','','03IN','','',''),(6711,'03IS','heliport','OSF St Anthony\'s Health Center Heliport',38.904999,-90.173401,580,'NA','US','US-IL','Alton','no','03IS','','03IS','','','St Anthony\'s Hospital'),(6712,'03KS','heliport','Valley Grain Heliport',39.86470031738281,-95.26409912109375,1160,'NA','US','US-KS','Highland','no','03KS','','03KS','','',''),(6713,'03KY','small_airport','Flying H Farms Airport',37.796085,-87.53859,385,'NA','US','US-KY','Henderson','no','03KY','','03KY','','',''),(6714,'03LA','heliport','Damien Heliport',30.199600219726562,-91.12789916992188,25,'NA','US','US-LA','Carville','no','03LA','','03LA','','',''),(6715,'03LS','heliport','Fmc Nr 1 Heliport',32.159000396728516,-91.70800018310547,79,'NA','US','US-LA','Winnsboro','no','03LS','','03LS','','',''),(6716,'03M','seaplane_base','Lakeside Lodge and Marina Seaplane Base',44.3209,-69.889503,165,'NA','US','US-ME','East Winthrop','no','03M','','03M','','',''),(6717,'03MA','small_airport','Hadley Airport',42.393431,-72.551553,150,'NA','US','US-MA','Hadley','no','03MA','','03MA','','',''),(6718,'03MD','heliport','Upper Chesapeake Medical Center Heliport',39.518427,-76.346022,302,'NA','US','US-MD','Bel Air','no','03MD','','03MD','','',''),(6719,'03ME','small_airport','Maple Ridge Airport',44.084251,-70.626905,556,'NA','US','US-ME','Harrison','no','03ME','','03ME','','',''),(6720,'03MI','heliport','Harold Miller Heliport',43.550899505615234,-83.86219787597656,585,'NA','US','US-MI','Bay City','no','03MI','','03MI','','',''),(6721,'03MN','small_airport','Nauerth Land Ranch Airport',43.62519836425781,-95.22470092773438,1435,'NA','US','US-MN','Lakefield','no','03MN','','03MN','','',''),(6722,'03MO','closed','Cahoochie Airport',37.884499,-93.131599,1010,'NA','US','US-MO','Urbana','no','','','','','','03MO'),(6723,'03MS','heliport','Vicksburg Medical Center Heliport',32.31880187988281,-90.8832015991211,110,'NA','US','US-MS','Vicksburg','no','03MS','','03MS','','',''),(6724,'03MT','small_airport','Cascade Field',47.267327,-111.71748,3580,'NA','US','US-MT','Cascade','no','3MT7','','3MT7','','','03MT'),(6725,'03MU','small_airport','McDonnell Airport',38.4925,-94.412498,874,'NA','US','US-MO','Archie','no','03MU','','03MU','','',''),(6726,'03NC','small_airport','Pilots Ridge Airport',34.10430145263672,-77.9041976928711,35,'NA','US','US-NC','Carolina Beach','no','03NC','','03NC','','',''),(6727,'03ND','small_airport','Olafson Brothers Airport',48.626399993896484,-97.8290023803711,1045,'NA','US','US-ND','Edinburg','no','03ND','','03ND','','',''),(6728,'03NE','small_airport','Hyde Ranch Airport',41.5463981628418,-99.3311996459961,2430,'NA','US','US-NE','Comstock','no','03NE','','03NE','','',''),(6729,'03NH','heliport','Lorden Heliport',42.815399169921875,-71.12439727783203,400,'NA','US','US-NH','Milford','no','03NH','','03NH','','',''),(6730,'03NJ','closed','AT&T Heliport',40.668713,-74.410152,360,'NA','US','US-NJ','Berkeley Heights','no','','','','','','03NJ'),(6731,'03NV','small_airport','Llama Ranch Airport',40.58440017700195,-115.2979965209961,6120,'NA','US','US-NV','Ruby Valley','no','03NV','','03NV','','',''),(6732,'03NY','small_airport','Talmage Field',40.958308,-72.717326,95,'NA','US','US-NY','Riverhead','no','03NY','','03NY','','',''),(6733,'03OH','small_airport','Gibbs Field',41.416933,-83.018339,580,'NA','US','US-OH','Fremont','no','03OH','','03OH','','',''),(6734,'03OI','heliport','Cleveland Clinic, Marymount Hospital Heliport',41.420312,-81.599552,890,'NA','US','US-OH','Garfield Heights','no','03OI','','03OI','','',''),(6735,'03OK','small_airport','Sahoma Lake Airport',36.041259,-96.161517,890,'NA','US','US-OK','Sapulpa','no','03OK','','03OK','','',''),(6736,'03OR','small_airport','Powwatka Ridge Airport',45.85540008544922,-117.48400115966797,3340,'NA','US','US-OR','Troy','no','03OR','','03OR','','',''),(6737,'03PA','heliport','Collegeville Heliport',40.162899017333984,-75.4656982421875,197,'NA','US','US-PA','Collegeville','no','03PA','','03PA','','',''),(6738,'03PN','heliport','M.P. Metals Heliport',41.066861,-76.180806,479,'NA','US','US-PA','Berwick','no','03PN','','03PN','','',''),(6739,'03PS','closed','Ziggy\'s Field',40.849998,-77.905602,1050,'NA','US','US-PA','Bellefonte','no','','','','','','03PS'),(6740,'03S','small_airport','Sandy River Airport',45.401629,-122.228771,704,'NA','US','US-OR','Sandy','no','K03S','','03S','','https://en.wikipedia.org/wiki/Sandy_River_Airport',''),(6741,'03SC','heliport','Seacoast Medical Center Heliport',33.8650016784668,-78.66190338134766,73,'NA','US','US-SC','Little River','no','03SC','','03SC','','',''),(6742,'03TA','closed','Gay Hill Farm Airport',30.262699,-96.500198,505,'NA','US','US-TX','Gay Hill','no','','','','','','03TA'),(6743,'03TE','small_airport','Barronena Ranch Airport',27.490812,-98.669615,600,'NA','US','US-TX','Hebbronville','no','03TE','','03TE','','',''),(6744,'03TN','heliport','Eagles Landing Heliport',35.92250061035156,-83.57939910888672,1000,'NA','US','US-TN','Sevierville','no','03TN','','03TN','','',''),(6745,'03TS','heliport','Shannon Medical Center Heliport',31.4658,-100.43397,1825,'NA','US','US-TX','San Angelo','no','03TS','','03TS','','',''),(6746,'03TX','heliport','M D K Field Heliport',29.580929,-95.30508,50,'NA','US','US-TX','Pearland','no','03TX','','03TX','','',''),(6747,'03UT','small_airport','AZ Minerals Corporation Airport',37.114384,-109.99014,5315,'NA','US','US-UT','Mexican Hat','no','03UT','','03UT','','','U23'),(6748,'03VA','closed','Whipoorwill Springs Airport',38.66460037231445,-77.57969665527344,250,'NA','US','US-VA','Nokesville','no','','','','','','03VA, 03VA, 03VA'),(6749,'03WA','small_airport','Spangle Field',47.408199310302734,-117.37200164794922,2440,'NA','US','US-WA','Spangle','no','03WA','','03WA','','',''),(6750,'03WI','closed','Zink Airport',44.028873,-88.883945,880,'NA','US','US-WI','Berlin','no','','','','','','03WI'),(6751,'03WN','small_airport','Aerostone Ranch Airport',45.875,-120.66999816894531,2320,'NA','US','US-WA','Goldendale','no','03WN','','03WN','','',''),(6752,'03XS','small_airport','Creekside Airport',31.318099975585938,-100.75399780273438,2100,'NA','US','US-TX','Mertzon','no','03XS','','03XS','','',''),(6753,'04AL','heliport','Anniston AHP (Anniston Army Depot)',33.62639999,-85.96720123,686,'NA','US','US-AL','Anniston','no','04AL','','04AL','','',''),(6754,'04AR','heliport','Saline Memorial Hospital Heliport',34.574319,-92.586047,430,'NA','US','US-AR','Benton','no','04AR','','04AR','','',''),(6755,'04AZ','closed','Chinle Airport',36.147197,-109.560771,5515,'NA','US','US-AZ','Chinle','no','','','','','','04AZ, Q32, 04AZ'),(6756,'04CA','small_airport','Gray Butte Field',34.566631,-117.670666,3020,'NA','US','US-CA','Palmdale','no','04CA','','04CA','','https://en.wikipedia.org/wiki/Grey_Butte_Field_Airport','KGXA, GXA'),(6757,'04CL','small_airport','Hunt\'s Sky Ranch Airport',33.08169937133789,-116.44100189208984,2310,'NA','US','US-CA','Julian','no','04CL','','04CL','','',''),(6758,'04CT','heliport','Shingle Mill Heliport',41.75510025024414,-73.05239868164062,880,'NA','US','US-CT','Harwinton','no','04CT','','04CT','','',''),(6759,'04F','closed','De Leon Municipal Airport',32.098801,-98.525325,1293,'NA','US','US-TX','De Leon','no','','','','','','04F'),(6760,'04FA','small_airport','Richards Field',25.558700561523438,-80.51509857177734,9,'NA','US','US-FL','Homestead','no','04FA','','04FA','','',''),(6761,'04FL','small_airport','Cross Creek Farms Airport',29.240353,-81.222525,30,'NA','US','US-FL','Ormond Beach','no','04FL','','04FL','','',''),(6762,'04I','small_airport','Columbus Southwest Airport',39.91151,-83.188577,920,'NA','US','US-OH','Columbus','no','K04I','','04I','','https://en.wikipedia.org/wiki/Columbus_Southwest_Airport',''),(6763,'04IA','small_airport','Middlekoop Airport',41.08829879760742,-92.05460357666016,801,'NA','US','US-IA','Packwood','no','04IA','','04IA','','',''),(6764,'04ID','small_airport','Lanham Field',43.877015,-116.538365,2343,'NA','US','US-ID','Emmett','no','04ID','','04ID','','','U85'),(6765,'04II','closed','Turkey Run Airport',41.1306,-84.994102,765,'NA','US','US-IN','New Haven','no','','','','','','04II'),(6766,'04IL','small_airport','Schertz Aerial Service - Hudson Airport',40.6375007629,-89.0070037842,755,'NA','US','US-IL','Hudson','no','04IL','','04IL','','',''),(6767,'04IS','small_airport','Van Gorder Airport',40.1786003112793,-88.56900024414062,728,'NA','US','US-IL','Mansfield','no','04IS','','04IS','','',''),(43030,'02AR','closed','Three Rivers Airport',34.822445,-92.44442,264,'NA','US','US-AR','Little Rock','no','','','','','','02AR'),(45347,'02FL','closed','Cuchens Airport',30.642527,-86.118779,215,'NA','US','US-FL','Defuniak Springs','no','','','','','','02FL'),(45410,'04IN','seaplane_base','Lake Gage Seaplane Base',41.701389,-85.113056,954,'NA','US','US-IN','Angola','no','04IN','','04IN','','',''),(45437,'00LA','heliport','Shell Chemical East Site Heliport',30.191944,-90.980833,15,'NA','US','US-LA','Gonzales','no','00LA','','00LA','','',''),(45537,'01NM','small_airport','Champion Ranch Airport',33.008611,-104.540278,3630,'NA','US','US-NM','Lake Arthur','no','01NM','','01NM','','',''),(45686,'02NC','closed','Race City Heliport',35.540477,-80.598047,809,'NA','US','US-NC','Landis','no','','','','','','02NC'),(45773,'00PN','small_airport','Ferrell Field',41.2995,-80.211111,1301,'NA','US','US-PA','Mercer','no','00PN','','00PN','','',''),(45900,'01WT','heliport','Odyssey Heliport',47.518178,-122.210908,20,'NA','US','US-WA','Renton','no','01WT','','01WT','','',''),(46288,'01XA','heliport','Ascension Seton Hays Heliport',30.007222,-97.853333,715,'NA','US','US-TX','Kyle','no','01XA','','01XA','','','Seton Medical Center Hays Heliport'),(321919,'00NK','seaplane_base','Cliche Cove Seaplane Base',44.8118612,-73.3698057,96,'NA','US','US-NY','Beekmantown','no','00NK','','00NK','','',''),(322099,'02MD','small_airport','Garner Field',38.672544,-76.709739,141,'NA','US','US-MD','Brandywine','no','02MD','','02MD','','',''),(322127,'00AS','small_airport','Fulton Airport',34.9428028,-97.8180194,1100,'NA','US','US-OK','Alex','no','00AS','','00AS','','',''),(322300,'00WY','heliport','Mountain View Regional Hospital Heliport',42.840361,-106.224443,5210,'NA','US','US-WY','Casper','no','00WY','','00WY','','',''),(322581,'00IG','small_airport','Goltl Airport',39.724028,-101.395994,3359,'NA','US','US-KS','McDonald','no','00IG','','00IG','','',''),(322658,'00CN','heliport','Kitchen Creek Helibase Heliport',32.7273736,-116.4597417,3350,'NA','US','US-CA','Pine Valley','no','00CN','','00CN','','',''),(322717,'03GA','small_airport','HIA Airport',32.561626,-81.85509,238,'NA','US','US-GA','Statesboro','no','03GA','','03GA','','',''),(322892,'03PR','small_airport','Sun View Field Airport',39.065931,-94.938417,980,'NA','US','US-KS','Bonner Springs','no','03PR','','03PR','','',''),(323361,'00AA','small_airport','Aero B Ranch Airport',38.704022,-101.473911,3435,'NA','US','US-KS','Leoti','no','00AA','','00AA','','',''),(324424,'00CL','small_airport','Williams Ag Airport',39.427188,-121.763427,87,'NA','US','US-CA','Biggs','no','00CL','','00CL','','',''),(324642,'00MT','heliport','Livingston Healthcare Heliport',45.675,-110.52515,4465,'NA','US','US-MT','Livingston','no','00MT','','00MT','','',''),(324859,'04FD','heliport','Tampa General Hospital Brandon Healthplex Heliport',27.929372,-82.336981,37,'NA','US','US-FL','Brandon','no','04FD','','04FD','','',''),(325443,'04AA','small_airport','Flying W Ranch Airport',60.535833,-150.811387,250,'NA','US','US-AK','Soldotna','no','04AA','','04AA','','','Phil\'s Airport'),(325508,'03AA','heliport','Trapper T Heliport',61.556055,-149.284527,159,'NA','US','US-AK','Palmer','no','03AA','','03AA','','',''),(327110,'02KT','heliport','St Claire Healthcare Heliport',38.181441,-83.443319,781,'NA','US','US-KY','Morehead','no','02KT','','02KT','','',''),(328503,'00OK','small_airport','Gull Bay Landing Airport',36.198598,-96.217693,960,'NA','US','US-OK','Sandsprings','no','00OK','','00OK','','',''),(330391,'00SD','small_airport','Homan Field',44.809158,-96.498897,1590,'NA','US','US-SD','Gary','no','00SD','','00SD','','',''),(330393,'02XA','small_airport','JLS Farms Airport',33.591319,-95.882864,675,'NA','US','US-TX','Honey Grove','no','02XA','','02XA','','',''),(335815,'02AA','small_airport','Barefoot Airport',61.506147,-149.912825,160,'NA','US','US-AK','Big Lake','no','02AA','','02AA','','','H & H Field'),(337183,'02OL','heliport','War Veterans Colony Heliport',34.811412,-95.307727,807,'NA','US','US-OK','Wilburton','no','02OL','','02OL','','',''),(340858,'01TT','heliport','Clute Fire & EMS Station #1 Heliport',29.012067,-95.402119,7,'NA','US','US-TX','Clute','no','01TT','','01TT','','',''),(341544,'02FD','small_airport','Triple R Ranch Airport',30.950976,-86.635555,209,'NA','US','US-FL','Baker','no','02FD','','02FD','','',''),(341551,'03TT','small_airport','Brazos Polo Airport',29.632117,-95.932481,117,'NA','US','US-TX','Orchard','no','03TT','','03TT','','',''),(345166,'01OL','small_airport','Spring Creek Ranch East Airport',34.391667,-96.690833,1060,'NA','US','US-OK','Tishomingo','no','01OL','','01OL','','',''),(345364,'03NM','heliport','Miner\'s Colfax Medical Center Heliport',36.862377,-104.442853,6600,'NA','US','US-NM','Raton','no','03NM','','03NM','','',''),(345707,'03NR','heliport','Johnston Medical Center Heliport',35.63027,-78.50392,320,'NA','US','US-NC','Clayton','no','03NR','','03NR','','',''),(345757,'03XA','heliport','Del Sol Medical Center Heliport',31.7574,-106.346895,3881,'NA','US','US-TX','El Paso','no','03XA','','03XA','','',''),(347920,'01OH','heliport','Atrium Medical Center Heliport',39.497455,-84.313851,775,'NA','US','US-OH','Middletown','no','01OH','','01OH','','',''),(348415,'03WT','heliport','Lopez Medical Clinic Heliport',48.524894,-122.912394,38,'NA','US','US-WA','Lopez Island','no','03WT','','03WT','','',''),(348548,'03OL','small_airport','Bluebird Airport',35.012334,-97.702735,1232,'NA','US','US-OK','Alex','no','03OL','','03OL','','',''),(356168,'01AN','small_airport','McHone Heights Airport',61.649095,-149.339025,610,'NA','US','US-AK','Wasilla','no','01AN','','01AN','','',''),(356169,'01MU','heliport','NWMC - Houghton Heliport',32.196747,-110.775142,2873,'NA','US','US-AZ','Tucson','no','01MU','','01MU','','',''),(506036,'02NR','heliport','McGee 02 Heliport',35.592197,-77.377372,25,'NA','US','US-NC','Greenville','no','02NR','','02NR','','',''),(506039,'00NR','heliport','Rodanthe Dare County Heliport',35.594729,-75.470002,8,'NA','US','US-NC','Rodanthe','no','00NR','','00NR','','',''),(506122,'01NR','heliport','McGee 01 Heliport',34.196264,-77.919917,40,'NA','US','US-NC','Wilmington','no','01NR','','01NR','','',''),(506791,'00AN','small_airport','Katmai Lodge Airport',59.093287,-156.456699,80,'NA','US','US-AK','King Salmon','no','00AN','','00AN','','',''),(509055,'04AN','small_airport','North 40 Airport',61.737511,-148.700724,943,'NA','US','US-AK','Sutton','no','04AN','','04AN','','',''),(512948,'03GE','heliport','NGMC Lumpkin Hospital Heliport',34.523153,-83.975058,1178,'NA','US','US-GA','Dahlonega','no','03GE','','03GE','https://www.nghs.com/locations/lumpkin','',''),(516563,'00TT','small_airport','Nowhere Airport',34.516606,-99.93694,1752,'NA','US','US-TX','Goodlett','no','00TT','','00TT','','',''),(525140,'00XA','small_airport','Weeski Ranch Airport',30.224,-96.01417,271,'NA','US','US-TX','','no','00XA','','00XA','','',''),(526225,'02NM','small_airport','FFR Animas Landing Strip',32.09071,-108.870735,4240,'NA','US','US-NM','Animas','no','02NM','','02NM','','',''),(529870,'02AN','small_airport','Emerald Ridge Airport',59.704223,-151.295869,222,'NA','US','US-AK','Homer','no','02AN','','02AN','','','');
/*!40000 ALTER TABLE `airports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `car_rental_agencies`
--

DROP TABLE IF EXISTS `car_rental_agencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `car_rental_agencies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car_rental_agencies`
--

LOCK TABLES `car_rental_agencies` WRITE;
/*!40000 ALTER TABLE `car_rental_agencies` DISABLE KEYS */;
INSERT INTO `car_rental_agencies` VALUES (1,'Avis','https://www.avis.com'),(2,'Hertz','https://www.hertz.com'),(3,'Enterprise','https://www.enterprise.com'),(4,'Sixt','https://www.sixt.com'),(5,'Budget','https://www.budget.com'),(6,'Alamo','https://www.alamo.com'),(7,'Thrifty','https://www.thrifty.com'),(8,'National','https://www.nationalcar.com'),(9,'Europcar','https://www.europcar.com'),(10,'Dollar','https://www.dollar.com');
/*!40000 ALTER TABLE `car_rental_agencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight_reservations`
--

DROP TABLE IF EXISTS `flight_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flight_reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `flight_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reservation_number` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `flight_id` (`flight_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `flight_reservations_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`),
  CONSTRAINT `flight_reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flight_reservations`
--

LOCK TABLES `flight_reservations` WRITE;
/*!40000 ALTER TABLE `flight_reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `flight_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flights` (
  `id` int NOT NULL AUTO_INCREMENT,
  `departure_airport` varchar(255) NOT NULL,
  `destination_airport` varchar(255) NOT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `direct_flight` tinyint(1) NOT NULL,
  `flight_number` varchar(50) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `flight_reference` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flight_reference` (`flight_reference`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flights`
--

LOCK TABLES `flights` WRITE;
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
INSERT INTO `flights` VALUES (1,'JFK','LAX','2023-08-01','2023-08-01','Cancelled',0.00,0,NULL,NULL,NULL,NULL),(2,'LAX','JFK','2023-08-02','2023-08-02','Scheduled',0.00,1,NULL,NULL,NULL,NULL),(3,'ORD','DFW','2023-08-01','2023-08-01','Scheduled',0.00,0,NULL,NULL,NULL,NULL),(4,'DFW','ORD','2023-08-02','2023-08-02','Scheduled',0.00,0,NULL,NULL,NULL,NULL),(5,'ATL','MIA','2023-08-01','2023-08-01','Scheduled',0.00,1,NULL,NULL,NULL,NULL),(6,'MIA','ATL','2023-08-02','2023-08-02','Scheduled',0.00,1,NULL,NULL,NULL,NULL),(7,'LHR','CDG','2023-08-01','2023-08-01','Scheduled',0.00,1,NULL,NULL,NULL,NULL),(8,'CDG','LHR','2023-08-02','2023-08-02','Scheduled',0.00,1,NULL,NULL,NULL,NULL),(9,'DXB','SYD','2023-08-01','2023-08-02','Scheduled',0.00,1,NULL,NULL,NULL,NULL),(10,'SYD','DXB','2023-08-03','2023-08-04','Scheduled',0.00,1,NULL,NULL,NULL,NULL),(12,'Paris Orly airport','Tunis Carthage airport','2024-07-30','2024-07-30','Scheduled',0.00,1,NULL,NULL,NULL,NULL),(13,'Italie','Espagne','2024-08-10','2024-08-11','Scheduled',0.00,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_reservations`
--

DROP TABLE IF EXISTS `hotel_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotel_reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hotel_id` int NOT NULL,
  `user_id` int NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `guests` int NOT NULL,
  `reservation_reference` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `hotel_reservations_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  CONSTRAINT `hotel_reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_reservations`
--

LOCK TABLES `hotel_reservations` WRITE;
/*!40000 ALTER TABLE `hotel_reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotel_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text,
  `price_per_night` decimal(10,2) NOT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `available_from` date NOT NULL DEFAULT '2024-01-01',
  `available_to` date NOT NULL DEFAULT '2024-12-31',
  `arrival_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (1,'Hotel Paris','Paris, France','A beautiful hotel located in the heart of Paris.',150.00,4.50,'https://example.com/image1.jpg','2024-01-01','2024-12-31','00:00:11'),(2,'Hotel Berlin','Berlin, Germany','A luxurious hotel with modern amenities.',200.00,4.80,'https://example.com/image2.jpg','2024-01-01','2024-12-31',NULL),(3,'Hotel New York','New York, USA','A comfortable hotel in the bustling city of New York.',180.00,4.20,'https://example.com/image3.jpg','2024-01-01','2024-12-31',NULL),(4,'Hotel Tokyo','Tokyo, Japan','A traditional hotel with a touch of modernity.',220.00,4.70,'https://example.com/image4.jpg','2024-01-01','2024-12-31',NULL),(5,'Hotel Sydney','Sydney, Australia','A wonderful hotel with a view of the Sydney Opera House.',250.00,4.90,'https://example.com/image5.jpg','2024-01-01','2024-12-31',NULL),(6,'Hotel Paris','Paris',NULL,100.00,NULL,NULL,'2024-07-01','2024-07-31',NULL),(7,'Hotel London','London',NULL,150.00,NULL,NULL,'2024-07-01','2024-07-31',NULL),(8,'Hotel New York','New York',NULL,200.00,NULL,NULL,'2024-07-01','2024-07-31',NULL);
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ma_reservation`
--

DROP TABLE IF EXISTS `ma_reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ma_reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `reservation_reference` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservation_reference` (`reservation_reference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ma_reservation`
--

LOCK TABLES `ma_reservation` WRITE;
/*!40000 ALTER TABLE `ma_reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `ma_reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `flight_id` int NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `flight_id` (`flight_id`),
  CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (1,1,20.00,'2024-07-01','2024-07-31'),(2,2,15.00,'2024-07-01','2024-07-31'),(3,3,25.00,'2024-07-01','2024-07-31'),(4,4,30.00,'2024-07-01','2024-07-31'),(5,5,10.00,'2024-07-01','2024-07-31'),(6,1,20.00,'2024-07-01','2024-07-31'),(7,2,15.00,'2024-07-01','2024-07-31'),(8,3,25.00,'2024-07-01','2024-07-31'),(9,4,30.00,'2024-07-01','2024-07-31'),(10,5,10.00,'2024-07-01','2024-07-31');
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `flight_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reservation_reference` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `reservation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `adults` int NOT NULL DEFAULT '0',
  `children` int NOT NULL DEFAULT '0',
  `infants` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `flight_id` (`flight_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,13,7,'cfe3f53751bc1006','moezlevioloniste@gmail.com','Bouali','Moez','0785040230','2024-08-02 13:57:23',NULL,NULL,2,1,0),(2,13,7,'c8022a6f24a2fedb','moezlevioloniste@gmail.com','Bouali','Moez','0785040230','2024-08-02 13:59:06',NULL,NULL,2,1,0);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Bouali','$2y$10$Gd6oAtgdnPzMgjqpmRBfJOlMhBkwcitzhE1MbuXdTjqXjLGfDhory','moez.bouali.levioloniste@gmail.com','2024-07-23 10:20:14','Moez','Bouali','0785040230','5b7d89fbbaf122c9f91fe97c33799de87531d9b4c660175d1650f654ac00a408bd470985be949f18a00b4e10565f3e50a52c','2024-08-01 23:29:05'),(2,'chervine','$2y$10$LD/A4KMn6JJg5r/kLXyWRu7RpcAhr3Ubef6YOG91xZDdPaZmrwA2C','chervine1999@gmail.com','2024-07-23 12:18:16','','','',NULL,NULL),(7,'paul','$2y$10$tlWFEHbP0Yeiu8pB110A9uMzSD8lxmKpWefVUfSMbyFEdSkia5jx6','moezlevioloniste@gmail.com','2024-08-01 20:36:46','Moez','Bouali','0785040230','de3b72ca344a11abf03c4479e79c40825eb86b79dc04fc6ec47433424e2a87f22428029a575bbaa3d143beccf2087741ccde','2024-08-01 23:41:56');
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

-- Dump completed on 2024-08-02 16:11:10
