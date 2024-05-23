<?php
if(!$session->goldclub) {
    include "16.php";
}else{
    ?>


        <div id="raidList">
            <div class="round spacer listTitle">
                <div class="listTitleText">
                    <?=build20?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="options">
                <?php
                if($session->evasion == 1){
                    ?>
                    <input type="checkbox" class="check" name="hideShow" onclick="window.location.href = '?id=39&t=100&disable';" checked="checked"> <?=build21?>
                <?php
                }else{
                    ?>
                    <input type="checkbox" class="check" name="hideShow" onclick="window.location.href = '?id=39&t=100&enable';"> <?=build21?>
                <?php } ?>
            </div>

        </div>


<?php } ?>