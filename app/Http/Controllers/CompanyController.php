<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{
    /**
     * Retrieve the company for the given ID.
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Company::findOrFail($id);
    }

    /**
    * For debugging purposes
    */
    public function showAll(){
        return Company::all();
    }

    /**
    * Get results and make a model to return to the db as to not overload the
    * remote API
    */
    public function getByName($name){
        // If it exists in db:
        $result = Company::where('name','LIKE',"{$name}%")
            ->orderBy('name')
            ->get();

        if(!$result->isEmpty()){
            return response()->json(['results' => $result]);
        }

        $data = $this->queryAPI($name);

        // Otherwise fetch data from external API and put in DB and return
        foreach ($data as $value) {
            Company::firstOrCreate($value);
        }
        return response()->json(['results' => $data]);
    }

    /**
    * Query the api and return data as array
    */
    public function queryAPI($term){
        $res = Http::get("http://apis.is/company?name=$term");
        return $res->json()['results'];
    }

}
