<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductModel;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Product_Title'=>$this->faker->text(20),
            'Product_Description'=>$this->faker->text(20),
            'Product_Price'=>$this->faker->text(20),
            'Product_Image_Path'=>$this->faker->text(20),
            'Product_Category'=>$this->faker->text(20),
            'Product_Status'=>$this->faker->text(20),
            'created_time'=>$this->faker->dateTime(),
            'modified_time'=>$this->faker->dateTime(),

        ];
    }
}
