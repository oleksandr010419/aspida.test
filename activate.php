<?php

include('GameEngine/Account.php');


?>
<!DOCTYPE html>
<html><?php include("Templates/html.php");?>

<body class="v35 <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> signup perspectiveBuildings">
  <div id="background"> <img id="staticElements" src="img/x.gif" alt="" />
    <div id="bodyWrapper"> <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
      <div id="header">
        <div id="mtop"> <a id="logo" href="<?php echo HOMEPAGE; ?>" target="_blank" title="<?php echo SERVER_NAME; ?>"></a>
          <div class="clear"></div>
        </div>
      </div>
      <div id="center"> <?php include('Templates/menu.php');?> <div id="contentOuterContainer" class="size1">
          <div class="contentTitle">&nbsp;</div>
          <div class="contentContainer">
            <?php
	include("Templates/activate/activate.php");
?> <div class="clear"></div>
          </div>
          <div class="contentFooter">&nbsp;</div>
        </div>
      </div>
    </div>
    <div id="ce"></div>
  </div>
  </div>
  </div>
</body>

</html>