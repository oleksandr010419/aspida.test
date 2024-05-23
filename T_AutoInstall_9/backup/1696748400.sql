2023-10-14T18:53:36+02:00:CREATE DATABASE aspidagames_test;

/*CREATING TABLE alidata*/
CREATE TABLE `alidata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `leader` int(11) unsigned NOT NULL,
  `notice` text NOT NULL,
  `desc` text NOT NULL,
  `max` tinyint(2) unsigned NOT NULL,
  `ap` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `dp` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `Rc` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `RR` decimal(65,0) NOT NULL DEFAULT 0,
  `Aap` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `Adp` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `clp` decimal(65,0) NOT NULL DEFAULT 0,
  `oldrank` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*INSERTING DATA INTO alidata*/



/*CREATING TABLE bank*/
CREATE TABLE `bank` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `gold` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*INSERTING DATA INTO bank*/



/*CREATING TABLE fdata*/
CREATE TABLE `fdata` (
  `vref` int(11) unsigned NOT NULL,
  `f1` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f1t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f2` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f2t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f3` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f3t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f4` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f4t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f5` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f5t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f6` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f6t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f7` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f7t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f8` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f8t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f9` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f9t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f10` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f10t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f11` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f11t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f12` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f12t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f13` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f13t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f14` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f14t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f15` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f15t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f16` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f16t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f17` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f17t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f18` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f18t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f19` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f19t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f20` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f20t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f21` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f21t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f22` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f22t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f23` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f23t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f24` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f24t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f25` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f25t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f26` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f26t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f27` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f27t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f28` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f28t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f29` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f29t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f30` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f30t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f31` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f31t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f32` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f32t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f33` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f33t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f34` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f34t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f35` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f35t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f36` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f36t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f37` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f37t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f38` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f38t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f39` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f39t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f40` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f40t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f99` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `f99t` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `wwname` varchar(100) NOT NULL DEFAULT 'World Wonder',
  PRIMARY KEY (`vref`),
  KEY `vref` (`vref`),
  KEY `f99t` (`f99t`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*INSERTING DATA INTO fdata*/
INSERT INTO fdata VALUES ('1','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('101','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('201','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('1547','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('2452','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('3271','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('3591','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('20001','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20101','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('20201','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20202','0','3','0','1','0','1','0','3','0','1','0','4','0','4','0','3','0','3','0','2','0','2','0','3','0','1','0','4','0','4','0','2','0','4','0','4','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20301','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('33505','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('40201','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('40301','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('40401','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');



/*CREATING TABLE users*/
CREATE TABLE `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `IsoCountryCode` varchar(2) DEFAULT 'XA',
  `access` tinyint(1) unsigned NOT NULL DEFAULT 2,
  `gold` int(9) unsigned NOT NULL DEFAULT 0,
  `dgold` int(9) unsigned NOT NULL DEFAULT 0,
  `gender` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `location` text NOT NULL,
  `desc1` text NOT NULL,
  `desc2` text NOT NULL,
  `breceived` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `plus` int(11) unsigned NOT NULL DEFAULT 0,
  `b1` int(11) unsigned NOT NULL DEFAULT 0,
  `b2` int(11) unsigned NOT NULL DEFAULT 0,
  `b3` int(11) unsigned NOT NULL DEFAULT 0,
  `b4` int(11) unsigned NOT NULL DEFAULT 0,
  `a1` int(11) unsigned NOT NULL DEFAULT 0,
  `d1` int(11) unsigned NOT NULL DEFAULT 0,
  `goldclub` tinyint(1) unsigned NOT NULL,
  `sit1` smallint(5) unsigned NOT NULL DEFAULT 0,
  `sit2` smallint(5) unsigned NOT NULL DEFAULT 0,
  `alliance` smallint(5) unsigned NOT NULL DEFAULT 0,
  `timestamp` int(11) unsigned NOT NULL DEFAULT 0,
  `ap` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `apall` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `dp` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `dpall` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `herxp` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `merch` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `protect` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `cp` float(14,5) unsigned NOT NULL DEFAULT 1.00000,
  `lastupdate` int(11) unsigned NOT NULL,
  `RR` decimal(65,0) NOT NULL DEFAULT 0,
  `Rc` decimal(65,0) NOT NULL DEFAULT 0,
  `ok` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `clp` decimal(65,0) NOT NULL DEFAULT 0,
  `oldrank` decimal(65,0) unsigned NOT NULL DEFAULT 0,
  `regtime` int(11) unsigned NOT NULL DEFAULT 0,
  `logtime` int(11) unsigned NOT NULL DEFAULT 0,
  `invited` smallint(5) unsigned NOT NULL DEFAULT 0,
  `deleting` int(11) unsigned NOT NULL,
  `brewery` text NOT NULL,
  `silver` int(11) unsigned NOT NULL DEFAULT 0,
  `evasion` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `evasiontime` int(11) unsigned NOT NULL DEFAULT 0,
  `quest` tinyint(2) NOT NULL DEFAULT 1,
  `advtime` int(11) NOT NULL DEFAULT 0,
  `vote1` int(15) NOT NULL DEFAULT 0,
  `vote2` int(15) NOT NULL DEFAULT 0,
  `vote3` int(15) NOT NULL DEFAULT 0,
  `share_fb` int(15) NOT NULL DEFAULT 0,
  `share_tw` int(15) NOT NULL DEFAULT 0,
  `share_gp` int(15) NOT NULL DEFAULT 0,
  `messages_sent` int(15) NOT NULL DEFAULT 0,
  `vote1_link` varchar(128) DEFAULT NULL,
  `vote2_link` varchar(128) DEFAULT NULL,
  `vote3_link` varchar(128) DEFAULT NULL,
  `main_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `alliance` (`alliance`),
  KEY `IsoCountryCode` (`IsoCountryCode`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*INSERTING DATA INTO users*/
INSERT INTO users VALUES ('2','Nature','','nature@gmail.com','4','XA','8','0','0','0','0000-00-00','','','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','1.00000','0','-386169','0','0','0','0','0','0','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','','','','');
INSERT INTO users VALUES ('3','Natars','0b9417e2b50c7f35d58472d712b2b3d3','natars@noreply.com','5','XA','2','0','0','0','0000-00-00','','','********************
					[#natars]
				********************','0','0','0','0','0','0','0','0','0','0','0','0','1696701606','0','0','0','0','0','0','0','1.00000','0','0','0','0','0','0','0','0','0','0','','0','0','0','1','0','0','0','0','0','0','0','0','','','','');
INSERT INTO users VALUES ('6','multihunter','613ceb663e14a53cad3713448be8cbc1','aspidagames@gmail.com','1','XA','9','999999','0','0','0000-00-00','','','[#multihunter]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','1.00000','1696701687','0','0','0','0','1','1696701687','0','0','0','','0','0','0','1','1696701687','0','0','0','0','0','0','0','','','','');



/*CREATING TABLE vdata*/
CREATE TABLE `vdata` (
  `wref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `capital` tinyint(1) unsigned NOT NULL,
  `pop` int(11) unsigned NOT NULL,
  `cp` int(11) unsigned NOT NULL,
  `celebration` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0,
  `wood` decimal(65,0) NOT NULL,
  `clay` decimal(65,0) NOT NULL,
  `iron` decimal(65,0) NOT NULL,
  `maxstore` decimal(65,0) unsigned NOT NULL,
  `crop` decimal(65,0) NOT NULL,
  `maxcrop` decimal(65,0) unsigned NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  `loyalty` float(9,6) unsigned NOT NULL DEFAULT 100.000000,
  `exp1` int(11) NOT NULL,
  `exp2` int(11) NOT NULL,
  `exp3` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `natar` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `vx` int(11) NOT NULL,
  `vy` int(11) NOT NULL,
  `vtype` tinyint(2) NOT NULL,
  PRIMARY KEY (`wref`),
  KEY `owner` (`owner`),
  KEY `wref` (`wref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*INSERTING DATA INTO vdata*/
INSERT INTO vdata VALUES ('1','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701606','1','-100','100','3');
INSERT INTO vdata VALUES ('101','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701606','1','0','100','3');
INSERT INTO vdata VALUES ('201','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701606','1','100','100','3');
INSERT INTO vdata VALUES ('1547','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701687','1','39','93','3');
INSERT INTO vdata VALUES ('2452','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701687','1','-61','88','3');
INSERT INTO vdata VALUES ('3271','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701687','1','-46','84','3');
INSERT INTO vdata VALUES ('3591','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701687','1','73','83','3');
INSERT INTO vdata VALUES ('20001','6','Village Multihunter','0','2','1','0','0','750','750','750','8000','750','8000','1696701687','100.000000','0','0','0','1696701687','0','1','1','3');
INSERT INTO vdata VALUES ('20101','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701606','1','-100','0','3');
INSERT INTO vdata VALUES ('20201','2','Village Natureland','0','2','1','0','0','750','750','750','8000','750','8000','1696701687','100.000000','0','0','0','1696701687','0','0','0','3');
INSERT INTO vdata VALUES ('20202','3','Village Natars','1','888','1','0','0','750','750','750','8000','750','8000','1696701606','100.000000','0','0','0','1696701606','0','1','0','11');
INSERT INTO vdata VALUES ('20301','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701606','1','100','0','2');
INSERT INTO vdata VALUES ('33505','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701687','1','38','-66','3');
INSERT INTO vdata VALUES ('40201','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701606','1','-100','-100','2');
INSERT INTO vdata VALUES ('40301','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701606','1','0','-100','3');
INSERT INTO vdata VALUES ('40401','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1696701606','1','100','-100','11');



/* THE END*/


