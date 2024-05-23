<?php
set_time_limit(0);
#DEBUG ONLY
error_reporting(E_ALL ^ E_NOTICE);
#On prod use
#error_reporting(0);

date_default_timezone_set("Europe/Paris");

define("DISABLE_REGISTER", FALSE);
define("HALT_CRON", FALSE);
define("ARTIFACT_COOLDOWN", 12);
define("INSTANT_TRAIN", false);
define("INSTANT_TRAIN_MODIFIER", 61.3);
define("GAME_ROUND", 62);
define("SERVER_NAME","Aspida test");
define("COSTRES",0);
define("DEFAULT_GOLD",300);  //DEFAULT GOLD
define("HOWRES",1000);
define("COSTCP",20);
define("EXTRA_MENU", false);
define("HOWCP",1000);
define("AUCTIONTIME",6400);
define("GP_LOCATE", "gpack/delusion_4.6/");
define("OPENING", 1713942000);
define("REF_POP",500);
define("REF_GOLD",50);
define("OASISX",3); //Oasis def
define("SPEED", 10); //Speed of the server
define("MAX_FILES",1000);
define("MAX_FILESH",3000);
define("IMGQUALITY",50);
define("MOMENT_TRAIN",False);
define("QUEST",True);
//define("ARTEFACTS",%ARTEFACTS%);
//define("WW_TIME",%WW_TIME%);
//define("WW_PLAN",%WW_PLAN%);
define("ROUND_LENGTH", 3); 
define("ROUND_TOTAL",ROUND_LENGTH * 896400);
define("PART_ROUND",ROUND_TOTAL / 3);
define("ARTEFACTS",OPENING + PART_ROUND);
define("WW_TIME",OPENING);
define("WW_PLAN",ARTEFACTS + PART_ROUND );
define("NATARS_TIME",WW_PLAN + PART_ROUND);
define("SELL_CP",True);
define("SELL_RES",False);
define("CRANNY_CAP",10);
define("ADV_TIME",86400/20);
define("TRAPPER_CAPACITY",10);
define("xQUEST",1);

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
define("PACK_H_PRICE",100);
define("PACK_A_GOLD",1250);
define("PACK_B_GOLD",3125);
define("PACK_C_GOLD",7750);
define("PACK_D_GOLD",19500);
define("PACK_E_GOLD",50000);
define("PACK_F_GOLD",100000);
define("PACK_H_GOLD",250000);

define("MAX_UNIT",80);
define("MAX_TRIBE",8);
// ***** Change storage capacity
define("STORAGE_MULTIPLIER",10);

define("STORAGE_BASE",800*STORAGE_MULTIPLIER);

// ***** World size
// Defines world size. NOTICE: DO NOT EDIT!!
define("WORLD_MAX", "100");

define("INCREASE_SPEED",10);

// ***** Beginners Protection
define("PHOUR", "3600");
define("PROTECTIOND",18000);
$timestoup = 0;
$fromstart=time()-OPENING;
if($fromstart>=42300){
$timestoup=floor($fromstart/42300);
}
define("PROTECTION",PROTECTIOND+($timestoup*PHOUR));
// ***** Trader capacity
// Values: 1 (normal), 3 (3x speed) etc...
define("TRADER_CAPACITY",10);

define("INCLUDE_ADMIN",True);

//////////////////////////////////
//   ****  SQL SETTINGS  ****   //
//////////////////////////////////

// ***** SQL Hostname
// example. sql106.000space.com / localhost
// If you host server on own PC than this value is: localhost
// If you use online hosting, value must be written in host cpanel
define("SQL_SERVER", "127.0.0.1");

// ***** Database Username
define("SQL_USER", "root");

// ***** Database Password
define("SQL_PASS", "");

// ***** Database Name
define("SQL_DB", "aspidagames_test");

$loginDB['index']=array('Server'=>SQL_SERVER,'User'=>SQL_USER,'Password'=>SQL_PASS,'Database'=>SQL_DB);


define("CP", "1");

// ***** PLUS
//Plus account lenght
define("PLUS_TIME",(3600*12));
//+25% production lenght
define("PLUS_PRODUCTION",(3600*12));
define("TS_THRESHOLD",20);


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
define("HOMEPAGE", "https://www.test.aspidanetwork.com/");
define("MAXLENGHT","15");
define("RADIUS",2);

define("OFFENSE1_COST",50);
define("OFFENSE1_BONUS",25);
define("DEFENCE1_COST",50);
define("DEFENCE1_BONUS",25);
define("OFF_DEF_TIME",43200);
define("POP_FOR_BONUS",1000);
define("DAILY_MESSAGE_LIMIT",20);//only for new messages - replies do not count