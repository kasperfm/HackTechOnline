<div id="top-wrapper" style="display: none;">
    <div id="main" class="clearfix">
        <div class="header">
            <img id="menubar-canvas" width="1000" height="40" src="img/menubar-canvas.png" alt="Header" />
            <div class="menubar">
                <div class="menubar-item logo">
                    <ul>
                        <li rel="news" class="menubar-item-inactive">NEWS</li>
                        <li rel="help" class="menubar-item-inactive">HELP</li>
                        <li rel="profilesettings" class="exec">PROFILE</li>
                        <li><hr class="menu-hr"></li>
                        <li rel="accountreset" class="exec">RESET GAME ACCOUNT</li>
                        <li rel="bugreporter" class="exec">REPORT A BUG</li>
                        <li><hr class="menu-hr"></li>
                        <li rel="about" class="exec">ABOUT</li>
                    </ul>
                </div>

                <div class="menubar-item">SYSTEM
                    <ul>
                        @if(currentPlayer()->aiStatus > 0)
                            <li rel="ai" class="exec">AI</li>
                        @else
                            <li rel="ai" class="menubar-item-inactive">AI</li>
                        @endif
                        <li rel="messenger" class="exec">MESSENGER</li>
                        <li rel="mailbox" class="exec">MAILBOX</li>
                        <li rel="missioncenter" class="exec">CONTRACTS</li>
                        <li rel="server_admin" class="menubar-item-inactive">SERVER ADMINISTRATION</li>
                        <li rel="webbrowser" class="exec">WEB-BROWSER</li>
                        <li rel="corpstatus" class="exec">CORPORATION</li>
                        <li rel="softwaremarket" class="exec">SOFTWARE MARKET</li>
                        <li rel="mygateway" class="exec">MY GATEWAY</li>
                        <li rel="mysoftware" class="exec">MY SOFTWARE</li>
                    </ul>
                </div>

                @if($installedApps->isEmpty())
                    <div class="applications-menu menubar-item" style="color: #4b4b4b">APPLICATIONS
                        <ul class="appmenu" id="appmenu"></ul>
                    </div>
                @else
                    <div class="applications-menu menubar-item" style="color: #ffffff" >APPLICATIONS
                        <ul class="appmenu" id="appmenu">
                            @foreach($installedApps as $app)
                                <li rel="{{ strtolower($app->app->app_name) }}" class="exec">{{ StringHelper::camelCaseToWords($app->app->app_name) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="menubar-item float-right logout-btn"><img width="10" height="10" alt="Logoff" src="img/icon-login.png" /> LOGOFF</div>
                <div class="menubar-item credits-display float-right">$ 0</div>
            </div>
        </div>
    </div>
</div>
