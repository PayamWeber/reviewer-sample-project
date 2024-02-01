<?php

namespace App\Http\Requests\BackOffice;

use App\Models\Enums\ProductReviewableType;
use App\Models\Provider;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'active' => ['required', 'bool'],
            'price' => ['required', 'numeric'],
            'reviewable_type' => ['required', Rule::enum(ProductReviewableType::class)],
            'provider_id' => ['required', Rule::exists('providers', 'id')],
        ];
    }
}
