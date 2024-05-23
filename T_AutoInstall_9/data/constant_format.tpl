<?php

header('Content-Type: text/html; charset=UTF-8');

set_time_limit(0);
error_reporting(E_ALL ^ E_NOTICE);

date_default_timezone_set("Europe/Paris");

define("DISABLE_REGISTER", false);
define("HALT_CRON", false);
define("ARTIFACT_COOLDOWN", 12);
define("INSTANT_TRAIN", %INSTANTTRAIN%);
define("INSTANT_TRAIN_MODIFIER", %INSTANTTRAINMODIFIER%);
define("GAME_ROUND", 1);
define("SERVER_NAME","%SERVERNAME%");
define("COSTRES",%COSTRES%);
define("DEFAULT_GOLD",%DEFGOLD%);  //DEFAULT GOLD
define("HOWRES",%HOWRES%);
define("COSTCP",%COSTCP%);
define("EXTRA_MENU", %EXTRAMENU%);
define("HOWCP",%HOWCP%);
define("AUCTIONTIME",%AUCTIME%);
define("GP_LOCATE", "gpack/delusion_4.5/");
define("OPENING", %OPENING%); //Start Time
define("REF_POP",%REFPOP%);
define("REF_GOLD",%REFGOLD%);
define("OASISX",%OASISX%); //Oasis def
define("SPEED", %SPEED%); //Speed of the server
define("MAX_FILES",%MAX_FILES%);
define("MAX_FILESH",%MAX_FILESH%);
define("IMGQUALITY",%IMGQUALITY%);
define("MOMENT_TRAIN",%MOMENT_TRAIN%);
define("QUEST",%QUEST%);
//define("ARTEFACTS",%ARTEFACTS%);
//define("WW_TIME",%WW_TIME%);
//define("WW_PLAN",%WW_PLAN%);
define("ROUND_LENGTH",%ROUND_LENGTH%);
define("ROUND_TOTAL",ROUND_LENGTH * 86400);
define("PART_ROUND",ROUND_TOTAL / 3);
define("ARTEFACTS",OPENING + PART_ROUND);
define("WW_TIME",OPENING);
define("WW_PLAN",ARTEFACTS + PART_ROUND);
define("NATARS_TIME",WW_PLAN + PART_ROUND);
define("SELL_CP",%SELL_CP%);
define("SELL_RES",%SELL_RES%);
define("CRANNY_CAP",%CRANNY%);
define("ADV_TIME",86400/%ADVS%);
define("TRAPPER_CAPACITY",%TRAPER%);
define("xQUEST",0);


define("MAX_UNIT",80);
define("MAX_TRIBE",8);
// ***** Change storage capacity
define("STORAGE_MULTIPLIER","%STORAGE_MULTIPLIER%");

define("STORAGE_BASE",800*STORAGE_MULTIPLIER);

// ***** World size
// Defines world size. NOTICE: DO NOT EDIT!!
define("WORLD_MAX", "%MAX%");

define("INCREASE_SPEED",%INCSPEED%);

// ***** Beginners Protection
define("PHOUR", "%PRHOUR%");
define("PROTECTIOND",%BEGINNER%);
$timestoup = 0;
$fromstart=time()-OPENING;
if($fromstart>=42300){
$timestoup=floor($fromstart/42300);
}
define("PROTECTION",PROTECTIOND+($timestoup*PHOUR));
// ***** Trader capacity
// Values: 1 (normal), 3 (3x speed) etc...
define("TRADER_CAPACITY",%TRADER%);

define("INCLUDE_ADMIN",%ARANK%);

//////////////////////////////////
//   ****  SQL SETTINGS  ****   //
//////////////////////////////////

// ***** SQL Hostname
// example. sql106.000space.com / localhost
// If you host server on own PC than this value is: localhost
// If you use online hosting, value must be written in host cpanel
define("SQL_SERVER", "127.0.0.1");

// ***** Database Username
define("SQL_USER", "%SUSER%");

// ***** Database Password
define("SQL_PASS", "%SPASS%");

// ***** Database Name
define("SQL_DB", "%SDB%");

$loginDB['index']=array('Server'=>SQL_SERVER,'User'=>SQL_USER,'Password'=>SQL_PASS,'Database'=>SQL_DB);


define("CP", "%VILLAGE_EXPAND%");

// ***** PLUS
//Plus account lenght
define("PLUS_TIME",%PLUS_TIME%);
//+25% production lenght
define("PLUS_PRODUCTION",%PLUS_PRODUCTION%);
define("TS_THRESHOLD",%TS_THRESHOLD%);


//////////////////////////////////////////
//   ****  DO NOT EDIT SETTINGS  ****   //
//////////////////////////////////////////
define("ALLOW_ALL_TRIBE",false);
define("USRNM_MIN_LENGTH",3);
define("PW_MIN_LENGTH",4);
define("BANNED",0);
define("MULTIHUNTER",8);
define("ADMIN",9);
define("COOKIE_EXPIRE", 60*60*24*7);
define("COOKIE_PATH", "/");
define("HOMEPAGE", "%HOMEPAGE%");
define("MAXLENGHT","15");
define("RADIUS",2);

define("OFFENSE1_COST",%OFFENSE1_COST%);
define("OFFENSE1_BONUS",%OFFENSE1_BONUS%);
define("DEFENCE1_COST",%DEFENCE1_COST%);
define("DEFENCE1_BONUS",%DEFENCE1_BONUS%);
define("OFF_DEF_TIME",%OFF_DEF_TIME%);
define("POP_FOR_BONUS",%POP_TO_GET_GOLD%);
define("GOLD_FOR_BONUS",%POP_GOLD_BONUS%);
define("DAILY_MESSAGE_LIMIT",10);//only for new messages - replies do not count

//Discount options
define("DISCOUNT",True);//On-Off
define("DISCOUNT_START",345);//Start time (timestamp)
define("DISCOUNT_TIME", 3);//Length of discount period in seconds
define("DISCOUNT_END", DISCOUNT_START + (DISCOUNT_TIME * 86400));
define("DICOUNT_BONUS",100);//Descount percentage

//Buy Gold options
define("PACK_A_PRICE",2);
define("PACK_B_PRICE",4);
define("PACK_C_PRICE",8);
define("PACK_D_PRICE",16);
define("PACK_E_PRICE",32);
define("PACK_F_PRICE",50);
define("PACK_A_GOLD",1250);
define("PACK_B_GOLD",3125);
define("PACK_C_GOLD",7750);
define("PACK_D_GOLD",19500);
define("PACK_E_GOLD",50000);
define("PACK_F_GOLD",100000);
