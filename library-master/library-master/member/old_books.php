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
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Books Table</strong>
                                </div>
						<!--  -->
								    <ul class="nav nav-pills">
										<li><a href="books.php">All Books</a></li>
										<li><a href="new_books.php">New Books</a></li>
										<li class="active"><a href="old_books.php">Old Books</a></li>
									</ul>
						<!--  -->
						<center class="title">
						<h1>Old Books</h1>
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
										<th>Copies</th>
										<th>Edition</th>
										<th>Publisher Name</th>
										<th>ISBN</th>
										<th>Copyright Year</th>
										<th>Date Added</th>
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php  $user_query = "SELECT * FROM book WHERE status = 'old'";
$user_result = $conn->query($user_query);

if ($user_result->num_rows > 0) {
    while ($row = $user_result->fetch_assoc()) {
        $id = $row['book_id'];
        $cat_id = $row['category_id'];

        // Prepare and execute category query
        $cat_query = "SELECT classname FROM category WHERE category_id = ?";
        $stmt = $conn->prepare($cat_query);
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $cat_result = $stmt->get_result();

        if ($cat_result->num_rows > 0) {
            $cat_row = $cat_result->fetch_assoc();
            $classname = $cat_row['classname'];
        }

        // Output the table row
        ?>
        <tr class="del<?php echo $id ?>">
            <td><?php echo $id; ?></td>
            <td><?php echo htmlspecialchars($row['book_title']); ?></td>
            <td><?php echo htmlspecialchars($classname); ?></td>
            <td><?php echo htmlspecialchars($row['author']); ?></td>
            <td class="action"><?php echo htmlspecialchars($row['book_copies']); ?></td>
            <td><?php echo htmlspecialchars($row['edition']); ?></td>
            <td><?php echo htmlspecialchars($row['publisher_name']); ?></td>
            <td><?php echo htmlspecialchars($row['isbn']); ?></td>
            <td><?php echo htmlspecialchars($row['copyright_year']); ?></td>
            <td><?php echo htmlspecialchars($row['date_added']); ?></td>
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