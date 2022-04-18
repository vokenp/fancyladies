<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComposedSms;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Event;
use App\Events\SendSMS;
class ComposedSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $page_title;
    public $page_description;
    public $btnAddNew;
    public $btnDelAction;
    public $tblContentLink;
    public $menuLinkName;
    public $storelink;
    public $editlink;
    public $listlink;

    public function __construct()
    {
        $this->menuLinkName = "composesms";

        $this->middleware('auth');
        $this->page_title = 'Compose SMS';
        $this->page_description = 'This is Page is Used to Compose SMS Message';
        $this->btnAddNew = 'apps.'.$this->menuLinkName.'.create';
        $this->btnDelAction = 'apps.'.$this->menuLinkName.'.store';
        $this->tblContentLink = 'apps.'.$this->menuLinkName.'.index';
        $this->storelink = 'apps.'.$this->menuLinkName.'.store';
        $this->editlink = 'apps.'.$this->menuLinkName.'.edit';
        $this->listlink = 'apps.'.$this->menuLinkName.'.list';
        $this->viewlink = 'apps.'.$this->menuLinkName.'.show';
    }

    public function index()
    {
        $smsBalance = getSmsBalance();
        $templates = DB::table('sms_templates')->select('template_code','template_name','template_text')->get();
        $SMSGroups = DB::table('sms_groups')->select('id','group_name')->get();
        $Shopemployees = DB::table('employees')->select('id','employee_name')->get();
        $ShopCustomers = DB::table('customers')->select('id','customer_name','customer_phoneno')->get();
        $data = [
            'smsBalance'       => $smsBalance,
            'smsGroups'       => $SMSGroups,
            'Shopemployees'   =>  $Shopemployees,
            'ShopCustomers'   =>  $ShopCustomers,
            'smsTemps'       => $templates,
            'page_title'       => $this->page_title,
            'page_description' => $this->page_description,
            'btncreate'    => $this->btnAddNew,
            'delAction'    => $this->btnDelAction,
            'storeAction'    => $this->storelink,
            'editAction'    => $this->editlink,
            'tblContent'    =>  $this->tblContentLink,
            'listLink'    =>  $this->listlink,
            'content'    => 'pages.Apps.MyRecords.ComposedSms_page',
            
        ];

        return view('pages.listview',$data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $sendCategory = $request->send_category;
       $distrubulist  = "Test";

       if($sendCategory == "optFreeNums")
       {
        $FreeNumsTag = $request->FreeNumsTag;
        $phonelist = explode(',',$FreeNumsTag);
        $arg = array_filter($phonelist);

        if(empty($arg))
        {
            return response()->json(['error'=>'Input atleast one PhoneNo!']);
        }
        $distrubulist = json_encode($phonelist);
       }

       if($sendCategory == "optSMSGroup")
       {
            $groupTags = $request->send_groups;
            if(!is_array($groupTags))
            {
                return response()->json(['error'=>'Please select atleast One SMS Group!']);
            }
           $distrubulist = json_encode($groupTags);
       }

       if($sendCategory == "optCustomers")
       {
                $CustSentTo = $request->CustSentTo;
                if($CustSentTo == "All")
                {
                    $CustTags = 'All';
                }
             else
           {
                 $CustTags = $request->ShopCustomers;
                if(!is_array($CustTags))
                    {
                      return response()->json(['error'=>'Please select atleast One Customer!']);
                    }
                $CustTags = json_encode($CustTags);
           }
          $distrubulist = $CustTags;
       }

       if($sendCategory == "optEmployees")
       {
        $EmpSentTo = $request->EmpSentTo;
        if($EmpSentTo == "All")
        {
            $EmpTags = "All";
        }
             else
        {
         $EmpTags = $request->Shopemployees;
        if(!is_array($EmpTags))
            {
              return response()->json(['error'=>'Please select atleast One Employee!']);
            }
            $EmpTags = json_encode($EmpTags);
         }
         $distrubulist =  $EmpTags;
       }

        $rst = ComposedSms::where('id', $request->row_id)->first();
        if($rst !== null)
        {
            $request->request->add(['updated_by', Auth::id()]);
            $exec = $rst->update(array_merge($request->all(), ['updated_by' => Auth::id()]));
        }
        else{
            $request->request->add(['send_category' => str_replace('opt','',$sendCategory)]);
            $request->request->add(['distribution_list' => $distrubulist]);
            $request->request->add(['created_by', Auth::id()]);
            $rec = ComposedSms::create(array_merge($request->all(), ['created_by' => Auth::id()]));
            $lastID = $rec->id;
            Event::dispatch(new SendSMS($lastID));
        }
        //SmsTemplate::updateOrCreate(['id' => $request->row_id,'created_by' => Auth::id()],$request->all());

        return response()->json(['success'=>'Record saved successfully!']);
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
        $rst = ComposedSms::findOrfail($id);
        return $rst;
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
        ComposedSms::find($id)->delete();
        return response()->json(['success'=>'Record deleted!']);
    }
}
