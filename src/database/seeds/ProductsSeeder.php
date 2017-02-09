<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\ProductType;
use App\Topping;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toppings = $this->create_toppings(['ketchup', 'mayonaise', 'frietsaus'], 30);
        print_r($toppings);

        $fries = $this->create_product_type('Frieten');

        // Fries
        // ==============================================
        $small = new Product([
            'name' => 'Kleine friet',
            'price' => '1.70',
        ]);

        $medium = new Product([
            'name' => 'Medium friet',
            'price' => '2.00',
        ]);

        $big = new Product([
            'name' => 'Grote friet',
            'price' => '2.30',
        ]);

        $fries->products()->saveMany([
            $small,
            $medium,
            $big,
        ]);

        $small->toppings()->attach($toppings);
        $medium->toppings()->attach($toppings);
        $big->toppings()->attach($toppings);

        // Extra dressings
        $extra_toppings = $this->create_product_type('Extra toppings');
        $extra_toppings->products()->saveMany([
            new Product([
                'name' => 'Mayonaise',
                'price' => '0.30',
            ]),
            new Product([
                'name' => 'Frietsaus',
                'price' => '0.30',
            ]),
            new Product([
                'name' => 'Ketchup',
                'price' => '0.30',
            ])
        ]);

        // Snacks
        $snacks = $this->create_product_type('Snacks');
        $snacks->products()->saveMany([
            new Product([
                'name' => 'Bitterballen',
                'price' => '1.50',
            ]),
            new Product([
                'name' => 'Party snacks',
                'price' => '1.50',
            ]),
            new Product([
                'name' => 'Lucifer',
                'price' => '1.50',
            ]),
        ]);


    }

    // Assuming all toppings has the same price
    public function create_toppings(array $names, int $price): array
    {
        $ids = [];
        foreach ($names as $name) {
            $topping = new Topping();
            $topping->name = $name;
            $topping->price = $price / 100.0;
            $topping->save();
            $ids[] = $topping->id;
        }

        return $ids;
    }

    public function create_product_type(string $name): ProductType
    {
        $type = new ProductType();
        $type->name = $name;
        $type->save();
        return $type;
    }
}
