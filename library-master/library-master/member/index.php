<?php include('header.php'); 
	session_start()
?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">
					<div class="sti">
						<img src="../LMS/main.png" class="img-rounded">
					</div>
				<div class="login">
				<div class="log_txt">
				<p><strong>Please Put Your Username & Password</strong></p>
				</div>
						<form class="form-horizontal" method="POST">
								<div class="control-group">
									<label class="control-label" for="inputEmail"><strong>Username</strong></label>
									<div class="controls">
									<input type="text" name="username" id="username" placeholder="Username" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPassword"><strong>Password</strong></label>
									<div class="controls">
									<input type="password" name="password" id="password" placeholder="Password" required>
								</div>
								</div>
								<div class="control-group">
									<div class="controls">
									<button id="login" name="submit" type="submit" class="btn"><i class="icon-signin icon-large"></i>&nbsp;Submit</button>
								</div>
								</div>
								
								<?php
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT * FROM member WHERE username=? AND password=?";
    
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            $_SESSION['id'] = $row['member_id'];

            header('Location: dashboard.php');
        } else {
            echo '<div class="alert alert-danger">Please Check Your Username and Password</div>';
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
} else {
    echo " ";
}
?>

						</form>
				
				</div>
			</div>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>