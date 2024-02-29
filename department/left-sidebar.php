
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

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>
                

                            <li>
                                <a href="officer_index.php">
                                    <i class="fas fa-users"></i>
                                    <span> Officers </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="pending_posting.php">
                                    <i class="fas  fa-list"></i>
                                    <span> Pending</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="posting_index.php">
                                    <i class="fas  fa-book"></i>
                                    <span>Posting</span>
                                </a>
                            </li>
                            
                            <?php
                                if($_SESSION['access_level']=='2'){
                            ?>
                            
                            <li>
                                <a href="terminal.php">
                                    <i class="fas  fa fa-archway"></i>
                                    <span> Terminal</span>
                                </a>
                            </li>
                            <?php
                                }
                                ?>
                            <!--<li>-->
                            <!--    <a href="surveyIndex.php">-->
                            <!--        <i class="fas  fa fa-clipboard-list"></i>-->
                            <!--        <span> Survey</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            
                            <li>
                                <a href="report_index.php">
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