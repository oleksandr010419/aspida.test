SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `a2b`;
CREATE TABLE IF NOT EXISTS `a2b` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ckey` varchar(255) NOT NULL,
  `time_check` int(11) unsigned NOT NULL DEFAULT '0',
  `to_vid` int(11) unsigned NOT NULL,
  `u1` decimal (65,0) NOT NULL,
  `u2` decimal (65,0) NOT NULL,
  `u3` decimal (65,0) NOT NULL,
  `u4` decimal (65,0) NOT NULL,
  `u5` decimal (65,0) NOT NULL,
  `u6` decimal (65,0) NOT NULL,
  `u7` decimal (65,0) NOT NULL,
  `u8` decimal (65,0) NOT NULL,
  `u9` decimal (65,0) NOT NULL,
  `u10` decimal (65,0) NOT NULL,
  `u11` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `add` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ckey` (`ckey`,`time_check`),
  KEY `to_vid` (`to_vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `abdata`;
CREATE TABLE IF NOT EXISTS `abdata` (
  `vref` int(11) unsigned NOT NULL,
  `a1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `achiev`;
CREATE TABLE IF NOT EXISTS `achiev` (
  `uid` int(11) NOT NULL,
  `a1` tinyint(3) NOT NULL DEFAULT '0',
  `a2` tinyint(3) NOT NULL DEFAULT '0',
  `a3` tinyint(3) NOT NULL DEFAULT '0',
  `a4` tinyint(3) NOT NULL DEFAULT '0',
  `a5` smallint(5) NOT NULL DEFAULT '0',
  `a6` tinyint(3) NOT NULL DEFAULT '0',
  `a7` tinyint(3) NOT NULL DEFAULT '0',
  `a8` tinyint(3) NOT NULL DEFAULT '0',
  `reward1` tinyint(1) NOT NULL DEFAULT '0',
  `reward2` tinyint(1) NOT NULL DEFAULT '0',
  `reward3` tinyint(1) NOT NULL DEFAULT '0',
  `reward4` tinyint(1) NOT NULL DEFAULT '0',
  `points` tinyint(3) NOT NULL DEFAULT '0',
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `activate`;
CREATE TABLE IF NOT EXISTS `activate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `IsoCountryCode` varchar(2) DEFAULT 'XA',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `act` varchar(10) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `location` tinyint(1) NOT NULL,
  `act2` varchar(10) NOT NULL,
  `ref` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `act` (`act`,`act2`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `adventure`;
CREATE TABLE IF NOT EXISTS `adventure` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(11) NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `dif` tinyint(1) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `x` smallint(4) NOT NULL DEFAULT '0',
  `y` smallint(4) NOT NULL DEFAULT '0',
  `time` int(11) unsigned NOT NULL,
  `end` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `time` (`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `alidata`;
CREATE TABLE IF NOT EXISTS `alidata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `leader` int(11) unsigned NOT NULL,
  `notice` text NOT NULL,
  `desc` text NOT NULL,
  `max` tinyint(2) unsigned NOT NULL,
  `ap` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `dp` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `Rc` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `RR` decimal (65,0) NOT NULL DEFAULT '0',
  `Aap` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `Adp` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `clp` decimal (65,0) NOT NULL DEFAULT '0',
  `oldrank` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ali_invite`;
CREATE TABLE IF NOT EXISTS `ali_invite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `accept` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ali_log`;
CREATE TABLE IF NOT EXISTS `ali_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ali_permission`;
CREATE TABLE IF NOT EXISTS `ali_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `rank` varchar(100) NOT NULL,
  `opt1` int(1) unsigned NOT NULL DEFAULT '0',
  `opt2` int(1) unsigned NOT NULL DEFAULT '0',
  `opt3` int(1) unsigned NOT NULL DEFAULT '0',
  `opt4` int(1) unsigned NOT NULL DEFAULT '0',
  `opt5` int(1) unsigned NOT NULL DEFAULT '0',
  `opt6` int(1) unsigned NOT NULL DEFAULT '0',
  `opt7` int(1) unsigned NOT NULL DEFAULT '0',
  `opt8` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `artefacts`;
CREATE TABLE IF NOT EXISTS `artefacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `size` tinyint(1) unsigned NOT NULL,
  `conquered` int(11) unsigned NOT NULL,
  `cooldown` int(11) NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `effect` VARCHAR(6) NULL DEFAULT '0_0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `attacks`;
CREATE TABLE IF NOT EXISTS `attacks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `t1` decimal (65,0) NOT NULL,
  `t2` decimal (65,0) NOT NULL,
  `t3` decimal (65,0) NOT NULL,
  `t4` decimal (65,0) NOT NULL,
  `t5` decimal (65,0) NOT NULL,
  `t6` decimal (65,0) NOT NULL,
  `t7` decimal (65,0) NOT NULL,
  `t8` decimal (65,0) NOT NULL,
  `t9` int(11) NOT NULL,
  `t10` int(11) NOT NULL,
  `t11` int(11) NOT NULL,
  `attack_type` tinyint(1) NOT NULL,
  `ctar1` tinyint(3) NOT NULL,
  `ctar2` tinyint(3) NOT NULL,
  `spy` tinyint(3) NOT NULL,
  `artefact` smallint(3) NOT NULL DEFAULT '0',
  `add` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vref` (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `auction`;
CREATE TABLE IF NOT EXISTS `auction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `itemid` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `btype` int(11) unsigned NOT NULL,
  `type` int(11) unsigned NOT NULL,
  `num` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `bids` int(11) NOT NULL,
  `silver` int(11) NOT NULL,
  `newsilver` int(11) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `finish` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `gold` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `bdata`;
CREATE TABLE IF NOT EXISTS `bdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) unsigned NOT NULL,
  `field` tinyint(2) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `loopcon` tinyint(1) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  `master` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `master` (`master`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `CountryTbl`;
CREATE TABLE IF NOT EXISTS `CountryTbl` (
  `IsoCountryCode` varchar(2) DEFAULT NULL,
  `ISO3` varchar(3) DEFAULT NULL,
  `ISONumeric` smallint(5) unsigned DEFAULT NULL,
  `Country` varchar(250) DEFAULT NULL,
  UNIQUE KEY `IsoCountryCode` (`IsoCountryCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `critical_log`;
CREATE TABLE IF NOT EXISTS `critical_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work` varchar(30) NOT NULL,
  `work_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `daily_quests`;
CREATE TABLE IF NOT EXISTS `daily_quests` (
  `userId` int(255) NOT NULL,
  `adventure` int(255) NOT NULL,
  `raid_oasis` int(255) NOT NULL DEFAULT '0',
  `raid_attack_natars` int(255) NOT NULL DEFAULT '0',
  `auction` int(255) NOT NULL DEFAULT '0',
  `gain_spend_gold` int(255) NOT NULL DEFAULT '0',
  `upgrade_building` int(255) NOT NULL DEFAULT '0',
  `upgrade_resource` int(255) NOT NULL DEFAULT '0',
  `build_infantry` int(255) NOT NULL DEFAULT '0',
  `build_cavalry` int(255) NOT NULL DEFAULT '0',
  `celebration` int(255) NOT NULL DEFAULT '0',
  `vote` int(255) NOT NULL DEFAULT '0',
  `reward1` int(255) NOT NULL DEFAULT '0',
  `reward2` int(255) NOT NULL DEFAULT '0',
  `reward3` int(255) NOT NULL DEFAULT '0',
  `reward4` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `demolition`;
CREATE TABLE IF NOT EXISTS `demolition` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `buildnumber` int(11) unsigned NOT NULL DEFAULT '0',
  `timetofinish` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `diplomacy`;
CREATE TABLE IF NOT EXISTS `diplomacy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alli1` int(11) unsigned NOT NULL,
  `alli2` int(11) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `enforcement`;
CREATE TABLE IF NOT EXISTS `enforcement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u1` decimal (65,0) NOT NULL DEFAULT '0',
  `u2` decimal (65,0) NOT NULL DEFAULT '0',
  `u3` decimal (65,0) NOT NULL DEFAULT '0',
  `u4` decimal (65,0) NOT NULL DEFAULT '0',
  `u5` decimal (65,0) NOT NULL DEFAULT '0',
  `u6` decimal (65,0) NOT NULL DEFAULT '0',
  `u7` decimal (65,0) NOT NULL DEFAULT '0',
  `u8` decimal (65,0) NOT NULL DEFAULT '0',
  `u9` int(11) NOT NULL DEFAULT '0',
  `u10` int(11) NOT NULL DEFAULT '0',
  `u11` tinyint(1) NOT NULL DEFAULT '0',
  `from` int(11) unsigned NOT NULL DEFAULT '0',
  `vref` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `from` (`from`),
  KEY `vref` (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `farmlist`;
CREATE TABLE IF NOT EXISTS `farmlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `laststart` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `fdata`;
CREATE TABLE IF NOT EXISTS `fdata` (
  `vref` int(11) unsigned NOT NULL,
  `f1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f1t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f2t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f3t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f4t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f5t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f6t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f7t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f8t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f9` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f9t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f10` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f10t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f11` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f11t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f12` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f12t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f13` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f13t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f14` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f14t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f15` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f15t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f16` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f16t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f17` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f17t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f18` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f18t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f19` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f19t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f20` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f20t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f21` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f21t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f22` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f22t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f23` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f23t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f24` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f24t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f25` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f25t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f26` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f26t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f27` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f27t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f28` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f28t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f29` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f29t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f30` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f30t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f31` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f31t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f32` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f32t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f33` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f33t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f34` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f34t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f35` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f35t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f36` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f36t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f37` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f37t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f38` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f38t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f39` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f39t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f40` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f40t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f99` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f99t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `wwname` varchar(100) NOT NULL DEFAULT 'World Wonder',
  PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `hero`;
CREATE TABLE IF NOT EXISTS `hero` (
  `heroid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `wref` int(11) unsigned NOT NULL,
  `level` mediumint(3) unsigned NOT NULL,
  `speed` int(2) unsigned NOT NULL,
  `points` int(3) unsigned NOT NULL,
  `experience` decimal (65,0) NOT NULL,
  `dead` tinyint(1) NOT NULL,
  `health` float(12,9) unsigned NOT NULL,
  `power` int(11) unsigned NOT NULL,
  `itempower` int(11) unsigned NOT NULL,
  `offBonus` tinyint(3) unsigned NOT NULL,
  `defBonus` tinyint(3) unsigned NOT NULL,
  `product` tinyint(3) unsigned NOT NULL,
  `r0` tinyint(1) unsigned NOT NULL,
  `r1` tinyint(1) unsigned NOT NULL,
  `r2` tinyint(1) unsigned NOT NULL,
  `r3` tinyint(1) unsigned NOT NULL,
  `r4` tinyint(1) unsigned NOT NULL,
  `autoregen` tinyint(3) NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  `lastadv` int(11) unsigned NOT NULL,
  `hash` varchar(45) NOT NULL,
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `revivetime` int(11) NOT NULL,
  PRIMARY KEY (`heroid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `heroface`;
CREATE TABLE IF NOT EXISTS `heroface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `beard` smallint(2) NOT NULL,
  `ear` smallint(2) NOT NULL,
  `eye` smallint(2) NOT NULL,
  `eyebrow` smallint(2) NOT NULL,
  `face` smallint(2) NOT NULL,
  `hair` smallint(2) NOT NULL,
  `mouth` smallint(2) NOT NULL,
  `nose` smallint(2) NOT NULL,
  `color` smallint(2) NOT NULL,
  `foot` int(3) unsigned NOT NULL,
  `helmet` int(3) unsigned NOT NULL,
  `horse` int(3) unsigned NOT NULL,
  `leftHand` int(3) NOT NULL,
  `rightHand` int(3) NOT NULL,
  `body` int(3) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `heroinventory`;
CREATE TABLE IF NOT EXISTS `heroinventory` (
  `uid` smallint(5) unsigned NOT NULL,
  `helmet` int(11) NOT NULL,
  `leftHand` int(11) NOT NULL,
  `rightHand` int(11) NOT NULL,
  `body` int(11) NOT NULL,
  `horse` int(11) NOT NULL,
  `shoes` int(11) NOT NULL,
  `bag` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `heroitems`;
CREATE TABLE IF NOT EXISTS `heroitems` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `btype` int(11) unsigned NOT NULL,
  `type` int(11) unsigned NOT NULL,
  `num` decimal (65,0) NOT NULL,
  `proc` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `pos` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `email` varchar(30) NOT NULL,
  `gold` int(11) unsigned NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `server` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `map_control`;
CREATE TABLE IF NOT EXISTS `map_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` smallint(5) NOT NULL,
  `hash` text NOT NULL,
  `x0` smallint(4) NOT NULL,
  `x1` smallint(4) NOT NULL,
  `y0` smallint(4) NOT NULL,
  `y1` smallint(4) NOT NULL,
  `version` smallint(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `market`;
CREATE TABLE IF NOT EXISTS `market` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `gtype` tinyint(1) unsigned NOT NULL,
  `gamt` int(11) unsigned NOT NULL,
  `wtype` tinyint(1) unsigned NOT NULL,
  `wamt` int(11) unsigned NOT NULL,
  `ratio` VARCHAR(4) NULL,
  `accept` tinyint(1) unsigned NOT NULL,
  `maxtime` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `merchant` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `mdata`;
CREATE TABLE IF NOT EXISTS `mdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `target` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `topic` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `viewed` tinyint(1) unsigned NOT NULL,
  `send` tinyint(1) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `deltarget` int(11) unsigned NOT NULL,
  `delowner` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `player` int(11) unsigned NOT NULL,
  `coor` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`),
  KEY `target` (`target`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `medal`;
CREATE TABLE IF NOT EXISTS `medal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `categorie` int(11) unsigned NOT NULL,
  `plaats` int(11) unsigned NOT NULL,
  `week` int(11) unsigned NOT NULL,
  `points` varchar(15) NOT NULL,
  `img` varchar(10) NOT NULL,
  `allycheck` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `movement`;
CREATE TABLE IF NOT EXISTS `movement` (
  `moveid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort_type` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `from` int(11) unsigned NOT NULL DEFAULT '0',
  `to` int(11) unsigned NOT NULL DEFAULT '0',
  `ref` int(11) unsigned NOT NULL DEFAULT '0',
  `merchant` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `starttime` int(11) unsigned NOT NULL DEFAULT '0',
  `endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `proc` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `send` tinyint(1) unsigned NOT NULL,
  `wood` decimal (65,0) unsigned NOT NULL,
  `clay` decimal (65,0) unsigned NOT NULL,
  `iron` decimal (65,0) unsigned NOT NULL,
  `crop` decimal (65,0) unsigned NOT NULL,
  PRIMARY KEY (`moveid`),
  UNIQUE KEY `from_2` (`from`,`ref`),
  KEY `from` (`from`),
  KEY `to` (`to`),
  KEY `ref` (`ref`),
  KEY `proc` (`proc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ndata`;
CREATE TABLE IF NOT EXISTS `ndata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `toWref` int(11) unsigned NOT NULL,
  `ally` int(11) unsigned NOT NULL,
  `ntype` tinyint(1) unsigned NOT NULL,
  `data` text NOT NULL,
  `data1` text NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `viewed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `del` tinyint(1) unsigned NOT NULL,
  `topic` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `toWref` (`toWref`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `newproc`;
CREATE TABLE IF NOT EXISTS `newproc` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `npw` varchar(45) NOT NULL,
  `nemail` varchar(45) NOT NULL,
  `act` varchar(10) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `proc` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `odata`;
CREATE TABLE IF NOT EXISTS `odata` (
  `wref` int(11) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `conqured` int(11) unsigned NOT NULL,
  `wood` int(11) unsigned NOT NULL,
  `iron` int(11) unsigned NOT NULL,
  `clay` int(11) unsigned NOT NULL,
  `maxstore` int(11) unsigned NOT NULL,
  `crop` int(11) unsigned NOT NULL,
  `maxcrop` int(11) unsigned NOT NULL,
  `lastupdated` int(11) unsigned NOT NULL,
  `loyalty` int(11) NOT NULL DEFAULT '100',
  `owner` int(11) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`wref`),
  KEY `owner` (`owner`),
  KEY `conqured` (`conqured`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `online`;
CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `time` varchar(32) NOT NULL,
  `sit` tinyint(1) unsigned NOT NULL,
  `sessid` varchar(100) NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `operation`;
CREATE TABLE IF NOT EXISTS `operation` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `code` text NOT NULL,
  `gold` int(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` int(16) NOT NULL,
  `status` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `palevo`;
CREATE TABLE IF NOT EXISTS `palevo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `infa` text NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `from` text NOT NULL,
  `browser` text NOT NULL,
  `sit` tinyint(1) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `password`;
CREATE TABLE IF NOT EXISTS `password` (
  `uid` int(11) unsigned NOT NULL,
  `npw` varchar(100) NOT NULL,
  `cpw` varchar(100) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `prisoners`;
CREATE TABLE IF NOT EXISTS `prisoners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  `t11` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `queue`;
CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jobID` int(11) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `finish` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `if1` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `raidlist`;
CREATE TABLE IF NOT EXISTS `raidlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `towref` int(11) unsigned NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `distance` varchar(5) NOT NULL DEFAULT '0',
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`lid`,`towref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `referals`;
CREATE TABLE IF NOT EXISTS `referals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `referer` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `research`;
CREATE TABLE IF NOT EXISTS `research` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `tech` varchar(3) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `wid` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `wood` int(5) unsigned NOT NULL,
  `clay` int(5) unsigned NOT NULL,
  `iron` int(5) unsigned NOT NULL,
  `crop` int(5) unsigned NOT NULL,
  `start` tinyint(2) unsigned NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `deliveries` tinyint(1) unsigned NOT NULL,
  `deliveries_done` int(11) unsigned NOT NULL,
  `merchant` int(11) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `timetogo` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `sitters`;
CREATE TABLE IF NOT EXISTS `sitters` (
  `uid` mediumint(5) NOT NULL,
  `s1` int(11) NOT NULL DEFAULT '1',
  `s2` int(11) NOT NULL DEFAULT '1',
  `s3` int(11) NOT NULL DEFAULT '1',
  `s4` int(11) NOT NULL DEFAULT '0',
  `s5` int(11) NOT NULL DEFAULT '1',
  `s6` int(11) NOT NULL DEFAULT '0',
  `s21` int(11) NOT NULL DEFAULT '1',
  `s22` int(11) NOT NULL DEFAULT '1',
  `s23` int(11) NOT NULL DEFAULT '1',
  `s24` int(11) NOT NULL DEFAULT '0',
  `s25` int(11) NOT NULL DEFAULT '1',
  `s26` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `spravka`;
CREATE TABLE IF NOT EXISTS `spravka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `tdata`;
CREATE TABLE IF NOT EXISTS `tdata` (
  `vref` int(11) unsigned NOT NULL,
  `t2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t4` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t5` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t6` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t7` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t8` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t9` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `training`;
CREATE TABLE IF NOT EXISTS `training` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `unit` int(3) unsigned NOT NULL,
  `amt` decimal (65,0) NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL,
  `eachtime` decimal(10,5) unsigned NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vref` (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `vref` int(11) unsigned NOT NULL,
  `u1` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u2` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u3` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u4` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u5` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u6` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u7` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u8` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u9` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u10` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u11` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `u99` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  `o99` decimal (65,0) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `update_check`;
CREATE TABLE IF NOT EXISTS `update_check` (
  `uid` smallint(5) NOT NULL,
  `code` varchar(20) NOT NULL,
  `ckey` varchar(20) NOT NULL,
  `source` varchar(255) NOT NULL,
  UNIQUE KEY `code` (`uid`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `IsoCountryCode` varchar(2) DEFAULT 'XA',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `gold` int(9) unsigned NOT NULL DEFAULT '0',
  `dgold` int(9) unsigned NOT NULL DEFAULT '0',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `location` text NOT NULL,
  `desc1` text NOT NULL,
  `desc2` text NOT NULL,
  `breceived` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `plus` int(11) unsigned NOT NULL DEFAULT '0',
  `b1` int(11) unsigned NOT NULL DEFAULT '0',
  `b2` int(11) unsigned NOT NULL DEFAULT '0',
  `b3` int(11) unsigned NOT NULL DEFAULT '0',
  `b4` int(11) unsigned NOT NULL DEFAULT '0',
  `a1` int(11) unsigned NOT NULL DEFAULT '0',
  `d1` int(11) unsigned NOT NULL DEFAULT '0',
  `goldclub` tinyint(1) unsigned NOT NULL,
  `sit1` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sit2` smallint(5) unsigned NOT NULL DEFAULT '0',
  `alliance` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `ap` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `apall` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `dp` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `dpall` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `herxp` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `merch` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `protect` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `cp` float(14,5) unsigned NOT NULL DEFAULT '1.00000',
  `lastupdate` int(11) unsigned NOT NULL,
  `RR` decimal (65,0) NOT NULL DEFAULT '0',
  `Rc` decimal (65,0) NOT NULL DEFAULT '0',
  `ok` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `clp` decimal (65,0) NOT NULL DEFAULT '0',
  `oldrank` decimal (65,0) unsigned NOT NULL DEFAULT '0',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0',
  `logtime` int(11) unsigned NOT NULL DEFAULT '0',
  `invited` smallint(5) unsigned NOT NULL DEFAULT '0',
  `deleting` int(11) unsigned NOT NULL,
  `brewery` text NOT NULL,
  `silver` int(11) unsigned NOT NULL DEFAULT '0',
  `evasion` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `evasiontime` int(11) unsigned NOT NULL DEFAULT '0',
  `quest` tinyint(2) NOT NULL DEFAULT '1',
  `advtime` int(11) NOT NULL DEFAULT '0',
  `vote1` int(15) NOT NULL DEFAULT '0',
  `vote2` int(15) NOT NULL DEFAULT '0',
  `vote3` int(15) NOT NULL DEFAULT '0',
  `share_fb` int(15) NOT NULL DEFAULT '0',
  `share_tw` int(15) NOT NULL DEFAULT '0',
  `share_gp` int(15) NOT NULL DEFAULT '0',  
  `messages_sent` int(15) NOT NULL DEFAULT '0',
  `vote1_link` VARCHAR(128) NULL, 
  `vote2_link` VARCHAR(128) NULL, 
  `vote3_link` VARCHAR(128) NULL,
  `main_id` int(11) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `alliance` (`alliance`),
  KEY `IsoCountryCode` (`IsoCountryCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `vdata`;
CREATE TABLE IF NOT EXISTS `vdata` (
  `wref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `capital` tinyint(1) unsigned NOT NULL,
  `pop` int(11) unsigned NOT NULL,
  `cp` int(11) unsigned NOT NULL,
  `celebration` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `wood` decimal (65,0) NOT NULL,
  `clay` decimal (65,0) NOT NULL,
  `iron` decimal (65,0) NOT NULL,
  `maxstore` decimal (65,0) unsigned NOT NULL,
  `crop` decimal (65,0) NOT NULL,
  `maxcrop` decimal (65,0) unsigned NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  `loyalty` float(9,6) unsigned NOT NULL DEFAULT '100.000000',
  `exp1` int(11) NOT NULL,
  `exp2` int(11) NOT NULL,
  `exp3` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `natar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vx` int(11) NOT NULL,
  `vy` int(11) NOT NULL,
  `vtype` tinyint(2) NOT NULL,
  PRIMARY KEY (`wref`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `wdata`;
CREATE TABLE IF NOT EXISTS `wdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fieldtype` tinyint(2) unsigned NOT NULL,
  `oasistype` tinyint(2) unsigned NOT NULL,
  `x` smallint(5) NOT NULL,
  `y` smallint(5) NOT NULL,
  `occupied` tinyint(1) NOT NULL,
  `image` varchar(3) NOT NULL,
  `oasisimg` tinyint(1) NOT NULL DEFAULT '0',
  `partimg` varchar(30) NOT NULL,
  `adv` tinyint(1) NOT NULL DEFAULT '0',
  `type_of` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x` (`x`,`y`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `antimult`;
CREATE TABLE IF NOT EXISTS `antimult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(40) CHARACTER SET latin1 NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `buygold`;
CREATE TABLE IF NOT EXISTS `buygold` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `tarif` varchar(1) NOT NULL,
  `gold` int(11) unsigned NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `status` (
  `isFinished` tinyint(4) NOT NULL DEFAULT '0',
  `finishedTime` int(14) unsigned DEFAULT NULL,
  `restartTime` int(14) unsigned DEFAULT NULL,
  UNIQUE KEY `isFinished_2` (`isFinished`),
  KEY `isFinished` (`isFinished`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `banlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reason` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `end` varchar(10) NOT NULL,
  `admin` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ip_log` (
  `ip` varchar(16) CHARACTER SET latin1 NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`ip`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `CountryTbl`(`IsoCountryCode`,`ISO3`,`ISONumeric`,`Country`) values 
('AD','AND',20,'Andorra'),
('AE','ARE',784,'United Arab Emirates'),
('AF','AFG',4,'Afghanistan'),
('AG','ATG',28,'Antigua and Barbuda'),
('AI','AIA',660,'Anguilla'),
('AL','ALB',8,'Albania'),
('AM','ARM',51,'Armenia'),
('AO','AGO',24,'Angola'),
('AQ','ATA',10,'Antarctica'),
('AR','ARG',32,'Argentina'),
('AS','ASM',16,'American Samoa'),
('AT','AUT',40,'Austria'),
('AU','AUS',36,'Australia'),
('AW','ABW',533,'Aruba'),
('AX','ALA',248,'Aland Islands'),
('AZ','AZE',31,'Azerbaijan'),
('BA','BIH',70,'Bosnia and Herzegovina'),
('BB','BRB',52,'Barbados'),
('BD','BGD',50,'Bangladesh'),
('BE','BEL',56,'Belgium'),
('BF','BFA',854,'Burkina Faso'),
('BG','BGR',100,'Bulgaria'),
('BH','BHR',48,'Bahrain'),
('BI','BDI',108,'Burundi'),
('BJ','BEN',204,'Benin'),
('BL','BLM',652,'Saint Barthelemy'),
('BM','BMU',60,'Bermuda'),
('BN','BRN',96,'Brunei'),
('BO','BOL',68,'Bolivia'),
('BQ','BES',535,'Bonaire, Saint Eustatius and Saba'),
('BR','BRA',76,'Brazil'),
('BS','BHS',44,'Bahamas'),
('BT','BTN',64,'Bhutan'),
('BV','BVT',74,'Bouvet Island'),
('BW','BWA',72,'Botswana'),
('BY','BLR',112,'Belarus'),
('BZ','BLZ',84,'Belize'),
('CA','CAN',124,'Canada'),
('CC','CCK',166,'Cocos Islands'),
('CD','COD',180,'Democratic Republic of the Congo'),
('CF','CAF',140,'Central African Republic'),
('CG','COG',178,'Republic of the Congo'),
('CH','CHE',756,'Switzerland'),
('CI','CIV',384,'Ivory Coast'),
('CK','COK',184,'Cook Islands'),
('CL','CHL',152,'Chile'),
('CM','CMR',120,'Cameroon'),
('CN','CHN',156,'China'),
('CO','COL',170,'Colombia'),
('CR','CRI',188,'Costa Rica'),
('CU','CUB',192,'Cuba'),
('CV','CPV',132,'Cape Verde'),
('CW','CUW',531,'Curacao'),
('CX','CXR',162,'Christmas Island'),
('CY','CYP',196,'Cyprus'),
('CZ','CZE',203,'Czech Republic'),
('DE','DEU',276,'Germany'),
('DJ','DJI',262,'Djibouti'),
('DK','DNK',208,'Denmark'),
('DM','DMA',212,'Dominica'),
('DO','DOM',214,'Dominican Republic'),
('DZ','DZA',12,'Algeria'),
('EC','ECU',218,'Ecuador'),
('EE','EST',233,'Estonia'),
('EG','EGY',818,'Egypt'),
('EH','ESH',732,'Western Sahara'),
('ER','ERI',232,'Eritrea'),
('ES','ESP',724,'Spain'),
('ET','ETH',231,'Ethiopia'),
('FI','FIN',246,'Finland'),
('FJ','FJI',242,'Fiji'),
('FK','FLK',238,'Falkland Islands'),
('FM','FSM',583,'Micronesia'),
('FO','FRO',234,'Faroe Islands'),
('FR','FRA',250,'France'),
('GA','GAB',266,'Gabon'),
('GB','GBR',826,'United Kingdom'),
('GD','GRD',308,'Grenada'),
('GE','GEO',268,'Georgia'),
('GF','GUF',254,'French Guiana'),
('GG','GGY',831,'Guernsey'),
('GH','GHA',288,'Ghana'),
('GI','GIB',292,'Gibraltar'),
('GL','GRL',304,'Greenland'),
('GM','GMB',270,'Gambia'),
('GN','GIN',324,'Guinea'),
('GP','GLP',312,'Guadeloupe'),
('GQ','GNQ',226,'Equatorial Guinea'),
('GR','GRC',300,'Greece'),
('GS','SGS',239,'South Georgia and the South Sandwich Islands'),
('GT','GTM',320,'Guatemala'),
('GU','GUM',316,'Guam'),
('GW','GNB',624,'Guinea-Bissau'),
('GY','GUY',328,'Guyana'),
('HK','HKG',344,'Hong Kong'),
('HM','HMD',334,'Heard Island and McDonald Islands'),
('HN','HND',340,'Honduras'),
('HR','HRV',191,'Croatia'),
('HT','HTI',332,'Haiti'),
('HU','HUN',348,'Hungary'),
('ID','IDN',360,'Indonesia'),
('IE','IRL',372,'Ireland'),
('IL','ISR',376,'Israel'),
('IM','IMN',833,'Isle of Man'),
('IN','IND',356,'India'),
('IO','IOT',86,'British Indian Ocean Territory'),
('IQ','IRQ',368,'Iraq'),
('IR','IRN',364,'Iran'),
('IS','ISL',352,'Iceland'),
('IT','ITA',380,'Italy'),
('JE','JEY',832,'Jersey'),
('JM','JAM',388,'Jamaica'),
('JO','JOR',400,'Jordan'),
('JP','JPN',392,'Japan'),
('KE','KEN',404,'Kenya'),
('KG','KGZ',417,'Kyrgyzstan'),
('KH','KHM',116,'Cambodia'),
('KI','KIR',296,'Kiribati'),
('KM','COM',174,'Comoros'),
('KN','KNA',659,'Saint Kitts and Nevis'),
('KP','PRK',408,'North Korea'),
('KR','KOR',410,'South Korea'),
('XK','XKX',0,'Kosovo'),
('KW','KWT',414,'Kuwait'),
('KY','CYM',136,'Cayman Islands'),
('KZ','KAZ',398,'Kazakhstan'),
('LA','LAO',418,'Laos'),
('LB','LBN',422,'Lebanon'),
('LC','LCA',662,'Saint Lucia'),
('LI','LIE',438,'Liechtenstein'),
('LK','LKA',144,'Sri Lanka'),
('LR','LBR',430,'Liberia'),
('LS','LSO',426,'Lesotho'),
('LT','LTU',440,'Lithuania'),
('LU','LUX',442,'Luxembourg'),
('LV','LVA',428,'Latvia'),
('LY','LBY',434,'Libya'),
('MA','MAR',504,'Morocco'),
('MC','MCO',492,'Monaco'),
('MD','MDA',498,'Moldova'),
('ME','MNE',499,'Montenegro'),
('MF','MAF',663,'Saint Martin'),
('MG','MDG',450,'Madagascar'),
('MH','MHL',584,'Marshall Islands'),
('MK','MKD',807,'Macedonia'),
('ML','MLI',466,'Mali'),
('MM','MMR',104,'Myanmar'),
('MN','MNG',496,'Mongolia'),
('MO','MAC',446,'Macao'),
('MP','MNP',580,'Northern Mariana Islands'),
('MQ','MTQ',474,'Martinique'),
('MR','MRT',478,'Mauritania'),
('MS','MSR',500,'Montserrat'),
('MT','MLT',470,'Malta'),
('MU','MUS',480,'Mauritius'),
('MV','MDV',462,'Maldives'),
('MW','MWI',454,'Malawi'),
('MX','MEX',484,'Mexico'),
('MY','MYS',458,'Malaysia'),
('MZ','MOZ',508,'Mozambique'),
('NA','NAM',516,'Namibia'),
('NC','NCL',540,'New Caledonia'),
('NE','NER',562,'Niger'),
('NF','NFK',574,'Norfolk Island'),
('NG','NGA',566,'Nigeria'),
('NI','NIC',558,'Nicaragua'),
('NL','NLD',528,'Netherlands'),
('NO','NOR',578,'Norway'),
('NP','NPL',524,'Nepal'),
('NR','NRU',520,'Nauru'),
('NU','NIU',570,'Niue'),
('NZ','NZL',554,'New Zealand'),
('OM','OMN',512,'Oman'),
('PA','PAN',591,'Panama'),
('PE','PER',604,'Peru'),
('PF','PYF',258,'French Polynesia'),
('PG','PNG',598,'Papua New Guinea'),
('PH','PHL',608,'Philippines'),
('PK','PAK',586,'Pakistan'),
('PL','POL',616,'Poland'),
('PM','SPM',666,'Saint Pierre and Miquelon'),
('PN','PCN',612,'Pitcairn'),
('PR','PRI',630,'Puerto Rico'),
('PS','PSE',275,'Palestinian Territory'),
('PT','PRT',620,'Portugal'),
('PW','PLW',585,'Palau'),
('PY','PRY',600,'Paraguay'),
('QA','QAT',634,'Qatar'),
('RE','REU',638,'Reunion'),
('RO','ROU',642,'Romania'),
('RS','SRB',688,'Serbia'),
('RU','RUS',643,'Russia'),
('RW','RWA',646,'Rwanda'),
('SA','SAU',682,'Saudi Arabia'),
('SB','SLB',90,'Solomon Islands'),
('SC','SYC',690,'Seychelles'),
('SD','SDN',729,'Sudan'),
('SS','SSD',728,'South Sudan'),
('SE','SWE',752,'Sweden'),
('SG','SGP',702,'Singapore'),
('SH','SHN',654,'Saint Helena'),
('SI','SVN',705,'Slovenia'),
('SJ','SJM',744,'Svalbard and Jan Mayen'),
('SK','SVK',703,'Slovakia'),
('SL','SLE',694,'Sierra Leone'),
('SM','SMR',674,'San Marino'),
('SN','SEN',686,'Senegal'),
('SO','SOM',706,'Somalia'),
('SR','SUR',740,'Suriname'),
('ST','STP',678,'Sao Tome and Principe'),
('SV','SLV',222,'El Salvador'),
('SX','SXM',534,'Sint Maarten'),
('SY','SYR',760,'Syria'),
('SZ','SWZ',748,'Swaziland'),
('TC','TCA',796,'Turks and Caicos Islands'),
('TD','TCD',148,'Chad'),
('TF','ATF',260,'French Southern Territories'),
('TG','TGO',768,'Togo'),
('TH','THA',764,'Thailand'),
('TJ','TJK',762,'Tajikistan'),
('TK','TKL',772,'Tokelau'),
('TL','TLS',626,'East Timor'),
('TM','TKM',795,'Turkmenistan'),
('TN','TUN',788,'Tunisia'),
('TO','TON',776,'Tonga'),
('TR','TUR',792,'Turkey'),
('TT','TTO',780,'Trinidad and Tobago'),
('TV','TUV',798,'Tuvalu'),
('TW','TWN',158,'Taiwan'),
('TZ','TZA',834,'Tanzania'),
('UA','UKR',804,'Ukraine'),
('UG','UGA',800,'Uganda'),
('UM','UMI',581,'United States Minor Outlying Islands'),
('US','USA',840,'United States'),
('UY','URY',858,'Uruguay'),
('UZ','UZB',860,'Uzbekistan'),
('VA','VAT',336,'Vatican'),
('VC','VCT',670,'Saint Vincent and the Grenadines'),
('VE','VEN',862,'Venezuela'),
('VG','VGB',92,'British Virgin Islands'),
('VI','VIR',850,'U.S. Virgin Islands'),
('VN','VNM',704,'Vietnam'),
('VU','VUT',548,'Vanuatu'),
('WF','WLF',876,'Wallis and Futuna'),
('WS','WSM',882,'Samoa'),
('YE','YEM',887,'Yemen'),
('YT','MYT',175,'Mayotte'),
('ZA','ZAF',710,'South Africa'),
('ZM','ZMB',894,'Zambia'),
('ZW','ZWE',716,'Zimbabwe'),
('CS','SCG',891,'Serbia and Montenegro'),
('AN','ANT',530,'Netherlands Antilles');
INSERT INTO `users` (`id`, `username`, `password`, `email`, `tribe`, `access`, `gold`, `gender`, `birthday`, `location`, `desc1`, `desc2`, `plus`, `b1`, `b2`, `b3`, `b4`, `goldclub`, `sit1`, `sit2`, `alliance`, `timestamp`, `ap`, `apall`, `dp`, `dpall`, `herxp`, `merch`, `protect`, `cp`, `lastupdate`, `RR`, `Rc`, `ok`, `clp`, `oldrank`, `regtime`, `invited`, `deleting`, `brewery`, `silver`, `evasion`, `evasiontime`, `quest`) VALUES(2, 'Nature', '', 'nature@gmail.com', 4, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1.00000, 0, -386169, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `artefacts` ADD INDEX(`vref`);
ALTER TABLE `artefacts` ADD INDEX(`id`);
ALTER TABLE `wdata` ADD INDEX(`id`);
ALTER TABLE `abdata` ADD INDEX(`vref`);
ALTER TABLE `adventure` ADD INDEX(`wref`);
ALTER TABLE `adventure` ADD INDEX(`end`);
ALTER TABLE `adventure` ADD INDEX(`id`);
ALTER TABLE `adventure` ADD INDEX(`uid`);

ALTER TABLE `alidata` ADD INDEX(`id`);
ALTER TABLE `alidata` ADD INDEX(`tag`);
ALTER TABLE `ali_invite` ADD INDEX(`uid`);
ALTER TABLE `ali_invite` ADD INDEX(`alliance`);
ALTER TABLE `ali_permission` ADD INDEX(`uid`);
ALTER TABLE `ali_permission` ADD INDEX(`alliance`);

ALTER TABLE `artefacts` ADD INDEX(`vref`);
ALTER TABLE `artefacts` ADD INDEX(`owner`);
ALTER TABLE `artefacts` ADD INDEX(`type`);
ALTER TABLE `artefacts` ADD INDEX(`size`);

ALTER TABLE `attacks` ADD INDEX(`id`);
ALTER TABLE `attacks` ADD INDEX(`attack_type`);

ALTER TABLE `auction` ADD INDEX(`id`);
ALTER TABLE `auction` ADD INDEX(`owner`);

ALTER TABLE `bank` ADD INDEX(`id`);
ALTER TABLE `banlist` ADD INDEX(`id`);
ALTER TABLE `bdata` ADD INDEX(`field`);
ALTER TABLE `bdata` ADD INDEX(`type`);
ALTER TABLE `bdata` ADD INDEX(`master`);
ALTER TABLE `buygold` ADD INDEX(`email`);

ALTER TABLE `demolition` ADD INDEX(`vref`);
ALTER TABLE `demolition` ADD INDEX(`timetofinish`);

ALTER TABLE `diplomacy` ADD INDEX(`id`);
ALTER TABLE `diplomacy` ADD INDEX(`alli1`);

ALTER TABLE `enforcement` ADD INDEX(`id`);
ALTER TABLE `farmlist` ADD INDEX(`id`);
ALTER TABLE `farmlist` ADD INDEX(`owner`);
ALTER TABLE `farmlist` ADD INDEX(`wref`);

ALTER TABLE `fdata` ADD INDEX(`vref`);
ALTER TABLE `fdata` ADD INDEX(`f99t`);
ALTER TABLE `hero` ADD INDEX(`heroid`);
ALTER TABLE `hero` ADD INDEX(`wref`);
ALTER TABLE `heroinventory` ADD INDEX(`uid`);
ALTER TABLE `heroitems` ADD INDEX(`uid`);
ALTER TABLE `market` ADD INDEX(`vref`);
ALTER TABLE `newproc` ADD INDEX(`uid`);
ALTER TABLE `odata` ADD INDEX(`wref`);
ALTER TABLE `odata` ADD INDEX(`type`);
ALTER TABLE `online` ADD INDEX(`uid`);
ALTER TABLE `queue` ADD INDEX(`finish`);
ALTER TABLE `research` ADD INDEX(`vref`);

ALTER TABLE `route` ADD INDEX(`uid`);
ALTER TABLE `route` ADD INDEX(`wid`);
ALTER TABLE `route` ADD INDEX(`from`);
ALTER TABLE `tdata` ADD INDEX(`vref`);
ALTER TABLE `vdata` ADD INDEX(`wref`);
ALTER TABLE `units` ADD INDEX(`vref`);
ALTER TABLE `users` ADD INDEX(`id`);
ALTER TABLE `wdata` ADD INDEX(`id`);