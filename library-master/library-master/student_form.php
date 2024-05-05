<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php');?>

	<div class="container">
		<div class="margin-top">
			<div class="row">
				<?php include('head.php'); ?>
					
				<div class="span12">
					<form action="<?php $_PHP_SELF ?>" method="POST">	
								<div class="span5">
								<div class="form-horizontal">
									
									<div class="control-group">
										<label class="control-label" for="inputEmail">First Name:</label>
										<div class="controls">
										<input type="text" id="inputEmail" name="firstname" placeholder="first Name" required>
											&nbsp;	&nbsp; 	&nbsp; 	&nbsp;
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inputEmail">Last Name:</label>
										<div class="controls">
										<input type="text" id="inputEmail" name="lastname"  placeholder="last Name" required>
											&nbsp;	&nbsp; 	&nbsp; 	&nbsp;
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inputEmail">User Name:</label>
										<div class="controls">
										<input type="text" id="inputEmail" name="username"  placeholder="User Name" required>
											&nbsp;	&nbsp; 	&nbsp; 	&nbsp;
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="inputEmail">Gender:</label>
										<div class="controls">
										<select name="gender" required>
										
													<option>Male</option>
													<option>Female</option>
													
									   </select>
									</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inputEmail">Address:</label>
										<div class="controls">
										<input type="text" id="inputEmail" name="address"  placeholder="Address" required>
											&nbsp;	&nbsp; 	&nbsp; 	&nbsp;
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="inputEmail">Roll No:</label>
										<div class="controls">
										<input type="text" id="inputEmail" name="roll"  placeholder="Roll No" required>
											&nbsp;	&nbsp; 	&nbsp; 	&nbsp;
										</div>
									</div>
									
									
									<div class="control-group">
										<label class="control-label" for="inputEmail">Contact:</label>
										<div class="controls">
										<input type="text" id="inputEmail" name="contact" placeholder="Contact" required>
											&nbsp;	&nbsp; 	&nbsp; 	&nbsp;
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="inputEmail">Type:</label>
										<div class="controls">
										<select name="type" required>
										
													<option>Student</option>
													<option></option>
													
									   </select>
								   </div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="inputEmail">Year_Level:</label>
										<div class="controls">
										<select name="year_level" >
													
													<option>First Year</option>
													<option>Second Year</option>
													<option>Third Year</option>
													<option>Fourth Year</option>
													<option>Masters</option>
										</select>
									</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="inputPassword">Password</label>
										<div class="controls">
										<input type="password" name="password" placeholder="Password">
										</div>
									</div>

									<div class="control-group">
										<div class="controls">
										<button name="submit" type="submit" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Confirm</button>
										</div>
									</div>
								</div>
							</div>
				</div>
			</div>
		</div>
	</div>
			
			<div class="span6">
	
	
			<div class="form-horizontal">

			<?php 
if(isset($_POST['submit'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $username = htmlspecialchars($_POST['username']);
    $gender = htmlspecialchars($_POST['gender']);
    $address = htmlspecialchars($_POST['address']);
    $contact = htmlspecialchars($_POST['contact']);
    $type = htmlspecialchars($_POST['type']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "INSERT INTO member (firstname, lastname, username, gender, address, contact, type, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssss", $firstname, $lastname, $username, $gender, $address, $contact, $type, $password);

    if(mysqli_stmt_execute($stmt)) {
        echo "<script type='text/javascript'>window.location='success.php';</script>";
    } 
    mysqli_stmt_close($stmt);
} else {
    echo " ";
}
?>


		
		</div>
		
		</div>	

	</form>