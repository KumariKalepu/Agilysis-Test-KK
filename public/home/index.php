<?php 
   require '../assets/info.php';
   
   $userID = "";
   $url = "https://fibonacciservice.azurewebsites.net/api/fibonacci/";
   $Ordinal ="";
   $urlData ="";
   
   // If the session Id for user is not set through login/register page, redirecting to login page
   if(!isset($_SESSION['UserID']))
   {
	   header('Location : ../index.php'); 
   }
   else
   {
	   $userID = $_SESSION['UserID'];	   
	   if(isset($_GET['value']))
	   {
	     // Retrieve value passed through login page, register page, combo select and concatinate to the Fibonacci API URL
		 $url = $url . $_GET['value']; 
		 $Ordinal = $_GET['value'];	
         $urlData = file_get_contents($url);	// Calling the Fibonacci API	 
	   }  
   }
?>

<html lang="en">
  <head>
  <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
    <title>MyWebApp - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../css/dashboard.css" rel="stylesheet">  
  </head>
  <body>
       <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">MyWebApplication</a>
        <ul class="navbar-nav px-3">
          <li class="nav-item text-nowrap">
            <a name = 'Logout' class="nav-link" href="../logout.php">Log out</a>
          </li>
        </ul>
      </nav>

      <div class="container-fluid">
        <div class="row">
          <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
              </ul>
              
            </div>
          </nav>

          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <h1 class="h2">Dashboard</h1><small><?php echo $userID  ?></small>
            </div>
            <canvas class="my-4" id="myChart" width="900" height="380" data = '<?php echo $urlData ?>'></canvas>
            <h2>Fibonacci Sequence</h2>
            <div class="table-responsive">
			<form action="?" method="get" name="comboSelect">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>Ordinal</th>
                    <th>Value</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td id="Ordinal"> <?php echo $Ordinal ?> </td>
					<td align="left"> <?php echo $urlData ?> </td>
                    <td name="Value" align="left">
					   <select name="value" OnChange="comboSelect.submit()" >
                          <?php for ($number = 1;$number<=50 ;$number +=1)echo '<option value="'.$number.'">'.$number.'</option>'?>
                       </select>					 
					</td>
					
                  </tr>
                </tbody>
              </table>
			  </form>
            </div>
          </main>
        </div>
      </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="../js/dashboard.js"></script>
  </body>
</html>