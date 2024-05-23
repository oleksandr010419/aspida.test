2021-03-31T13:44:50+02:00:CREATE DATABASE aspidagames_test;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*INSERTING DATA INTO alidata*/



/*CREATING TABLE bank*/
CREATE TABLE `bank` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `gold` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*INSERTING DATA INTO fdata*/
INSERT INTO fdata VALUES ('1','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('101','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('201','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('7180','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('10856','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('13594','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('14920','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('20001','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20101','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('20201','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20202','0','3','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20301','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('29496','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*INSERTING DATA INTO users*/
INSERT INTO users VALUES ('2','Nature','','nature@gmail.com','4','XA','8','0','0','0','0000-00-00','','','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','1.00000','0','-386169','0','0','0','0','0','0','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','','','','');
INSERT INTO users VALUES ('3','Natars','0b9417e2b50c7f35d58472d712b2b3d3','natars@noreply.com','5','XA','2','0','0','0','0000-00-00','','','********************
					[#natars]
				********************','0','0','0','0','0','0','0','0','0','0','0','0','1617190911','0','0','0','0','0','0','0','1.00000','0','0','0','0','0','0','0','0','0','0','','0','0','0','1','0','0','0','0','0','0','0','0','','','','');
INSERT INTO users VALUES ('6','multihunter','dffd4a84f4a52c0595a7adf9f2fec658','aspidagames@gmail.com','1','XA','9','999999','0','0','0000-00-00','','','[#multihunter]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','1.00000','1617190989','0','0','0','0','0','1617190989','0','0','0','','0','0','0','1','1617190989','0','0','0','0','0','0','0','','','','');



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*INSERTING DATA INTO vdata*/
INSERT INTO vdata VALUES ('1','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190911','1','-100','100','3');
INSERT INTO vdata VALUES ('101','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190911','1','0','100','3');
INSERT INTO vdata VALUES ('201','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190911','1','100','100','3');
INSERT INTO vdata VALUES ('7180','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190989','1','44','65','3');
INSERT INTO vdata VALUES ('10856','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190989','1','-99','46','3');
INSERT INTO vdata VALUES ('13594','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190989','1','26','33','3');
INSERT INTO vdata VALUES ('14920','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190989','1','-55','26','3');
INSERT INTO vdata VALUES ('20001','6','Village Multihunter','0','2','1','0','0','750','750','750','8000','750','8000','1617190989','100.000000','0','0','0','1617190989','0','1','1','3');
INSERT INTO vdata VALUES ('20101','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190911','1','-100','0','4');
INSERT INTO vdata VALUES ('20201','2','Village Natureland','0','2','1','0','0','750','750','750','8000','750','8000','1617190989','100.000000','0','0','0','1617190989','0','0','0','3');
INSERT INTO vdata VALUES ('20202','3','Village Natars','1','888','1','0','0','750','750','750','8000','750','8000','1617190911','100.000000','0','0','0','1617190911','0','1','0','2');
INSERT INTO vdata VALUES ('20301','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190911','1','100','0','3');
INSERT INTO vdata VALUES ('29496','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190989','1','49','-46','3');
INSERT INTO vdata VALUES ('40201','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190911','1','-100','-100','3');
INSERT INTO vdata VALUES ('40301','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190911','1','0','-100','8');
INSERT INTO vdata VALUES ('40401','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617190911','1','100','-100','10');



/* THE END*/


2021-05-18T20:00:03+02:00:CREATE DATABASE aspidagames_test;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*INSERTING DATA INTO alidata*/



/*CREATING TABLE bank*/
CREATE TABLE `bank` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `gold` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*INSERTING DATA INTO fdata*/
INSERT INTO fdata VALUES ('1','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('101','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('201','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('211','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('465','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('2058','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('4349','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('9117','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('10418','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('10637','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('11254','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('11284','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('14727','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('15402','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('16172','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('16182','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('16391','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('16392','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('17189','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('17776','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('17779','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('17985','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18001','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18177','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18375','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18387','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18778','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18793','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18795','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18808','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18979','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('18999','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19000','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19182','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19185','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19197','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19586','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19594','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19603','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19611','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19809','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19812','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19983','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('19997','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20001','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20006','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20010','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20101','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('20201','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20202','0','3','0','4','0','4','0','1','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','15','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20301','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('20404','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20419','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20604','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20813','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('20997','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('21611','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('21617','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('21791','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('21797','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('21807','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('21811','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22196','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22206','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22404','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22413','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22602','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22622','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22813','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22818','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('22831','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('23215','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('23430','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('23620','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('23622','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('23813','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('24011','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('24200','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('24204','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('24216','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('24222','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('24412','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','10','27','0','0','0','0','0','0','1','15','0','0','10','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('24431','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','10','23','0','0','0','0','20','27','0','0','0','0','0','0','1','15','0','0','20','25','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('25283','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('26687','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('28362','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('31587','20','1','20','4','20','1','20','3','20','2','20','2','20','3','20','4','20','4','20','3','20','3','20','4','20','4','20','1','20','4','20','2','20','1','20','2','20','17','20','39','1','15','20','38','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','100','40','World Wonder');
INSERT INTO fdata VALUES ('33615','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('34104','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','20','15','20','10','10','22','10','25','0','0','0','0','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','40','World Wonder');
INSERT INTO fdata VALUES ('35352','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
INSERT INTO fdata VALUES ('37800','0','1','0','4','0','1','0','3','0','2','0','2','0','3','0','4','0','4','0','3','0','3','0','4','0','4','0','1','0','4','0','2','0','1','0','2','20','17','20','11','10','27','20','10','10','22','10','25','0','0','20','15','10','19','0','0','0','0','0','0','10','23','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','16','0','0','0','0','World Wonder');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*INSERTING DATA INTO users*/
INSERT INTO users VALUES ('2','Nature','','nature@gmail.com','4','XA','8','0','0','0','0000-00-00','','','','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','1.00000','0','-386169','0','0','0','0','0','0','0','0','','0','0','0','0','0','0','0','0','0','0','0','0','','','','');
INSERT INTO users VALUES ('3','Natars','0b9417e2b50c7f35d58472d712b2b3d3','natars@noreply.com','5','XA','2','0','0','0','0000-00-00','','','********************
					[#natars]
				********************','0','0','0','0','0','0','0','0','0','0','0','0','1617191093','0','0','0','0','0','0','0','230427.60938','1621264661','0','0','0','0','0','0','0','0','0','','0','0','0','1','0','0','0','0','0','0','0','0','','','','');
INSERT INTO users VALUES ('6','multihunter','dffd4a84f4a52c0595a7adf9f2fec658','aspidagames@gmail.com','1','XA','9','999999','0','0','0000-00-00','','','[#multihunter]','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','1.00000','1617346800','0','0','0','0','1','1617346800','0','0','0','','0','0','0','1','1617346800','0','0','0','0','0','0','0','','','','');



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*INSERTING DATA INTO vdata*/
INSERT INTO vdata VALUES ('1','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191093','1','-100','100','12');
INSERT INTO vdata VALUES ('101','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191093','1','0','100','5');
INSERT INTO vdata VALUES ('201','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191093','1','100','100','11');
INSERT INTO vdata VALUES ('211','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','-91','99','3');
INSERT INTO vdata VALUES ('465','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','-38','98','3');
INSERT INTO vdata VALUES ('2058','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','-53','90','3');
INSERT INTO vdata VALUES ('4349','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191174','1','27','79','3');
INSERT INTO vdata VALUES ('9117','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191173','1','-29','55','3');
INSERT INTO vdata VALUES ('10418','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191173','1','66','49','3');
INSERT INTO vdata VALUES ('10637','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','84','48','3');
INSERT INTO vdata VALUES ('11254','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','98','45','3');
INSERT INTO vdata VALUES ('11284','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','-73','44','3');
INSERT INTO vdata VALUES ('14727','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191173','1','-47','27','3');
INSERT INTO vdata VALUES ('15402','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','25','24','3');
INSERT INTO vdata VALUES ('16172','3','Tale of a Rat','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','-9','20','3');
INSERT INTO vdata VALUES ('16182','3','Golden Chariot','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','1','20','3');
INSERT INTO vdata VALUES ('16391','3','Generals Letter','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','9','19','3');
INSERT INTO vdata VALUES ('16392','3','Giant Marble Hammer','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','10','19','3');
INSERT INTO vdata VALUES ('17189','3','Declaration of War','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','3','15','3');
INSERT INTO vdata VALUES ('17776','3','Bottomless Satchel','0','163','1','0','0','750','750','750','8000','750','8000','1618243203','100.000000','0','0','0','1618243203','0','-13','12','3');
INSERT INTO vdata VALUES ('17779','3','Generals Letter','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','-10','12','3');
INSERT INTO vdata VALUES ('17985','3','Golden Chariot','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','-5','11','3');
INSERT INTO vdata VALUES ('18001','3','Pheidippides Sandals','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','11','11','3');
INSERT INTO vdata VALUES ('18177','3','Pendant of Mischief','0','163','1','0','0','750','750','750','8000','750','8000','1618243203','100.000000','0','0','0','1618243203','0','-14','10','3');
INSERT INTO vdata VALUES ('18375','3','Builders Sketch','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','-17','9','3');
INSERT INTO vdata VALUES ('18387','3','Silver Platter','0','163','1','0','0','750','750','750','8000','750','8000','1618243203','100.000000','0','0','0','1618243203','0','-5','9','3');
INSERT INTO vdata VALUES ('18778','3','Declaration of War','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','-16','7','3');
INSERT INTO vdata VALUES ('18793','3','Diamond Chisel','0','163','1','0','0','750','750','750','8000','750','8000','1618243203','100.000000','0','0','0','1618243203','0','-1','7','3');
INSERT INTO vdata VALUES ('18795','3','Babylonian Tablet','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','1','7','3');
INSERT INTO vdata VALUES ('18808','3','King Arthur\'s Chalice','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','14','7','3');
INSERT INTO vdata VALUES ('18979','3','Scribed Soldiers Oath','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','-16','6','3');
INSERT INTO vdata VALUES ('18999','3','Scribed Soldiers Oath','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','4','6','3');
INSERT INTO vdata VALUES ('19000','3','Tale of a Rat','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','5','6','3');
INSERT INTO vdata VALUES ('19182','3','Hemons Scrolls','0','163','1','0','0','750','750','750','8000','750','8000','1618243202','100.000000','0','0','0','1618243202','0','-14','5','3');
INSERT INTO vdata VALUES ('19185','3','Map of the Hidden Caverns','0','163','1','0','0','750','750','750','8000','750','8000','1618243203','100.000000','0','0','0','1618243203','0','-11','5','3');
INSERT INTO vdata VALUES ('19197','3','Silver Platter','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','1','5','3');
INSERT INTO vdata VALUES ('19586','3','Opal Horseshoe','0','163','1','0','0','750','750','750','8000','750','8000','1618243203','100.000000','0','0','0','1618243203','0','-12','3','3');
INSERT INTO vdata VALUES ('19594','3','Sacred Hunting Bow','0','163','1','0','0','750','750','750','8000','750','8000','1618243203','100.000000','0','0','0','1618243203','0','-4','3','3');
INSERT INTO vdata VALUES ('19603','3','Builders Sketch','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','5','3','3');
INSERT INTO vdata VALUES ('19611','3','Map of the Hidden Caverns','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','13','3','3');
INSERT INTO vdata VALUES ('19809','3','Opal Horseshoe','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','10','2','3');
INSERT INTO vdata VALUES ('19812','3','Sacred Hunting Bow','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','13','2','3');
INSERT INTO vdata VALUES ('19983','3','Giant Marble Hammer','0','163','1','0','0','750','750','750','8000','750','8000','1618243203','100.000000','0','0','0','1618243203','0','-17','1','3');
INSERT INTO vdata VALUES ('19997','3','Babylonian Tablet','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','-3','1','3');
INSERT INTO vdata VALUES ('20001','6','Village Multihunter','0','2','1','0','0','750','750','750','8000','750','8000','1617191174','100.000000','0','0','0','1617191174','0','1','1','3');
INSERT INTO vdata VALUES ('20006','3','Bottomless Satchel','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','6','1','3');
INSERT INTO vdata VALUES ('20010','3','Diamond Chisel','0','163','1','0','0','750','750','750','8000','750','8000','1618243204','100.000000','0','0','0','1618243204','0','10','1','3');
INSERT INTO vdata VALUES ('20101','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191093','1','-100','0','3');
INSERT INTO vdata VALUES ('20201','2','Village Natureland','0','2','1','0','0','750','750','750','8000','750','8000','1617191174','100.000000','0','0','0','1617191174','0','0','0','3');
INSERT INTO vdata VALUES ('20202','3','Village Natars','1','888','1','0','0','750','750','750','8000','750','8000','1617191093','100.000000','0','0','0','1617191093','0','1','0','8');
INSERT INTO vdata VALUES ('20301','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191093','1','100','0','2');
INSERT INTO vdata VALUES ('20404','3','Babylonian Tablet','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','2','-1','3');
INSERT INTO vdata VALUES ('20419','3','Golden Chariot','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','17','-1','3');
INSERT INTO vdata VALUES ('20604','3','Bottomless Satchel','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','1','-2','3');
INSERT INTO vdata VALUES ('20813','3','Diamond Chisel','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','9','-3','3');
INSERT INTO vdata VALUES ('20997','3','Giant Marble Hammer','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-8','-4','3');
INSERT INTO vdata VALUES ('21611','3','Builders Sketch','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','3','-7','3');
INSERT INTO vdata VALUES ('21617','3','Scribed Soldiers Oath','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','9','-7','3');
INSERT INTO vdata VALUES ('21791','3','Babylonian Tablet','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-18','-8','3');
INSERT INTO vdata VALUES ('21797','3','Forbidden Manuscript','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-12','-8','3');
INSERT INTO vdata VALUES ('21807','3','Sacred Hunting Bow','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-2','-8','3');
INSERT INTO vdata VALUES ('21811','3','Diary of Sun Tzu','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','2','-8','3');
INSERT INTO vdata VALUES ('22196','3','Diamond Chisel','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-15','-10','3');
INSERT INTO vdata VALUES ('22206','3','Golden Chariot','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-5','-10','3');
INSERT INTO vdata VALUES ('22404','3','Opal Horseshoe','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-8','-11','3');
INSERT INTO vdata VALUES ('22413','3','Declaration of War','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','1','-11','3');
INSERT INTO vdata VALUES ('22602','3','Declaration of War','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-11','-12','3');
INSERT INTO vdata VALUES ('22622','3','Generals Letter','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','9','-12','3');
INSERT INTO vdata VALUES ('22813','3','Builders Sketch','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-1','-13','3');
INSERT INTO vdata VALUES ('22818','3','Map of the Hidden Caverns','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','4','-13','3');
INSERT INTO vdata VALUES ('22831','3','Silver Platter','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','17','-13','3');
INSERT INTO vdata VALUES ('23215','3','Generals Letter','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-1','-15','3');
INSERT INTO vdata VALUES ('23430','3','Giant Marble Hammer','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','13','-16','3');
INSERT INTO vdata VALUES ('23620','3','Tale of a Rat','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','2','-17','3');
INSERT INTO vdata VALUES ('23622','3','Sacred Hunting Bow','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','4','-17','3');
INSERT INTO vdata VALUES ('23813','3','Scribed Soldiers Oath','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-6','-18','3');
INSERT INTO vdata VALUES ('24011','3','Tale of a Rat','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-9','-19','3');
INSERT INTO vdata VALUES ('24200','3','Bottomless Satchel','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-21','-20','3');
INSERT INTO vdata VALUES ('24204','3','Silver Platter','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-17','-20','3');
INSERT INTO vdata VALUES ('24216','3','Memoirs of Alexander the Great','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-5','-20','3');
INSERT INTO vdata VALUES ('24222','3','Opal Horseshoe','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','1','-20','3');
INSERT INTO vdata VALUES ('24412','3','Map of the Hidden Caverns','0','163','1','0','0','750','750','750','8000','750','8000','1618243206','100.000000','0','0','0','1618243206','0','-10','-21','3');
INSERT INTO vdata VALUES ('24431','3','Trojan Horse','0','163','1','0','0','750','750','750','8000','750','8000','1618243205','100.000000','0','0','0','1618243205','0','9','-21','3');
INSERT INTO vdata VALUES ('25283','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','57','-25','3');
INSERT INTO vdata VALUES ('26687','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','54','-32','3');
INSERT INTO vdata VALUES ('28362','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','-80','-41','3');
INSERT INTO vdata VALUES ('31587','3','World Wonder','0','1391','0','0','0','1449001','1449001','51228','2400000','2279178','2400000','1621301101','100.000000','0','0','0','1314968914','0','-71','-57','3');
INSERT INTO vdata VALUES ('33615','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','-53','-67','3');
INSERT INTO vdata VALUES ('34104','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191173','1','34','-69','3');
INSERT INTO vdata VALUES ('35352','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','76','-75','3');
INSERT INTO vdata VALUES ('37800','3','WW Buildingplan','0','230','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1314968914','0','-89','-88','3');
INSERT INTO vdata VALUES ('40201','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191093','1','-100','-100','10');
INSERT INTO vdata VALUES ('40301','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191094','1','0','-100','10');
INSERT INTO vdata VALUES ('40401','3','WW village','0','233','0','0','0','80000','80000','80000','80000','80000','80000','1314974534','100.000000','0','0','0','1617191093','1','100','-100','10');



/* THE END*/


