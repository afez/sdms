

<div class="col-lg-12">
    <section class="panel">
        <div class="panel-body">
            <div style="color: #003300; font-weight: bold;  "><h3>Welcome to ACADEMIC STAFF DEVELOPMENT MANAGEMENENT SYSTEM (ASDMS) University of Dar es salaam</h3></div>
        </div>
    </section>
</div>
<div class="col-lg-6">
    <section class="panel">
        <div class="panel-body">
            <h4 style="color: #003300; ">What the System Do</h4>
            <Ul>
                <li>
                   Send notification messages to the staff  automatically, when required
                </li>
                
                
                <li>
                    Publication assesment done online, with different reviewers
                </li>
                
                <li>
                    Academic staff overstayed detected easier by the system
                </li>
                <li>
                    The system generate different reports
                </li>
            </Ul>

        </div>
    </section>
</div>
<div class="col-lg-6">
    <section class="panel">
        <div class="panel-body">
            <h4 style="color: #003300; ">System Users</h4>
            <Ul>
                <li>
                    Administrator
                </li>
                <li>
                    Recruitment Officer
                </li>
                <li>
                    Staff Training Officer
                </li>
                <li>
                    Dvc Academic Officer
                </li>
                <li>
                    Head of Department(HoD)
                </li>
                <li>
                    Academic Staff
                </li>
                <li>
                    Reviewer
                </li>

            </Ul>

        </div>
    </section>
</div>

<div class="col-md-4">
    <div class="mini-stat clearfix">
        <span class="mini-stat-icon orange"><i class="fa fa-group"></i></span>
        <div class="mini-stat-info">
            <span><?php echo count(Staff::model()->findAll());?></span>
            Academic Staffs
        </div>
    </div>
</div>
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
