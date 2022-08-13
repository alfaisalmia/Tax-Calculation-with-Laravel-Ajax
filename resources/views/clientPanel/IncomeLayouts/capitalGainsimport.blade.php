
@extends("clientPanel.clientPanelMaster")
@section('title', 'Capital Gains -Import')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">
     
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Capital Gains Import By Excel</h3>
                    <h5>Download our Excel template to import multiple capital gains records</h5>
                    <a href="" class="color_blue our_link">Download the Capital Gains Excel Sample File</a><br/>
                    <a href="" class="color_blue our_link">Download the Capital Gains Excel Template File</a>
                </div>
                <br/>
                <hr>
                <br/>
                <hr>
                <div class="col-md-12 ulockd-mrgn1210">
                    <h4 class="color_blue">Upload Your Capital Gain File</h4>
                    <h5>Click on "SELECT FILE" to select your file to import and then click  "UPLOAD & VIEW DATA" button to view your updated data. Lastly, Simply import the data by clicking the "Save Capital Gains Items" button.</h5>
                      <div class="form-group text-left">
                    <label for="form_attachment"><i class="fa fa-file-text-o"></i> SELECT FILE</label>
                    <input type="file" id="form_attachment" name="form_attachment" class="form-control" required="">
                </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <button class="btn btn-primary block btn-sm"><i class="fa fa-upload">  </i> &nbsp; UPLOAD AND VIEW DATA</button><br/>
                        </div>
                        <br/><br/> <br/><br/> <br/> <br/><br/> 
                    </div>
                </div>
              <br/><br/> <br/>
                <div class="form-group col-sm-12">
                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                   

                </div>

                <br/><br/><br/> <br/><br/> <br/> <br/><br/> <br/><br/>  
                <br/><br/><br/> <br/><br/> <br/> <br/><br/> <br/><br/> <br/><br/>  
                
            </div>
        </div>
    </div>

</div>
</div>

@stop