<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Exchange;
use App\User;


class ExchangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exchange.index');
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
        $codeexchange = $this->RandomString(4).time().$this->RandomString(2);

        if ($request['address_wallet'] == '' || 
            $request['phone'] == '' ||
            $request['bank'] == '' || 
            $request['coin'] == '' ||
            $request['type'] == '' ||
            $request['account_number']  == '' ||
            $request['invite'] == '' ||
            $request['mediator'] == ''){
            return redirect(url("exchange?err"))->with("flash","Please fill all field!");}

        $user_a = $request['type'] == "BUY" ? Auth::user()->id:$request['invite'];
        $user_b = $request['type'] == "SELL" ? Auth::user()->id:$request['invite'];
        $mediator = DB::select("select coin.* from users, coin where users.id = coin.user_id and coin.coin = '".$request['coin']."' and users.id = ".$request['mediator']." ");
        $us = DB::select("select coin.* from users, coin where users.id = coin.user_id and coin.coin = '".$request['coin']."' and users.id = ".$request['mediator']." ");
        // var_dump(isset($mediator) && $mediator != null ? $mediator[0]->address_wallet:'');
        // die();

        $data = [
            'codeexchange' => $codeexchange,
            'userid_a' => $user_a,
            $request['type'] == "BUY" ? 'address_wallet_a':'address_wallet_b' => $request['address_wallet'],
            $request['type'] == "BUY" ? 'phone_a':'phone_b' => $request['phone'],
            $request['type'] == "BUY" ? 'bank_a':'bank_b' => $request['bank'],
            'type' => $request['type'],
            $request['type'] == "BUY" ? 'account_number_a':'account_number_b' => $request['account_number'],
            'coin' => $request['coin'],
            'userid_b' => $user_b,
            'intermediate_id' => $request['mediator'],
            'address_wallet_mediator' => (isset($mediator) && $mediator!= null ) ? $mediator[0]->address_wallet:'',
            'phone_mediator' => (isset($mediator) && $mediator!= null) ? $mediator[0]->phone:'',
            'bank_mediator' => (isset($mediator) && $mediator!= null ) ? $mediator[0]->bank:'',
            'account_number_mediator' => (isset($mediator) && $mediator!= null ) ? $mediator[0]->account_number:'',
        ];

        DB::table('exchange')->insert($data);
        return redirect(url("exchange/".$codeexchange))->with("flash","Create success!!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['exchange'] = DB::table('exchange')->where('codeexchange','=',$id)->first();
        $ath = Auth::user()->id;

        if ($ath != $data['exchange']->userid_a &&
            $ath != $data['exchange']->userid_b && 
            $ath != $data['exchange']->intermediate_id
        ){
            return redirect(url("home"))->with("flash","You are not in this transaction! Create your deal!");
    }

    $data['user_a'] = DB::table('users')->where('id','=',$data['exchange']->userid_a)->first();
    $data['user_b'] = DB::table('users')->where('id','=',$data['exchange']->userid_b)->first();
    $data['mediator'] = DB::table('users')->where('id','=',$data['exchange']->intermediate_id)->first();
    $data['step'] = $data['exchange']->step;

    if ( $data['exchange'] != null)
    {
        return view('exchange.show',$data);
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // $exchange = DB::table('exchange')->where('codeexchange','=',$id)->first();
        $exchange = Exchange::where('codeexchange', $id)->first();


        if ($request->has("action")){

            if ($request["action"] == "auto_a"){
                $auto_a = DB::select("select coin.* from users, coin where users.id = coin.user_id and coin.coin = '".$exchange->coin."' and users.id = ".$exchange->userid_a." ");
                if (isset($auto_a) && $auto_a != null){
                    $exchange->address_wallet_a = $auto_a[0]->address_wallet;
                    $exchange->phone_a = $auto_a[0]->phone;
                    $exchange->bank_a = $auto_a[0]->bank;
                    $exchange->account_number_a = $auto_a[0]->account_number;
                    $exchange->save();
                }
                
                // DB::table('exchange')->update($exchange);
                
                if ($this->ExchangeNull($exchange) == true){
                    $exchange->step = 1;
                    $exchange->save();
                    // DB::table('exchange')->update($exchange);
                }

            }

            if ($request["action"] == "auto_b"){
                $auto_b = DB::select("select coin.* from users, coin where users.id = coin.user_id and coin.coin = '".$exchange->coin."' and users.id = ".$exchange->userid_b." ");
                if (isset($auto_b) && $auto_b!= null){
                    $exchange->address_wallet_b = $auto_b[0]->address_wallet;
                    $exchange->phone_b = $auto_b[0]->phone;
                    $exchange->bank_b = $auto_b[0]->bank;
                    $exchange->account_number_b = $auto_b[0]->account_number;
                    $exchange->save();
                }
                
                // DB::table('exchange')->update($exchange);
                
                if ($this->ExchangeNull($exchange) == true){
                    $exchange->step = 1;
                    $exchange->save();
                    // DB::table('exchange')->update($exchange);
                }

            }

            if ($request["action"] == "b"){
                $exchange->address_wallet_b = $request["address_wallet"];
                $exchange->phone_b = $request["phone"];
                $exchange->bank_b = $request["bank"];
                $exchange->account_number_b = $request["account_number"];
                // DB::table('exchange')->update($exchange);
                $exchange->save();
                if ($this->ExchangeNull($exchange) == true){
                    $exchange->step = 1;
                    $exchange->save();
                    // DB::table('exchange')->update($exchange);
                }

            }
            if ($request["action"] == "mediator"){
                $exchange->address_wallet_mediator = $request["address_wallet"];
                $exchange->phone_mediator = $request["phone"];
                $exchange->bank_mediator = $request["bank"];
                $exchange->account_number_mediator = $request["account_number"];
                // DB::table('exchange')->update($exchange);
                $meditor = User::findorFail($exchange->intermediate_id);

                if ($meditor != null){
                    $data = [
                        'user_id' => $meditor->id,
                        'address_wallet' => $exchange->address_wallet_mediator,
                        'phone' => $exchange->phone_mediator,
                        'bank' => $exchange->bank_mediator,
                        'account_number' => $exchange->account_number_mediator,
                        'coin' => $exchange->coin,
                    ];
                    DB::table('coin')->insert($data);
                }
                
                $exchange->save();
                if ($this->ExchangeNull($exchange) == true){
                    $exchange->step = 1;
                    $exchange->save();
                    // DB::table('exchange')->update($exchange);
                }
            }

            return redirect(url("exchange/".$exchange->codeexchange))->with("flash","Update success!!!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function confirm(Request $request)
    {
        $id = $request["codeexchange"];
        $exchange = Exchange::where('codeexchange', $id)->first();

        if ($request->has("action")){
            if ($request["action"] == "mediator" && $exchange->step == 1){
                $exchange->step = 2;
                $exchange->save();
            }
            if ($request["action"] == "b" && $exchange->step == 2){
                $exchange->step = 3;
                $exchange->save();
            }
            if ($request["action"] == "mediator" && $exchange->step == 3){
                $exchange->step = 4;
                $exchange->save();
            }
            if ($request["action"] == "a" && $exchange->step == 4){
                $exchange->step = 5;
                $exchange->save();
            }
        }
        return redirect(url("exchange/".$exchange->codeexchange));
    }

    private function RandomString($stt)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $stt; $i++) {
            $randstring = $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }

    private function ExchangeNull($exchange)
    {
        if ( 
            $exchange->address_wallet_a == '' ||
            $exchange->phone_a == '' ||
            $exchange->bank_a == '' ||
            $exchange->account_number_a == '' ||
            $exchange->address_wallet_b == '' ||
            $exchange->phone_b == '' ||
            $exchange->bank_b == '' ||
            $exchange->account_number_b == '' ||
            $exchange->address_wallet_mediator == '' ||
            $exchange->phone_mediator == '' ||
            $exchange->bank_mediator == '' ||
            $exchange->account_number_mediator == ''
        ){
            return false;
        }
        return true;
    }
}
