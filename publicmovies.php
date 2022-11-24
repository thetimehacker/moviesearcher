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
  <a  href="searchmovie.php">All Movies</a>
  <a href="mylist.php">My list</a>  
  <a class="active" href="publicmovies.php">Public List</a>
  <a href="addmovie.php">Add Movies</a>
  <a href="index.php">Sign Out</a>
</div>

<div class="content">
<h1>
    <div class="col-sm-12">
      <!-- All Activities -->
      <div class="admin_tick" style="text-align: left;margin-bottom: 20px;">
        <div class="admin_heading" style="margin-bottom: 20px;">
          <h1 style="text-align: center;">Public Movies</h1>
        </div>
        <!-- //create php  -->
        <!-- <h4 style="text-align: center;">Remove Club coordinator</h4> -->
      
        <!-- </table> -->
        <?php
          session_start();
          
          include('connection.php');
          $check=$db->prepare('SELECT * FROM moviesearch where (public=0)');
          // $data=array($_SESSION['sid']);
          $check->execute();
          if($check->rowcount()==0){
            echo 'Empty Table'; //->> 0 for account does not exist
          }

          else{
            ?>
            <table>
              <tr>
              <th>Image</th>
              <th>Movie Name</th>
              <th>WorldWide Gross</th>
              </tr>

            <?php
            while($datarow=$check->fetch()){
              ?>
              
              <tr>

                  <td><img src ="<?php echo $datarow['image'] ?>" style="width: 250px;height: 200px;padding:10px;"/></td>
                  <td><?php echo $datarow['name'] ?></td>
                  <td><?php echo $datarow['description'] ?></td>

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
   function addclub(mid){

    if(mid!=""){
      
      $.ajax(
      {
        type:"POST",
        url:"ajax/approve.php",
        data:{mid:mid},
        success:function(data){
          if(data==0){
            // alert('Activity Does not exist!!!');
          }
          else if(data == 1){
            //account created
            alert('Successfully added movie!!!');
            open("searchmovie.php","_self"); //refresh the page

          }
          else if(data == 2){
            alert('Some problem encountered!');
          }
          else{
            alert(data);
          }
        }
      }
      );

    }
    else 
    {
      alert("Invalid Input!");
    }
    
  }

  function remove(mid){

    if(mid!=""){
      
      $.ajax(
      {
        type:"POST",
        url:"ajax/approve.php",
        data:{mid:mid},
        success:function(data){
          if(data==0){
            // alert('Activity Does not exist!!!');
          }
          else if(data == 1){
            //account created
            alert('Successfully removed movie!!!');
            open("searchmovie.php","_self"); //refresh the page

          }
          else if(data == 2){
            alert('Some problem encountered!');
          }
          else{
            alert(data);
          }
        }
      }
      );

    }
    else 
    {
      alert("Invalid Input!");
    }
    
  }
</script>
</body>
</html>

