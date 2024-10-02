<?php

namespace VadiksMoniks\PhoneBook\Http\Controllers;

use VadiksMoniks\PhoneBook\Models\Person;
use VadiksMoniks\PhoneBook\Models\PhoneNumber;
use Exception;
use Illuminate\Support\Facades\DB;
use VadiksMoniks\PhoneBook\Http\Controllers\Controller;
use VadiksMoniks\PhoneBook\Http\Resources\PhoneBookResourceCollection;
use VadiksMoniks\PhoneBook\Http\Requests\PhoneBookRequestValidator;
use VadiksMoniks\PhoneBook\Http\Resources\ResponseResource;
use VadiksMoniks\PhoneBook\Services\PhoneBookService;

class RecordController extends Controller
{
    public $phoneBookService;

    public function __construct(PhoneBookService $service)
    {
        $this->phoneBookService = $service;
    }

    public function index()
    {
        $records =  Person::join('phone_numbers', 'people.id', '=', 'phone_numbers.person_id')
                            ->select('phone_numbers.id', 'people.last_name', 'people.first_name', 'phone_number')
                            ->paginate(6, request('page'));
        return new PhoneBookResourceCollection($records);
    }

    public function store(PhoneBookRequestValidator $request)
    {
        return $this->phoneBookService->store($request);
    }

    public function update(PhoneBookRequestValidator $request)
    {
        return $this->phoneBookService->update($request);
    }

    public function delete($id)
    {
        return $this->phoneBookService->delete($id);
    }

    public function searchByPattern($pattern)
    {
        return $this->phoneBookService->searchByPattern($pattern);
    }
}

