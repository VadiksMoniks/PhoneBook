<?php

namespace PhoneBook\Http\Controllers;

use VadiksMoniks\PhoneBook\Models\Person;
use VadiksMoniks\PhoneBook\Models\PhoneNumber;
use VadiksMoniks\PhoneBook\Rules\PhoneValidationRule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    public $personalData;
    public $phoneNumberData;

    public function __construct()
    {
        $this->personalData = new Person();
        $this->phoneNumberData = new PhoneNumber();
    }

    public function index()
    {
        return response()->json([
            'records' => Person::join('phone_numbers', 'people.id', '=', 'phone_numbers.person_id')
                                ->select('phone_numbers.id', 'people.last_name', 'people.first_name', 'phone_number')
                                ->paginate(6, request('page')),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'phone_number' => ['required', 'unique:phone_numbers,phone_number', new PhoneValidationRule()],
            'additional_numbers' => ['nullable', 'array'],
            'additional_numbers.*' => ['string', new PhoneValidationRule()],
        ]);

        DB::transaction( function() use ($request){
            $data = Person::firstOrCreate([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name
            ]);
            PhoneNumber::create([
                'phone_number' => $request->phone_number,
                'person_id' => $data->id
            ]);
            if($request->additional_numbers != null){
                foreach($request->additional_numbers as $number){
                    PhoneNumber::create([
                        'phone_number' => $number,
                        'person_id' => $data->id
                    ]);
                }
            }
        });

        return response()->json([
            'message' => 'contacts were addet to list',
            'status' => 200
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'phone_number' => ['required', new PhoneValidationRule()],
            'additional_numbers' => ['nullable', 'array'],
            'additional_numbers.*' => ['string', new PhoneValidationRule()],
        ]);
        $result = [];
        $personAndNumber = Person::join('phone_numbers', 'people.id', '=', 'phone_numbers.person_id')->where('last_name', $request->last_name)->where('first_name', $request->first_name)->where('phone_numbers.phone_number', $request->phone_number)->exists();
        $personData = Person::where("last_name", $request->last_name)->where('first_name', $request->first_name)->first();
        $phoneNumber = PhoneNumber::where('phone_number', $request->phone_number)->first();

        if($personAndNumber != null){//EVERYTHING EXISTS
            $result = [
                'message' => 'This contact is already exists',
                'status' => 200
            ];
        }
        else{
            if($personData == null && $phoneNumber != null){//PERSON DOESN'T EXISTS PHONE EXISTS

                DB::transaction(function() use($request) {
                    $data = Person::create([
                        'last_name' => $request->last_name,
                        'first_name' => $request->first_name
                    ]);
                    PhoneNumber::where('phone_number', $request->phone_number)->update([
                        'person_id' => $data->id
                    ]);
                });

                $result = [
                    'message' => 'Contact updated',
                    'status' => 200
                ];

            }
            elseif($personData != null && $phoneNumber == null){//PERSON EXISTS PHONE DOESN;T
                PhoneNumber::insert([
                    'person_id' => $personData->id,
                    'phone_number' => $request->phone_number
                ]);

                $result = [
                    'message' => 'Contact updated',
                    'status' => 200
                ];
            }
            elseif($personData != null && $phoneNumber != null){//PHONE EXISTS BUT NOT BELONGS TO PERSON
                PhoneNumber::where('phone_number', $request->phone_number)->update([
                    'personal_id' => $personData->id,
                ]);

                $result = [
                    'message' => 'Contact updated',
                    'status' => 200
                ];

            }
            else{//NOTHING EXISTS
                return $this->store($request);
            }
        }

        return response()->json($result);

    }

    public function delete($id)
    {
        try{

            PhoneNumber::where('id', $id)->delete();

            return response()->json([
                'message' => 'Contact was deleted successfuly',
                'status' => 200
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'message' => "Something went wrong ".$e->getMessage(),
                'status' => 500
            ]);
        }
    }

    public function searchByPattern($pattern)
    {

        $result = Person::join('phone_numbers', 'people.id', '=', 'phone_numbers.person_id')
                        ->where('last_name', 'like', "%$pattern%")
                        ->orWhere('first_name', 'like', "%$pattern%")
                        ->orWhere('phone_numbers.phone_number', 'like', "%$pattern%")
                        ->select('people.last_name', 'people.first_name', 'phone_number')
                        ->limit(5)
                        ->get();

        if($result->isEmpty()){
            $result = "No matches from your request";
        }

        return response()->json([
            'results' => $result,
        ]);
    }
}
