## About HackTech Online

HackTech Online is a semi-realistic hacking simulation game, set in a near cyberpunk like future.
All you need is a web browser, to be able to play with people from all around the world!

In HackTech Online no player is safe, and no firewall is good enough! You take part in the game as yourself, and have the option to fight against the bad guys on the net, or join them... Join or create a corporation with other players, and start your PvP hacking career. Or choose to complete missions for underground groups, big corporations or secret government agencies.
You will soon be able to conquer the net!

## Who made this?

The game is made by me, Kasper Færch Mikkelsen (https://kasperfm.com).
HTO is my "little child" that I have been working on for a long time. In the beginning I used it to learn PHP and Javascript, but as time passed I rewrote it a couple of times. Now the game is made with Laravel 8.x (started as Laravel 5.5), and this is probably the last version of the game I will make.

## Development status

I don't have the time for completing this project, or developing it any further. So now I'm releasing the code for everything here on Github, for you to play around with.

The project is made with PHP using the Laravel Framework. The ingame messenger chat system is made using NodeJS. There is also a lot of jQuery involved.

So if you want to make your own fork, feel free to do so. But please don't report Issues, as the development is halted. If you decide to make your own game from this, please just include the original name of the project, the author (me), and a link to this Github repo. That would make me very happy 😄

There is not much documentation for the development and the source code overall, but if you have any questions, feel free to reach out to me. Just remember: The game was made while I was learning Laravel. So the code may not be pretty, and all that fancy, but I still put a lot of hours into this project ❤️

## Working features

- [x] Login and signup functionality (using invite keys)
- [x] UI window system
- [x] Module based ingame applications with support for multiple versions of the same app
- [x] An ingame "virtual internet" with IP addresses and hostnames
- [x] Corporation trust points to decide which missions a user can take
- [x] Missions/Contracts for players to complete and earn money, files and trust points
- [x] Game webbrowser for players to visit ingame websites
- [x] Gateways (player computers) and servers (AI/system and even support for player owned)
- [x] Ports and services for servers
- [x] Software market
- [x] Gateway upgrades and system resource meters
- [x] Ingame email client and messenger/chat service
- [x] "Virtual File System" for both servers and gateways with a filebrowser
- [x] NPC and player based corporations
- [x] Banks with accounts and a simple economy system
- [x] Basic admin panel made with Backpack for Laravel
- [x] Admin tools for creating servers and files
- [x] Dynamic seeder-system for adding new content to the game database
- [x] Bug report system


## ToDo

There is some things that aren't done yet (Surprise!). So here is my personal list of things that the game needs, before it's a "real" game.

(Items marked with a star * has high priority)

### Admin panel:
- [ ] Mission creator tool*
- [ ] Server manager*
- [ ] Dynamic ingame music manager
- [ ] A list of online users

### Game features:
- [ ] Hal - The AI helper
- [ ] Additional logging of user actions
- [ ] Missions! A lot of them + more corporations*
- [ ] More hardware parts for both servers and gateways*

### Ideas for further development:
- [ ] Black market for software trade
- [ ] Help tool for new players
- [ ] In game logging of world actions
- [ ] App - Log deleter / modifier
- [ ] App - Finances overview
- [ ] App - Server manager
- [ ] App - Whois tool
- [ ] App - Remote system analyzer
- [ ] Corp - Corporation bank accounts
- [ ] Corp - Share scripts/software with other corp members
- [ ] Corp - Role and permission system for corporation members


## How do I set up the game?

- Start with setting up your server for a regular Laravel project.
- Run ``composer install`` To install the required composer packages.
- Run ``npm install`` To install the JS packages.
- Make a copy of ``.env.example`` as ``.env`` and fill out the variables.
- Run ``php artisan migrate`` To generate all the MySQL tables.
- Run ``php artisan db:seed`` To seed the database with the default data.
- Run ``php artisan game:makeinvite 1`` To make an invite key to use in the registration process.
- Run ``npm run prod`` To build javascript files, and copy assets.
- Go to the project URL you set up, and sign up using the invite key you just made.
- You are good to go!

Note: If you want to use the admin system, you should set is_admin in the users table to 1 for your account entry. You also have to give your user the 'admin' role in the database manually or by using artisan tinker.
