
<div class="col-lg-12" style="height: 400px">
    <section class="panel panel-primary">
        <header style="background:ghostwhite "class="panel-heading">
            <h4 style="color: black  ">Reports </h4>
        </header>
        <div class="panel-body">

<!--            <div class="form-group col-lg-4">
                <label class="control">Date Range</label>

                <div class="input-group input-large">
                    <input type="text" class="form-control datetimepicker" required name="from">
                    <span class="input-group-addon">To</span>
                    <input type="text" class="form-control datetimepicker" required name="to">
                </div>
                <span class="help-block">Select date range</span>

            </div>-->

            <div style="margin-top: 28px"class="dropdown col-lg-5 ">
                <label class="control">Report Type</label>
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select type of Report
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
<!--                    <li><a target="_blank" href="<?php //echo $this->createUrl('//user/report');  ?>">System users</a></li>-->
                    <li><a target="_blank" href="<?php echo $this->createUrl('//staff/staff/report'); ?>">Academic Staffs</a></li>
                    <li><a target="_blank" href="<?php echo $this->createUrl('//staff/staff/notifyreport'); ?>">Staffs overstayed</a></li> 
                    <li><a target="_blank" href="<?php echo $this->createUrl('//study/study/report'); ?>">Staffs on studies</a></li>
                    <li><a target="_blank" href="#">Assesment Result Reports</a></li>
                    <li><a target="_blank" href="<?php echo $this->createUrl('//progreport/preport/report'); ?>">Academic Progressive Reports</a></li>
                    <li><a target="_blank" href="<?php echo $this->createUrl('//publication/publication/pubreport'); ?>">Publications Reports</a></li>
                </ul>
            </div>

        </div>
    </section>
</div>

