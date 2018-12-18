
<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=index.html", true, 303);
 }
?>


<!DOCTYPE html><html>


<head>
  <meta charset="utf-8">
 <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
  <script>
  // This code depends on jQuery Core and Handlebars.js
function f(){
  var playerID=document.getElementById('playerID');
  var player2ID=document.getElementById('player2ID')
  alert(playerID)
  alert(player2ID);
  var resource_url = 'compare.php?playerID='+ playerID + 'player2ID=' + player2ID;
  $.get(resource_url, function (data) {
  	console.log(data);
      // data: { meta: {<metadata>}, data: {<array[Practice]>} }
      var template = Handlebars.compile(document.getElementById('docs-template').innerHTML);
      document.getElementById('content-placeholder').innerHTML = template(data);
  });
}
  </script>

  <style>
body {
    font-family: ProximaNovaReg, 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
h3 {
    color: #bb3794;
}
a {
    text-decoration: none;
}
a, a:visited {
    color: rgb(84, 180, 210);
}
a:hover {
    color: rgb(51,159,192);
}
th {
    text-align: left;
}
td, th {
  padding-right: 20px;
}
  </style>
</head>
<body>
  <form>
<input type=text name="playerID" id="playerID" required >playerID
<input type=text name="player2ID" id="player2ID" required >player2ID
<input type=button onclick="f()">
  </form>
<div id="result">
<h3>NBA FANTASY - Player Search Results</h3>
<div id="content-placeholder"></div>
<script id="docs-template" type="text/x-handlebars-template">
    <table>
        <thead>
            <th>Name</th>
            <th>Title</th>
            <th>Bio</th>
            <th>Picture</th>
        </thead>
        <tbody>
        {{#data}}
        """<tr>
            <td><a href="link.php?lic={{uid}}" target="_new">{{profile.first_name}} {{profile.last_name}}</a><br>
              <img src="{{ratings.0.image_url_small}}"></img></td>
            <td>{{profile.title}}</td>
            <td>{{uid}}</td>
            <td><img src="{{profile.image_url}}"></img></td>
        </tr>"""
        {{/data}}
        </tbody>
    </table>
</script>
</div>
</body>
</html>
