<?php

include('GameEngine/Account.php');


?>
<!DOCTYPE html>
<html><?php include("Templates/html_.php");?>

<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> login perspectiveBuildings" data-theme="default">
  <div id="background"> <img id="staticElements" src="img/x.gif" alt="" />
    <div id="bodyWrapper"> <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
      <div id="topBar">
        <div id="header">
          <div id="mtop"> <a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>">
          <img src="https://test.aspidanetwork.com/gpack/delusion_4.5/img/layout/logoSmall.png" width="300px">
        </a>
            <div class="clear"></div>
          </div>
        </div>
      </div>
      <div id="center"> <?php include('Templates/menu.php');?> <div id="contentOuterContainer" class="size1 contentPage">
          <div class="contentTitle">&nbsp;</div>
          <div class="contentContainer">
            <?php
	include("Templates/activate/activate.php");
?> <div class="clear"></div>
          </div>
          <!-- <div class="contentFooter">&nbsp;</div> -->
        </div>
      </div>
    </div>
    <div id="ce"></div>
  </div>
  </div>
  </div>
</body>

</html>
