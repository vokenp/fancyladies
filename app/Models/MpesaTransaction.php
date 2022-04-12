<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaTransaction extends Model
{
    use HasFactory;
    protected $table = "mpesa_transactions";

    protected $fillable = [
        'created_by',
        'updated_by',	
        'TransactionType',	
        'TransID',	
        'TransTime',	
        'TransAmount',	
        'BusinessShortCode',	
        'BillRefNumber',	
        'InvoiceNumber',	
        'OrgAccountBalance',	
        'ThirdPartyTransID',	
        'MSISDN',	
        'FirstName',	
        'MiddleName',
        'LastName'
    ];
}
