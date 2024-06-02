<?php
$unitsbytype=array
('infantry'=>array(1,2,3,11,12,13,14,21,22,31,32,33,34,41,42,43,44,51,52,53,61,62,71,72,73,74),
'cavalry'=>array(4,5,6,15,16,23,24,25,26,35,36,45,46,54,55,56,63,64,65,66,75,76),
'siege'=>array(7,8,17,18,27,28,37,38,47,48,57,58,67,68,77,78),
'ram'=>array(7,17,27,47,57,67,77),
'catapult'=>array(8,18,28,48,58,68,78),
'expansion'=>array(9,10,19,20,29,30,39,40,49,50,59,60,69,70,79,80),
'scout'=>array(4,14,23,44,54,63,72),
'chief'=>array(9,19,29,49,59,69,79));
//Roman troops//unit tribe = 1
$u1=array('atk'=>40,'di'=>35,'dc'=>50,'wood'=>120,'clay'=>100,'iron'=>150,'crop'=>30,'pop'=>1,'speed'=>6,'time'=>1600,'cap'=>50);//Legionnaire
$u2=array('atk'=>30,'di'=>65,'dc'=>35,'wood'=>100,'clay'=>130,'iron'=>160,'crop'=>70,'pop'=>1,'speed'=>5,'time'=>1760,'cap'=>20);//Praetorian
$u3=array('atk'=>70,'di'=>40,'dc'=>25,'wood'=>150,'clay'=>160,'iron'=>210,'crop'=>80,'pop'=>1,'speed'=>7,'time'=>1920,'cap'=>50);//Imperian
$u4=array('atk'=>0,'di'=>20,'dc'=>10,'wood'=>140,'clay'=>160,'iron'=>20,'crop'=>40,'pop'=>2,'speed'=>16,'time'=>1360,'cap'=>0);//Equites Legati
$u5=array('atk'=>120,'di'=>65,'dc'=>50,'wood'=>550,'clay'=>440,'iron'=>320,'crop'=>100,'pop'=>3,'speed'=>14,'time'=>2640,'cap'=>100);//Equites Imperatoris
$u6=array('atk'=>180,'di'=>80,'dc'=>105,'wood'=>550,'clay'=>640,'iron'=>800,'crop'=>180,'pop'=>4,'speed'=>10,'time'=>3520,'cap'=>70);//Equites Caesaris
$u7=array('atk'=>60,'di'=>30,'dc'=>75,'wood'=>900,'clay'=>360,'iron'=>500,'crop'=>70,'pop'=>3,'speed'=>4,'time'=>4600,'cap'=>0);//Battering Ram
$u8=array('atk'=>75,'di'=>60,'dc'=>10,'wood'=>950,'clay'=>1350,'iron'=>600,'crop'=>90,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);//Fire Catapult
$u9=array('atk'=>50,'di'=>40,'dc'=>30,'wood'=>30750,'clay'=>27200,'iron'=>45000,'crop'=>37500,'pop'=>5,'speed'=>5,'time'=>90700,'cap'=>0);//Senator
$u10=array('atk'=>0,'di'=>80,'dc'=>80,'wood'=>5800,'clay'=>5300,'iron'=>7200,'crop'=>5500,'pop'=>1,'speed'=>5,'time'=>26900,'cap'=>3000);//Settler

//Teutonic troops - unit tribe = 2
$u11=array('atk'=>40,'di'=>20,'dc'=>5,'wood'=>95,'clay'=>75,'iron'=>40,'crop'=>40,'pop'=>1,'speed'=>7,'time'=>720,'cap'=>60);//Maceman
$u12=array('atk'=>10,'di'=>35,'dc'=>60,'wood'=>145,'clay'=>70,'iron'=>85,'crop'=>40,'pop'=>1,'speed'=>7,'time'=>1120,'cap'=>40);//Spearman
$u13=array('atk'=>60,'di'=>30,'dc'=>30,'wood'=>130,'clay'=>120,'iron'=>170,'crop'=>70,'pop'=>1,'speed'=>6,'time'=>1200,'cap'=>50);//Axeman
$u14=array('atk'=>0,'di'=>10,'dc'=>5,'wood'=>160,'clay'=>100,'iron'=>50,'crop'=>50,'pop'=>1,'speed'=>9,'time'=>1120,'cap'=>0);//Scout
$u15=array('atk'=>55,'di'=>100,'dc'=>40,'wood'=>370,'clay'=>270,'iron'=>290,'crop'=>75,'pop'=>2,'speed'=>10,'time'=>2400,'cap'=>110);//Paladin
$u16=array('atk'=>150,'di'=>50,'dc'=>75,'wood'=>450,'clay'=>515,'iron'=>480,'crop'=>80,'pop'=>3,'speed'=>9,'time'=>2960,'cap'=>80);//Teutonic Knight
$u17=array('atk'=>65,'di'=>30,'dc'=>80,'wood'=>1000,'clay'=>300,'iron'=>350,'crop'=>70,'pop'=>3,'speed'=>4,'time'=>4200,'cap'=>0);//Ram
$u18=array('atk'=>50,'di'=>60,'dc'=>10,'wood'=>900,'clay'=>1200,'iron'=>600,'crop'=>60,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);//Catapult
$u19=array('atk'=>40,'di'=>60,'dc'=>40,'wood'=>35500,'clay'=>26600,'iron'=>25000,'crop'=>27200,'pop'=>4,'speed'=>5,'time'=>70500,'cap'=>0);//Chief
$u20=array('atk'=>10,'di'=>80,'dc'=>80,'wood'=>7200,'clay'=>5500,'iron'=>5800,'crop'=>6500,'pop'=>1,'speed'=>5,'time'=>31000,'cap'=>3000);//Settler

//Gallic troops - unit tribe = 3
$u21=array('atk'=>15,'di'=>40,'dc'=>50,'wood'=>100,'clay'=>130,'iron'=>55,'crop'=>30,'pop'=>1,'speed'=>7,'time'=>1040,'cap'=>35);//Phalanx
$u22=array('atk'=>65,'di'=>35,'dc'=>20,'wood'=>140,'clay'=>150,'iron'=>185,'crop'=>60,'pop'=>1,'speed'=>6,'time'=>1440,'cap'=>45);//Swordsman
$u23=array('atk'=>0,'di'=>20,'dc'=>10,'wood'=>170,'clay'=>150,'iron'=>20,'crop'=>40,'pop'=>2,'speed'=>17,'time'=>1360,'cap'=>0);//Pathfinder
$u24=array('atk'=>90,'di'=>25,'dc'=>40,'wood'=>350,'clay'=>450,'iron'=>230,'crop'=>60,'pop'=>2,'speed'=>19,'time'=>2480,'cap'=>75);//Theutates Thunder
$u25=array('atk'=>45,'di'=>115,'dc'=>55,'wood'=>360,'clay'=>330,'iron'=>280,'crop'=>120,'pop'=>2,'speed'=>16,'time'=>2560,'cap'=>35);//Druidrider
$u26=array('atk'=>140,'di'=>50,'dc'=>165,'wood'=>500,'clay'=>620,'iron'=>675,'crop'=>170,'pop'=>3,'speed'=>13,'time'=>3120,'cap'=>65);//Haeduan
$u27=array('atk'=>50,'di'=>30,'dc'=>105,'wood'=>950,'clay'=>555,'iron'=>330,'crop'=>75,'pop'=>3,'speed'=>4,'time'=>5000,'cap'=>0);//Ram
$u28=array('atk'=>70,'di'=>45,'dc'=>10,'wood'=>960,'clay'=>1450,'iron'=>630,'crop'=>90,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);//Trebuchet
$u29=array('atk'=>40,'di'=>50,'dc'=>50,'wood'=>30750,'clay'=>45400,'iron'=>31000,'crop'=>37500,'pop'=>4,'speed'=>4,'time'=>90700,'cap'=>0);//Chieftain
$u30=array('atk'=>0,'di'=>80,'dc'=>80,'wood'=>5500,'clay'=>7000,'iron'=>5300,'crop'=>4900,'pop'=>1,'speed'=>5,'time'=>22700,'cap'=>3000);//Settler

//Egyptians - unit tribe = 6
$u51=array('atk'=>10,'di'=>30,'dc'=>20,'wood'=>45,'clay'=>60,'iron'=>30,'crop'=>15,'pop'=>1,'speed'=>7,'time'=>530,'cap'=>15);//Slave Militia
$u52=array('atk'=>30,'di'=>55,'dc'=>40,'wood'=>115,'clay'=>100,'iron'=>145,'crop'=>60,'pop'=>1,'speed'=>6,'time'=>1320,'cap'=>50);//Ash Warden
$u53=array('atk'=>65,'di'=>50,'dc'=>20,'wood'=>170,'clay'=>180,'iron'=>220,'crop'=>80,'pop'=>1,'speed'=>7,'time'=>1440,'cap'=>45);//Khopesh Warrior
$u54=array('atk'=>0,'di'=>20,'dc'=>10,'wood'=>170,'clay'=>150,'iron'=>20,'crop'=>40,'pop'=>2,'speed'=>16,'time'=>1360,'cap'=>0);//Sopdu Explorer -cav
$u55=array('atk'=>50,'di'=>110,'dc'=>50,'wood'=>360,'clay'=>330,'iron'=>280,'crop'=>120,'pop'=>2,'speed'=>15,'time'=>2560,'cap'=>50);//Anhur Guard
$u56=array('atk'=>110,'di'=>120,'dc'=>150,'wood'=>450,'clay'=>560,'iron'=>610,'crop'=>180,'pop'=>3,'speed'=>10,'time'=>2990,'cap'=>70);//Resheph Chariot
$u57=array('atk'=>55,'di'=>30,'dc'=>95,'wood'=>995,'clay'=>575,'iron'=>340,'crop'=>80,'pop'=>3,'speed'=>4,'time'=>4800,'cap'=>0);//Ram
$u58=array('atk'=>65,'di'=>55,'dc'=>10,'wood'=>980,'clay'=>1510,'iron'=>660,'crop'=>100,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);//Stone Catapult
$u59=array('atk'=>40,'di'=>50,'dc'=>50,'wood'=>34000,'clay'=>50000,'iron'=>34000,'crop'=>42000,'pop'=>4,'speed'=>5,'time'=>90700,'cap'=>0);//Nomarch
$u60=array('atk'=>0,'di'=>80,'dc'=>80,'wood'=>4560,'clay'=>5890,'iron'=>5370,'crop'=>4180,'pop'=>1,'speed'=>5,'time'=>24800,'cap'=>3000);//Settler

//huns - unit tribe = 7
$u61=array('atk'=>35,'di'=>40,'dc'=>30,'wood'=>130,'clay'=>80,'iron'=>40,'crop'=>40,'pop'=>1,'speed'=>6,'time'=>810,'cap'=>50);//Mercenary
$u62=array('atk'=>50,'di'=>30,'dc'=>10,'wood'=>140,'clay'=>110,'iron'=>60,'crop'=>40,'pop'=>1,'speed'=>6,'time'=>1120,'cap'=>30);//Bowman
$u63=array('atk'=>0,'di'=>20,'dc'=>10,'wood'=>170,'clay'=>150,'iron'=>20,'crop'=>40,'pop'=>2,'speed'=>19,'time'=>1360,'cap'=>0);//Spotter - cav
$u64=array('atk'=>120,'di'=>30,'dc'=>15,'wood'=>290,'clay'=>370,'iron'=>190,'crop'=>45,'pop'=>2,'speed'=>16,'time'=>2400,'cap'=>115);//Steppe Rider
$u65=array('atk'=>115,'di'=>80,'dc'=>70,'wood'=>320,'clay'=>350,'iron'=>330,'crop'=>50,'pop'=>2,'speed'=>16,'time'=>2480,'cap'=>105);//Marksman
$u66=array('atk'=>180,'di'=>60,'dc'=>40,'wood'=>450,'clay'=>560,'iron'=>610,'crop'=>140,'pop'=>3,'speed'=>14,'time'=>2990,'cap'=>80);//Marauder
$u67=array('atk'=>65,'di'=>30,'dc'=>90,'wood'=>1060,'clay'=>330,'iron'=>360,'crop'=>70,'pop'=>3,'speed'=>4,'time'=>4400,'cap'=>0);//Ram
$u68=array('atk'=>45,'di'=>55,'dc'=>10,'wood'=>950,'clay'=>1280,'iron'=>620,'crop'=>60,'pop'=>6,'speed'=>3,'time'=>9000,'cap'=>0);//Catapult
$u69=array('atk'=>40,'di'=>50,'dc'=>50,'wood'=>37200,'clay'=>27600,'iron'=>25200,'crop'=>27600,'pop'=>4,'speed'=>5,'time'=>90700,'cap'=>0);//Logades
$u70=array('atk'=>0,'di'=>80,'dc'=>80,'wood'=>6100,'clay'=>4600,'iron'=>4800,'crop'=>5400,'pop'=>1,'speed'=>5,'time'=>28950,'cap'=>3000);//Settler

//Spartans - tribe = 8
$u71 = array('atk'=>50, 'di'=>35, 'dc'=>30, 'wood'=>60, 'clay'=>110, 'iron'=>185, 'crop'=>110, 'pop'=>1, 'speed'=>6, 'time'=>1700, 'cap'=>60); // Hoplite
$u72 = array('atk'=>0, 'di'=>40, 'dc'=>22, 'wood'=>0, 'clay'=>185, 'iron'=>150, 'crop'=>35, 'pop'=>1, 'speed'=>9, 'time'=>1232, 'cap'=>0); // Sentinel
$u73 = array('atk'=>40, 'di'=>85, 'dc'=>45, 'wood'=>40, 'clay'=>145, 'iron'=>95, 'crop'=>245, 'pop'=>1, 'speed'=>8, 'time'=>1936, 'cap'=>40); // Shieldsman
$u74 = array('atk'=>90, 'di'=>55, 'dc'=>40, 'wood'=>50, 'clay'=>130, 'iron'=>200, 'crop'=>400, 'pop'=>1, 'speed'=>6, 'time'=>2112, 'cap'=>50); // Twinsteel Therion
$u75 = array('atk'=>55, 'di'=>120, 'dc'=>90, 'wood'=>110, 'clay'=>555, 'iron'=>445, 'crop'=>330, 'pop'=>2, 'speed'=>16, 'time'=>2816, 'cap'=>110); // Elpida Rider
$u76 = array('atk'=>195, 'di'=>80, 'dc'=>75, 'wood'=>80, 'clay'=>660, 'iron'=>495, 'crop'=>995, 'pop'=>3, 'speed'=>9, 'time'=>3432, 'cap'=>80); // Corinthian Crusher
$u77 = array('atk'=>65, 'di'=>30, 'dc'=>80, 'wood'=>0, 'clay'=>525, 'iron'=>260, 'crop'=>790, 'pop'=>3, 'speed'=>4, 'time'=>4620, 'cap'=>0); // Ram
$u78 = array('atk'=>50, 'di'=>60, 'dc'=>10, 'wood'=>0, 'clay'=>550, 'iron'=>1240, 'crop'=>825, 'pop'=>6, 'speed'=>3, 'time'=>9900, 'cap'=>0); // Ballista
$u79 = array('atk'=>40, 'di'=>60, 'dc'=>40, 'wood'=>0, 'clay'=>33450, 'iron'=>30665, 'crop'=>36240, 'pop'=>4, 'speed'=>4, 'time'=>77550, 'cap'=>0); // Ephor
$u80 = array('atk'=>10, 'di'=>80, 'dc'=>80, 'wood'=>3000, 'clay'=>5115, 'iron'=>5580, 'crop'=>6045, 'pop'=>1, 'speed'=>5, 'time'=>33700, 'cap'=>3000); // Settler


//Nature's troops - unit tribe = 4
$u31=array('atk'=>10,'di'=>25,'dc'=>20,'wood'=>85,'clay'=>75,'iron'=>120,'crop'=>25,'speed'=>7,'pop'=>1,'time'=>1600,'cap'=>45);
$u32=array('atk'=>20,'di'=>35,'dc'=>40,'wood'=>125,'clay'=>130,'iron'=>60,'crop'=>40,'speed'=>7,'pop'=>1,'time'=>1800,'cap'=>65);
$u33=array('atk'=>60,'di'=>40,'dc'=>60,'wood'=>140,'clay'=>150,'iron'=>40,'crop'=>60,'speed'=>6,'pop'=>1,'time'=>1900,'cap'=>80);
$u34=array('atk'=>10,'di'=>66,'dc'=>50,'wood'=>95,'clay'=>120,'iron'=>65,'crop'=>25,'speed'=>9,'pop'=>1,'time'=>2000,'cap'=>0);
$u35=array('atk'=>50,'di'=>70,'dc'=>33,'wood'=>250,'clay'=>200,'iron'=>125,'crop'=>45,'speed'=>10,'pop'=>2,'time'=>2000,'cap'=>120);
$u36=array('atk'=>100,'di'=>80,'dc'=>70,'wood'=>250,'clay'=>125,'iron'=>250,'crop'=>150,'speed'=>9,'pop'=>2,'time'=>2000,'cap'=>150);
$u37=array('atk'=>250,'di'=>140,'dc'=>200,'wood'=>250,'clay'=>220,'iron'=>135,'crop'=>50,'speed'=>4,'pop'=>3,'time'=>2000,'cap'=>125);
$u38=array('atk'=>450,'di'=>380,'dc'=>240,'wood'=>125,'clay'=>250,'iron'=>300,'crop'=>65,'speed'=>3,'pop'=>3,'time'=>2000,'cap'=>0);
$u39=array('atk'=>200,'di'=>170,'dc'=>250,'wood'=>350,'clay'=>350,'iron'=>125,'crop'=>80,'speed'=>5,'pop'=>3,'time'=>70500,'cap'=>0);
$u40=array('atk'=>600,'di'=>440,'dc'=>520,'wood'=>350,'clay'=>250,'iron'=>135,'crop'=>100,'speed'=>5,'pop'=>5,'time'=>31000,'cap'=>3000);

//Natarian troops - unit tribe = 5
$u41=array('atk'=>20,'di'=>35,'dc'=>50,'wood'=>105,'clay'=>110,'iron'=>85,'crop'=>50,'pop'=>1,'speed'=>10,'time'=>1100,'cap'=>25);//pop=1
$u42=array('atk'=>65,'di'=>30,'dc'=>10,'wood'=>95,'clay'=>145,'iron'=>100,'crop'=>55,'pop'=>1,'speed'=>9,'time'=>1300,'cap'=>55);//pop=1
$u43=array('atk'=>100,'di'=>90,'dc'=>75,'wood'=>125,'clay'=>165,'iron'=>130,'crop'=>75,'pop'=>1,'speed'=>15,'time'=>1500,'cap'=>60);//pop=1
$u44=array('atk'=>0,'di'=>10,'dc'=>0,'wood'=>50,'clay'=>25,'iron'=>20,'crop'=>5,'pop'=>2,'speed'=>20,'time'=>2200,'cap'=>0);//pop=2
$u45=array('atk'=>155,'di'=>80,'dc'=>50,'wood'=>150,'clay'=>205,'iron'=>135,'crop'=>85,'pop'=>2,'speed'=>22,'time'=>3000,'cap'=>80);//pop=2
$u46=array('atk'=>170,'di'=>140,'dc'=>80,'wood'=>175,'clay'=>230,'iron'=>200,'crop'=>100,'pop'=>2,'speed'=>20,'time'=>3450,'cap'=>45);//pop=2
$u47=array('atk'=>250,'di'=>120,'dc'=>150,'wood'=>225,'clay'=>255,'iron'=>230,'crop'=>125,'pop'=>3,'speed'=>17,'time'=>4000,'cap'=>55);//pop=3
$u48=array('atk'=>60,'di'=>45,'dc'=>10,'wood'=>1500,'clay'=>760,'iron'=>890,'crop'=>390,'pop'=>3,'speed'=>0,'time'=>0,'cap'=>0);//pop=0
$u49=array('atk'=>80,'di'=>50,'dc'=>50,'wood'=>37000,'clay'=>30000,'iron'=>32000,'crop'=>33500,'pop'=>5,'speed'=>0,'time'=>0,'cap'=>0);//pop=0
$u50=array('atk'=>30,'di'=>40,'dc'=>40,'wood'=>8000,'clay'=>8250,'iron'=>8500,'crop'=>5505,'pop'=>5,'speed'=>0,'time'=>0,'cap'=>0);//pop=0
$u99=array('atk'=>0,'di'=>0,'dc'=>0,'wood'=>20,'clay'=>30,'iron'=>10,'crop'=>20,'speed'=>0,'pop'=>1,'time'=>600,'cap'=>0);//pop=0
// Hero data base values and increase per point
$h1=array('atk'=>50,'atkp'=>54,'di'=>60,'dip'=>49,'dc'=>85,'dcp'=>62.5);
$h2=array('atk'=>40,'atkp'=>46.5,'di'=>100,'dip'=>75.5,'dc'=>60,'dcp'=>47.5);
$h3=array('atk'=>90,'atkp'=>74,'di'=>65,'dip'=>57,'dc'=>40,'dcp'=>42);
$h5=array('atk'=>150,'atkp'=>107.5,'di'=>100,'dip'=>73,'dc'=>85,'dcp'=>59);
$h6=array('atk'=>225,'atkp'=>147.5,'di'=>135,'dip'=>79,'dc'=>175,'dcp'=>99);
$h11=array('atk'=>50,'atkp'=>54,'di'=>35,'dip'=>49.5,'dc'=>10,'dcp'=>24);
$h12=array('atk'=>15,'atkp'=>34,'di'=>60,'dip'=>48,'dc'=>100,'dcp'=>70.5);
$h13=array('atk'=>75,'atkp'=>67.5,'di'=>50,'dip'=>47.5,'dc'=>50,'dcp'=>47.5);
$h15=array('atk'=>70,'atkp'=>64,'di'=>165,'dip'=>100,'dc'=>65,'dcp'=>39.5);
$h16=array('atk'=>190,'atkp'=>127.5,'di'=>85,'dip'=>58.5,'dc'=>125,'dcp'=>80);
$h21=array('atk'=>20,'atkp'=>37.5,'di'=>65,'dip'=>53,'dc'=>85,'dcp'=>62);
$h22=array('atk'=>80,'atkp'=>71,'di'=>60,'dip'=>54,'dc'=>35,'dcp'=>38);
$h24=array('atk'=>115,'atkp'=>87.5,'di'=>40,'dip'=>42,'dc'=>65,'dcp'=>57);
$h25=array('atk'=>55,'atkp'=>57.5,'di'=>190,'dip'=>108.5,'dc'=>90,'dcp'=>60.5);
$h26=array('atk'=>175,'atkp'=>121,'di'=>85,'dip'=>55,'dc'=>275,'dcp'=>145);
