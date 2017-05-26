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
    <script src="/socket.io/socket.io.js"></script>

</head>
<body>
    <div id="terminalContainer"></div>


    <script>
      window.addEventListener('load', function() {
        var terminalContainer = document.getElementById('terminal-container');
        var term = new Terminal({ cursorBlink: true });
        term.open(terminalContainer);
        term.fit();

        var socket = io.connect();
        socket.on('connect', function() {
          term.write('\r\n*** Connected to backend***\r\n');

          // Browser -> Backend
          term.on('data', function(data) {
            socket.emit('data', data);
          });

          // Backend -> Browser
          socket.on('data', function(data) {
            term.write(data);
          });

          socket.on('disconnect', function() {
            term.write('\r\n*** Disconnected from backend***\r\n');
          });
        });
      }, false);
    </script>
</body>
</html>
