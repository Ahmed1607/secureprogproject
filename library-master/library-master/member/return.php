<?php 
include('header.php');
include('session.php');
include('navbar.php');
?>

<div class="container">
    <div class="margin-top">
        <div class="row">    
            <div class="span12">      
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><i class="icon-user icon-large"></i>&nbsp;Returned Books</strong>
                </div>

                <!-- Navigation tabs -->
                <ul class="nav nav-pills">
                    <li class="active"><a href="return.php">Student</a></li>
                    <li><a href="teacher_return.php">Teacher</a></li>
                    <li><a href="#myModal4" data-toggle="modal"><i class="icon-search icon-large"></i>&nbsp;Search</a></li>
                </ul>

                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                    <div class="pull-right">
                        <a href="#" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
                    </div>
                    <thead>
                        <tr>
                            <th>Book title</th>                                 
                            <th>Borrower</th>                                 
                            <th>Year</th>    
                            <th>Roll No</th>
                            <th>Email</th>
                            <th>Date Borrow</th>                                 
                            <th>Due Date</th>                                
                            <th>Date Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_query = mysqli_query($conn, "SELECT * FROM borrow
                                                            LEFT JOIN member ON borrow.member_id = member.member_id
                                                            LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
                                                            LEFT JOIN book ON borrowdetails.book_id = book.book_id 
                                                            WHERE borrowdetails.borrow_status = 'returned' AND member.type='student'
                                                            ORDER BY borrow.borrow_id DESC") or die(mysqli_error($conn));

                        while ($row = mysqli_fetch_array($user_query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['book_title']; ?></td>
                                <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                                <td><?php echo $row['year_level']; ?></td>
                                <td><?php echo $row['roll']; ?></td>
                                <td><?php echo $row['username']; ?>@gmail.com</td>
                                <td><?php echo $row['date_borrow']; ?></td> 
                                <td><?php echo $row['due_date']; ?> </td>
                                <td><?php echo $row['date_return']; ?> </td>
                            </tr>
                            <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>      
        </div>
    </div>
</div>

<?php include('footer.php') ?>
