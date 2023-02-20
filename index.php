<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<html>
<body class="hold-transition skin-g layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<!-- Slideshow container -->
						<div class="slideshow-container">

						  <!-- Full-width images with number and caption text -->
						  <div class="mySlides fade">
						    <div class="numbertext">1 / 3</div>
						    <img src="images\black_friday.jpg" style="width:100%">
						    <div class="text">Black Friday Offer</div>
						  </div>

						  <div class="mySlides fade">
						    <div class="numbertext">2 / 3</div>
						    <img src="images\bkash-offer.jpg" style="width:100%">
						    <div class="text">20% Offer on Bkash Payment</div>
						  </div>

						  <div class="mySlides fade">
						    <div class="numbertext">3 / 3</div>
						    <img src="images\megasell.jpg" style="width:100%">
						    <div class="text">Mega Sell for December</div>
						  </div>

						  <!-- Next and previous buttons -->
						  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						  <a class="next" onclick="plusSlides(1)">&#10095;</a>
						</div>
						<br>

						<!-- The dots/circles -->
						<div style="text-align:center">
						  <span class="dot" onclick="currentSlide(1)"></span>
						  <span class="dot" onclick="currentSlide(2)"></span>
						  <span class="dot" onclick="currentSlide(3)"></span>
						</div>


					<style>	
						* {box-sizing:border-box}

							/* Slideshow container */
							.slideshow-container {
							  max-width: 1000px;
							  position: relative;
							  margin: auto;
							}

							/* Hide the images by default */
							.mySlides {
							  display: none;
							}

							/* Next & previous buttons */
							.prev, .next {
							  cursor: pointer;
							  position: absolute;
							  top: 50%;
							  width: auto;
							  margin-top: -22px;
							  padding: 16px;
							  color: white;
							  font-weight: bold;
							  font-size: 18px;
							  transition: 0.6s ease;
							  border-radius: 0 3px 3px 0;
							  user-select: none;
							}

							/* Position the "next button" to the right */
							.next {
							  right: 0;
							  border-radius: 3px 0 0 3px;
							}

							/* On hover, add a black background color with a little bit see-through */
							.prev:hover, .next:hover {
							  background-color: rgba(0,0,0,0.8);
							}

							/* Caption text */
							.text {
							  color: #f2f2f2;
							  font-size: 15px;
							  padding: 8px 12px;
							  position: absolute;
							  bottom: 8px;
							  width: 100%;
							  text-align: center;
							}

							/* Number text (1/3 etc) */
							.numbertext {
							  color: #f2f2f2;
							  font-size: 12px;
							  padding: 8px 12px;
							  position: absolute;
							  top: 0;
							}

							/* The dots/bullets/indicators */
							.dot {
							  cursor: pointer;
							  height: 15px;
							  width: 15px;
							  margin: 0 2px;
							  background-color: #bbb;
							  border-radius: 50%;
							  display: inline-block;
							  transition: background-color 0.6s ease;
							}

							.active, .dot:hover {
							  background-color: #717171;
							}

							/* Fading animation */
							.fade {
							  animation-name: fade;
							  animation-duration: 2.5s;
							}
							.content-wrapper{display: flex;
								align-items: center;
								justify-content: center;
								flex-direction: column;
								}


							@keyframes fade {
							  from {opacity: .4}
							  to {opacity: 1}
							}
						</style>
							<script>
							let slideIndex = 0;
							showSlides();

							function showSlides() {
							  let i;
							  let slides = document.getElementsByClassName("mySlides");
							  for (i = 0; i < slides.length; i++) {
							    slides[i].style.display = "none";
							  }
							  slideIndex++;
							  if (slideIndex > slides.length) {slideIndex = 1}
							  slides[slideIndex-1].style.display = "block";
							  setTimeout(showSlides, 2000); // Change image every 2 seconds
							}
							</script>



		            <h2>Make Up Products</h2>
						<!-- Main content -->
						<section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
		            
		       		<?php
		       			
		       			$conn = $pdo->open();
						   $rand = 4;
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $rand]);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        <h2>Laptop</h2>	
	      

		  
	        <div class="row">
	        	<div class="col-sm-12">
		            
		       		<?php
		       			
		       			$conn = $pdo->open();
						   $rand = 6;
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $rand]);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	
	     

		  <h2>Phone</h2>	
	      

		  
	        <div class="row">
	        	<div class="col-sm-12">
		            
		       		<?php
		       			
		       			$conn = $pdo->open();
						   $rand = 7;
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $rand]);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 

	        	
	      </section>

		       		
	     
	    </div>
	  </div>
  
  	
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<?php include 'includes/scripts.php'; ?>
<?php include 'footer.php'; ?>
</body>
</html>

