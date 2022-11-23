<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" type="text/css" href="normalize.css">
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style >
    table {
    border-collapse: collapse;
    width: 100%;
    /*overflow: auto;*/
    color: #588c7e;
    font-family: monospace;
    font-size: 20px;
    text-align: left;
    }
    th {
    background-color: #588c7e;
    color: white;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
  </style>
  <style>
    body {
      margin: 0;
      font-family: "Lato", sans-serif;
    }

    .sidebar {
      margin: 0;
      padding: 0;
      width: 200px;
      background-color: black;
      position: fixed;
      height: 100%;
      overflow: auto;
      font-size: 20px;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 16px;
      text-decoration: none;
    }
     
    .sidebar a.active {
      background-color: white;
      color: black;
    }

    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }

    div.content {
      margin-left: 200px;
      padding: 1px 16px;
      /*height: 1000px;*/
    }

    @media screen and (max-width: 700px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      div.content {margin-left: 0;}
    }

    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }
  </style>
</head>
<body> 
  

<div class="sidebar">
  <a class="active" href="searchmovie.php">Search Movie</a>
  <a href="">List</a>
  <a href="index.php">Sign Out</a>
</div>

<div class="content">
<h1>
    <div class="col-sm-12">
      <!-- All Activities -->
      <div class="admin_tick" style="text-align: left;margin-bottom: 20px;">
        <div class="admin_heading" style="margin-bottom: 20px;">
          <h1 style="text-align: center;">All Movies</h1>
        </div>
        <!-- //create php  -->
        <!-- <h4 style="text-align: center;">Remove Club coordinator</h4> -->
      
        <!-- </table> -->
        <?php
          // session_start();
          
          include('connection.php');
          $check=$db->prepare('SELECT * FROM moviesearch');
          // $data=array($_SESSION['uid']);
          $check->execute();
          if($check->rowcount()==0){
            echo 'Empty Table'; //->> 0 for account does not exist
          }

          else{
            ?>
            <table>
              <tr>
              <th>Movie Name</th>
              <th>WorldWide Gross</th>
              <th>action</th>
              </tr>

            <?php
            while($datarow=$check->fetch()){
              ?>
              
              <tr>
                  <td><?php echo $datarow['name'] ?></td>
                  <td><?php echo $datarow['description'] ?></td>
                  <td><button onclick="deleteclub(<?php echo $datarow['mid'] ?>)" 
                    style="text-decoration:none;
                    background: red;
                    border: none;
                    border-radius: 5px;
                    padding: 0px 10px;
                    color: white;
                    margin: 10px;">Delete</button></td>
                </tr>



              <?php
            }
            echo "</table>";
            
          }

        ?>

      </div>
  </h1>
</div>


<script type="text/javascript">
    function savedata(){
      var movie_name=document.getElementById('movie_name').value;
// const options = {
//   method: 'GET',
//   headers: {
//     'X-RapidAPI-Key': '09d032c388msh01b8b4cdb983f37p13a1c0jsnbd49ad14901b',
//     'X-RapidAPI-Host': 'imdb8.p.rapidapi.com'
//   }
// };

// fetch('https://imdb8.p.rapidapi.com/auto-complete?q=game%20of%20thr', options)
//   .then(response => response.json())
//   .then(response => console.log(response))
//   .catch(err => console.error(err));

// const settings = {
//   "async": true,
//   "crossDomain": true,
//   "url": "https://imdb8.p.rapidapi.com/auto-complete?q=game%20of%20thr",
//   "method": "GET",
//   "headers": {
//     "X-RapidAPI-Key": "09d032c388msh01b8b4cdb983f37p13a1c0jsnbd49ad14901b",
//     "X-RapidAPI-Host": "imdb8.p.rapidapi.com"
//   }
// };

// $.ajax(settings).done(function (response) {
//   console.log(response);
// });

var url = new URL("https://imdb8.p.rapidapi.com/title/find?");

// If your expected result is "http://foo.bar/?x=1&y=2&x=42"
url.searchParams.append('q', "k.g.f");

    // if(movie_name!=""){
      $.ajax(
      {
        async: true,
        crossDomain: true,
        type:"GET",
        url:url,
        headers: {
          "X-RapidAPI-Key": "09d032c388msh01b8b4cdb983f37p13a1c0jsnbd49ad14901b",
          "X-RapidAPI-Host": "imdb8.p.rapidapi.com"
        },
        success:function(data){
          console.log(data);
          // if(data == 0){
          //   alert('Club already exists!');
          // }
          // else if(data == 1){
          //   //account created
          //   // alert('Successfully created club!!!');
          //   // open("clubcoordinator.php","_self"); //refresh the page

          // }
          // else if(data == 2){
          //   alert('Some problem encountered!');
          // }
          // else{
          //   alert(data);
          // }
        }
      }
      );

    // }
    // else 
    // {
    //   alert("Invalid Input!");
    // }
    
    
  }
</script>
</body>
</html>