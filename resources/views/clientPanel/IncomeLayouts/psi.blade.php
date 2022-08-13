
@extends("clientPanel.clientPanelMaster")
@section('title', 'Personal Services Income ')
@section("content")
<?php
$allpersonals = DB::table('inc_personal_serv_inc')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

$personal_service_inc_id = "";
$user_id = "";
$description_of_psi = "";
$income = "";
$tax_withheld = "";


if (count($allpersonals) > 0) {
    foreach ($allpersonals as $abc) {
        $personal_service_inc_id = $abc->personal_service_inc_id;
        $user_id = $abc->user_id;
        $description_of_psi = $abc->description_of_psi;
        $income = $abc->income;
        $tax_withheld = $abc->tax_withheld;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Attributed&nbsp;Personal Service Income (PSI)</h3>
                    <h5>Please provide the information listed on your Attributed Personal Services Income Payment Summary.</h5>
                </div>
                <form id="psi_form_element"> 
                    <?php
                    if ($user_id == Auth::User()->id) {
                        echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                        echo '<input type="hidden" class="form-control" id="personal_service_inc_id" name="personal_service_inc_id" value="' . $personal_service_inc_id . '">';
                    }
                    ?>
                    <div class="">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="description_of_psi">Description of PSI</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-align-justify color_blue"></i></span>
                                        <input type="text" class="form-control" id="description_of_psi" name="description_of_psi" value="<?php echo $description_of_psi ;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="income">Income</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="income" name="income" value="<?php echo $income; ?>" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="tax_withheld">Tax Withheld</label> <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="tax_withheld" name="tax_withheld" value="<?php echo $tax_withheld ;?>" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="PersonalServiceIncomeFormDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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
<script>
    function PersonalServiceIncomeFormDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('PersonalServiceIncomeFormDataSave')}}',
            data: $("#psi_form_element").serialize(),
            success: function (data) {
               window.location.href = "{{URL::to('income/personalServices')}}";
               
            },
            error: function () {
            }
        });
    }
</script>
@stop