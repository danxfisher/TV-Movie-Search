<!doctype html>
<html>
<head>
  <title>Select Provider</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
  <script language="javascript">
      function setTimezone(){
          var tz = jstz.determine(); // Determines the time zone of the browser client
          return tz.name();
      }
      window.onload = function(){
          document.getElementById('timezone').value = setTimezone();
      }
  </script>
</head>
<body>
