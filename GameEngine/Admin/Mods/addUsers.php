 <?php
include_once(__DIR__."/../../config.php");
include_once(__DIR__."/../../Session.php");
require_once(__DIR__."/../../Register.php");
require_once(__DIR__."/../../Data/buidata.php");
require_once(__DIR__."/../../Database.php");
global $database;

$wgarray=array(1=>1200,1700,2300,3100,4000,5000,6300,7800,9600,11800,14400,17600,21400,25900,31300,37900,45700,55100,66400,80000);


$id = $_POST['id'];
$baseName = $_POST['users_base_name'];
$amount = (int) $_POST['users_amount'];
$beginnersProtection = $_POST['users_protection'];
$country = $_POST['country'];
$postTribe = $_POST['tribe'];

// Some basic error checking
if (strlen($baseName) < 4)
{
    header("Location: ../../../2388076972/admin.php?p=addUsers&e=BN2S&bn=$baseName&am=$amount");
}
elseif (strlen($baseName) > 20)
{
    // Might be needed if older browers don't respect form maxlength
    header("Location: ../../../2388076972/admin.php?p=addUsers&e=BN2L&bn=$baseName&am=$amount");
}
elseif ($amount < 1)
{
    header("Location: ../../../2388076972/admin.php?p=addUsers&e=AMLO&bn=$baseName&am=$amount");
}
elseif ($amount > 200) // TODO: Make this a config variable?
{
    header("Location: ../../../2388076972/admin.php?p=addUsers&e=AMHI&bn=$baseName&am=$amount");
}
else
{
    // Looks OK, let's go for it
    $created = 0;
    $skipped = 0;
    for ($i= 1; $i <= $amount; $i++)
    {
        $userName = $baseName . $i;
        // Random passwords disallow admin logging in to use the accounts
        $password = "ZBSQSf1t9WcIf";

        // Leaving the line below but commented out - could be used to
        // allow admin to log in to the generated accounts and play them
        // Easily guessed by players so should only be used for testing
        //$password = $baseName . $i . 'PASS';

        $email = $baseName . $i . '@example.com';
        if ($postTribe == 0)
        {
            // Random Tribe
            $tribe = rand(1, 7);
        }
        else
        {
            // No error checking here but should be set to 1-3 from form
            $tribe = $postTribe;
        }
        // Create in a random quad
        $kid = rand(1,7);
        // Dont need to activate, not 100% sure we need to initialise $act
        $act = "";

        // Check username not already registered
        if($database->checkExist($userName,0))
        {
            // Name already used, do nothing except update $skipped
            $skipped ++;
        }
        else
        {
			//var_dump($userName, md5($password), $email, $tribe ,$act);
            // Register them and build the village
			$x = new Registr();
           // $uid2 = $x->activate($userName,md5($password.mb_convert_case($userName,MB_CASE_LOWER,"UTF-8")),$email,0, $country, 0,$generator->generateRandStr(10),0,0);
			$uid = $x->register($userName,md5($password.mb_convert_case($userName,MB_CASE_LOWER,"UTF-8")),$email,$tribe, $country, $act);
$q = "SELECT * FROM users";
			if($uid > 0)
            {
                /*
*   [MENTION=6887]Tod[/MENTION]O
*
* Allow option to create (random) bigger villages,
* upgrade fields, granary, warehouse, wall etc
*
* Allow option to create (random) troops in some villages
*
* Don't directly access the DB, create a $database function
* where required
*/

                // Show the dove in User Profile - will show this even if
                // beginners protection is not checked
                // Need a $database function for this
                // (assuming we don't already have one as creating Natars also updates this way)
                $q = "UPDATE users SET desc2 = '[#0]', access = 2 WHERE id = $uid";
                $database->query($q);

                if (!$beginnersProtection)
                {
                    // No beginners protection so set it to current time
                    // TODO create a $database function for this
                    // also used in editProtection.php so assuming no function
                    // already exists
                    $protection = time();
                    $database->removeBeginnerProtection($uid);
                }

                //$database->updateUserField($uid,"act","",1);
				///////////////////////////////////////////////////////
				$frandom0 = rand(0,4);$frandom1 = rand(0,3);$frandom2 = rand(0,4);$frandom3 = rand(0,3);
		echo 1;
				$database->addHeroFace($uid,$frandom0,$frandom1,$frandom2,$frandom3,$frandom3,$frandom2,$frandom1,$frandom0,$frandom2);
				$database->addHero($uid);
				$database->addHeroinventory($uid);
				$wid = $database->generateBase(rand(1,4));
				//$wid = $database->getBaseID(-88, 65);
				//$wid = $database->getBaseID(-19, 52);
				//$wid = $database->getBaseID(-29,50);
				$database->setFieldTaken($wid);
				//$database->addVillage($wid,$uid,$userName,1,2,$time);
				//$database->addResourceFields($wid,$database->getVillageType($wid));
				$database->addUnits($wid);
				$database->addTech($wid);
				$database->addABTech($wid);
				$database->modifyUnit($wid, array(11), array(1), 1,"Create hero");
				$database->modifyHero2('wref', $wid, $uid, 0);
				$database->InsertRights($uid);
				$database->addAdventure($wid, $uid,10);
				$database->AddAchiev($uid);
				$x->unreg($userName);
		echo 1;



				/////////////////////////////////////////////////////////


                //$wid = $database->generateBase($kid,mt_rand(1,4));
                //$database->setFieldTaken($wid);

                //calculate random generate value and level building
                $rand_resource=rand(30000, 80000);
                $level_storage=rand(20, 20);
                $cap_storage=$wgarray[$level_storage]*(STORAGE_BASE/800);
                $rand_resource=($rand_resource>$cap_storage)? $cap_storage:$rand_resource;

                //insert village with all resource and building with random level
                $xxx = $database->row("SELECT x, y FROM wdata WHERE id='".$wid."'");
                $time = time();
                $q = "INSERT INTO vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`, `vx`, `vy`) values ('$wid','$uid','".$userName."\'s village',1,200,1,0,0,$rand_resource,$rand_resource,$rand_resource,$cap_storage,$rand_resource,$cap_storage,$time,100,0,0,0,$time, ".$xxx['x'].", ".$xxx['y'].")";
                $database->query($q);// or die("vData already exists! ".mysql_error());//																																																																																																																																	1					2				3					4				5					6				7					8				9					10				11					12				13				14					15				16					17				18				19(warehouse)	20(warehouse)		21(grannary)		22(granary)		 23(Grain Mill) 	24(Academy)				25(iron)		26(main)			27(stable)			28(Barracks)	29(bakery)		30(smithy)			31(workshop)		32(market)		33(Brickworks)		34(hero)		35(toutnament)		35(palace)			36(treusary)	37(Trade Office)	38(embasy)		39(rally point)																																				
				$q = "insert  into fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid ,".rand(10,20).",1,".rand(10,20).",4,".rand(10,20).",1,".rand(10,20).",3,".rand(10,20).",2,".rand(10,20).",2,".rand(10,20).",3,".rand(10,20).",4,".rand(10,20).",4,".rand(10,20).",3,".rand(10,20).",3,".rand(10,20).",4,".rand(10,20).",4,".rand(10,20).",1,".rand(10,20).",4,".rand(10,20).",2,".rand(10,20).",1,".rand(10,20).",2,".rand(10,20).",10,".rand(20,20).",10,".rand(20,20).",11,".rand(15,20).",11," .rand(2,5).",8,".rand(15,20).",22,"   .rand(2,5).",7,".rand(15,20).",15,".rand(15,20).",20,".rand(15,20).",19,".rand(2,5).",9,".rand(15,20).",12,".rand(15,20).",21,".rand(15,20).",17,".rand(2,5).",6,".rand(15,20).",37,".rand(15,20).",14,".rand(10,20).",25,".rand(15,20).",27,".rand(10,20).",28,".rand(10,20).",18,".rand(10,20).",0,0,0,'World Wonder')";
                $database->query($q);// or die("fData already exists! ".mysql_error());
                $pop = $database->recountPop($wid);
                $cp = $database->recountPop($wid);

				$database->recountPopUser($uid);
//				mysql_query("UPDATE vdata SET pop=".$pop.", cp=".$cp." WHERE wref=".$wid);
                //$database->addUnits($wid);
                //$database->addTech($wid);
                //$database->addABTech($wid);
                //$database->updateUserField($uid,"access",USER,1);

				echo "Created user #".$uid." => ".$userName."<br/>";

                //insert units randomly generate the number of troops
                $q = "UPDATE units SET u1 = ".rand(6*SPEED, 12*SPEED).", u2 = ".rand(5*SPEED, 10*SPEED).", u3 = ".rand(4*SPEED, 8*SPEED).", u4 = ".rand(3*SPEED, 6*SPEED).", u5 = " .rand(2*SPEED, 4*SPEED).", u6 = ".rand(1*SPEED, 2*SPEED)." WHERE vref = '".$wid."'";
                $database->query($q);

                $created ++;

            }
            else
            {
                // Do nothing as the user wasn't created or some unknown error
            }
        }
    }
   header("Location: ../../../2388076972/admin.php?p=addUsers&g=OK&bn=$baseName&am=$created&sk=$skipped&bp=$beginnersProtection&tr=$postTribe");
}
?>
