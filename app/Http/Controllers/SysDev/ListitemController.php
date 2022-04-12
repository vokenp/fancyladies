<?php

namespace App\Http\Controllers\SysDev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListItem;
use DataTables;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ListitemController extends Controller
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
        $this->menuLinkName = "listitem";

        $this->middleware('auth');
        $this->page_title = 'Listitems';
        $this->page_description = 'This is Page is Used to Manage Listitems';
        $this->btnAddNew = 'sysdev.'.$this->menuLinkName.'.create';
        $this->btnDelAction = 'sysdev.'.$this->menuLinkName.'.store';
        $this->tblContentLink = 'sysdev.'.$this->menuLinkName.'.index';
        $this->storelink = 'sysdev.'.$this->menuLinkName.'.store';
        $this->editlink = 'sysdev.'.$this->menuLinkName.'.edit';
        $this->listlink = 'sysdev.'.$this->menuLinkName.'.list';
        $this->viewlink = 'sysdev.'.$this->menuLinkName.'.show';
    }

    public function index()
    {
        $itemType = DB::table('listitems')->select('item_type')->distinct()->get();
        $data = [
            'itemTypes'       => $itemType,
            'page_title'       => $this->page_title,
            'page_description' => $this->page_description,
            'btncreate'    => $this->btnAddNew,
            'delAction'    => $this->btnDelAction,
            'storeAction'    => $this->storelink,
            'editAction'    => $this->editlink,
            'tblContent'    =>  $this->tblContentLink,
            'listLink'    =>  $this->listlink,
            'content'    => 'pages.SysDev.listview_view',
            
        ];

        $columns = [];
        $columns[] = array('data' => 'DT_RowIndex', 'name' => 'DT_RowIndex','title' => '#' ,'searchable' =>false,'orderable' =>false);
        
        $columns[] = array('data' => 'item_code', 'name' => 'item_code', 'title' =>'Item Code');
        $columns[] = array('data' => 'item_description', 'name' => 'item_description', 'title' =>'Item Description');
        $columns[] = array('data' => 'action', 'name' => 'action','title' => 'Actions' ,'searchable' =>false,'orderable' =>false);
        
        $data['cols'] = json_encode($columns);

        return view('pages.listview',$data);
    }


    public function list(Request $request)
    {
        if ($request->ajax()) {
            $itemType = $request->get('item_type');
            $q_user = Listitem::select('*')->where([['id','!=', 0],['item_type','=',$itemType]])->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                    
                        $btn = "";
                        $btn .= '<div class="dropdown dropdown-inline mr-4">';
                        $btn .= '<button type="button" class="btn btn-info btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        $btn .= '<i class="flaticon2-gear text-white"></i></button>';
                        $btn .= '<div class="dropdown-menu">';

                
                        $btn .= '<a class="dropdown-item editRecord" href="#"  data-id="'.$row->id.'">';
                        $btn .= '<span class="navi-icon"><i class="flaticon2-pen text-success"> </i><span class="navi-text"> Edit Item</span></a>';

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
        $rst = ListItem::where('id', $request->row_id)->first();
        if($rst !== null)
        {
            $request->request->add(['updated_by', Auth::id()]);
            $exec = $rst->update(array_merge($request->all(), ['updated_by' => Auth::id()]));
        }
        else{
            $request->request->add(['created_by', Auth::id()]);
            ListItem::create(array_merge($request->all(), ['created_by' => Auth::id()]));
        }
        //listitem::updateOrCreate(['id' => $request->row_id,'created_by' => Auth::id()],$request->all());

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
        $rst = ListItem::findOrfail($id);
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
        ListItem::find($id)->delete();
        return response()->json(['success'=>'Record deleted!']);
    }
}
