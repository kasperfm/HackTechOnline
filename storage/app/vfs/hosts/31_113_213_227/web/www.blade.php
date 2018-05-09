@extends('templates.www')

@section('content')
    <link href="css/jquery.terminal.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.terminal.js"></script>

    <style>
        @keyframes blink {
            50% {
                color: #000;
                background: #0c0;
                -webkit-box-shadow: 0 0 5px rgba(0,100,0,50);
                box-shadow: 0 0 5px rgba(0,100,0,50);
            }
        }
        @-webkit-keyframes blink {
            50% {
                color: #000;
                background: #0c0;
                -webkit-box-shadow: 0 0 5px rgba(0,100,0,50);
                box-shadow: 0 0 5px rgba(0,100,0,50);
            }
        }
        @-ms-keyframes blink {
            50% {
                color: #000;
                background: #0c0;
                -webkit-box-shadow: 0 0 5px rgba(0,100,0,50);
                box-shadow: 0 0 5px rgba(0,100,0,50);
            }
        }
        @-moz-keyframes blink {
            50% {
                color: #000;
                background: #0c0;
                -webkit-box-shadow: 0 0 5px rgba(0,100,0,50);
                box-shadow: 0 0 5px rgba(0,100,0,50);
            }
        }
        .terminal {
            font-family: monospace !important;
            --background: #000;
            --color: #0c0;
            text-shadow: 0 0 3px rgba(0,100,0,50);
        }
        .cmd .cursor.blink {
            font-family: monospace !important;
            -webkit-animation: 1s blink infinite;
            animation: 1s blink infinite;
            -webkit-box-shadow: 0 0 0 rgba(0,100,0,50);
            box-shadow: 0 0 0 rgba(0,100,0,50);
            border: none;
            margin: 0;
        }

        #psybytes_term > div.terminal-wrapper > div.cmd > div > span > span {
            font-family: monospace !important;
            font-size: large;
        }

        .terminal .terminal-output div span{
            font-family: monospace !important;
            font-size: large;
        }

        #psybytes_term > div.terminal-wrapper > div.cmd > div{
            font-size: large;
            font-family: monospace !important;
        }

        #psybytes_term > div.terminal-wrapper > div.cmd{
            font-size: large;
            font-family: monospace !important;
        }
    </style>

    <img width="100%" height="100%" src="vfs/web/img/31_113_213_227-logo.png" alt="PsychedelicBytes" />
    <br>

    <div style="padding-top: 15px; max-height: 285px; overflow: paged-y-controls;" id="psybytes_term"></div>

    <script>
        $(function() {
            $('#psybytes_term').terminal(function(command, term) {
                return $.post('/game/web/31_113_213_227/ajax/terminal', {command: command});
            }, {
                greetings: 'PsyBytes Terminal - Your shortcut to a better trip\n' +
                'Type help to see a list of commands'
            });
        });
    </script>
@endsection
