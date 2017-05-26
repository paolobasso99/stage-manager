<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/axios.js') }}"></script>

</head>
<body>
    <div id="terminal-container">
        <form id="terminal-form" action="{{ route('ssh') }}" method="post">
            {{ csrf_field() }}
            <input id="terminal-input" type="text" name="command" value="">
            <pre id="terminal-output">

            </pre>
            <input id="terminal-submit" type="submit" name="submit" value="Submit">
        </form>
    </div>


    <script>

        $("#terminal-form").submit(function(e){
            console.log('Submit comand ...');
            e.preventDefault();

            axios({
                method:'post',
                url: '{{ route('ssh') }}',
                timeout: 5000,
                data: {
                    command: $('#terminal-input').val(),
                    host: 'http://lab3.workup.it',
                    username: 'root',
                    password: '{{ Crypt::encrypt('%1t4_l4b3') }}'
                }
            }).then(function (response) {
                    $('#terminal-output').html(response.data);
                    console.log(response);
            });
        });

    </script>
</body>
</html>
