<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <title>Laravel</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <div class="" id="app">
      <h1>Chatroom</h1>
      <chat-log v-bind:messages="messages"></chat-log>
      <chat-composer v-on:messagesent="addMessage"></chat-composer>
    </div>

    <script type="text/javascript" src="/js/app.js"></script>
  </body>
</html>
