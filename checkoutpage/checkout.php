<?php
include_once "../connection.php";
session_start();
$user_id=$_SESSION['userID'];

if(isset($_POST['submit']))
{
$first_name=$_POST['fname'];
$last_name=$_POST['lname'];
$country=$_POST['country'];
$street_address=$_POST['street'];
$city=$_POST['city'];
$state=$_POST['state'];
$postcode=$_POST['postcode'];
$phone_number=$_POST['phonenumber'];
$email_address=$_POST['emailaddress'];
$productid;
// $product_id="1";
// $checkoutData="SELECT product_id FROM checkout;";
// $resultData=mysqli_query($conn,$checkoutData);
// while($row=mysqli_fetch_assoc($resultData)){
// 	$product_id=$row['product_id'];
//   $productid=$product_id;

// }


$checkoutData="SELECT * FROM checkout;";
$resultData=mysqli_query($conn,$checkoutData);
while($row=mysqli_fetch_assoc($resultData)){
    $product_id=$row['product_id'];
 
  $order_num=$row['order_number'];
 $order_quan = $row['order_quantity'];

}
echo $order_num;

$sql5 = "INSERT INTO checkout (order_number,product_id,user_id,order_quantity, first_name, last_name, country, state, city, street_address, zipcode, phone, order_email)
VALUES ('$order_num','$product_id','$user_id','$order_quan','$first_name', '$last_name', '$country','$state','$city','$street_address','$postcode','$phone_number','$email_address');";
$resultplease=mysqli_query($conn,$sql5);
if(!$sql5)
echo("Error description: " . mysqli_error($conn));

//$sql7 = "DELETE FROM checkout WHERE first_name = '';";


//$delete_temp = mysqli_query($conn,$sql7);
header("location:../billPage/billPage.php");


//
$sqlBill = "SELECT billing_number FROM billing_history";
    $queryBill = mysqli_query($conn, $sqlBill);
    $row1 = mysqli_fetch_assoc($queryBill);
    $resultcheck1 = mysqli_num_rows($queryBill);

    $num = $resultcheck1 + 1;

    // echo "$num / $id / $total";

    $_SESSION["bill_id"] = $num;
    $sqlBill = "INSERT INTO billing_history(billing_number, user_id) VALUES('$num', '$user_id');";
    $run2 = mysqli_query($conn, $sqlBill);
    $sqlBill2 = "UPDATE `checkout` SET `bill_id`='$num',`user_id`='$user_id' WHERE 1;";
    $run3 = mysqli_query($conn, $sqlBill2);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/bootstrap.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Lobster&family=Lora&family=Sacramento&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="./css/footer.css">
   
    <script src="https://kit.fontawesome.com/f32d43040b.js" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<nav class="navbar navbar-expand-lg ">
        <div class="container">
        <a class="navbar-brand" href="#"><img src="../img/projectimg/logo.png" width="125px" height="auto"alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation" >
                <span class="navbar-toggler-icon" style="color: black;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about us/about_us.php"> About us</a>
                    </li>
                    
                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            CATEGORIES
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="../ProductsPage/Dress.php">Dress</a></li>
                          <li><a class="dropdown-item" href="../ProductsPage/Suit.php">Suits</a></li>
                          <li><a class="dropdown-item" href="../ProductsPage/Accessories.php">Accessories</a></li>
                          <li><a class="dropdown-item" href="../ProductsPage/Men_shoes.php">Men Shoes</a></li>
                          <li><a class="dropdown-item" href="../ProductsPage/Women_shoes.php">Women Shoes</a></li>
                         
                        </ul>
                      </li>
                    
                </ul>
                <form action="" method="post">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                    <!-- profile icon/login/register -->
                    
                <?php
                
        
                          $check=0;
                        
                          if(isset($_SESSION["userID"])){

                               $profile_icon= '
                               <a class="nav-link" href="../profile_page/user_profile.php">
                                   <i class="fa-solid fa-user"></i>
                               </a>';

                               $cart='
                               <a class="nav-link" href="../cart.php">
                               <i class="fa-solid fa-cart-shopping"></i>
                                 </a>'
                               
                               
                               ?>
                               <form action="" method='post'>
                           <li class="nav_item"><input class="nav-link" type="submit" name="logout" value=" Logout " style="border:none; background-color: white;">
                                </li>
                                   </form>
                                 
                                  <?php if(isset($_POST['logout'])){
                                   
                                    session_destroy();
                                    echo'<script>
                                     setTimeout(() => {
                                         window.location = "index.php";
                                       })
                                     
                                     </script>';
                               
                                  }

                          }else
                           
                           { echo '<li class="nav-item ">
                            <a class="nav-link " href="./loginPage/login.php">
                                Login </a> </li>';

                            echo '<li class="nav-item ">
                            <a class="nav-link " href="./registerPage/register.php">
                                Register </a> </li>';
                           }?>
                       <!-- <li class="nav-item">
                      

                    </li> -->

                       <li class="nav-item">
                       <?php if(isset( $profile_icon)){echo $profile_icon;}?>

                    </li>
                  
                    <li class="nav-item">
                    <?php if(isset( $cart)){echo $cart;}?>

                    </li>
                </ul>
                </form>

            </div>
        </div>
    </nav>
    
  
	<div class="row">
		<div class="col-md-5 container bg-default">
			<h1 class="my-4">
                Checkout
        	</h1>
        	<hr style="background-color: rgba(3, 50, 239, 0.804); height:3px">
			<h4 class="my-4">
				Billing details
			</h4>
			<form action="" method="post">
				<div class="form-row">
					<div class="col-md-6 form-group">
						<label for="firstname">First Name</label>
						<input type="text" class="form-control" name="fname" id="firstname" placeholder="First Name">
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>

					<div class="col-md-6 form-group">
						<label for="lastname">Last Name</label>
						<input type="text" class="form-control" name="lname" id="lastname" placeholder="Last Name">
						<div class="invalid-feedback">
							Valid last name is required.
						</div>
					</div>
				</div>

			
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" id="country" placeholder="country" required>
               </div>

               <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="city" required>
              </div>


				<div class="form-group">
					<label for="adress"> Street address</label>
					<input type="text" class="form-control"  name="street" id="adress" placeholder="1234 Main Street" required>
					<div class="invalid-feedback">
						Please enter your shipping address.
					</div>
				</div>

				<div class="form-group">
					<label for="state">State
						<span class="text-muted">(Optional)</span>
					</label>
					<input type="text" class="form-control" name="state" id="state" placeholder="state">
				</div>

                <div class="form-group">
					<label for="postcode">Postcode
					</label>
					<input type="text" class="form-control" name="postcode" id="postcode" placeholder="postcode">
				</div>

                <div class="form-group">
					<label for="tel">Phone Number
					</label>
					<input type="tel" class="form-control" name="phonenumber" id="tel" placeholder="000-0000-000">
				</div>

                
				<div class="form-group">
                    <label for="email">Email address </label>
                    <input type="email" class="form-control" name="emailaddress" id="email" placeholder="you@example.com" required>
            </div>
	
		</div>

	
		<div class="col-md-5 col-lg-3 col-xl-3 offset-lg-1 offset-xl-2 container totalcard ">
      <div class="p-3" style="border:1px solid blue ">
        <h2 class="fw-bold">Your order</h2>
        <div class="d-flex justify-content-between mt-2">
          <h4>Product</h4> <h4>Subtotal</h4>
        </div>
		<hr>
		<?php
		$sql1="SELECT * FROM cart WHERE user_id={$_SESSION['userID']}";
		$result= mysqli_query($conn , $sql1);
		$result_check= mysqli_num_rows($result);
		
		if ($result_check > 0) {
			while($row=mysqli_fetch_assoc($result)){
		
				$items=$row['product_name'].'  x '. $row['order_quantity'];
				$itemprice=$row['order_price'] * $row['order_quantity'];
			
				echo  "<div class='d-flex justify-content-between mt-2'>";
				echo "<span>".'$'.$items. "</span>";
				echo "<span>".'$'.$itemprice. "</span>";
			
			
			  echo "</div>";

			
			}}
			
///////////////////////total price/////////////////////////

// $summ="SELECT *
// FROM  checkout
// WHERE user_id={$_SESSION['userID']};";
// $result1= mysqli_query($conn , $summ);
// $result_check1= mysqli_num_rows($result1);

// if ($result_check1 > 0) {
// 	while($row1=mysqli_fetch_assoc($result1)){

// 	}
// }
	?>
		<hr>
        <div class="d-flex justify-content-between mt-2">
          <span>Total </span> <span class="text-success"><?php echo $_SESSION['total'].'$'?></span>
        </div>
		<hr class="mb-4">
		<h6 class="fw-bold">Cash on delivery</h6>
		<p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
		<button class="btn btn-primary bt-lg btn-block" type="submit" name="submit">PLACE ORDER</button>
      </div>
    </div>
  </div>
  </form>
</div>
</body>
</html>