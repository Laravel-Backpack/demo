<?php

namespace Database\Seeders;

use App\Models\PetShop\Invoice;
use App\Models\PetShop\InvoiceItem;
use App\Models\PetShop\Owner;
use Carbon\CarbonImmutable;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app()->make(Generator::class);

        Owner::factory()->count(5)->create();

        $owners = Owner::all();

        foreach ($owners as $owner) {
            // owner avatars
            $avatar = rand(1, 2);
            $owner->avatar()->create([
                'url' => 'uploads/person'.$avatar.'.jpg',
            ]);

            // owner invoices
            $invoices = rand(1, 3);
            while ($invoices) {
                $inssuanceDate = CarbonImmutable::parse($faker->dateTimeThisDecade());
                $dueDate = $inssuanceDate->addMonths(1);
                $invoice = Invoice::create([
                    'owner_id'      => $owner->id,
                    'series'        => Arr::random(['SRV', 'PRD']),
                    'number'        => $faker->numerify('####'),
                    'issuance_date' => $inssuanceDate->toDateString(),
                    'due_date'      => $dueDate->addDays(15)->toDateString(),

                ]);
                // invoice items
                $invoiceItems = rand(2, 5);
                while ($invoiceItems) {
                    InvoiceItem::create([
                        'invoice_id'  => $invoice->id,
                        'order'       => $faker->bothify('?????-#####'),
                        'description' => $faker->text,
                        'quantity'    => $faker->randomFloat(0, 0, 999),
                        'unit_price'  => $faker->randomFloat(0, 0, 9999),
                    ]);
                    $invoiceItems--;
                }
                $invoices--;
            }
        }
    }
}
