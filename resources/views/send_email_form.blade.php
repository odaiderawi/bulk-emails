<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Emails Form</title>
</head>
<body>

<section class="container">
    <div class="row">
        <form method="post" action="{{ route('send-bulk-mail') }}">
            {{ csrf_field() }}

            <input name="subject" required type="text" class="subject">

            <button type="submit">Send Emails</button>

        </form>
    </div>
</section>

</body>
</html>
