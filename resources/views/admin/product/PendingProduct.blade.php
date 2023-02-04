@extends('layouts.templete')

@section('body_title')
<h4 class="header-title">Pending Product</h4>
@endsection
@section('content')
    <div id="content">

    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function(){
            $.get('{{route('get_pending_product')}}', function(data){
                document.getElementById('content').innerHTML = data;
            });
        });
    </script>

    <script>
        function checkUncheck(){

            if(document.getElementById('checkUncheck').checked){value = true;}
            else{value = false;}

            boxes = document.getElementsByClassName("checkBox");
            for(i=0; i<boxes.length; i++){boxes[i].checked = value;}
        }
    </script>

    <script>
        function cancelShifting(shiftNo){
            decision = confirm('Do you want to cancel the shifting request?');
            if(decision){
                shifts = getCheckedShiftItem();
                $.get('{{route('cancel_shift_request')}}',{shifts:shifts}, function(data){
                    console.log(data);
                    document.getElementById('content').innerHTML = data;
                });
            }
        }
    </script>

    <script>
        function acceptShifting(shiftNo){
            decision = confirm('Do you want to accept the shifting request?');
            if(decision){
                shifts = getCheckedShiftItem();
                //console.log(shifts);
                $.get('{{route('accept_shift_request')}}',{shifts:shifts}, function(data){
                    //alert('ok');
                    document.getElementById('content').innerHTML = data;
                });
            }
        }
    </script>
    <script>
        function getCheckedShiftItem(){
            ar = [];
            dx = 0;
            boxes = document.getElementsByClassName("checkBox");
            for(i=0; i<boxes.length; i++){
                if(boxes[i].checked){
                    ar[dx++] = boxes[i].value;
                }
            }

            return ar;
        }
    </script>
@endsection


