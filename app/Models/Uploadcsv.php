<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadcsv extends Model {
   protected $table = 'csv_data';

   public static function insertData($data){
         DB::table('temp_csv_data')->insert($data);
         $id = DB::getPdo()->lastInsertId();
         return $id;
   }
   public static function addcsv($query){
      $data = DB::insert($query);
      
         return $data;
   }

}