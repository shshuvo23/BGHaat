@extends('layouts.templete')
@section('body_title')
<h4 class="header-title">Payment</h4>
@endsection
@section('content')
<div class="container">
<section id="add_user" >
    <div class="justify-content-center" >
        <div class="" >
            <div class="" >

                <div class=" " style="height: 100vh;">
                    <form method="POST" action="{{ route('paied_due') }}">
                        @csrf

                        <div class="row mb-3 ">

                            <input type="text" name="type" value="{{$type}}" hidden required>
                            <input type="number" name="id" value="{{$customer->id}}" hidden required>

                            <div class="col-md-3">
                                <label for="user_name">{{ __('Name') }} </label>
                                <input id="name" class="form-control" name="name" type="text" value="{{$customer->name}}"  readonly>
                            </div>
                            <div class="col ">
                                <label for="">Due</label>
                                <input id="due" type="number" name="due"
                                    class="form-control " value="{{$customer->due}}"
                                    readonly="" required>
                                    @error('due')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 ">
                                <label for="">Payment</label>
                                <input onkeyup="payment()" onchange="payment()"
                                    name="paid" id="paid" type="number"
                                    class="form-control " value="">
                                    @error('paid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="col-md-3 ">
                                <label for="">Change</label>
                                <input id="change" type="number" name="change"
                                    class="form-control " value=""
                                    readonly="" required>
                                    @error('change')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-0 ">
                            <div class="col d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection

@section('js')
    <script>
        function payment(){
            let due = document.getElementById('due').value;
            let paid = document.getElementById('paid').value;
            if(paid == null || paid == ""){ paid = 0; document.getElementById('paid').value = 0;}

            if(parseFloat(paid)<0) {
                paid = 0;
                document.getElementById('paid').value = 0;
            }
            if(parseFloat(paid) <= parseFloat(due)){
                document.getElementById('change').value = 0;
            }

            if(parseFloat(paid) >= parseFloat(due)){
                document.getElementById('change').value = parseFloat(paid) - parseFloat(due);
            }
        }
    </script>
@endsection
