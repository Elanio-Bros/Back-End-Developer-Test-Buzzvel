<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>
            {{$title}}
        </h1>
            <hr/>
        <h3>
            Date: {{date('m/d/Y',strtotime($date))}}
        </h3>
        <h3>
           Location: {{ucwords($location)}}
        </h3>
        <h3>
            Participants: {{implode(', ',$participants)}}
        </h3>
        <hr/>
        <h3>
            Resume
        </h3>
        <p>
            {{$description}}
        </p>
    </body>
</html>