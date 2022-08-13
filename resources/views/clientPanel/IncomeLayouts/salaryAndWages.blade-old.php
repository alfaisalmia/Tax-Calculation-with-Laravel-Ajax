
@extends("clientPanel.clientPanelMaster")
@section('title', 'Salary and Wages')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">

        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Salary and Wages</h3>
                    <h5>Click on "Add New Record" to input your salary and wage information. You may add as many PAYG Payment Summaries as needed. Please note that more than three entries in this section will increase your tax preparation fees.  </h5>

                </div>

                <div class="">
                    <div class="col-md-12">
                        <p>Select your main wage &amp; salary occupation. Then click Add New Record to input your information.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5 class="color_blue"></h5>
                    <div class="row">
                        <div class="col-md-4">
                            <p>How many PAYG Summaries do you have?</p>
                        </div>
                        <div class="col-md-4">
                            <select id="paygSummary" class="form-control" name="paygSummary" onchange="paygSummary()">

                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>

                            </select>
                        </div> 

                    </div>

                    <h5 class="color_blue">Allowances</h5>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <td class="text-center"><p><b >Payer’s ABN</b></p></td>
                                        <td class="text-center"><p><b>Total Tax Withheld</b></p></td>
                                        <td class="text-center"><p><b>Gross Payments (Income)</b></p></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="">
                                        <th scope="row">1</th>
                                        <td> <input type="text" class="form-control" id="UntaxedElement" name="UntaxedElement" value=""></td>
                                        <td> <input type="text" class="form-control" id="UntaxedElement" name="UntaxedElement" value=""></td>
                                        <td> <input type="text" class="form-control" id="UntaxedElement" name="UntaxedElement" value=""></td>
                                       
                                    </tr>
                                </tbody>


                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ulockd-mrgn1210">
                            <div class="alert alert-info">
                                <strong>Section B: Payer Details</strong> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <p>This was my only salary or income during the past year.</p>
                        </div>
                        <div class="col-md-2">
                            <select id="higher_education_loan" name="higher_education_loan" class="form-control" onchange="">
                                <option selected value="0">Choose</option>
                                <?php
                                $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                                foreach ($yesnos as $yn) {
                                    if (1 == $yn->yes_no_id) {
                                        echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                    } else {
                                        echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Please add notes about any other income:</p>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" cols="20" data-validation="" id="SalaryOrWage2017Section_NotesAboutOtherIncome" name="SalaryOrWage2017Section_NotesAboutOtherIncome" rows="2" style="height: 100px;"></textarea>
                        </div> 
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-8">
                            <p>Please attach a copy of your PAYG statement (optional):</p>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
  </div>
</div> 
                        </div> 
                    </div>
                    <br/>
          
                    <br/><br/><br/> 
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-forward"></i> Save and Go</button>

                            </div>
                        </div>
                    </div>
                    <br/><br/><br/>  <br/><br/><br/><br/><br/><br/>  
                </div>
            </div>
        </div>

    </div>
</div>




</form>

</div>

</div>
</div>
<script>
    function paygSummary() {
        var id = $("#paygSummary").val();
        var newTextBoxRow = '';

//        newTextBoxRow += '<tr><th scope="row">1</th><td> <input type="text" class="form-control" id="UntaxedElement" name="UntaxedElement" value=""></td><td> <input type="text" class="form-control" id="UntaxedElement" name="UntaxedElement" value=""></td></tr>';
        $("table tbody").empty();
        for (var i = 1; i <= id; i++) {
            newTextBoxRow += '<tr><th scope="row">' + i + '</th><td> <input type="text" class="form-control" id="PayersAMB' + i + '" name="PayersAMB[' + i + ']" value=""></td><td> <input type="text" class="form-control" id="TotalTaxWithheld' + i + '" name="TotalTaxWithheld[' + i + ']" value=""></td><td> <input type="text" class="form-control" id="GrossPayment' + i + '" name="GrossPayment[' + i + ']" value=""></td></tr>';
        }
        $("table tbody").append(newTextBoxRow);
    }

</script>

@stop