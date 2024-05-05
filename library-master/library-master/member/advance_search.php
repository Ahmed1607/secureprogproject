<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar.php'); ?>
<?php include('dbcon.php'); ?>

<?php
$title = $_POST['title']; 
$author = $_POST['author'];
?>

    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Books Table</strong>
                                </div>
						<!--  -->
								    <ul class="nav nav-pills">
										<li   class="active"><a href="books.php">All Books</a></li>
										<li><a href="new_books.php">New Books</a></li>
										<li><a href="old_books.php">Old Books</a></li>
									</ul>
						<!--  -->
						<center class="title">
						<h1>Books List</h1>
						</center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
								<div class="pull-right">
								<a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
								</div>
							
							
                                <thead>
                                    <tr>
									    <th>Book No.</th>                                 
                                        <th>Book Title</th>                                 
                                        <th>Category</th>
										<th>Author</th>
										<th class="action">Copies</th>
										<th>Edition</th>
										<th>Publisher Name</th>
										<th>ISBN</th>
										<th>Copyright Year</th>
										<th>Date Added</th>
										<th>Status</th>	
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php 

				
$user_query = "SELECT * FROM book WHERE book_title LIKE ? OR author LIKE ?";
$stmt = $conn->prepare($user_query);

// Bind parameters
$stmt->bind_param("ss", $titlePattern, $authorPattern);

// Set parameter values
$titlePattern = "%$title%";
$authorPattern = "%$author%";

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['book_id'];
        $cat_id = $row['category_id'];
        $book_copies = $row['book_copies'];

        // Get the number of pending borrow details
        $borrow_details = $conn->query("SELECT * FROM borrowdetails WHERE book_id = '$id' AND borrow_status = 'pending'");
        $count = $borrow_details->num_rows;

        // Calculate the total copies
        $total = $book_copies - $count;

        // Get category info
        $cat_query = $conn->query("SELECT classname FROM category WHERE category_id = '$cat_id'");
        $cat_row = $cat_query->fetch_assoc();

        // Output the table row
        ?>
        <tr class="del<?php echo $id ?>">
            <td><?php echo $id; ?></td>
            <td><?php echo htmlspecialchars($row['book_title']); ?></td>
            <td><?php echo htmlspecialchars($cat_row['classname']); ?></td>
            <td><?php echo htmlspecialchars($row['author']); ?></td> 
            <td class="action"><?php echo htmlspecialchars($total); ?></td>
            <td><?php echo htmlspecialchars($row['edition']); ?></td>
            <td><?php echo htmlspecialchars($row['publisher_name']); ?></td>
            <td><?php echo htmlspecialchars($row['isbn']); ?></td>
            <td><?php echo htmlspecialchars($row['copyright_year']); ?></td>      
            <td><?php echo htmlspecialchars($row['date_added']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
        </tr>
        <?php
    }
} else {
    echo "0 results";
}

// Close the prepared statement and connection
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