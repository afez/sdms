<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->clientScript;
$cs->registerScriptFile($baseUrl . '/js/dashboard.js',  CClientScript::POS_END);
?>


<div class="col-md-4">
    <div class="mini-stat clearfix">
        <span class="mini-stat-icon tar"><i class="fa fa-home"></i></span>
        <div class="mini-stat-info">
            <span>16</span>
            Colleges
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="mini-stat clearfix">
        <span class="mini-stat-icon tar"><i class="fa fa-home"></i></span>
        <div class="mini-stat-info">
            <span><?php echo count(Department::model()->findAll());?></span>
            Departments
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="mini-stat clearfix">
        <span class="mini-stat-icon tar"><i class="fa fa-home"></i></span>
        <div class="mini-stat-info">
            <span><?php echo count(Staff::model()->findAll());?></span>
            Departments
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="event-calendar clearfix">
            <div class="col-lg-7 calendar-block">
                <div class="cal1 ">
                </div>
            </div>
            <div class="col-lg-5 event-list-block">
                <div class="cal-day">
                    <span>Today</span>
                    Friday
                </div>
                <ul class="event-list">
                    <li>Lunch with jhon @ 3:30 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>
                    <li>Coffee meeting with Lisa @ 4:30 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>
                    <li>Skypee conf with patrick @ 5:45 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>
                    <li>Gym @ 7:00 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>
                    <li>Dinner with daniel @ 9:30 <a href="#" class="event-close"><i class="ico-close2"></i></a></li>

                </ul>
                <input type="text" class="form-control evnt-input" placeholder="NOTES">
            </div>
        </div>
    </div>
     <div class="col-md-4">
        <div class="profile-nav alt">
            <section class="panel">
                <div class="user-heading alt clock-row terques-bg">
                    <h1>July 14</h1>
                    <p class="text-left">2014, Friday</p>
                    <p class="text-left">7:53 PM</p>
                </div>
                <ul id="clock">
                    <li id="sec"></li>
                    <li id="hour"></li>
                    <li id="min"></li>
                </ul>

                <ul class="clock-category">
                    <li>
                        <a href="#" class="active">
                            <i class="ico-clock2"></i>
                            <span>Clock</span>
                        </a>
                    </li>
                  
                </ul>

            </section>

        </div>
    </div>
</div>