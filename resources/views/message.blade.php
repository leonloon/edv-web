<!DOCTYPE html>
<html>
<head>
    <title>Live Messaging App</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container">

    <h1>Live Messaging App</h1>

    <div id="messages">
    </div>

    {!! Form::open(['method' => 'post']) !!}
      <input class="form-control" type="text" name="name" placeholder="Your name">
      <textarea class="form-control" name="message" rows="2" placeholder="Write something here..."></textarea>
      <button id="submit" type="button" class="float-right btn btn-info">Enter</button>
    {!! Form::close() !!}

  </div>
</body>

<style>
.container {
  padding-top: 20px;
  width: 600px;
}

#messages {
  background-color: #edead9;
  margin: 20px 0;
  padding: 20px;
  border-radius: 8px;
  height: 400px;
  overflow: auto;
}

textarea {
  margin: 10px 0;
}

.chat-bubble {
  border-radius: 8px;
  background-color: #fff;
  padding: 10px;
}

.username {
  margin-right: 5px;
}

.timestamp {
  font-size: 9px;
  margin-left: 10px;
  margin-top: 5px;
}

</style>

<script>
$(document).ready(function() {
  $('#submit').click(function() {
    event.preventDefault();
    $.ajax({
      url: '/api/message',
      type: 'POST',
      data: {'name': $('input[name=name]').val(),
             'message': $('textarea').val(),
             '_token': '{{ csrf_token() }}'},
      success: function(data) {
        $('textarea').val('');
      }
    });
  });
});

function getMessage() {
  $.ajax({
    url: '/api/message',
    type: 'GET',
    data: { get_param: 'value' },
    dataType: 'json',
    success: function (data) {

      var id = $('#messages p.chat-bubble:last-child').data('id');

      var length = data.length - 1;

      var lastId = data[length].id;

      if (id != lastId) {
        $('#messages').append('<p class="chat-bubble" data-id="' + data[length].id + 
          '"><span><b class="username">'+ data[length].name +':</b> ' + data[length].message + '</span><span class="timestamp">'+ 
          data[length].created_at.slice(10, 16) +'</span></p>');
      };
    }
  })
}

getMessage();
setInterval(getMessage, 100);
</script>
</html>