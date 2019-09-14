<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use App\Day;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendar = Calendar::all();

        return view('/welcome', compact('calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'this is the method create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 2019-09-17 dte format
        $day_arr = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $day_clone = [];
        $day_avail = $request->input('days');
        $startTime = strtotime( $request->from_date );
        $endTime = strtotime( $request->to_date );
        // $day_for_testing = [];
        
        if ($day_avail) {
            for ($i=0; $i <  count($day_avail); $i++) { 
                array_push($day_clone, ($day_avail[$i]-1)); 
            }
            // arr(2,3,4)
        }

        if ($day_clone) {
            if(!empty($request->event) && $day_avail && ($startTime <= $endTime)) { 
               
                    
                    // Loop between timestamps, 24 hours at a time
                    for ( $a = $startTime; $a <= $endTime; $a = $a + 86400 ) {
                        for ($i=0; $i < count($day_clone); $i++) { 
                            $day_save = $day_arr[$day_clone[$i]] === date( 'D', $a );
                            $check_if_exist = Calendar::where('date', '=', date( 'Y-m-d', $a ))->where('day_id', '=', $day_clone[$i]+1)->first();
                            
                            if ($check_if_exist) {
                                $calendar = Calendar::find($check_if_exist->id);  //to update
                                $calendar->event = $request->event;
                                $calendar->save();
                            } 
                            if ($day_save && !$check_if_exist) {
                                $calendar1 = new Calendar;
                                $calendar1->day_id = $day_clone[$i]+1;
                                $calendar1->event = $request->event;
                                $calendar1->date = date( 'Y-m-d', $a );
                                $calendar1->save();
                            }
                        }
                    }   
                    // dd($day_for_testing);
                   
               
                $notification = array(
                    'message' => 'Event successfully saved.',
                    'alert-type' => 'success'
                );
            } else {
                $notification = array(
                    'message' => 'Make sure to fill in all fields correctly.',
                    'alert-type' => 'warning'
                );    
            }
            
        } else {
            $notification = array(
                'message' => 'Choose weekdays.',
                'alert-type' => 'warning'
            );
        }

        // return redirect('/');
        return back()->withInput()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
