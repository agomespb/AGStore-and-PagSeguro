<?php

namespace AGStore\Http\Requests;

use AGStore\Http\Requests\Request;

class ProductRequest extends Request {

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
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
		];
	}

}
