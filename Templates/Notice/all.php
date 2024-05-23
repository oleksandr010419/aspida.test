<form method="post" action="berichte.php" name="msg">
    <table cellpadding="1" cellspacing="1" id="overview" class="row_table_data">
        <thead>
            <tr>
                <th>
                    <input class="check" type="checkbox" id="selectAll" onclick="selectAllCheckboxes()" />
                    <label for="selectAll">Select All</label>
                </th>
                <th colspan="1"><?=rpts6?>:</th>
                <th class="sent"><?=rpts8?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($_GET['s'])) {
                $s = $_GET['s'];
            }
            else {
                $s = 0;
            }

            $filt="";
            if(isset($_GET['t'])) {
                if($_GET['t'] == 1) {
                    $type = array(8, 15, 16, 17);
                }
                if($_GET['t'] == 2) {
                    $type = array(10, 11, 12, 13);
                }
                if($_GET['t'] == 3) {
                    $type = array(1, 2, 3, 4, 5, 6, 7);
                }
                if($_GET['t'] == 4) {
                    $type = array(0, 18, 19, 20, 21);
                }

                $filt=" and ntype IN (".implode(",",$type).") ";
            }
            $nt = $database->getNotics($session->uid,$s,$s+10,$filt);

            $nnot=$database->getNoticn($session->uid,$filt);
            $name = 1;
            $count = 0;
            for($i=1;$i<=10;$i++) {
                for($k=48;$k>=1;$k--){
                    $nt[$i-1]['topic'] = preg_replace("/REP_С".$k."/",constant('REP_С'.$k),$nt[$i-1]['topic']);
                }
                if(is_numeric($nt[$i-1]['ntype'])){
                    if($nnot >= $i) {
                        echo "<tr><td class=\"sel\"><input class=\"check\" type=\"checkbox\" name=\"n".$name."\" value=\"".$nt[$i-1]['id']."\" /></td>
                        <td class=\"sub\">";
                        $type =  $nt[$i-1]['ntype'];
                        if($type==25 or $type==26 or $type==27){
                            $type-=21;
                        }

                        echo "<img src=\"img/x.gif\" class=\"iReport iReport$type\" alt=\"\" title=\"\" />";

                        echo "<div><a href=\"berichte.php?id=".$nt[$i-1]['id']."\">".$nt[$i-1]['topic']."</a> ";

                        if($nt[$i-1]['viewed'] == 0) {
                            echo rpts13;
                        }
                        $date = $generator->procMtime($nt[$i-1]['time']);
                        echo "</div></td><td class=\"dat\">".$date[0]." ".$date[1]."</td></tr>";

                        $name++;
                        if($nnot <= $i){break;}
                    }
                }else{$nnot--;}
            }
            if($nnot == 0) {
                echo "<td colspan=\"3\" class=\"none\">".rpts14."</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="footer">
        <?php if($session->plus) { ?>
        <div id="markAll">
            <input class="check" type="checkbox" id="sAll" name="s10" onclick="
                $(this).up('form').getElements('input[type=checkbox]').each(function(element)
                {
                    element.checked = this.checked;
                }, this);
            ">
            <span><label for="sAll"><?=HEROAC28?></label></span>
        </div>
        <?php } ?>

        <div class="paginator">
            <?php
            $t = isset($_GET['t'])?"&t=".$_GET['t']:'';
            if(!isset($_GET['s']) && $nnot < 10) {
                echo "&laquo;&raquo;";
            }
            else if (!isset($_GET['s']) && $nnot > 10) {
                echo "&laquo;".STATISTIC34." | <a href=\"?s=10".$t."\">".STATISTIC35."&raquo;</a>";
            }
            else if(isset($_GET['s']) && $nnot > $_GET['s']) {
                if($nnot > ($_GET['s']+10) && $_GET['s']-10 < $nnot && $_GET['s'] != 0) {
                    echo "<a href=\"?s=".($_GET['s']-10).$t."\">&laquo;".STATISTIC34."</a> | <a href=\"?s=".($_GET['s']+10).$t."\"> ".STATISTIC35."&raquo;</a>";
                }
                else if($nnot > $_GET['s']+10) {
                    echo "&laquo;".STATISTIC34." | <a href=\"?s=".($_GET['s']+10).$t."\"> ".STATISTIC35."&raquo;</a>";
                }
                else {
                    echo "<a href=\"?s=".($_GET['s']-10).$t."\">&laquo;".STATISTIC34."</a> | ".STATISTIC35."&raquo;";
                }
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    
    <?php if(!$session->sit && $session->right['s6']) { ?>
    <button name="del_x" type="submit" value="del" id="del" class="green delete">
        <div class="button-container addHoverClick ">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content">
                <?=farmlist20?>
            </div>
        </div>
    </button>
    <?php } ?>
</form>

<script>
    function selectAllCheckboxes() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"].check');
        var selectAllCheckbox = document.getElementById('selectAll');
        
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = selectAllCheckbox.checked;
        }
    }
</script>
