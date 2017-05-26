<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('vendor/xterm/xterm.css') }}" />
    
    <script src="{{ asset('vendor/xterm/xterm.js') }}"></script>
    <script src="{{ asset('vendor/xterm/addons/fit/fit.js') }}"></script>
</head>
<body>
    <div id="terminalContainer"></div>
    <script>
        var terminalContainer = document.getElementById('terminal-container');
        var term = new Terminal({ cursorBlink: true });
        term.open(terminalContainer);

        var shellprompt = '$ ';
        term.write(shellprompt);

        term.prompt = function () {
            term.write('\r\n' + shellprompt);
        };

        term.on('key', function (key, ev) {
          var printable = (
            !ev.altKey && !ev.altGraphKey && !ev.ctrlKey && !ev.metaKey
          );

          if (ev.keyCode == 13) {
            term.prompt();
          } else if (ev.keyCode == 8) {
           // Do not delete the prompt
            if (term.x > 2) {
              term.write('\b \b');
            }
          } else if (printable) {
            term.write(key);
          }
        });

        term.on('paste', function (data, ev) {
          term.write(data);
        });
    </script>
</body>
</html>
