<?php

namespace App\Http\Controllers\Apps;

use App\Models\Members;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DataTables;


class InteriMemberController extends Controller
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
     public $viewlink;
     public $modalName;


    public function __construct()
    {
        $this->menuLinkName = "interimember";
        $this->modalName = "interimember_create_modal";
        $this->middleware('auth');
        $this->page_title = 'Interim Members';
        $this->page_description = 'This is Page is Used to Manage Interim Members';
        $this->btnAddNew = 'apps.'.$this->menuLinkName.'.create';
        $this->btnDelAction = 'apps.'.$this->menuLinkName.'.store';
        $this->tblContentLink = 'apps.'.$this->menuLinkName.'.index';
        $this->storelink = 'apps.'.$this->menuLinkName.'.store';
        $this->editlink = 'apps.'.$this->menuLinkName.'.edit';
        $this->listlink = 'apps.'.$this->menuLinkName.'.list';
        $this->viewlink = 'apps.'.$this->menuLinkName.'.show';
        
    }


    public function index(Request $request)
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
            'content'    => 'pages.globallist_view',
            'hasModal'    => 'pages.Apps.Membership.'. $this->modalName,
            'modalName'  =>  $this->modalName,
            
        ];

        $columns = [];
        $columns[] = array('data' => 'DT_RowIndex', 'name' => 'DT_RowIndex','title' => '#' ,'searchable' =>false,'orderable' =>false);
        $columns[] = array('data' => 'member_no', 'name' => 'member_no', 'title' =>'Interim No');
        $columns[] = array('data' => 'member_idno', 'name' => 'member_idno', 'title' =>'Member IDNo');
        $columns[] = array('data' => 'member_name', 'name' => 'member_name', 'title' =>'Member Name');
        //$columns[] = array('data' => 'member_dob', 'name' => 'member_dob', 'title' =>'Date of Birth');
        $columns[] = array('data' => 'member_gender', 'name' => 'member_gender', 'title' =>'Gender');
       // $columns[] = array('data' => 'member_martialstatus', 'name' => 'member_martialstatus', 'title' =>'Martial Status');
        $columns[] = array('data' => 'member_phoneno', 'name' => 'member_phoneno', 'title' =>'Phone No');
        $columns[] = array('data' => 'member_email', 'name' => 'member_email', 'title' =>'Email');
        $columns[] = array('data' => 'action', 'name' => 'action','title' => 'Actions' ,'searchable' =>false,'orderable' =>false);
        $data['cols'] = json_encode($columns);

        return view('pages.listview',$data);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $q_Members = Members::select('*')->where('member_type','=', 'Interim')->orderByDesc('created_at');
            return Datatables::of($q_Members)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = "";
                        $btn .= '<div class="dropdown dropdown-inline mr-4">';
                        $btn .= '<button type="button" class="btn btn-info btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        $btn .= '<i class="flaticon2-gear text-white"></i></button>';
                        $btn .= '<div class="dropdown-menu">';

                        $btn .= '<a class="dropdown-item" href="'.route($this->editlink,$row->id).'">';
                        $btn .= '<span class="navi-icon"><i class="flaticon2-eye text-success"> </i> <span class="navi-text"> Preview Members</span></a>';
                        
                        $btn .= '</div></div> ';
                    

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
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rst = Members::where('id', $request->row_id)->first();
        if($rst !== null)
        {
            $request->request->add(['updated_by', Auth::id()]);
            $exec = $rst->update(array_merge($request->all(), ['updated_by' => Auth::id()]));
            $lastid = $request->row_id;
        }
        else{
            
            $checkExist = Members::where('member_idno', $request->member_idno)->exists();
            if($checkExist)
            {
                return response()->json(['error'=>'Similar Member exist with same ID No !']);
            }

            $nextID = getNextId('members');
            $MemNo = 'IM'.str_pad($nextID,6, "0", STR_PAD_LEFT);
            $request->request->add(['member_no' => $MemNo]);
            $rec = Members::create(array_merge($request->all(), ['created_by' => Auth::id()]));
            $lastid = $rec->id;

            // $items =  [
            //     [
            //       'Members_id' => $lastid,
            //       'created_by' => Auth::id(),
            //       'created_at' => now()
            //     ]
            //   ];
            // DB::table('Members_active_logs')->insert($items);
           // event(new Registered($rec));
        }
   
        return response()->json(['success'=>'Record saved successfully!','lastid' => $lastid]);
        
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Members  $Members
     * @return \Illuminate\Http\Response
     */
    public function show(Members $Members)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Members  $Members
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rst = Members::findOrfail($id);
        ;
         $data = [
             'rst'       => $rst,
             'page_title'       => $this->page_title,
             'page_description' => $this->page_description,
             'btncreate'    => $this->btnAddNew,
             'delAction'    => $this->btnDelAction,
             'storeAction'    => $this->storelink,
             'editAction'    => $this->editlink,
             'tblContent'    =>  $this->tblContentLink,
             'listLink'    =>  $this->listlink,
             'content'    => 'pages.Apps.Membership.interimember_edit'
             // 'hasModal'    => 'pages.SysDev.menucategory_edit_modal',
             // 'modalName'  => 'menucat_edit_modal',
         ];
 
         return view('pages.listview',$data);
    }


   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Members  $Members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Members $Members)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Members  $Members
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
