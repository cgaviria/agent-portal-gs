<?php
namespace App\Traits;
use DB;
trait MonthlyRecordTrait {
   public function getBookingMonthlyRecord(){
		$set = DB::table("bookings") ->select(DB::raw('count(id) as `data`'),DB::raw('MONTH(created_at) month'))
               ->groupby('month')
               ->orderby('month')
               ->get();
        return $set;      
	}
	public function getClientMonthlyRecord(){
		$set = DB::table("clients") ->select(DB::raw('count(id) as `data`'),DB::raw('MONTH(created_at) month'))
               ->groupby('month')
               ->orderby('month')
               ->get();
        return $set;
	}
	public function getGroupMonthlyRecord(){
		$set = DB::table("groups") ->select(DB::raw('count(id) as `data`'),DB::raw('MONTH(created_at) month'))
               ->groupby('month')
               ->orderby('month')
               ->get();
        return $set;   
	}
}