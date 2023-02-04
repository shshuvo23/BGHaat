@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Shifting Request</h4>
@endsection

@section('content')


<div id="content"></div>




@endsection

@section('js')

    <script>
        $(document).ready(function() {
            $.get('{{route('shifting_request')}}', function(data){
            //console.log(data);
                document.getElementById('content').innerHTML = data;
            });
        });
    </script>




    <script>
         function cancelSendedShiftingRequest(shiftNo){
            decision = confirm('Do you want to cancel the shifting request?');
            if(decision){
                $.get('{{route('cancel_pending_product')}}',{shiftNo:shiftNo}, function(data){

                    document.getElementById('content').innerHTML = data;
                });
            }
        }
    </script>
@endsection

