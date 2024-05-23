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

TRUNCATE `critical_log`;

ALTER TABLE `artefacts` ADD `effect` VARCHAR(6) NULL DEFAULT '0_0' AFTER `activated`;