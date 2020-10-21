<?php
/*
** Comment page
** can add | delete | edit | update | manage
*/
    ob_start(); // output buffering start
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Comment';
        include 'init.php';
        $do =isset($_GET['do']) ?$do=$_GET['do']:$do = 'Manage';
        if($do == "Manage"){
            
            // select all user in db without admin
            $stmt = $con->prepare("SELECT shops.comments.* , shops.items.Name AS 'Item Name' , shops.users.UserName AS 'Member Name'
            FROM shops.comments
            INNER JOIN shops.items on shops.items.ID = shops.comments.Item_Id
            INNER JOIN shops.users on shops.users.UserId = shops.comments.User_Id");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            ?>
            <h2 class=" text-center"  >Manage Comments</h2>
            <div class ='container'>
                <div class = 'table-responsive'>
                    <table class = 'main-table text-center table table-bordered'>
                        <tr>
                            <td>#ID</td>
                            <td>Comment</td>
                            <td>Item Name</td>
                            <td>User Name</td>
                            <td>Added Date</td>
                            <td>Control</td>
                        </tr>
                        <?php
                            foreach($rows as $row){
                                echo "<tr>";
                                    echo "<td>" . $row['ID'] . "</td>";
                                    echo "<td>" . $row['Comment'] . "</td>";
                                    echo "<td>" . $row['Item Name'] . "</td>";
                                    echo "<td>" . $row['Member Name'] . "</td>";
                                    echo "<td>" . $row['CommentDate'] ."</td>";
                                    echo "<td>
                                                <a href='comment.php?do=Edit&commentid=". $row['ID'] ."  '  class='btn btn-success btnPadd'><i class='far fa-edit'></i> Edit</a>
                                                <a href='comment.php?do=Delete&commentid=". $row['ID'] ." ' class='btn btn-danger confirm btnPadd'><i class='fa fa-close'></i> Delete</a>";
                                                if($row['Status'] == 0){
                                                echo "<a href='comment.php?do=Approve&commentid=". $row['ID'] ." ' class='btn btn-info btnPadd active'><i class='fa fa-check'></i> Approve</a>";
                                                }
                                                echo"</td>";
                                    
                                echo "</tr>";

                            }
                        ?>
                        
                    </table>
                </div>
            
            </div>
            
            <?php
        
        }
        elseif($do == 'Edit'){
            // check if GET request user id is number and get userid value
            $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid'])? intval($_GET['commentid']): 0 ;
           // select all data depends in this id 
            $stmt = $con->prepare("SELECT * FROM shops.comments WHERE ID = ?  ");
            //ececute query
            $stmt->execute(array($commentid));
            // featch data from db
            $row = $stmt->fetch(); 
            // the row count 
            $count = $stmt->rowCount();
            // if there is such id show the form 
            if($count > 0){?>

                <h2 class=" text-center"  >Edit Comment</h2>
                <div class ='container'>
                    <form class='form-horizontal ' action = '?do=Update' method = 'POST'>
                        <input type = 'hidden' value = '<?php echo $commentid ?>' name = 'commentid'>
                    <!-- Start comment filed-->
                        <div class ="row form-group form-group-lg">
                            <label class="control-lable col-sm-2 " >Comment</label>
                            <div class = "col-sm-10 col-md-5">
                                <textarea name="comment" class="form-control" cols="30" rows="4"><?php echo $row['Comment'] ?></textarea>
                            </div>
                        </div>
                    <!-- End comment filed-->

                   
                    <!-- Start save filed-->
                        <div class ='row form-group text-center'>
                            <div class = ' col-sm-10'>
                                <input type="submit" value='<?php echo lang('Save')?>' class='btn btn-primary '>
                            </div>
                        </div>
                    <!-- End save filed-->

                    </form>
                </div>
            <?php
            // else show if ther is no such id in db
            }else {
                echo '<div class = "container">';
                    $Msg = "<div class ='alert alert-danger' >there is no id equiavilant " . $userid .'</div>';
                    redirectPage($Msg);
                echo '</div>';
            }
        
        }elseif($do == 'Update'){
            echo "<h2 class='text-center'>Update Comment</h2> ";
            echo "<div class = 'container' >" ;
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // نفس الاسم الي في التاغ زي اتربيوت النيم
                $commentid = $_POST['commentid'];
                $comment = $_POST['comment'];

                $stmt = $con-> prepare("UPDATE shops.comments SET Comment = ?  WHERE ID = ?");
                $stmt->execute(array($comment ,$commentid ));

                $Msg='<div class= "alert alert-success">'. $stmt->rowCount() . "Recored updated".'</div>';
                redirectPage($Msg,'back' , 5);
                   
                
                
                
            }else {
                $Msg = "<div class = 'alert alert-danger'>Sorry you can not access this browser directly</div>";
                redirectPage($Msg);
                
            }
            echo "</div>";
            
        }
        elseif($do == 'Delete'){ // delete page member

            echo "<h2 class='text-center'>Delete Comment</h2> ";
            echo "<div class = 'container' >" ;

                // check if GET request user id is number and get userid value
                $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid'])? intval($_GET['commentid']): 0 ;
                // select all data depends in this id 
                /*
                use itemfunction insted of next line
                    $stmt = $con->prepare("SELECT * FROM shops.users WHERE UserId = ?  LIMIT 1");
                    //ececute query
                    $stmt->execute(array($userid));
                    // the row count 
                    $count = $stmt->rowCount();
                */
                $check = checkItem('ID','shops.comments',$commentid);
                // if there is such id show the form 
                if($check > 0){
                    $stmt = $con->prepare("DELETE FROM shops.comments WHERE ID = :zcommentid ");
                    $stmt->bindParam(":zcommentid" , $commentid);
                    $stmt->execute();
                    $Msg='<div class= "alert alert-success">'. $stmt->rowCount() . "Recored Deleted".'</div>';
                    redirectPage($Msg,'back' , 5);
                    
                }else{
                    echo '<div class = "container">'; 
                        $Msg = "id number is not exist";
                        redirectPage($Msg);
                    echo '</div>';

                }
            echo'</div>';  
        }elseif($do == 'Approve'){ // Active page member

            echo "<h2 class='text-center'>Approve Member</h2> ";
            echo "<div class = 'container' >" ;

                // check if GET request user id is number and get userid value
                $commentid = isset($_GET['commentid']) && is_numeric($_GET['commentid'])? intval($_GET['commentid']): 0 ;
                
                $check = checkItem('ID','shops.comments',$commentid);
                // if there is such id show the form 
                if($check > 0){
                    $stmt = $con->prepare("UPDATE  shops.comments SET Status = 1 where ID = ?");
                    
                    $stmt->execute(array($commentid));
                    $Msg='<div class= "alert alert-success">'. $stmt->rowCount() . "Comment Approve".'</div>';
                    redirectPage($Msg,'back' , 5);
                    
                }else{
                    echo '<div class = "container">'; 
                        $Msg = "id number is not exist";
                        redirectPage($Msg);
                    echo '</div>';

                }
            echo'</div>';  
        }
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
        exit();
    }
    ob_end_flush();

