
@extends("clientPanel.clientPanelMaster")
@section('title', 'Capital Gains -Sale of Shares')
@section("content")
<?php
$segment_1 = Request::segment(1);
$segment_2 = Request::segment(2);
$make_submenu_url = $segment_1 . "/" . $segment_2;

$getting_sub_and_mainmenu_id = DB::table('tbl_submenu')->select("submenu_id", "mainmenu_id")->where('submenu_url', $make_submenu_url)->get();
foreach ($getting_sub_and_mainmenu_id as $fs) {
    $mainmenu_id = $fs->mainmenu_id;
    $submenu_id = $fs->submenu_id;
}

//
$sale_of_share = "";
$user_id = "";
$own_interest = "";
$description = "";
$assest_category = "";
$assest_type = "";
$date_purchased = "";
$date_sold = "";
$purchase_price = "";
$sale_price = "";

$allSalesShares = DB::table('inc_sale_of_shares')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
if (count($allSalesShares) > 0) {
    foreach ($allSalesShares as $cgm) {
        $sale_of_share = $cgm->sale_of_share;
        $user_id = $cgm->user_id;
        $own_interest = $cgm->own_interest;
        $description = $cgm->description;
        $assest_category = $cgm->assest_category;
        $assest_type = $cgm->assest_type;
        $date_purchased = $cgm->date_purchased;
        $date_sold = $cgm->date_sold;
        $purchase_price = $cgm->purchase_price;
        $sale_price = $cgm->sale_price;
    }
}

?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-9 col-lg-9">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Sale of Shares, Units of Trust, Property, or Other Asset</h3>
                    <h5>Please provide the following details regarding your capital gain/loss from sale of stock, units in a trust, property, or other asset.</h5>
                </div>
                <div class="col-sm-12 "> 
                    <form id="saleOfShareFormElement">
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="sale_of_share" name="sale_of_share" value="' . $sale_of_share . '">';
                        }
                        ?>
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="ownership_interest">Ownership Interest (%)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-percent color_blue"></i></span>
                                    <input type="text" class="form-control" id="ownership_interest" name="ownership_interest" value="{{$own_interest}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="description"> Description </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>

                                    <input type="text" class="form-control" id="description" name="description" value="{{$description}}">          
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="assets_category"> Assets Category </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="assets_category" class="form-control" name="assets_category">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $assets_categories = DB::table('tbl_assets_category')->select('assets_category_id', 'assets_category_name')->get();
                                        foreach ($assets_categories as $assets_cat) {
                                            if ($assest_category == $assets_cat->assets_category_id) {
                                                echo '<option value="' . $assets_cat->assets_category_id . '" selected >' . $assets_cat->assets_category_name . '</option>';
                                            } else {
                                                echo '<option value="' . $assets_cat->assets_category_id . '">' . $assets_cat->assets_category_name . '</option>';
                                            }
                                            ?>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <label>Asset Type ? </label>
                            </div>
                            <div class="input-group col-md-6">
                                <div class="col-sm-12"> 
                                    <div class="input-group">
                                        <?php $activeS = DB::table('tbl_active_inactive')->select('act_inact_id', 'act_inact_name')->get(); ?>
                                        @foreach($activeS as $yn)
                                        <label class="container_radio radio-inline">{{$yn->act_inact_name}}
                                            <input type="radio" name="asset_type" value="{{$yn->act_inact_id}}" <?php
                                            if ($assest_type == $yn->act_inact_id) {
                                                echo "checked";
                                            }
                                            ?> >
                                            <span class="checkmark_radio"></span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div><br/>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_purchased">Date Purchased</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calculator color_blue"></i></span>
                                    <input type="text" class="form-control datepicker" id="date_purchased" name="date_purchased" value="{{ \Carbon\Carbon::parse($date_purchased)->format('d/m/Y')}}">          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_sold">Date Sold</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                    <input type="text" class="form-control datepicker" id="date_sold" name="date_sold" value="{{ \Carbon\Carbon::parse($date_sold)->format('d/m/Y')}}">          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="purchase_price">Purchase Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="purchase_price" name="purchase_price" value="{{$purchase_price}}" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="sale_price">Sale Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{$sale_price}}" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>
                        <hr>


                        <h5 class="color_blue">Expenses</h5>
                        <div id="addExpesehere">
                            <?php
                            if (isset($user_id) && $user_id > 0) {
                                $SaleofShares = DB::table('inc_sale_of_share_sub')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
//                             
//                                echo "<pre>";
//                                print_r($SaleofShares);
//                                echo "</pre>";
                                ?>
                                <div class="col-md-2 col-md-offset-10" style="padding-left: 41px;">
                                    <button type="button" id="addMoreExpense" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div> 
                                <?php
                                $i = 1;
                                foreach ($SaleofShares as $index => $singlecap) {
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for=expense_date">Date</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                                <input type="text" class="form-control datepicker" id="expense_date" name="expense_date[{{$i}}]" value="{{ \Carbon\Carbon::parse($singlecap->expense_date)->format('d/m/Y')}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="expense_description">Description</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                                <select id="expense_description" class="form-control" name="expense_description[{{$i}}]">
                                                    <option selected="selected" value="0">Select</option>
                                                    <?php
                                                    $expenses = DB::table('tbl_expenses')->select('expenses_id', 'expenses_name')->get();
                                                    foreach ($expenses as $expen) {
                                                        if ($singlecap->expense_descr == $expen->expenses_id) {
                                                            echo ' <option value="' . $expen->expenses_id . '" selected >' . $expen->expenses_name . '</option>';
                                                        } else {
                                                            echo ' <option value="' . $expen->expenses_id . '">' . $expen->expenses_name . '</option>';
                                                        }
                                                        ?>

                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="expense_amt">Amount</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="expense_amt" name="expense_amt[{{$i}}]" value="{{$singlecap->expense_amt}}" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="margin-top: 25px;">
                                            <button id="addMoreRcpt" type="button" class="deleteRow btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>
                                        </div>
                                    </div>

                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for=expense_date">Date</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                            <input type="text" class="form-control datepicker" id="expense_date" name="expense_date[1]" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="expense_description">Description</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                            <select id="expense_description" class="form-control" name="expense_description[1]">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $expenses = DB::table('tbl_expenses')->select('expenses_id', 'expenses_name')->get();
                                                foreach ($expenses as $expen) {
                                                    ?>
                                                    <option value="{{$expen->expenses_id}}">{{$expen->expenses_name}}</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="expense_amt">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                            <input type="text" class="form-control" id="expense_amt" name="expense_amt[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button type="button" id="addMoreExpense" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </form>
                </div>

                <br/>
                <br/>

                <div class="form-group col-sm-12">
                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                    <button type="button" class="btn btn-success btn-sm" onclick="SaleOfShareFormDataSave()"><i class="fa fa-forward"></i> <?php
                        if (isset($user_id) && $user_id > 0) {
                            echo "Update and Go";
                        } else {
                            echo "Save and Go";
                        }
                        ?></button>

                </div>

                <br/><br/><br/> <br/><br/> <br/> 
            </div>
        </div>
    </div>

</div>
</div>
<?php
if (isset($i) && $i > 0) {
    $counter = $i;
} else {
    $counter = '2';
}
?> 
<script>

    var counter = '<?php echo $counter ?>';
    $("#addMoreExpense").click(function () {
        $(' <div class="row">\n\
                        <div class="form-group col-md-4">\n\
                            <div class="input-group">\n\
                                    <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>\n\
                            <input type="text" class="form-control datepicker" id="expenses_date" name="expense_date[' + counter + ']" value="">\n\
                        </div>\n\
                        </div>\n\
                        <div class="form-group col-md-4">\n\
                                        <div class="input-group">\n\
                                            <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>\n\
                                            <select id="expense_description" class="form-control" name="expense_description[' + counter + ']">\n\
                                                <option selected="selected" value="0">Select</option>\n\
<?php
$expenses = DB::table('tbl_expenses')->select('expenses_id', 'expenses_name')->get();
foreach ($expenses as $expen) {
    ?><option value="{{$expen->expenses_id}}">{{$expen->expenses_name}}</option><?php } ?>\n\
                                            </select>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="form-group col-md-2">\n\
                                        <div class="input-group">\n\
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                            <input type="text" class="form-control" id="expense_amt" name="expense_amt[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                                        </div>\n\
                                        </div>\n\
 <div class="col-md-2" style="margin-top: ;">\n\
                                            <button id="addMoreRcpt" type="button" class="deleteRow btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>\n\
                                        </div>\n\
                                    </div>').appendTo("#addExpesehere");
        counter++;
       jQuery('.datepicker').datetimepicker({
    timepicker: false,
    format: 'd/m/Y',
    formatDate: 'd/m/Y',
});


    });


    function SaleOfShareFormDataSave() {
        alert($("#saleOfShareFormElement").serialize());
        $.ajax({
            type: 'get',
            url: '{{ URL::to('SaleOfShareFormDataSave')}}',
            data: $("#saleOfShareFormElement").serialize(),
            success: function (data) {
                alert(data);
                var url = $(location).attr('href');
                var subUrl = url.substring(0, url.lastIndexOf("/"))
                var sdas = subUrl.substring(0, subUrl.lastIndexOf("/"))
                var mainurl = sdas + "/" + data;
                window.location.href = mainurl;

            },
            error: function () {
                alert("Failed ! Please try again later.");
            }
        });
    }
    $("#addExpesehere").on("click", "button.deleteRow", function () {
        $(this).closest('.row').remove();
    });


</script>
@stop