<div id="top-wrapper" style="display: none;">
    <div id="main" class="clearfix">
        <div class="header">
            <img id="menubar-canvas" width="1000" height="40" src="img/menubar-canvas.png" alt="Header" />
            <div class="menubar">
                <div class="menubar-item logo">
                    <ul>
                        <li rel="news" class="menubar-item-inactive">NEWS</li>
                        <li rel="help" class="menubar-item-inactive">HELP</li>
                        <li rel="bugreporter" class="exec">REPORT A BUG</li>
                        <li rel="about" class="exec">ABOUT</li>
                    </ul>
                </div>

                <div class="menubar-item">SYSTEM
                    <ul>
                        <li rel="ai_helper" class="menubar-item-inactive">AI</li>
                        <li rel="player_profile" class="menubar-item-inactive">PLAYER PROFILE</li>
                        <li rel="messenger" class="exec">MESSENGER</li>
                        <li rel="mailbox" class="exec">MAILBOX</li>
                        <li rel="missioncenter" class="exec">MISSION CENTER</li>
                        <li rel="server_admin" class="menubar-item-inactive">SERVER ADMINISTRATION</li>
                        <li rel="webbrowser" class="exec">WEB-BROWSER</li>
                        <li rel="corp_status" class="menubar-item-inactive">CORP. STATUS</li>
                        <li rel="softwaremarket" class="exec">SOFTWARE MARKET</li>
                        <li rel="mygateway" class="exec">MY GATEWAY</li>
                        <li rel="mysoftware" class="exec">MY SOFTWARE</li>
                    </ul>
                </div>

                @if($installedApps->isEmpty())
                    <div class="applications-menu menubar-item" style="color: #4b4b4b">APPLICATIONS</div>
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
