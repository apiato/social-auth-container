<?php

namespace App\Containers\Vendor\SocialAuth\UI\API\Requests;

use Apiato\Core\Abstracts\Requests\Request;

class ApiAuthenticateRequest extends Request
{
	/**
	 * Define which Roles and/or Permissions has access to this request.
	 */
	protected array $access = [
		'permissions' => '',
		'roles' => '',
	];

	/**
	 * Id's that needs decoding before applying the validation rules.
	 */
	protected array $decode = [

	];

	/**
	 * Defining the URL parameters (`/stores/999/items`) allows applying
	 * validation rules on them and allows accessing them like request data.
	 */
	protected array $urlParameters = [
		'provider'
	];

	/**
	 * Get the validation rules that apply to the request.
	 */
	public function rules(): array
	{
		return [
            'oauth_token' => 'required'
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return $this->check([
			'hasAccess',
		]);
	}
}
