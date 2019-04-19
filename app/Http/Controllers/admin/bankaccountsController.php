<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankAccount;
use App\role;



 use Illuminate\Support\Facades\Storage ;
use File;
use DB ;
class bankaccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //

        $bankList = BankAccount::select('id','bankName','accountOwner','accountNumber','swift','image')
            ->orderby('id','desc')->get();
        return $bankList ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      /* show data of banks */
      public function view(){
          $banks=DB::table('bank_account')->get();
          return view('admin.statistics.view_Bank',compact('banks'));


      }
      

    //delete
    public function remove($id){
        DB::table('bank_account')->where('id',$id)->delete();
        return back();
       

    }
     public function edit($id){
         $values=DB::table('bank_account')->where('id',$id)->get();

        return view('admin.statistics.Edit_banks',compact('values'));
     }
     /////////////////update////////////////////
     public function update(Request $request, $id)
    {
      
     $x=BankAccount::where('id',$id)->first();
     $file = $request->file('image');
    //  $file = Storage::putFile('public/storage');
     $filename='public/bank/'.$file->getClientOriginalName();
     
     Storage::disk('local')->put($filename , File::get($file));
     $link=Storage::url($filename);
     
  
      //$img->move(base_path('public/storage'),$img->getClientOriginalName());
    
    $x->bankName=$request->name;
    $x->accountOwner=$request->account;
    $x->accountNumber=$request->caccount;
    $x->swift=$request->swift;
    $x->image=$link;
    
     $x->save();
     return back();
  

   

    
     

    }
    public function viewbank()
    {
        $x=DB::table('bank_account')->get();
        return view('admin.statistics.bankaccount',compact('x'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function Addbank(){
         return view('admin.statistics.add_bamk');
     }

    public function Add(Request $request)
    {
        
        $x=new BankAccount();
       $r=$request->file('image');
       
       $filename='public/bank/'.$r->getClientOriginalName();
       Storage::disk('local')->put($filename, File::get($r));
       $link=Storage::url($filename);
       $x->bankName=$request->name;
       $x->accountOwner=$request->account;
       $x->accountNumber=$request->caccount;
       $x->swift=$request->swift;
       $x->image=$link;
       
        $x->save();
        return back();
     

  }
}
