<?php

namespace VadiksMoniks\PhoneBook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use VadiksMoniks\PhoneBook\Rules\PhoneValidationRule;

class PhoneBookRequestValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->isMethod('post')){
            return [
                'last_name' => ['required', 'string'],
                'first_name' => ['required', 'string'],
                'phone_number' => ['required', 'unique:phone_numbers,phone_number', new PhoneValidationRule()],
                'additional_numbers' => ['nullable', 'array'],
                'additional_numbers.*' => ['string', new PhoneValidationRule()],
            ];
        }

        if($this->isMethod('put')){
            return [
                'last_name' => ['required', 'string'],
                'first_name' => ['required', 'string'],
                'phone_number' => ['required', new PhoneValidationRule()],
                'additional_numbers' => ['nullable', 'array'],
                'additional_numbers.*' => ['string', new PhoneValidationRule()],
            ];
        }
    }
}
