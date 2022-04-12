<?php

namespace App\Http\Controllers\SysDev;

use App\Models\Module;
use App\Models\moduleview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DataTables;


class ModuleController extends Controller
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
        $this->menuLinkName = "module";
        $this->modalName = "module_create_modal";

        $this->middleware('auth');
        $this->page_title = 'Module';
        $this->page_description = 'This is Page is Used to System Modules';
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
        $menuCategory = DB::table('menucategories')->select('id','menu_title')->get();
        $data = [
            'menuCategory' => $menuCategory,
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
        $columns[] = array('data' => 'module_name', 'name' => 'module_name', 'title' =>'Module Name');
        $columns[] = array('data' => 'model_name', 'name' => 'model_name', 'title' =>'Model Name');
        $columns[] = array('data' => 'display_order', 'name' => 'display_order', 'title' =>'Display Order');
        $columns[] = array('data' => 'module_type', 'name' => 'module_type', 'title' =>'Module Type');
        $columns[] = array('data' => 'page_link', 'name' => 'page_link', 'title' =>'Page Link');
        $columns[] = array('data' => 'action', 'name' => 'action','title' => 'Actions' ,'searchable' =>false,'orderable' =>false);
        
        $data['cols'] = json_encode($columns);

        return view('pages.listview',$data);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $q_user = Module::select('*')->where('id','!=', 0)->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = "";
                        $btn .= '<div class="dropdown dropdown-inline mr-4">';
                        $btn .= '<button type="button" class="btn btn-info btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        $btn .= '<i class="flaticon2-gear text-white"></i></button>';
                        $btn .= '<div class="dropdown-menu">';


                        $btn .= '<a class="dropdown-item" href="'.route($this->editlink,$row->id).'">';
                        $btn .= '<span class="navi-icon"><i class="flaticon2-pen text-success"> </i> <span class="navi-text"> Update</span></a>';

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
            'content'    => 'pages.App.Modulehip.Module_create',
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
        $rst = Module::where('id', $request->row_id)->first();
        if($rst !== null)
        {
            $request->request->add(['updated_by', Auth::id()]);
            $exec = $rst->update(array_merge($request->all(), ['updated_by' => Auth::id()]));
            $lastid = $request->row_id;
        }
        else{
          
            $nextID = getNextId('modules');
            $moduleCode = Str::slug($request->module_name).'_'.$nextID;
            $request->request->add(['module_code' => $moduleCode]);
            $rec = Module::create(array_merge($request->all(), ['created_by' => Auth::id()]));
            $lastid = $rec->id;
        }
   

        return response()->json(['success'=>'Record saved successfully!','lastid' => $lastid]);
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $Module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $Module)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $Module
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuCategory = DB::table('menucategories')->select('id','menu_title')->get();
        $rst = Module::findOrfail($id);
       ;
        $data = [
            'rst'       => $rst,
            'menuCategory' => $menuCategory,
            'page_title'       => $this->page_title,
            'page_description' => $this->page_description,
            'btncreate'    => $this->btnAddNew,
            'delAction'    => $this->btnDelAction,
            'storeAction'    => $this->storelink,
            'editAction'    => $this->editlink,
            'tblContent'    =>  $this->tblContentLink,
            'listLink'    =>  $this->listlink,
            'content'    => 'pages.SysDev.module_edit'
            // 'hasModal'    => 'pages.SysDev.menucategory_edit_modal',
            // 'modalName'  => 'menucat_edit_modal',
        ];

        return view('pages.listview',$data);
    }


    public function saveModuleView(Request $request)
    {
        $module_id = $request->module_id;
        $fields = $request->field_name;
        $displayName = $request->display_name;
        $displayOrder = $request->display_order;
        $is_searchable = $request->is_searchable;
         DB::table('moduleviews')->where('module_id',$module_id)->delete();
        foreach ($fields as $key => $val) {
            if ($is_searchable[$key] != 'Y') {
                continue;
            }
        $rec = new moduleview;
        $rec->created_by = Auth::id();
        $rec->module_id = $request->module_id;
        $rec->field_name = $key;
        $rec->display_name = $displayName[$key];
        $rec->display_order = $displayOrder[$key] ?? 0;
        $rec->is_searchable = $is_searchable[$key];

        $rec->save();
        }
       
       return response()->json(['success'=>'Record Saved']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $Module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $Module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $Module
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Module::find($id)->delete();
        return response()->json(['success'=>'Record deleted!']);
    }
}
