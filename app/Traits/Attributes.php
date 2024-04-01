<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Attribute;

trait Attributes
{

    /**
     * @param Request $request
     */
    private function addAttributes(string $productId, array $attributes)
    {
        if (is_array($attributes)) {
            foreach ($attributes as $name) {
                $attribute = new Attribute;
                $attribute->attribute_name = $name;
                $attribute->product_id = $productId;
                $attribute->save();
            }
        }
    }

    private function deleteAttributes(string $productId)
    {
        Attribute::where('product_id', $productId)->delete();
    }
}