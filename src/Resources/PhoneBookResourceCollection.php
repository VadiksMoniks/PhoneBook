<?php

namespace VadiksMoniks\PhoneBook\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PhoneBookResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($record){
                return [
                    'phone_number' => $record->phone_number,
                    'id' => $record->id,
                    'last_name' => $record->last_name,
                    'first_name' => $record->first_name
                ];
            }),
        ];
    }
}
