<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar.php'); ?>
<?php
$from = $_POST['from']; 
$to = $_POST['to'];
?>

    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-info">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong><i class="icon-user icon-large"></i>&nbsp;Returned Books</strong>
									</div>
							<!--  -->
										<ul class="nav nav-pills">
											<li ><a href="return.php">Student</a></li>
											<li ><a href="teacher_return.php">Teacher</a></li>
											<li class="active"><a href="#myModal4" data-toggle="modal"><i class="icon-search icon-large"></i>&nbsp;Search</a></li>
										</ul>
						<!--  -->
						<center class="title">
						<h1>Returned Books</h1>
						</center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
								<div class="pull-right">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
								</div>
							
							
                                <thead>
                                    <tr>
                                        <th>Book title</th>                                 
                                        <th>Borrower</th>                                 
                                        <th>Email</th>
										<th>Type</th>                                 
                                        <th>Date Borrow</th>                                 
                                        <th>Due Date</th> 
										<th>Date Returned</th>
                                    </tr>
                                </thead>
                                <tbody>
								 
                                
								  
								<tbody>
<?php  
    $query = "SELECT * FROM borrow
                LEFT JOIN member ON borrow.member_id = member.member_id
                LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
                LEFT JOIN book ON borrowdetails.book_id = book.book_id 
                WHERE borrowdetails.borrow_status = 'returned' 
                AND borrowdetails.date_return BETWEEN ? AND ?
                ORDER BY borrow.borrow_id DESC";
    $stmt = mysqli_prepare($conn, $query);
    
    // Assuming $from and $to are already defined with proper values
    mysqli_stmt_bind_param($stmt, "ss", $from, $to);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['borrow_id'];
        $book_id = $row['book_id'];
        $borrow_details_id = $row['borrow_details_id'];
?>
    <tr class="del<?php echo $id ?>">
        <td><?php echo $row['book_title']; ?></td>
        <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
        <td><?php echo $row['username']; ?>@gmail.com</td>
        <td><?php echo $row['type']; ?></td>
        <td><?php echo $row['date_borrow']; ?></td> 
        <td><?php echo $row['due_date']; ?></td>
        <td><?php echo $row['date_return']; ?></td>
    </tr>
<?php  
    }  
    mysqli_stmt_close($stmt);
?>
</tbody>

                            </table>
							

				</div>		
		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>