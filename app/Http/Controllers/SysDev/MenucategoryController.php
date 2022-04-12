<?php

namespace App\Http\Controllers\SysDev;

use App\Models\menucategory;
use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;

class MenucategoryController extends Controller
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
        $this->menuLinkName = "menucats";

        $this->middleware('auth');
        $this->page_title = 'Menu Categories';
        $this->page_description = 'This is Page is Used to Manage Menu Categories';
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
            'hasModal'    => 'pages.SysDev.menucategory_create_modal',
            'modalName'  => 'menucategory_create_modal',
        ];

        $columns = [];
        $columns[] = array('data' => 'DT_RowIndex', 'name' => 'DT_RowIndex','title' => '#' ,'searchable' =>false,'orderable' =>false);
        $columns[] = array('data' => 'menu_title', 'name' => 'menu_title', 'title' =>'Menu Title');
        $columns[] = array('data' => 'menu_icon', 'name' => 'menu_icon', 'title' =>'Menu Icon');
        $columns[] = array('data' => 'menu_bullet', 'name' => 'menu_bullet', 'title' =>'Menu Bullet');
        $columns[] = array('data' => 'menu_section', 'name' => 'menu_section', 'title' =>'Menu Section');
        
        $columns[] = array('data' => 'action', 'name' => 'action','title' => 'Actions' ,'searchable' =>false,'orderable' =>false);
        
        $data['cols'] = json_encode($columns);
        
        return view('pages.listview',$data);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $q_user = menucategory::select('*')->where('id','!=', 0)->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                    
                        $btn = "";
                        $btn .= '<div class="dropdown dropdown-inline mr-4">';
                        $btn .= '<button type="button" class="btn btn-info btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        $btn .= '<i class="flaticon2-gear text-white"></i></button>';
                        $btn .= '<div class="dropdown-menu">';

                
                        $btn .= '<a class="dropdown-item" href="'.route($this->editlink,$row->id).'">';
                        $btn .= '<span class="navi-icon"><i class="flaticon2-pen text-success"></i><span class="navi-text">Manage SubMenus</span></a>';

                        $btn .= '<a class="dropdown-item deleteRecord text-danger" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" href="#"> <span class="navi-icon"><i class="flaticon2-trash"></i><span class="navi-text"> Delete</span></a>';
                        $btn .= '</div></div> ';
                    

                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function listsubmenus(Request $request)
    {
        if ($request->ajax()) {
            $menucategory_id = $request->menucategory_id;
            $q_user = Submenu::select('*')->where('menucategory_id','=', $menucategory_id)->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                    
                        $rowjs[] = array('id' => $row->id,'title'=> $row->page);
                        $btn = "";
                        $btn .= '<div class="dropdown dropdown-inline mr-4">';
                        $btn .= '<button type="button" class="btn btn-info btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';

                        $btn .= '<i class="flaticon2-gear text-white"></i></button>';
                        $btn .= '<div class="dropdown-menu">';
                
                        $btn .= '<a class="dropdown-item subItemEdit" href="#" data-value="'.json_encode($rowjs).'" >';
                        $btn .= '<span class="navi-icon"><i class="flaticon2-pen text-success "></i><span class="navi-text"  >Edit Item</span></a>';

                        $btn .= '<a class="dropdown-item deleteRecord text-danger" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" href="#"> <span class="navi-icon"><i class="flaticon2-trash"></i><span class="navi-text"> Delete Item</span></a>';
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
            'content'    => 'pages.SysDev.menucategory_crud',
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
        $rst = menucategory::where('id', $request->row_id)->first();
        if($rst !== null)
        {
            $request->request->add(['updated_by', Auth::id()]);
            $exec = $rst->update(array_merge($request->all(), ['updated_by' => Auth::id()]));
            $lastid = $request->row_id;
        }
        else{
          
            
            $rec = menucategory::create(array_merge($request->all(), ['created_by' => Auth::id()]));
            $lastid = $rec->id;
        }
   

        return response()->json(['success'=>'Record saved successfully!','lastid' => $lastid]);
    }

    public function save_submenu(Request $request)
    {
        $rst = Submenu::where('id', $request->row_id2)->first();
        if($rst !== null)
        {
            $request->request->add(['updated_by', Auth::id()]);
            $exec = $rst->update(array_merge($request->all(), ['updated_by' => Auth::id()]));
            $lastid = $request->row_id2;
        }
        else{
          
            
            $rec = Submenu::create(array_merge($request->all(), ['created_by' => Auth::id()]));
            $lastid = $rec->id;
        }
   

        return response()->json(['success'=>'Record saved successfully!','lastid' => $lastid]);
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menucategory  $menucategory
     * @return \Illuminate\Http\Response
     */
    public function show(menucategory $menucategory)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menucategory  $menucategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rst = menucategory::findOrfail($id);
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
            'content'    => 'pages.SysDev.menucategory_edit',
            'hasModal'    => 'pages.SysDev.menucategory_edit_modal',
            'modalName'  => 'menucategory_edit_modal',
        ];

        $columns = [];
        $columns[] = array('data' => 'DT_RowIndex', 'name' => 'DT_RowIndex','title' => '#' ,'searchable' =>false,'orderable' =>false);
        $columns[] = array('data' => 'title', 'name' => 'title', 'title' =>'Menu Title');
        $columns[] = array('data' => 'page', 'name' => 'page', 'title' =>'Menu Page');
    
        $columns[] = array('data' => 'action', 'name' => 'action','title' => 'Actions' ,'searchable' =>false,'orderable' =>false);
        
        $data['cols'] = json_encode($columns);

        return view('pages.listview',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menucategory  $menucategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menucategory $menucategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menucategory  $menucategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        menucategory::find($id)->delete();
        return response()->json(['success'=>'Record deleted!']);
    }


    public function delsubmenu(Submenu $submenu)
    {

        Submenu::find($id)->delete();
        return response()->json(['success'=>'Record deleted!']);
    }
}
