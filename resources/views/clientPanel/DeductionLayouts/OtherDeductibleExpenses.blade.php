
@extends("clientPanel.clientPanelMaster")
@section('title', 'Other Deductive Expenses')
@section("content")
<?php
$DepDeductions = DB::table('deduc_other_expenses')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

            $other_expense_id = "";
            $user_id = "";
            $description = "";
            $other_deduc_expen_id = "";
            $amount = "";
           
            if (count($DepDeductions) > 0) {
                foreach ($DepDeductions as $inc_etp) {
                    $other_expense_id = $inc_etp->other_expense_id;
                    $user_id = $inc_etp->user_id;
                    $description = $inc_etp->description;
                    $other_deduc_expen_id = $inc_etp->other_deduc_expen_id;
                    $amount = $inc_etp->amount;
                }
            }
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
           <div class="col-md-10 col-lg-10">
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Other Deductible Expenses</h3>
                    <h5>Debt Deductions, Deduction for Project Pool, Election Expenses, Foreign Exchange Losses, Income Protection Insurance, Low Value Pool Deduction, and Personal Superannuation Contributions
                    </h5>

                </div>
                <form id="OtherDeducFormData">
                     <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="other_expense_id" name="other_expense_id" value="' . $other_expense_id . '">';
                        }
                        ?>
                <div class="col-sm-12 "> 
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Descriptions</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                            <input type="text" class="form-control" id="description" name="description" value="{{$description}}">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Type </label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>

                            <select id="other_deduc_expen_id" class="form-control" name="other_deduc_expen_id">
                                <option selected="selected" value="0">Select</option>
                                <?php
                                $PoTYs = DB::table('tbl_other_deduc_expen')->select('other_deduc_expen_id', 'other_deduc_expen_name')->get();
                                foreach ($PoTYs as $pty) {
                                    if($other_deduc_expen_id == $pty->other_deduc_expen_id){
                                    ?>
                            <option value="{{$pty->other_deduc_expen_id}}" selected="">{{$pty->other_deduc_expen_name}}</option>
                                    <?php
                                }else{
                                ?> 
                                     <option value="{{$pty->other_deduc_expen_id}}">{{$pty->other_deduc_expen_name}}</option> 
                                <?php  } 
                                }?> 
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Amount</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                    <input type="text" class="form-control" id="amount" name="amount" value="{{$amount}}" onkeypress="return isNumber(event)">
                        </div>
                    </div>
                    </div>
                </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                        <button type="button" class="btn btn-success btn-sm" onclick="OtherDeducFormDataSave()"><i class="fa fa-forward"></i> 
<?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                    </div>
                </div>
            </div>
                </form>
        </div>
    </div>
</div>

</div>
</div>
<script>
function OtherDeducFormDataSave(){
            $.ajax({
            type: 'get',
            url: '{{ URL::to('OtherDeducFormDataSave')}}',
            data: $("#OtherDeducFormData").serialize(),
            success: function (data) {
               
 window.location.href = "{{URL::to('/deduction/otherExpenses')}}";
            },
            error: function () {
            }
        });
}
</script>
@stop