
@extends("clientPanel.clientPanelMaster")
@section('title', 'Finish')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-12 col-lg-12">
            <div class="row" style="background-color: white">
                <div class="col-md-12 ">
                    <h2 class="text-center">Checkout & Additional Service Options</h2>
                    <div class="row col-sm-10 col-sm-offset-1" style="background-color: #f5f5f5; border-bottom: 3px solid silver">
                        <div class="col-sm-6"><h2>  Package Type: Express</h2></div>
                        <div class="col-sm-6 pull-right"> <h2>$19.00</h2></div>

                    </div>
                    <div class="row col-sm-10 col-sm-offset-1" style="background-color: #f5f5f5">
                        <p>The Express Package is tailored to those with a total income of less than $25,000. Income types are limited to wages, salaries, interest, dividends and Centrelink payments. This package also allows you to claim up to $300 in deductions.
                        </p>

                    </div>

                </div>

    
                    <div class="row col-sm-10 col-sm-offset-1" style="padding: 15px">
                        <div class="form-group">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <a href="{{URL('/finish')}}" class="btn btn-success btn-sm"><i class="fa fa-backward"></i> Save and Go</a>

                        </div>
                    </div>

        </div>  </div>

    </div>
</div>
</div>
</div>
@stop