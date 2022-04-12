<?php

namespace App\Http\Controllers\SysDev;

use App\Models\User;
use App\Models\UserActiveLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DataTables;


class UserController extends Controller
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
        $this->menuLinkName = "user";
        $this->modalName = "user_create_modal";
        $this->middleware('auth');
        $this->page_title = 'User';
        $this->page_description = 'This is Page is Used to Manage System Users';
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
            'hasModal'    => 'pages.SysDev.'. $this->modalName,
            'modalName'  =>  $this->modalName,
            
        ];

        $columns = [];
        $columns[] = array('data' => 'DT_RowIndex', 'name' => 'DT_RowIndex','title' => '#' ,'searchable' =>false,'orderable' =>false);
        $columns[] = array('data' => 'username', 'name' => 'username', 'title' =>'User Name');
        $columns[] = array('data' => 'name', 'name' => 'name', 'title' =>'Full Name');
        $columns[] = array('data' => 'phoneno', 'name' => 'phoneno', 'title' =>'Phone No');
        $columns[] = array('data' => 'email', 'name' => 'email', 'title' =>'Email');
        $columns[] = array('data' => 'user_type', 'name' => 'user_type', 'title' =>'User Type');
        $columns[] = array('data' => 'active_status', 'name' => 'active_status', 'title' =>'Active');
        $columns[] = array('data' => 'action', 'name' => 'action','title' => 'Actions' ,'searchable' =>false,'orderable' =>false);
        
        $data['cols'] = json_encode($columns);

        return view('pages.listview',$data);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $q_user = User::select('*')->where('id','!=', 0)->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = "";
                        $btn .= '<div class="dropdown dropdown-inline mr-4">';
                        $btn .= '<button type="button" class="btn btn-info btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        $btn .= '<i class="flaticon2-gear text-white"></i></button>';
                        $btn .= '<div class="dropdown-menu">';

                        $btn .= '<a class="dropdown-item" href="'.route($this->editlink,$row->id).'">';
                        $btn .= '<span class="navi-icon"><i class="flaticon2-eye text-success"> </i> <span class="navi-text"> Preview User</span></a>';
                        
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
        $rst = User::where('id', $request->row_id)->first();
        if($rst !== null)
        {
            $request->request->add(['updated_by', Auth::id()]);
            $exec = $rst->update(array_merge($request->all(), ['updated_by' => Auth::id()]));
            $lastid = $request->row_id;
        }
        else{
            
            $checkUser = User::where('username', $request->username)->exists();
            if($checkUser)
            {
                return response()->json(['error'=>'Similar User exist with same User Name !']);
            }

            $request->request->add(['password' => Hash::make(config('app.DefaultPassword'))]);
            $rec = User::create(array_merge($request->all(), ['created_by' => Auth::id()]));
            $lastid = $rec->id;

            $items =  [
                [
                  'user_id' => $lastid,
                  'created_by' => Auth::id(),
                  'created_at' => now()
                ]
              ];
            DB::table('user_active_logs')->insert($items);
           // event(new Registered($rec));
        }
   
        return response()->json(['success'=>'Record saved successfully!','lastid' => $lastid]);
        
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rst = User::findOrfail($id);
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
             'content'    => 'pages.SysDev.user_edit'
             // 'hasModal'    => 'pages.SysDev.menucategory_edit_modal',
             // 'modalName'  => 'menucat_edit_modal',
         ];
 
         return view('pages.listview',$data);
    }


   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
