
@extends("clientPanel.clientPanelMaster")
@section('title', 'Non-Attributed Personal Service Income (PSI)')
@section("content")


<div class="ulockd-service-details">
    <div class="container"> 
          <div class="col-md-10 col-lg-10">
     
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Non-Attributed Personal Service Income (PSI)</h3>
                    <h5>According to the ATO, PSI is income that is mainly a reward for an individual's personal efforts or skills. You should ONLY complete this section if you earned PSI that was not attributed to you through your employer. Any attributed PSI should be reported in the <a href="#" class="our_link color_blue">Attributed PSI income section</a>. To complete this section, you MUST also satisfy the test below. If you do not satisfy the test below, you may alternatively report this income as business income. <span style="color:red;">If you are an ABN holder, you must NOT include that income here. That income should be reported as a</span> <a href="#" class="our_link color_blue">Business Schedule.</a></h5>
                </div>
                <div class="col-sm-12 ">

                    <hr>
                    <h5 class="color_blue">Business Information:</h5>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="description"><span style="color: red">With respect to at least 75% of this income was PSI paid to achieve a specific result or outcome?</span></label>
                        </div>
                        <div class="form-group col-md-2">
                            <select id="code" class="form-control" name="code">
                                <option selected="selected" value="0">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="1">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="description"><span style="color: red">With respect to at least 75% of this income did you provide the tools or equipment? (Answer "Yes" if tools or equipment were not required)</span></label>
                        </div>
                        <div class="form-group col-md-2">
                            <select id="code" class="form-control" name="code">
                                <option selected="selected" value="0">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="1">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="description"><span style="color: red">With respect to at least 75% of this income were you liable for fixing defects in your work?</span></label>
                        </div>
                        <div class="form-group col-md-2">
                            <select id="code" class="form-control" name="code">
                                <option selected="selected" value="0">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="1">No</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                </div>
                

             
              
        </div>
    </div>
        </div>
    </div>
    </div>


    @stop