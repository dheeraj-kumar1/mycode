<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Client extends Model
{
    use HasFactory;
    protected $fillable = ['full_name','group_id','company_name','title','first_name','surname','friendly_name','email','mobile_phone','home_phone','work_phone','fax','notes','address_line1','address_line2','town','county','postcode','country','date_registered','registration_complete','reg_website','branches','source','grouping','property_email','property_sms','other_marketing','consent_updated','consent_link','delete_before','finance_status','finance_status_notes','chain_status','chain_status_notes'];

    public function clients()
    {
        return $this->belongsTo(clients::class);
    }

    public function clientsbygroupid($group_id){

        $data = DB::select('*')->where('group_id', '=', $group_id);
        return $data;
    }
}