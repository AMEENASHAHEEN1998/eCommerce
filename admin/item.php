<?php
/*
** item page
** can add | delete | edit | update | manage
*/
    ob_start(); // output buffering start
    session_start();
    if(isset($_SESSION['UserName'])){
        $pageTitle ='Item';
        include 'init.php';
        $do =isset($_GET['do']) ?$do=$_GET['do']:$do = 'Manage';
        if($do == "Manage"){

            echo "hello ";
        }elseif($do == 'Add'){?>

            <h2 class=" text-center"  >Add New Item</h2>
            <div class ='container'>
                <form class='form-horizontal ' action = '?do=Insert' method = 'POST'>
                <!-- Start Name filed-->
                    <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " ><?php echo lang('Name')?></label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="name" class="form-control"  required = "required" placeholder = "Add New Item Name " >
                        </div>
                    </div>
                <!-- End Name filed-->
                <!-- Start Description filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Description</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="description" class="form-control"  required = "required" placeholder = "Enter Description Of Item " >
                        </div>
                    </div>
                <!-- End Description filed-->
                <!-- Start Price filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Price</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="price" class="form-control"  required = "required" placeholder = "Enter Price Of Item " >
                        </div>
                    </div>
                <!-- End Price filed-->
                <!-- Start Country filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Country</label>
                        <div class = "col-sm-10 col-md-5">
                            <input type="text" name="country" class="form-control"  required = "required" placeholder = "Enter Country Made " >
                        </div>
                    </div>
                <!-- End Country filed-->
                <!-- Start Status filed-->
                <div class ="row form-group form-group-lg">
                        <label class="control-lable col-sm-2 " >Status</label>
                        <div class = "col-sm-10 col-md-5">
                            <select  name="status" >
                                <option value="0">...</option>
                                <option value="1">New</option>
                                <option value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4">Old</option>

                            </select>
                        </div>
                    </div>
                <!-- End Rating filed-->
                <div class ="row form-group form-group-lg" >
                        <label class="control-lable col-sm-2 " >Rating</label>
                        <div class = "col-sm-10 col-md-5">
                            <select  name="rating" >
                                <option value="0">...</option>
                                <option value="1">*</option>
                                <option value="2">**</option>
                                <option value="3">***</option>
                                <option value="4">****</option>

                            </select>
                        </div>
                    </div>
                <!-- End Rating filed-->
                <!-- Start save filed-->
                    <div class ='row form-group text-center'>
                        <div class = 'col-sm-10'>
                            <input type="submit" value='Add Item' class='btn btn-primary '>
                        </div>
                    </div>
                <!-- End save filed-->

                </form>
            </div> 
        <?php 
                
            
        }elseif($do == 'Insert'){
            
        
            
        }elseif($do == 'Edit'){
           
        
        }elseif($do == 'Update'){
            
            
        }
        elseif($do == 'Delete'){ 

              
        }elseif($do == 'Active'){ 

             
        }
        include $tpl . 'Footer.php';

    }else{
        header('location:index.php');
        exit();
    }
    ob_end_flush();
