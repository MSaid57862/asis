
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                            class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-bs-toggle="dropdown">Geneva Kennedy</a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock me-1"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-log-out me-1"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>

<!-- Sidebar user panel (optional) -->
      <div class="logo-box mt-2 pb-1  d-flex">
        <div class="image">
          <div class="img-circle elevation-3 p-1">
               <?php
                    $result = DB::queryFirstRow("SELECT svn, initials, surname FROM basic_information WHERE officer_email= '$_SESSION[username]'");
            	      if($result){
                    	      $svn = $result['svn'];
                    	      $initials = $result['initials'];
                    	      $surname = $result['surname'];
                    	      $nameTag = $initials." ".$surname;
                    	      
                    	      $result = DB::queryFirstRow("SELECT pass_name FROM passports WHERE svn= '$svn'");
                    	      if($result){
                            	      $passport = $result['pass_name'];
                    	   ?>
                            	   
                                        <img src="<?php echo 'passports/'.$passport; ?>" class="rounded-circle"  style="height:55px; width:55px;">
                                        <br>
                                   
                                	   <?php
                                	
                            	}else{
                            	        //No Picture
                            	        //$nameTag = '<i class="fa fa-circle text-success"></i> Online';
                            	        echo '<img src="passports/avata.jpg" class="rounded-circle" style="height:55px; width:55px;">';
                            	        }
                            
                    }else{
            	    //no records found
            	                $nameTag = '<i class="fa fa-circle text-success"></i> Online';
            	                
            	        echo '<img src="passports/avata.jpg" class="rounded-circle" style="height:55px; width:55px;">';
            	    }
                ?>
          </div>
        </div>
        <br>
        <div class="info my-auto">
            
          <a href="#" class="d-block"><?php echo $nameTag; ?></a>
        </div>
      </div>
      
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>
                

                            <li>
                                <a href="../personnel/index.php">
                                    <i class="fas fa-users"></i>
                                    <span> Profile </span>
                                </a>
                            </li>
                            
                            
                            <li>
                                <a href="allocation_index.php">
                                    <i class="fas  fa fa-archway"></i>
                                    <span> Allocation</span>
                                </a>
                            </li>
                            
                             <li>
                                <a href="index.php">
                                    <i class="fas fa-th-list"></i>
                                    <span> Barracks List</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="barrack_maintenance.php">
                                  <i class="fas fa-rocket"></i>
                                    <span> Barracks Maintenance</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="barrack_accessories.php">
                                  <i class="far fa-calendar-alt"></i>
                                    <span> Barrack Accessories</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="barrack_management.php">
                                  <i class="far fa-handshake"></i>
                                    <span> Barrack Management</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="#">
                                    <i class="fas  fa fa-search"></i>
                                    <span> Report </span>
                                </a>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->