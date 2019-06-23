<?php

namespace App\Http\Requests;

use http\Env\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class SliderRequest extends FormRequest
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

    protected function prepareForValidation()
    {
          $this->merge([
            'appearance' => json_decode($this->appearance,true),
            'settings' => json_decode($this->settings,true),
            'countdown' => json_decode($this->countdown,true),
            'button' => json_decode($this->button,true),
            'opt_in_appearance' => json_decode($this->opt_in_appearance,true),
            'opt_in_settings' => json_decode($this->opt_in_settings,true),
            'pro_features' => json_decode($this->pro_features,true),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'slider_name' => 'required',
            'appearance.heading_color' => [
                'required',
                'regex:/(#[a-zA-Z0-9]{6})/'
            ],
            'appearance.subheading_color' => [
                'required',
                'regex:/(#[a-zA-Z0-9]{6})/'
            ],
            'appearance.bg_color_start' => [
                'required',
                'regex:/(#[a-zA-Z0-9]{6})/'
            ],
            'appearance.bg_color_end' => [
                'required',
                'regex:/(#[a-zA-Z0-9]{6})/'
            ],
            'appearance.bg_gradient'=>'required',
            'appearance.bg_gradient_angle'=>'numeric|required|min:0|max:180',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errorBag = [];
        $errors = json_decode($validator->errors());
        foreach($errors as $key=>$error){
            $errorBag[]=['field'=>$key,
                        'msg'=>$error[0]];
        }
        $response = new JsonResponse([
                'message' => 'The given data is invalid',
                'errors' => json_encode($errorBag)
            ], 422);

        throw new ValidationException($validator, $response);
    }


//    protected function failedValidation(Validator $validator)
//    {
//        $errors = $validator->errors();
//        $response = new ResponseObject();
//
//        $response->code = ResponseObject::BAD_REQUEST;
//        $response->status = ResponseObject::FAILED;
//        foreach ($errors as $item) {
//            array_push($response->messages, $item);
//        }
//
//        throw new HttpResponseException(response()->json($response));
//    }
}
