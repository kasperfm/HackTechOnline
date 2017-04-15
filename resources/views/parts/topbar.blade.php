<div id="top-wrapper" style="display: none;">
    <div id="main" class="clearfix">
        <div class="header">
            <img id="menubar-canvas" width="1000" height="40" src="img/menubar-canvas.png" alt="Header" />
            <div class="menubar">
                <div class="menubar-item logo">
                    <ul>
                        <li rel="news" class="menubar-item-inactive">NEWS</li>
                        <li rel="help" class="menubar-item-inactive">HELP</li>
                        <li rel="bugreport" class="menubar-item-inactive">REPORT A BUG</li>
                        <li rel="about" class="exec">ABOUT</li>
                    </ul>
                </div>

                <div class="menubar-item">SYSTEM
                    <ul>
                        <li rel="ai_helper" class="menubar-item-inactive">AI</li>
                        <li rel="player_profile" class="menubar-item-inactive">PLAYER PROFILE</li>
                        <li rel="messenger" class="menubar-item-inactive">MESSENGER</li>
                        <li rel="email" class="menubar-item-inactive">E-MAIL CLIENT</li>
                        <li rel="server_admin" class="menubar-item-inactive">SERVER ADMINISTRATION</li>
                        <li rel="webbrowser" class="menubar-item-inactive">WEB-BROWSER</li>
                        <li rel="corp_status" class="menubar-item-inactive">CORP. STATUS</li>
                        <li rel="software_market" class="menubar-item-inactive">SOFTWARE MARKET</li>
                        <li rel="mygateway" class="menubar-item-inactive">MY GATEWAY</li>
                        <li rel="my_software" class="menubar-item-inactive">MY SOFTWARE</li>
                    </ul>
                </div>

                @if($installedApps->isEmpty())
                    <div class="applications-menu menubar-item" style="color: #4b4b4b">APPLICATIONS</div>
                @else
                <div class="applications-menu menubar-item" style="color: #ffffff" >APPLICATIONS
                    <ul class="appmenu" id="appmenu">
                        @foreach($installedApps as $app)
                            <li rel="{{ strtolower($app->application->app_name) }}" class="exec">{{ $app->application->app_name }}</li>
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
