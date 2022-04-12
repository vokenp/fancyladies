<?php

namespace App\Http\Controllers\SysDev;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;

class MembersController extends Controller
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


    public function __construct()
    {
        $this->menuLinkName = "member";

        $this->middleware('auth');
        $this->page_title = 'Member';
        $this->page_description = 'This is Page is Used to Manage Church Members';
        $this->btnAddNew = 'sysdev.'.$this->menuLinkName.'.create';
        $this->btnDelAction = 'sysdev.'.$this->menuLinkName.'.store';
        $this->tblContentLink = 'sysdev.'.$this->menuLinkName.'.index';
        $this->storelink = 'sysdev.'.$this->menuLinkName.'.store';
        $this->editlink = 'sysdev.'.$this->menuLinkName.'.edit';
        $this->listlink = 'sysdev.'.$this->menuLinkName.'.list';
        $this->viewlink = 'sysdev.'.$this->menuLinkName.'.show';
        
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
            //'hasModal'    => 'pages.App.MemberQuickEdit',
        ];

        $columns = [];
        $columns[] = array('data' => 'DT_RowIndex', 'name' => 'DT_RowIndex','title' => '#' ,'searchable' =>false,'orderable' =>false);
        $columns[] = array('data' => 'member_no', 'name' => 'member_no', 'title' =>'MemberNo');
        $columns[] = array('data' => 'member_name', 'name' => 'member_name', 'title' =>'Member Name');
        $columns[] = array('data' => 'member_dob', 'name' => 'member_dob', 'title' =>'Date of Birth');
        $columns[] = array('data' => 'member_gender', 'name' => 'member_gender', 'title' =>'Gender');
        $columns[] = array('data' => 'member_martialstatus', 'name' => 'member_martialstatus', 'title' =>'Martial Status');
        $columns[] = array('data' => 'member_phoneno', 'name' => 'member_phoneno', 'title' =>'Phone No');
        $columns[] = array('data' => 'member_email', 'name' => 'member_email', 'title' =>'Email');
        $columns[] = array('data' => 'action', 'name' => 'action','title' => 'Actions' ,'searchable' =>false,'orderable' =>false);
        
        $data['cols'] = json_encode($columns);

        return view('pages.listview',$data);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $q_user = Members::select('*')->where('id','!=', 0)->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = "";
                        $btn .= '<div class="dropdown dropdown-inline mr-4">';
                        $btn .= '<button type="button" class="btn btn-info btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        $btn .= '<i class="flaticon2-gear text-white"></i></button>';
                        $btn .= '<div class="dropdown-menu">';

                        $btn .= '<a class="dropdown-item text-info" href="'.route($this->viewlink,$row->id).'" data-toggle="modal" data-target="#exampleModal">';
                        $btn .= '<span class="navi-icon"><i class="flaticon-eye "></i><span class="navi-text"> Preview</span></a>';

                        $btn .= '<a class="dropdown-item" href="'.route($this->editlink,$row->id).'">';
                        $btn .= '<span class="navi-icon"><i class="flaticon2-pen text-success"></i><span class="navi-text"> Update</span></a>';

                        $btn .= '<a class="dropdown-item deleteRecord text-danger" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" href="#"> <span class="navi-icon"><i class="flaticon2-trash"></i><span class="navi-text"> Delete</span></a>';
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
        $data = [
            'page_title'       => $this->page_title,
            'page_description' => $this->page_description,
            'btncreate'    => $this->btnAddNew,
            'delAction'    => $this->btnDelAction,
            'storeAction'    => $this->storelink,
            'editAction'    => $this->editlink,
            'tblContent'    =>  $this->tblContentLink,
            'content'    => 'pages.App.Membership.Members_create',
        ];
        return view('pages.listview',$data);
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
          
            $nextID = getNextId('members');
            $MemNo = 'CFF'.str_pad($nextID,6, "0", STR_PAD_LEFT);
            $request->request->add(['member_no' => $MemNo]);
            $rec = Members::create(array_merge($request->all(), ['created_by' => Auth::id()]));
            $lastid = $rec->id;
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
    public function edit(Members $Members)
    {
        //
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
        Members::find($id)->delete();
        return response()->json(['success'=>'Record deleted!']);
    }
}
