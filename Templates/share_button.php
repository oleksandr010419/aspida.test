<div id="vote-box" class="sidebarBoxInnerBox share_buttons">
    <div class="innerBox header ">
        <div class="travianBirthdayRibbon">
            <div class="headline">
                Get even more free Gold   </div>
        </div>
        <div class="boxTitle">Vote</div>		</div>
    <div class="innerBox content">
        <div class="questAchievementContainer">
            <button class="green questButtonOverviewAchievements goldVote disabled share_button" id="fbShareBtn">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content" id="share1" data-str="Share with FB"><img src="/gpack/delusion_4.4/img/Facebook-Share-Button.png" alt="Share with FB"/></div>
                </div>
                <script src="https://connect.facebook.net/en_US/all.js" type="text/javascript"></script>
                <script type="text/javascript">
                    $j(document).ready(function () {
                        FB.init({
                            appId: 298703407189076,
                            status: true,
                            init: true,
                            autoRun: false,
                            viewMode: "website"
                        });
                        document.getElementById('fbShareBtn').onclick = function () {
                            FB.ui(
                                    {
                                        method: 'share',
                                        name: 'Join the battle with me!',
                                        href: 'https://www.aspidanetwork.com/',//https://www.facebook.com/aspidanetwork/posts/1656823734627700',
                                        picture: 'http://fbrell.com/f8.jpg', //image to be replaced here
                                        caption: 'JOIN TRAVIAN TODAY!',
                                        description: 'Come and play Travian with me! Be my ally and help me be one of the best warriors!',
                                        message: 'This is going to be fun!'
                                    },
                            function (response) {
                                var responseData = new Object();
                                responseData.name = "facebook";
                                responseData.data = response;
                                sendCallbackResult(responseData);
                            }
                            );
                        }
                    });
                </script>
            </button>							
            <div class="button green questButtonOverviewAchievements goldVote disabled">								
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">                                            
                            <div class="buttonEnd">                                                
                                <div class="buttonMiddle"></div>                                            
                            </div>                                        
                        </div>                                    
                    </div>																		
                    <div class="button-content" id="share2" data-str="Share with Twitter">
                        <div id="twShareButton" ></div>
                    </div>								
                    <script type="text/javascript">
                        window.twttr = (function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0],
                                    t = window.twttr || {};
                            if (d.getElementById(id))
                                return;
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "https://platform.twitter.com/widgets.js";
                            fjs.parentNode.insertBefore(js, fjs);

                            t._e = [];
                            t.ready = function (f) {
                                t._e.push(f);
                            };

                            return t;
                        }(document, "script", "twitter-wjs"));

                        twttr.ready(function (twttr) {
                            twttr.widgets.createShareButton(
                                    "http://aspidanetwork.com",
                                    document.getElementById("twShareButton"),
                                    {
                                        size: "medium",																				hashtag: "aspidanetwork",
                                        related: "aspidanetwork,travian",
                                        text: "Come and play Travian with me! Be my ally and help me be one of the best warriors!"
                                    }
                            );
                            twttr.events.bind('tweet', function (event) {
                                var responseData = new Object();
                                responseData.name = "twitter";
                                responseData.data = $j.parseJSON(JSON.stringify(event));
                                sendCallbackResult(responseData);
                            });
                        });
                    </script>
                </div>							
			</div>		
            <script>
                function sendCallbackResult(responseData) {
                    responseData.speed = "<?php echo SPEED ?>";
                    responseData.sname = "x<?php echo SPEED ?>"
                    responseData.timestamp = Math.round(new Date().getTime() / 1000);
                    responseData.uid = <?php echo $session->uid; ?>;
                    $j.ajax({
                        method: "POST",
                        url: "https://aspidanetwork.com/scripts/share/index.php?cmd=shareTheNews&sname=" + responseData.sname,
                        crossDomain: false,
						async: true,
                        data: {
                            name: responseData.name,
                            speed: responseData.speed,
                            timestamp: responseData.timestamp,
                            uid: responseData.uid,
                            data: responseData.data
                        },
                        success: function (data) {
							if (data){
								data = JSON.parse(data);
								if (data.status === true) {
                                result = data.response;
								location.reload();
                            }
							}                            
                        }
                    });
                }


                function getTimeRemaining(endtime) {
                    var t = Date.parse(endtime) - Date.parse(new Date());
                    var seconds = Math.floor((t / 1000) % 60);
                    var minutes = Math.floor((t / 1000 / 60) % 60);
                    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
                    var days = Math.floor(t / (1000 * 60 * 60 * 24));

                    if (seconds < 0)
                    {
                        seconds = 0;
                    }
                    if (minutes < 0)
                    {
                        minutes = 0;
                    }
                    if (hours < 0)
                    {
                        hours = 0;
                    }
                    if (days < 0)
                    {
                        days = 0;
                    }


                    return {
                        'total': t,
                        'days': days,
                        'hours': hours,
                        'minutes': minutes,
                        'seconds': seconds
                    };
                }

                function initializeShareClock(id, endtime) {
					endtime = endtime - Math.round(new Date().getTime() / 1000);
					var seconds = Math.floor((endtime) % 60);
                    var minutes = Math.floor((endtime / 60) % 60);
                    var hours = Math.floor((endtime / (60 * 60)) % 24);
                    var days = Math.floor(endtime / (60 * 60 * 24));
                    var clock = document.getElementById(id);
					var timer = 1;
					while(document.getElementById("timer"+timer) != null){
						timer++;
					}
					
					if (hours <= 0 && minutes <= 0 && seconds <= 0)
					{
						//$j('#' + id).html($j('#' + id).attr('data-str'));
						$j('#' + id).parent().parent().removeClass('disabled');
						$j('#' + id).parent().parent().removeClass('green');						
					}
					else {
						if(!$j('#' + id).parent().parent().hasClass('green')){
							$j('#' + id).parent().parent().addClass('green');
							$j('#' + id).parent().parent().addClass('disabled');
						}
						clock.innerHTML = "<span id=\"timer"+timer+"\">"+ hours + ':' +
								'' + minutes + ':' +
								'' + seconds+"</span>";
						resetCounterForAjax();
					}
                }

                $j(document).ready(function () {
                    $j('.share_buttons button').on('click', function () {
                        return false;
                    });

                    var share1 = '<?php echo $uservote['share_fb']; ?>';
                    var share2 = '<?php echo $uservote['share_tw']; ?>';
                    var share3 = '<?php echo $uservote['share_gp']; ?>';

                    initializeShareClock('share1', share1);
                    initializeShareClock('share2', share2);
                    initializeShareClock('share3', share3);
                });
            </script>
            <style>
                #vote-box button, #vote-box button:hover, #vote-box button:focus{
                    margin: 5px;
                }
            </style>
        </div>
    </div>
    <div class="innerBox footer">
    </div>
</div>