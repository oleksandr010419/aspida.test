<?php
include("GameEngine/Account.php")
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= SERVER_NAME ?></title>
    <link rel="shortcut icon" href="favicon.ico"/>
    <meta name="content-language" content="en" />
    <link href="gpack/delusion_4.4/lang/en/compact.css" rel="stylesheet" type="text/css" />

    <link href="gpack/delusion_4.4/lang/en/compact4.css" rel="stylesheet" type="text/css" />
    <script src="crypt2.js" type="text/javascript"></script>
</head>
<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> activate">
	<div id="background">
		<img id="staticElements" src="img/x.gif" alt=""/>
		<div id="bodyWrapper">
			<img style="filter:chroma();" src="img/x.gif" id="msfilter" alt=""/>
			<div id="header">
				<div id="mtop">
					<a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
					<div class="clear"></div>
				</div>
			</div>
			<div id="center">
                <div id="sidebarBeforeContent" class="sidebar beforeContent">
                    <div id="sidebarBoxMenu" class="sidebarBox   ">
                        <div class="sidebarBoxBaseBox">
                            <div class="baseBox baseBoxTop">
                                <div class="baseBox baseBoxBottom">
                                    <div class="baseBox baseBoxCenter"></div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebarBoxInnerBox">
                            <div class="innerBox header noHeader">
                            </div>
                            <div class="innerBox content">
                                <ul>
                                    <li class="first">
                                        <a href="/" target="_blank"><?=HOME?></a>
                                    </li>

                                    <li class="active">
                                        <a href="login.php"><?=SIGN6?></a>
                                    </li>

                                    <li>
                                        <a href="anmelden.php" target="_blank"><?=SIGN5?></a>
                                    </li>





                                </ul>		</div>
                            <div class="innerBox footer">
                            </div>
                        </div>
                    </div>												<div class="clear"></div>
                </div>
				<div id="contentOuterContainer" class="size1">
					<div class="contentTitle">&nbsp;</div>
					<div class="contentContainer">
								<div id="content" class="activate">
<h1 class="titleInHeader"><?php echo LOGIN; ?></h1>
<div id="passwordForgotten">
<?php
$npw = $_GET['npw'];
$act = $_GET['code'];
$user = $_GET['user'];
$pagehide = false;
$userid=$database->getUserField($user,'id',1);
if($userid>0){
    $getProc = $database->getNewProc($userid);
    if($npw == $getProc['npw']){
    	if($act == $getProc['act']){
        	$newPassword = md5($getProc['npw'].mb_convert_case($user,MB_CASE_LOWER,"UTF-8"));
        	$database->updateUserField($user, 'password', $newPassword, 0);
            $database->editTableField('newproc', 'proc', 1, 'uid', $userid);
			echo JR_PASSCHANGESUCCESS.'<br /><br />'.JR_PASSFOLLOW.'<a class="a arrow" href="login.php">'.LOGIN.'</a>';
			$database->removeProc($userid);
        }else{
        	echo '<font color="#FF0000">'.JR_PASSWRONGCODE.'</font>';
        }
    }else{
        	echo '<font color="#FF0000">'.JR_PASSWRONG.'</font>';
        }
}else{
	echo '<font color="#FF0000">'.JR_PASSNOTAUSER.'</font>';
}
?>

</div>
</div>
							<div class="clear"></div>
					</div>
						<div class="contentFooter">&nbsp;</div>
					</div>
						<div id="sidebarAfterContent" class="sidebar afterContent">



		</div>
					</div>
					

				</div>
				<div id="ce"></div></div></div></div>
			
</body>
</html>
