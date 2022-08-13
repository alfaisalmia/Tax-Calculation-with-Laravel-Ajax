
@extends("clientPanel.clientPanelMaster")
@section('title', 'Self Education')
@section("content")
<?php
$addDatasSelfEdu = DB::table('deduc_self_education_main')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

            $self_education_main_id = "";
            $user_id = "";
            $course_desc = "";
            $current_job_descr = "";
            $institution_name = "";
            $majority_selfeducation_exp_id = "";
        
            if (count($addDatasSelfEdu) > 0) {
                foreach ($addDatasSelfEdu as $xyz) {
                    $self_education_main_id = $xyz->self_education_main_id;
                    $user_id = $xyz->user_id;
                    $course_desc = $xyz->course_desc;
                    $current_job_descr = $xyz->current_job_descr;
                    $institution_name = $xyz->institution_name;
                    $majority_selfeducation_exp_id = $xyz->majority_selfeducation_exp_id;
                }
            }
            ?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Self Education</h3><i data-toggle="modal" data-target="#myModal" class="fa fa-question-circle pull-right" style="font-size: 30px; color: blue"></i>
                    <h5>List the expenses related to tuition and materials for self education that directly impact your occupational skills, lead to increased income, or are otherwise directly related to your employment.</h5>
                </div>
                <form id="SelfEduForm">
                         <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="etp_id" name="self_education_main_id" value="' . $self_education_main_id . '">';
                        }
                        ?>
                <div class="">
                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label for="course_desc">Description of your course or program:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                <input type="text" class="form-control" id="course_desc" name="course_desc" value="{{$course_desc}}">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="">
                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label for="current_job_descr">Please describe how your course relates to your current job</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height color_blue"></i></span>
                                <textarea class="form-control" rows="5" id="current_job_descr" name="current_job_descr">{{$current_job_descr}}</textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label for="institution_name"> Name of Instution:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-gg color_blue"></i></span>
                                <input type="text" class="form-control" id="institution_name" name="institution_name" value="{{$institution_name}}">
                            </div>

                        </div>
                    </div>
                </div>
                <hr>


                <!-- Tax Offset Amount Start -->

                  <div class="row col-md-12">
                        <div class="col-md-12">
                            <p>Please select one of the following that best describes the majority of the self-education expenses.</p>
                        </div>
                        <div class="input-group col-md-12">
                            <div class="col-sm-12"> 
                                <div class="input-group">
                                    <?php
                                    $yesnos = DB::table('tbl_majority_selfeducation_exp')->select('majority_selfeducation_exp_id', 'majority_selfeducation_exp_name')->get();
                                    ?>
                                    @foreach($yesnos as $yn)
                                    <label class="container_radio radio-inline">{{$yn->majority_selfeducation_exp_name}}
                                        <input type="radio" name="majority_selfeducation_exp_id" value="{{$yn->majority_selfeducation_exp_id}}" <?php
                                        if ($majority_selfeducation_exp_id == $yn->majority_selfeducation_exp_id) {
                                           echo "checked";
                                       }
                                        ?> >
                                        <span class="checkmark_radio"></span>
                                    </label><br/>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><br/>
                <!-- Tax Offset Amount End -->
                <hr>
                <!-- Lum Sum in Arrears Start -->
                <div class="col-sm-12">

                    <h5 class="color_blue">Expenses Related to the Course or Program </h5>
                    <div id="targetDIV">
                        
                        <?php if($user_id == Auth::User()->id){ ?>
                        <div class="row">
                         <div class="col-md-2" style="margin-top: 25px;">
                            <button type="button" class="btn btn-warning btn-sm" id="AndSecond"><i class="fa fa-plus"></i>Add</button>
                        </div>
                        </div>
                        <?php
                            $Datas = DB::table('deduc_self_education_sub')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                            foreach ($Datas as $value) {
                            ?>
                        
                        <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Description</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                <select id="description" class="form-control" name="description[1]">
                                    <option selected="selected" value="0">Select</option>
                                    <?php
                                    $expenses_namesss = DB::table('tbl_course_related_expenses')->select('course_related_expenses_id', 'course_related_expenses_name')->get();
                                    foreach ($expenses_namesss as $expenses_name) {
                                        if($value->course_related_expenses_id == $expenses_name->course_related_expenses_id) {
                                        ?>
                                    <option value="{{$expenses_name->course_related_expenses_id}}" selected>{{$expenses_name->course_related_expenses_name}}</option>
                                        <?php
                                    }else{
                                    ?>
                                         <option value="{{$expenses_name->course_related_expenses_id}}">{{$expenses_name->course_related_expenses_name}}</option>
                                    <?php }
                                    }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="amount">Amount</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="amount" name="amount[1]" value="{{$value->amount}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 25px;">
                            <button type="button" class="deleteRoww btn btn-danger btn-sm" id=""><i class="fa fa-remove"></i> Remove</button>
                        </div>
                    </div>
                        
                        <?php } 
                        }else{ ?>
                        
                        <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Description</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                <select id="description" class="form-control" name="description[1]">
                                    <option selected="selected" value="0">Select</option>
                                    <?php
                                    $expenses_namesss = DB::table('tbl_course_related_expenses')->select('course_related_expenses_id', 'course_related_expenses_name')->get();
                                    foreach ($expenses_namesss as $expenses_name) {
                                        ?>
                                        <option value="{{$expenses_name->course_related_expenses_id}}">{{$expenses_name->course_related_expenses_name}}</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="amount">Amount</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="amount" name="amount[1]" value="" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 25px;">
                            <button type="button" class="btn btn-warning btn-sm" id="AndSecond"><i class="fa fa-plus"></i>Add</button>
                        </div>
                    </div>
                        <?php } ?>
                    
                    </div>
                    <h5 class="color_blue ">Items to Depreciate (e.g. Computer, Tools, etc.)</h5>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <a href="{{URL('/deduction/selfEducation/depriciationDeduction')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                        </div>
                    </div> <br/>

                </div>
                <!-- Lum Sum in Arrears End -->
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="SelfEduFormSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                        </div>
                    </div>
                </div>
                </form>
            </div>



            </form>

        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Self Education
                </h4>
            </div>
            <div class="modal-body">

                <div class="HelpSection"> <div id="HelpSectionAdvanced" style="display: block;"> <p>You can claim the cost of self-education as a work-related tax deduction if there is a solid link between your studies and your income-earning activities. You may be eligible if:</p>
                        <ul>
                            <li>you are upgrading skills or knowledge specific to your work</li>
                            <li>you are bringing your qualifications up to date</li>
                            <li>your studies are related to your employment as a trainee</li>
                            <li>your studies led to an increase in income from your work</li>
                        </ul>

                        <p>You can also claim a deduction for self-education expenses if the course helps you satisfy study requirements to maintain your right to tax bonded scholarship.</p>

                        <p><b>Note that certain otherwise deductible items, such as course fees and textbooks, will require you to reduce your allowable self-education expenses by $250. This means that if your expense for a course was $1000 you will only be able to claim $750 as a tax deduction.</b></p>

                        <p>You may however be able to offset this $250 requirement using other types of expenses such as the cost of childcare or the purchase of a computer. Please go to the Income and deductions page of the ATO for more details.</p>

                    </div> </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function SelfEduFormSave() {
    alert($("#SelfEduForm").serialize());
       $.ajax({
            type: 'get',
            url: '{{ URL::to('SelfEduFormSave')}}',
            data: $("#SelfEduForm").serialize(),
            success: function (data) {
                alert(data);
              //  window.location.href = data;
            },
            error: function () {
                alert("Failed ! Please try again later.");
            }
        }); 
}
</script>
<script>
    $("#AddNewRow").on("click", "button.deleteRow", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    });

    var counter = 20;
    $("#AndSecond").click(function () {
        $('<div class="row">\n\
                        <div class="form-group col-md-5">\n\
                            <label for="">Description</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>\n\
                                <select id="description" class="form-control" name="description['+counter+']">\n\
                                    <option selected="selected" value="0">Select</option>\n\
<?php
$expenses_namesss = DB::table('tbl_course_related_expenses')->select('course_related_expenses_id', 'course_related_expenses_name')->get();
foreach ($expenses_namesss as $expenses_name) {
    ?><option value="{{$expenses_name->course_related_expenses_id}}">{{$expenses_name->course_related_expenses_name}}</option><?php } ?>\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
                        <div class="form-group col-md-5">\n\
                            <label for="amount">Amount</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="amount" name="amount['+counter+']" value="" onkeypress="return isNumber(event)">\n\
                            </div>\n\
                        </div>\n\
                        <div class="col-md-2" style="margin-top: 25px;">\n\
                            <button type="button" class="deleteRoww btn btn-danger btn-sm" id=""><i class="fa fa-remove"></i> Remove</button>\n\
                        </div>\n\
                    </div>').appendTo("#targetDIV");
        counter++;
    });
    $("#targetDIV").on("click", "button.deleteRoww", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    })
</script>
@stop