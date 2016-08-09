<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.png">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!--Core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-reset.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/clndr.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/data-tables/DT_bootstrap.css" />
        <!--clock css-->
<!--        <link href="<?php //echo Yii::app()->request->baseUrl               ?>/js/css3clock/css/style.css" rel="stylesheet">-->
        <!-- Morris Chart CSS  -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/morris-chart/morris.css">
        <!-- Custom styles for this template -->

<!--     <link href="<?php //echo Yii::app()->request->baseUrl;                          ?>/css/datepicker.css">-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-responsive.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bs3/js/bootstrap.min.js"></script>


    </head>
    <body class="fixed-width">
        <section id="container">
            <!--header start-->
            <header class="header fixed-top clearfix">
                <!--logo start-->
                <div class="brand">

                    <a href="<?php echo $this->createUrl('/site/home'); ?>" class="logo">
                        <img style="margin-top: -25px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="">

                    </a>
                    <div class="sidebar-toggle-box">
                        <div class="fa fa-bars"></div>
                    </div>
                </div>
                <!--logo end-->
                <h3 style="margin-top: -1px; margin-left: 400px;font-style:  oblique; font-weight: bolder">Staff Development Management System UDSM</h3>
                <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                    <div style="margin-top: -2px;"class="nav notify-row" id="top_menu">
                        <!--  notification start -->
                        <ul class="nav top-menu">


                            <!-- notification dropdown start-->
                            <?php
                            $nots = Notification::collect();
                            $count = count($nots);
                            if ($count > 0) {
                                $total = 0;
                                $overstay = $nots['overstay'];
                                foreach ($nots as $n) {
                                    $total +=count($n);
                                }
                                ?>
                                <li id="header_notification_bar" class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                        <i class="fa fa-bell-o"></i>
                                        <span class="badge bg-warning"><?php echo $total ?></span>
                                    </a>
                                    <ul class="dropdown-menu extended notification">
                                        <?php foreach ($overstay as $ov): ?>
                                            <li>
                                                <div class="alert alert-info clearfix">
                                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                                    <div class="noti-info">
                                                        <a href="#"><?php echo $ov['name'] ?> </a>
                                                    </div>
                                                </div>
                                            </li>

                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <!-- notification dropdown end -->
                        </ul>
                        <!--  notification end -->

                    </div>
                <?php endif; ?>


                <div class="top-nav clearfix" style="margin-right: 70px;">

                    <ul class="nav pull-right top-menu">

                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i style="font-size:30px;" class="fa fa-user"></i>
                                <span class="username">Hello! <?php echo User::loggedUser()->username; ?> </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
<!--                                <li><a href="<?php //echo $this->createUrl('/user/profile');                    ?>"><i class=" fa fa-user"></i>profile</a></li>-->

                                <li><a href="<?php echo $this->createUrl('//site/logout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                    <!--search & user info end-->
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->
            <aside>
                <div id="sidebar" class="nav-collapse">
                    <!-- sidebar menu start-->
                    <div class="leftside-navigation">
                        <ul class="sidebar-menu" id="nav-accordion">
                            <li>
                                <a class="active" href="<?php echo $this->createUrl('/site/home'); ?>">
                                    <i class="fa fa-home"></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            <?php if ((User::loggedUser()->role_id != 7)) : ?>
                                <li class="sub-menu">
                                    <a href="javascript:;">
                                        <i class="fa fa-users"></i>
                                        <span>Users </span>
                                    </a>
                                    <ul class="sub">
                                        <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7 AND ( User::loggedUser()->role_id != 4)AND ( User::loggedUser()->role_id != 5)AND ( User::loggedUser()->role_id != 6))) : ?>
                                            <li><a href="<?php echo $this->createUrl('/user/index'); ?>">System Users</a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo $this->createUrl('/user/changepassword'); ?>"> Change Password</a></li>
                                    </ul>
                                </li>

                            <?php endif; ?>
                            <?php if ((User::loggedUser()->role_id != 7)) : ?>
                                <li class="sub-menu">
                                    <a href="">
                                        <i class="fa fa-building-o"></i>
                                        <span>Colleges & Departments</span>
                                    </a>
                                    <ul class="sub">
                                        <li><a href="<?php echo $this->createUrl('/college/college/index'); ?>">Colleges list</a></li>

                                        <li><a href="<?php echo $this->createUrl('/department/department/index'); ?>">Department list</a></li>

                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ((User::loggedUser()->role_id != 7)) : ?>
                                <li class="sub-menu">
                                    <a href="javascript:;">
                                        <i class="fa fa-group"></i>

                                        <span>Academic Staffs</span>
                                    </a>
                                    <ul class="sub">
                                        <li><a href="<?php echo $this->createUrl('/position/position/index'); ?>">Academic Qualification Details</a></li>
                                        <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7) AND ( User::loggedUser()->role_id != 4)) : ?>
                                            <li><a href="<?php echo $this->createUrl('/staff/staff/create'); ?>">Register New Staff</a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo $this->createUrl('/staff/staff/index'); ?>">Academic Staff Profiles</a></li>
                                        <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 7)) : ?>
                                            <li><a href="<?php echo $this->createUrl('/study/study/index'); ?>">Academic Staff on Studies</a></li>
                                        <?php endif; ?>


                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ((User::loggedUser()->role_id != 7)AND ( User::loggedUser()->role_id != 2)) : ?>
                                <li class="sub-menu">
                                    <a href="<?php echo $this->createUrl('/exreview/create'); ?> ">
                                        <i class="fa fa-comment"></i>
                                        <span>Reviewers</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ((User::loggedUser()->role_id != 7)) : ?>
                                <li class="sub-menu">
                                    <a href="<?php echo $this->createUrl('/staff/staff/liststaff'); ?> ">
                                        <i class="fa fa-book"></i>
                                        <span>Academic Staff Publications</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ((User::loggedUser()->role_id != 2) AND ( User::loggedUser()->role_id != 3) AND ( User::loggedUser()->role_id != 6)) : ?>
                                <li class="sub-menu">
                                    <a href="<?php echo $this->createUrl('/publication/publication/assigned'); ?>">
                                        <i class="fa fa-plus-square-o"></i>
                                        <span>Assigned Publications</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ((User::loggedUser()->role_id != 2)) : ?>
                                <li class="sub-menu">
                                    <a href="<?php echo $this->createUrl('/Assescriteria/assesment/result'); ?>">
                                        <i class="fa fa-thumbs-o-up"></i>
                                        <span>Publications Assesment Results</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ((User::loggedUser()->role_id != 7)) : ?>
                                <li class="sub-menu">
                                    <a href="javascript:;">
                                        <i class="fa fa-paperclip"></i>
                                        <span>Academic Progress Reports</span>
                                    </a>
                                    <ul class="sub">
                                        <?php if ((User::loggedUser()->role_id != 7) AND ( User::loggedUser()->role_id != 6) AND ( User::loggedUser()->role_id != 5)AND ( User::loggedUser()->role_id != 4)AND ( User::loggedUser()->role_id != 2)) : ?>
                                            <li><a href="<?php echo $this->createUrl('/progreport/Preport/index'); ?>">View Progress Reports</a></li>
                                        <?php endif; ?>

                                        <li><a href="<?php echo $this->createUrl('/progreport/Preport/create'); ?>">Add Progress Reports</a></li>


                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ((User::loggedUser()->role_id != 7)) : ?>
                                <li class="sub-menu">
                                    <a href="<?php echo $this->createUrl('/report/report/index'); ?> ">
                                        <i class="fa fa-book"></i>
                                        <span>Reports</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <!-- sidebar menu end-->
                    </div>
            </aside>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <?php if (Yii::app()->user->hasFlash('success')): ?>
                        <div class="alert alert-success alert-block fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <?php echo Yii::app()->user->getFlash('success'); ?>

                        </div>

                    <?php endif; ?>
                    <?php if (Yii::app()->user->hasFlash('error')): ?>
                        <div class="alert alert-danger alert-block fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <?php echo Yii::app()->user->getFlash('error'); ?>

                        </div>

                    <?php endif; ?>

                    <?php echo $content; ?>


                </section>
                <hr noshade="" style="border-color:#B9C2C6" size="1">
                <div style="margin-left: 400px;  color: black; "class="copyright">
                    Copyright 2016 &copy; Academic Staff Development-UDSM. All rights Reserved.
                </div>
            </section>

            <!--main content end-->

        </section>
      <!--Core js-->

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.nicescroll.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot-chart/excanvas.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/skycons/skycons.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.scrollTo/jquery.scrollTo.js"></script>
<!--        <script src="<?php //echo Yii::app()->request->baseUrl;                                      ?>/js/jquery.easing.min.js"></script>
        <script src="<?php //echo Yii::app()->request->baseUrl;                                      ?>/js/calendar/clndr.js"></script>
     <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/underscore-min.js"></script>
        <script src="<?php //echo Yii::app()->request->baseUrl;                                      ?>/js/calendar/moment-2.2.1.js"></script>
        <script src="<?php //echo Yii::app()->request->baseUrl;                                      ?>/js/evnt.calendar.init.js"></script>
        <script src="<?php //echo Yii::app()->request->baseUrl;                                      ?>/js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php //echo Yii::app()->request->baseUrl;                                      ?>/js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
        <script src="<?php //echo Yii::app()->request->baseUrl;                                      ?>/js/gauge/gauge.js"></script>-->
        <!--clock init-->
<!--        <script src="<?php //echo Yii::app()->request->baseUrl;                                              ?>/js/css3clock/js/css3clock.js"></script>

<!--        <script src="<?php //echo Yii::app()->request->baseUrl;                                                  ?>/js/jquery.customSelect.min.js" ></script>-->
        <!--common script init for all pages-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>

        <!--script for this page-->
<!--        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot-chart/jquery.flot.js"></script>
<script src="<?php //echo Yii::app()->request->baseUrl;                                     ?>/js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="<?php //echo Yii::app()->request->baseUrl;                                     ?>/js/flot-chart/jquery.flot.resize.js"></script>
<script src="<?php //echo Yii::app()->request->baseUrl;                                     ?>/js/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="<?php //echo Yii::app()->request->baseUrl;                                     ?>/js/flot-chart/jquery.flot.animator.min.js"></script>
<script src="<?php //echo Yii::app()->request->baseUrl;                                     ?>/js/flot-chart/jquery.flot.growraf.js"></script>-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.customSelect.min.js" ></script>

        <script type="text/javascript">
            $(document).ready(function () {
//                 console.log($("#datetimepicker").prop("tagName")) ;
                $(".datetimepicker").datepicker({
                    format: 'yyyy-mm-dd'
                });
            });

        </script>

    </body>

</html>