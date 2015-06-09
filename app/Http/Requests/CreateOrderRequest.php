<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrderRequest extends Request {

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
	 * @return array
	 */
	public function rules()
	{
		return [
                    'customer_name' => 'required|min:5',
                    'tip' => 'required|Numeric|between:0,999.99',
                            'table_id' => 'required|Integer|between:1,10'
                ];
	}

}
