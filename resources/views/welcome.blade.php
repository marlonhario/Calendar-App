<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

       <!-- Styles -->
        <style>
            .body{
                padding: 0px;
                margin: 0px;
            }
            .list-group-item {
                border-left: none;
                border-right: none;
            }

            #main_container {
                border-radius: 10px;
            }
            #title_container {
                margin: 0;
                border-bottom: 1px solid rgba(0,0,0,.125);
            }
            
        </style>
        
    </head>
    <body>
  

     
        <div id="main_container" class="p-0 mt-4 container bg-white">
            <div id="title_container" class="row p-4">
                <h1>Calendar</h1>
            </div>
            <div class="container p-4">
                <div class="row">
                    <div class="col-md-5">
                        <form method="POST" action="/calendar">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputevent1">Event</label>
                                <input name="event" value="{{ old('event') }}" type="event" class="form-control" id="exampleInputevent1" aria-describedby="eventHelp" />
                            </div>
                            <div class="row">
                                <div class='col-md-6 p-0'>
                                    <div class="form-group col-md-12">
                                        <label for="datepicker1">From</label>
                                        <input name="from_date" value="{{ old('from_date') }}" type='date' class="form-control" id='datepicker1' />
                                    </div>
                                </div>
                                <div class='col-md-6 p-0'>
                                    <div class="form-group col-md-12">
                                        <label for="datepicker2">To</label>
                                        <input name="to_date" value="{{ old('to_date') }}" type='date' class="form-control" id='datepicker2' />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="form-check">
                                        <input name="days[]" class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Mon
                                        </label>
                                    </div>
                                    <div class="form-check ">
                                        <input name="days[]" class="form-check-input" type="checkbox" value="2" id="defaultCheck2">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Tue
                                        </label>
                                    </div>
                                    <div class="form-check ">
                                        <input name="days[]" class="form-check-input" type="checkbox" value="3" id="defaultCheck3">
                                        <label class="form-check-label" for="defaultCheck3">
                                            Wed
                                        </label>
                                    </div>
                                    <div class="form-check ">
                                        <input name="days[]" class="form-check-input" type="checkbox" value="4" id="defaultCheck4">
                                        <label class="form-check-label" for="defaultCheck4">
                                            Thu
                                        </label>
                                    </div>
                                    <div class="form-check ">
                                        <input name="days[]" class="form-check-input" type="checkbox" value="5" id="defaultCheck5">
                                        <label class="form-check-label" for="defaultCheck5">
                                            Fri
                                        </label>
                                    </div>
                                    <div class="form-check ">
                                        <input name="days[]" class="form-check-input" type="checkbox" value="6" id="defaultCheck6">
                                        <label class="form-check-label" for="defaultCheck6">
                                            Sat
                                        </label>
                                    </div>
                                    <div class="form-check ">
                                        <input name="days[]" class="form-check-input" type="checkbox" value="7" id="defaultCheck7">
                                        <label class="form-check-label" for="defaultCheck7">
                                            Sun
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <h4><strong>{{date("M")}} {{date("Y")}}</strong></h4>
                        <ul class="list-group">
                            <?php $number = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")); ?>
          
                            @for ($i=1; $i <= $number; $i++)
                                <li class="list-group-item d-flex bg-lightBlue">
                                    <p>{{$i}} {{date('D', strtotime($i."-".date("M")."-".date("Y")))}}</p>
                                    @foreach($calendar as $key => $value)
                                        @if( $value->date === date('Y-m-d', strtotime($i."-".date("M")."-".date("Y"))))   
                                            <h5 class="pl-5" >{{$value->event}}</h5>
                                        @endif
                                    @endforeach   
                                </li> 
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script>
            $( document ).ready(function() {
                $( "li.bg-lightBlue" ).has( "h5" ).css( "background-color", "#abeef9" );
            });
           
            @if(Session::has('message'))
                var type="{{Session::get('alert-type', 'info')}}"
                
                switch(type){
                    case 'info':
                        toastr.info("{{Session::get('message')}}");
                        break;
                    case 'success':
                        toastr.success("{{Session::get('message')}}");
                        break;
                    case 'warning':
                        toastr.warning("{{Session::get('message')}}");
                        break;
                    case 'error':
                        toastr.error("{{Session::get('message')}}");
                        break;
                }
            @endif    
        </script>
    </body>
</html>

