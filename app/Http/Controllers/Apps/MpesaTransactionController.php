<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MpesaTransaction;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class MpesaTransactionController extends Controller
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
        $this->menuLinkName = "mpesa";

        $this->middleware('auth');
        $this->page_title = 'Mpesa Till Transactions';
        $this->page_description = 'This is Page is Used to Manage Mpesa Till Transactions';
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
        $data = [
            'page_title'       => $this->page_title,
            'page_description' => $this->page_description,
            'btncreate'    => $this->btnAddNew,
            'delAction'    => $this->btnDelAction,
            'storeAction'    => $this->storelink,
            'editAction'    => $this->editlink,
            'tblContent'    =>  $this->tblContentLink,
            'listLink'    =>  $this->listlink,
            'content'    => 'pages.Apps.MyRecords.mpesatrans_view',
            
        ];

        $columns = [];
        $columns[] = array('data' => 'DT_RowIndex', 'name' => 'DT_RowIndex','title' => '#' ,'searchable' =>false,'orderable' =>false);
        $columns[] = array('data' => 'created_at', 'name' => 'created_at', 'title' =>'Trans Date');
        $columns[] = array('data' => 'TransID', 'name' => 'TransID', 'title' =>'TransID');
        $columns[] = array('data' => 'TransAmount', 'name' => 'TransAmount', 'title' =>'Trans Amount');
        $columns[] = array('data' => 'MSISDN', 'name' => 'MSISDN', 'title' =>'Phone No');
        $columns[] = array('data' => 'FirstName', 'name' => 'FirstName', 'title' =>'First Name');
        $columns[] = array('data' => 'MiddleName', 'name' => 'MiddleName', 'title' =>'Middle Name');
        $columns[] = array('data' => 'LastName', 'name' => 'LastName', 'title' =>'Last Name');
        
        $columns[] = array('data' => 'action', 'name' => 'action','title' => 'Actions' ,'searchable' =>false,'orderable' =>false);
        
        $data['cols'] = json_encode($columns);

        return view('pages.listview',$data);
    }


    public function list(Request $request)
    {
        if ($request->ajax()) {
            
            $q_user = MpesaTransaction::select('*')->where('id','!=', 0)->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                    
                        $btn = "";
                        // $btn .= '<div class="dropdown dropdown-inline mr-4">';
                        // $btn .= '<button type="button" class="btn btn-info btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        // $btn .= '<i class="flaticon2-gear text-white"></i></button>';
                        // $btn .= '<div class="dropdown-menu">';
                        
                        // $btn .= '</div> </div>';
                        // $popInfo = 'CreatedOn: '.date_format($row->created_at,'D jS M Y g:i A');
                        // $btn .= '<a href="#" class="btn btn-success btn-icon btn-sm " data-toggle="tooltip" data-placement="top" title="'.$popInfo.'" ><i class="fa fa-info "></a>';
                    

                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
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
        $rst = MpesaTransaction::where('id', $request->row_id)->first();
        if($rst !== null)
        {
            $request->request->add(['updated_by', Auth::id()]);
            $exec = $rst->update(array_merge($request->all(), ['updated_by' => Auth::id()]));
        }
        else{
            $request->request->add(['created_by', Auth::id()]);
            MpesaTransaction::create(array_merge($request->all(), ['created_by' => Auth::id()]));
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
       
    }
}
