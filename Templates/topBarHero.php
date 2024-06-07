<div id="topBarHeroWrapper">
    <div id="topBarHero" class="heroV2">
        <svg class="health" viewBox="0 0 110 110">
            <defs>
                <clipPath id="healthMask" maskContentUnits="objectBoundingBox">
                    <path d="M55 55L47.35 109.46A 55 55 0 0 0 109.87 51.16" fill="white"></path>
                </clipPath>
            </defs>

            <image xlink:href="//cdn.legends.travian.com/gpack/2473.4/img_ltr/hud/topBar/hero/frame/health.png" x="0"
                y="0" width="110" height="110" style="clip-path: url(#healthMask);"></image>

            <path class="title" d="M55 55L47.35 109.46A 55 55 0 0 0 109.87 51.16" fill="transparent">

            </path>
        </svg>
        <svg class="experience" viewBox="0 0 110 110">
            <defs>
                <clipPath id="experienceMask" maskContentUnits="objectBoundingBox">
                    <path d="M55 55L32.63 105.25A 55 55 0 0 1 32.63 105.25" fill="white"></path>
                </clipPath>
            </defs>

            <image xlink:href="//cdn.legends.travian.com/gpack/2473.4/img_ltr/hud/topBar/hero/frame/experience.png"
                x="0" y="0" width="110" height="110" style="clip-path: url(#experienceMask);"></image>

            <path class="title" d="M55 55L32.63 105.25A 55 55 0 0 1 4 34.4" fill="transparent">

            </path>
        </svg>

        <button id="heroImageButton" onclick="window.location.href='hero_inventory.php';" class="heroImageButton"
            type="button" previewlistener="true">
            <div class="heroImageHover">
                <img class="heroImage heroImageMale" src="<?=$database->herface();?>" alt="Hero" width="64px"
                    height="83px">
            </div>
        </button>

        <div class="heroStatus">
            <a href="/build.php?newdid=22303&amp;id=39&amp;&amp;tt=2" title="" class="" previewlistener="true"><i
                    class="heroHome"></i></a>
            <span class="hide"><i class="heroHome"></i></span>
        </div>
        <?php
            $availiblepoint = $hero['level'] * 4;
            $freepoints = $availiblepoint - ($hero['power'] + $hero['offBonus'] + $hero['defBonus'] + $hero['product']+1);
            if($session->heroD['dead']==1){?>
        <i class="dead "></i>
        <?php }elseif($freepoints>0){?>
        <i class="levelUp "></i>
        <?php    } ?>
        <!-- <i class="levelUp "></i> -->

        <a id="button6660810937383" class="layoutButton buttonFramed withIcon round auction green    "
            data-load-tooltip="hero"
            data-load-tooltip-data="{&quot;boxId&quot;:&quot;hero&quot;,&quot;buttonId&quot;:&quot;auction&quot;}"
            href="hero_auction.php" previewlistener="true">
            <svg viewBox="0 0 20.18 19.44" class="auction">
                <g class="outline">
                    <path
                        d="M20 9.44l-6.14 6.16a.54.54 0 0 1-.78 0L11 13.5a.56.56 0 0 1 0-.78l1.64-1.64-.64-.64h-1.24l-7.38 8.7L0 15.76l8.67-7.41V7.13l-.57-.57-.74.75a.49.49 0 0 1-.69 0L4.19 4.83a.49.49 0 0 1 0-.69l4-4a.49.49 0 0 1 .69 0l2.45 2.45a.52.52 0 0 1 0 .74l-.45.46.65.65h3.14v3.14l.73.73 1.75-1.75a.54.54 0 0 1 .78 0L20 8.66a.54.54 0 0 1 0 .78zm-9.35 7v3h9v-3z">
                    </path>
                </g>
                <g class="icon">
                    <path
                        d="M20 9.44l-6.14 6.16a.54.54 0 0 1-.78 0L11 13.5a.56.56 0 0 1 0-.78l1.64-1.64-.64-.64h-1.24l-7.38 8.7L0 15.76l8.67-7.41V7.13l-.57-.57-.74.75a.49.49 0 0 1-.69 0L4.19 4.83a.49.49 0 0 1 0-.69l4-4a.49.49 0 0 1 .69 0l2.45 2.45a.52.52 0 0 1 0 .74l-.45.46.65.65h3.14v3.14l.73.73 1.75-1.75a.54.54 0 0 1 .78 0L20 8.66a.54.54 0 0 1 0 .78zm-9.35 7v3h9v-3z">
                    </path>
                </g>
            </svg>
        </a>
        <?php
            $adventures = $database->query("SELECT end FROM adventure WHERE `uid`='".$session->uid."' AND `end` = 0 and `time` > '".time()."'");
            ?>
        <a id="button6660810937402" class="layoutButton buttonFramed withIcon round adventure green    attention"
            data-load-tooltip="hero"
            data-load-tooltip-data="{&quot;boxId&quot;:&quot;hero&quot;,&quot;buttonId&quot;:&quot;adventure&quot;}"
            href="/hero/adventures" previewlistener="true" aria-describedby="tippy-37">
            <?php 
                if(count($adventures) > 0) {
            ?>
                <div class="content"><?php echo count($adventures); ?></div>
            <?php }
            ?>
        </a>
    </div>
</div>