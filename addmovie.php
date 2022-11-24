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
  <a href="searchmovie.php">All Movies</a>
  <a href="mylist.php">My list</a>  
  <a href="publicmovies.php">Public List</a>
  <a class="active" href="addmovie.php">Add Movies</a>
  <a href="index.php">Sign Out</a>
</div>


<div class="content">
  <section id="adminform" class="section_class">
		<div class="col-sm-12">
		
			<div class="col-sm-6">
				
					<div class="admin_tick" style="text-align: left;margin-bottom: 20px;">
						<div class="admin_heading" style="margin-bottom: 20px;">
							<h1 style="text-align: center;">Add Movies</h1>
						</div>
						<form id="adminform">
							<div class="form-group">
								<input type="text" id="imgurl" placeholder="Image url" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="text" id="name" placeholder="Movie Name" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="text" id="budget" placeholder="Movie Box office" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="date" id="date" placeholder="Release Date" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="submit" value="Submit" class="btn btn-success btn-block" onclick="savedata();">
							</div>	
						</form>
					</div>
			</div>
			
		</div>
	</section>
</div>
<script type="text/javascript">
	function savedata(){
		var url=document.getElementById('imgurl').value;
		var name=document.getElementById('name').value;
		var budget=document.getElementById('budget').value;
		var date=document.getElementById('date').value;

		if(url!="" && name!="" && budget!=""){
			
			//sending data to backend
			//using ajax post
			// alert('sending data');
			$.ajax(
			{
				type:"POST",
				url:"ajax/addmovie.php",
				data:{url:url,name:name,budget:budget,date:date}, //cvalue will be passed in ajax
				success:function(data){
					//we are getting the result in form of data from the signup php
					if(data == 0){
						alert('Movie already exists!');
					}
					else if(data == 1){
						//account created
						alert('Successfully added movie!!!');
						open("addmovie.php","_self"); //refresh the page

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
<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</body>
</html>