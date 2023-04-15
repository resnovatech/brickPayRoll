<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Mail;
use DB;
use PDF;
use App\Models\Namechange;
use App\Models\Ngostatus;
use App\Models\Duration;
use App\Models\Renew;
use Carbon\Carbon;
class RegisterController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }







    public function new_registration_list(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('register_new_list')) {
            abort(403, 'Sorry !! You are Unauthorized to view !');
        }


        $all_data_for_new_list = Ngostatus::where('status','Ongoing')->latest()->get();


      return view('backend.registration_list.new_registration_list',compact('all_data_for_new_list'));
    }


    public function revision_registration_list(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('register_new_list')) {
            abort(403, 'Sorry !! You are Unauthorized to view !');
        }


        $all_data_for_new_list = Ngostatus::where('status','Rejected')->latest()->get();


      return view('backend.registration_list.revision_registration_list',compact('all_data_for_new_list'));
    }


    public function already_registration_list(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('register_new_list')) {
            abort(403, 'Sorry !! You are Unauthorized to view !');
        }


        $all_data_for_new_list = Ngostatus::where('status','Accepted')->latest()->get();


      return view('backend.registration_list.already_registration_list',compact('all_data_for_new_list'));
    }


    public function registration_view($id){





        try {

            $r_status = Ngostatus::where('user_id',$id)->value('status');
            $name_change_status = Namechange::where('user_id',$id)->value('status');
            $renew_status = Renew::where('user_id',$id)->value('status');


            $all_data_for_new_list_all = Ngostatus::where('user_id',$id)->first();
            $form_one_data = DB::table('fboneforms')->where('user_id',$all_data_for_new_list_all->user_id)->first();
            $form_eight_data = DB::table('ngo_committee_members')->where('user_id',$all_data_for_new_list_all->user_id)->get();
            $form_member_data = DB::table('ngomembers')->where('user_id',$all_data_for_new_list_all->user_id)->get();


            $form_member_data_doc_renew = DB::table('ngorenewinfos')->where('user_id',$all_data_for_new_list_all->user_id)->get();


 $duration_list_all1 = DB::table('durations')->where('user_id',$all_data_for_new_list_all->user_id)->value('end_date');
            $duration_list_all = DB::table('durations')->where('user_id',$all_data_for_new_list_all->user_id)->value('start_date');

            $form_member_data_doc = DB::table('ngo_member_docs')->where('user_id',$all_data_for_new_list_all->user_id)->get();
            $form_ngo_data_doc = DB::table('ngodocs')->where('user_id',$all_data_for_new_list_all->user_id)->get();

            $users_info = DB::table('users')->where('id',$all_data_for_new_list_all->user_id)->first();

            $all_source_of_fund = DB::table('sourceoffunds')->where('user_id',$all_data_for_new_list_all->user_id)->get();

            $all_partiw = DB::table('fdoneform_staffs')->where('user_id',$all_data_for_new_list_all->user_id)->get();


            $get_all_data_adviser_bank = DB::table('bankaccounts')->where('user_id',$all_data_for_new_list_all->user_id)
            ->first();


            $get_all_data_other= DB::table('acounntotherinfos')->where('user_id',$all_data_for_new_list_all->user_id)
            ->get();

            $get_all_data_adviser = DB::table('fdoneformadvisers')->where('user_id',$all_data_for_new_list_all->user_id)
    ->get();


            //dd($users_info);
        } catch (Exception $e) {



            return $e->getMessage();

        }



        return view('backend.registration_list.registration_view',compact('duration_list_all1','duration_list_all','renew_status','name_change_status','r_status','form_member_data_doc_renew','get_all_data_adviser','get_all_data_other','get_all_data_adviser_bank','all_partiw','all_source_of_fund','users_info','form_ngo_data_doc','form_member_data_doc','form_member_data','form_eight_data','all_data_for_new_list_all','form_one_data'));
    }


    public function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );

        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );

            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');

            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');

            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');

            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );

            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';

                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }

            $words  = implode( ', ' , $words );

            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
            if( $commas )
            {
                $words  = str_replace( ',' , ' and' , $words );
            }

            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }





    public function print_certificate_view(Request $request){

           $user_id = $request->user_id;

           $form_one_data = DB::table('fboneforms')->where('user_id',$user_id)->first();

           $duration_list_all = DB::table('durations')->where('user_id',$user_id)->latest()->first();

           //dd($user_id);

           $newyear = date('y', strtotime($request->main_date));

           $newmonth = date('F', strtotime($request->main_date));


           $newdate = date('d', strtotime($request->main_date));

           $word = $this->numberToWord($newyear);
           $word1 = $this->numberToWord($newdate);
           //dd($word1);

           //dd($newdate);

           $file_Name_Custome = 'certificate';
           $pdf=PDF::loadView('backend.registration_list.print_certificate_view',['newyear'=>$newyear,
'newmonth'=>$newmonth,'newdate'=>$newdate,'word'=>$word,'word1'=>$word1,
'form_one_data'=>$form_one_data,'duration_list_all'=>$duration_list_all],[],['orientation' => 'L'],['format' => [279.4,215.9]]);
return $pdf->stream($file_Name_Custome.''.'.pdf');
    }


    public function update_status_reg_form(Request $request){

        $data_save = Ngostatus::find($request->id);
        $data_save->status = $request->status;
        $data_save->save();

$get_user_id = Ngostatus::where('id',$request->id)->value('user_id');





//DB::table('fboneforms')->where('user_id',$get_user_id)->first();

DB::table('fboneforms')->where('user_id',$get_user_id)
->update([
    'reg_no_get_from_admin' => $request->reg_no_get_from_admin
]);




        if($request->status == 'Accepted'){

            $date = date('Y-m-d');
    $newDate = date('Y-m-d', strtotime($date. ' + 10 years'));



        $data_save = new Duration();
        $data_save->user_id = $get_user_id;
        $data_save->status = $request->status;
        $data_save->end_date = $newDate;
        $data_save->start_date =date('Y-m-d');
        $data_save->save();
        }



        Mail::send('emails.passwordResetEmail', ['id' => $request->status], function($message) use($request){
            $message->to($request->email);
            $message->subject('NGO AB');
        });







        return redirect()->back()->with('success','Updated Successfully');
    }


    public function form_one_pdf($main_id,$id){

        if($id = 'plan'){

            $form_one_data = DB::table('fboneforms')->where('user_id',$main_id)->value('plan_of_operation');

        }elseif($id = 'invoice'){

            $form_one_data = DB::table('fboneforms')->where('user_id',$main_id)->value('attach_the__supporting_papers');

        }elseif($id = 'treasury_bill'){

            $form_one_data = DB::table('fboneforms')->where('user_id',$main_id)->value('board_of_revenue_on_fees');

        }elseif($id = 'final_pdf'){
            $form_one_data = DB::table('fboneforms')->where('user_id',$main_id)->value('s_pdf');
        }

        return view('backend.registration_list.form_one_pdf',compact('form_one_data'));
    }


    public function form_eight_pdf($main_id){

        $form_one_data = DB::table('ngo_committee_members')->where('user_id',$main_id)->value('s_pdf');

        return view('backend.registration_list.form_eight_pdf',compact('form_one_data'));
    }

    public function source_of_fund($id){

        $form_one_data = DB::table('sourceoffunds')->where('id',$id)->value('letter_file');
         return view('backend.registration_list.source_of_fund',compact('form_one_data'));
    }

    public function other_pdf_view($id){

        $form_one_data = DB::table('acounntotherinfos')->where('id',$id)->value('information_type');
         return view('backend.registration_list.other_pdf_view',compact('form_one_data'));
    }


    public function ngo_member_doc__pdf_view($id){

        $form_one_data = DB::table('ngo_member_docs')->where('id',$id)->value('person_nid_copy');
         return view('backend.registration_list.ngo_member_doc__pdf_view',compact('form_one_data'));
    }


    public function ngo_doc__pdf_view($id){

        $form_one_data = DB::table('ngodocs')->where('id',$id)->value('primary_portal');
         return view('backend.registration_list.ngo_doc__pdf_view',compact('form_one_data'));
    }


    public function renew_pdf_list($main_id,$id){

        if($id = 'f'){

            $form_one_data = DB::table('ngorenewinfos')->where('user_id',$main_id)->value('foregin_pdf');

        }elseif($id = 'y'){

            $form_one_data = DB::table('ngorenewinfos')->where('user_id',$main_id)->value('yearly_budget');

        }elseif($id = 'c'){

            $form_one_data = DB::table('ngorenewinfos')->where('user_id',$main_id)->value('copy_of_chalan');

        }elseif($id = 'd'){

            $form_one_data = DB::table('ngorenewinfos')->where('user_id',$main_id)->value('due_vat_pdf');

        }elseif($id = 'ch'){
            $form_one_data = DB::table('ngorenewinfos')->where('user_id',$main_id)->value('change_ac_number');
        }

        return view('backend.registration_list.renew_pdf_list',compact('form_one_data'));
    }
}
