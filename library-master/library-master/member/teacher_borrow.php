<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

    <div class="container">
		<div class="margin-top">
			<div class="row">	
				<div class="span12">		
					<div class="alert alert-info">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong><i class="icon-user icon-large"></i>&nbsp;Borrowed Books</strong>
									</div>
							<!--  -->
										<ul class="nav nav-pills">
											<li ><a href="view_borrow.php">Student</a></li>
											<li class="active"><a href="teacher_borrow.php">Teacher</a></li>
											<li><a href="#myModal3" data-toggle="modal"><i class="icon-search icon-large"></i>&nbsp;Search</a></li>
										</ul>
							<!--  -->
						
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
							
							<div class="pull-right">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
								</div>
								
                                <thead>
                                    <tr>
                                        <th>Book title</th>                                 
                                        <th>Borrower</th>
										<th>Email</th> 
                                        <th>Date Borrow</th>                                 
                                        <th>Due Date</th> 
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php  $query = "SELECT borrow.borrow_id, borrowdetails.book_id, borrowdetails.borrow_details_id, book.book_title, member.firstname, member.lastname, member.username, borrow.date_borrow, borrow.due_date
          FROM borrow
          LEFT JOIN member ON borrow.member_id = member.member_id
          LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
          LEFT JOIN book ON borrowdetails.book_id = book.book_id 
          WHERE borrowdetails.borrow_status = 'pending' AND member.type = 'teacher'
          ORDER BY borrow.borrow_id DESC";

// Prepare and execute the statement
$stmt = $conn->prepare($query);
$stmt->execute();

// Bind result variables
$stmt->bind_result($id, $book_id, $borrow_details_id, $book_title, $firstname, $lastname, $username, $date_borrow, $due_date);

// Fetch values and display them
while ($stmt->fetch()) {
    ?>
    <tr class="del<?php echo $id ?>">
        <td><?php echo htmlspecialchars($book_title); ?></td>
        <td><?php echo htmlspecialchars($firstname . " " . $lastname); ?></td>
        <td><?php echo htmlspecialchars($username) . "@gmail.com"; ?></td>
        <td><?php echo htmlspecialchars($date_borrow); ?></td> 
        <td><?php echo htmlspecialchars($due_date); ?></td>
    </tr>
    <?php
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
</tbody>
                            </table>
							

			    </div>		
		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>