<?php

namespace Database\Seeders;

use App\Models\Monster;
use App\Models\PetShop\Invoice;
use App\Models\PetShop\InvoiceItem;
use App\Models\PetShop\Owner;
use App\Models\Product;
use Backpack\NewsCRUD\app\Models\Category;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

/**
 * Seeds realistic time-distributed data for Invoices, Monsters, and Products
 * so that the Report Operation pages look impressive with trends, comparisons,
 * and meaningful date-range / interval testing.
 *
 * Run with: php artisan db:seed --class=ReportDemoSeeder
 */
class ReportDemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->command?->info('Seeding report demo data...');

        $this->seedInvoices();
        $this->seedMonsters();
        $this->seedProducts();

        $this->command?->info('Report demo data seeded successfully!');
    }

    // ─── INVOICES ────────────────────────────────────────────────────────

    private function seedInvoices(): void
    {
        $this->command?->info('  → Invoices & Invoice Items...');

        // Ensure we have owners to attach invoices to
        $ownerIds = Owner::pluck('id')->toArray();
        if (count($ownerIds) < 10) {
            Owner::factory()->count(10 - count($ownerIds))->create();
            $ownerIds = Owner::pluck('id')->toArray();
        }

        $faker = fake();
        $series = ['SRV', 'PRD', 'WEB', 'CON'];
        $itemDescriptions = [
            'Consultation fee', 'Vaccination', 'Grooming service', 'Pet food (premium)',
            'Medication', 'Surgery', 'X-Ray', 'Blood test', 'Dental cleaning',
            'Boarding (per night)', 'Training session', 'Microchip implant',
            'Nail trimming', 'Flea treatment', 'Pet insurance premium',
        ];

        $period = CarbonPeriod::create(
            Carbon::now()->subMonths(24)->startOfMonth(),
            '1 day',
            Carbon::now()
        );

        $invoiceNumber = Invoice::max('number') ?? 1000;
        $invoices = [];
        $items = [];
        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($period as $day) {
            // More invoices on weekdays, seasonal bump in spring/summer
            $month = (int) $day->format('m');
            $dayOfWeek = (int) $day->format('N'); // 1=Mon, 7=Sun

            $baseRate = 3;
            // Seasonal: more activity in spring (Mar-May) and winter holidays (Nov-Dec)
            if (in_array($month, [3, 4, 5])) {
                $baseRate = 5;
            } elseif (in_array($month, [11, 12])) {
                $baseRate = 6;
            } elseif (in_array($month, [7, 8])) {
                $baseRate = 4;
            }

            // Weekends are quieter
            if ($dayOfWeek >= 6) {
                $baseRate = max(1, intdiv($baseRate, 2));
            }

            // Add growth trend: more recent = slightly more invoices
            $monthsAgo = Carbon::now()->diffInMonths($day);
            $growthMultiplier = 1 + (24 - $monthsAgo) * 0.015; // ~1.0 to ~1.36
            $count = max(0, (int) round($baseRate * $growthMultiplier + rand(-1, 2)));

            for ($i = 0; $i < $count; $i++) {
                $invoiceNumber++;
                $issuanceDate = $day->copy()->addHours(rand(8, 18))->addMinutes(rand(0, 59));
                $dueDate = $issuanceDate->copy()->addDays(rand(7, 30));
                $createdAt = $issuanceDate->format('Y-m-d H:i:s');

                $invoiceId = null;
                $invoices[] = [
                    'owner_id'      => Arr::random($ownerIds),
                    'series'        => Arr::random($series),
                    'number'        => $invoiceNumber,
                    'issuance_date' => $issuanceDate->format('Y-m-d'),
                    'due_date'      => $dueDate->format('Y-m-d'),
                    'created_at'    => $createdAt,
                    'updated_at'    => $createdAt,
                ];
            }
        }

        // Bulk insert invoices in chunks
        foreach (array_chunk($invoices, 500) as $chunk) {
            Invoice::insert($chunk);
        }

        // Now create items for the newly created invoices
        $newInvoices = Invoice::where('number', '>', 1000)
            ->select('id', 'issuance_date')
            ->get();

        foreach ($newInvoices as $invoice) {
            $itemCount = rand(1, 5);
            for ($j = 1; $j <= $itemCount; $j++) {
                $quantity = rand(1, 4);
                $unitPrice = Arr::random([15, 25, 35, 50, 75, 100, 150, 200, 299, 499]);
                $items[] = [
                    'invoice_id'  => $invoice->id,
                    'order'       => $j,
                    'description' => Arr::random($itemDescriptions),
                    'quantity'    => $quantity,
                    'unit_price'  => $unitPrice,
                    'created_at'  => $invoice->issuance_date . ' 12:00:00',
                    'updated_at'  => $invoice->issuance_date . ' 12:00:00',
                ];
            }
        }

        foreach (array_chunk($items, 500) as $chunk) {
            InvoiceItem::insert($chunk);
        }

        $this->command?->info('    ✓ ' . count($invoices) . ' invoices with ' . count($items) . ' items');
    }

    // ─── MONSTERS ────────────────────────────────────────────────────────

    private function seedMonsters(): void
    {
        $this->command?->info('  → Monsters...');

        $faker = fake();
        $statuses = ['working', 'not-working', 'dont-know'];
        $statusWeights = [60, 25, 15]; // working is most common

        $period = CarbonPeriod::create(
            Carbon::now()->subMonths(24)->startOfMonth(),
            '1 day',
            Carbon::now()
        );

        $monsters = [];

        foreach ($period as $day) {
            $month = (int) $day->format('m');
            $dayOfWeek = (int) $day->format('N');

            // Base: 1-2 monsters per day, with some variation
            $baseRate = 2;

            // Seasonal spikes
            if (in_array($month, [1, 2])) {
                $baseRate = 3; // New year burst
            } elseif (in_array($month, [6, 7])) {
                $baseRate = 1; // Summer dip
            } elseif ($month === 10) {
                $baseRate = 4; // Halloween spike!
            }

            // Growth trend
            $monthsAgo = Carbon::now()->diffInMonths($day);
            $growthMultiplier = 1 + (24 - $monthsAgo) * 0.02;
            $count = max(0, (int) round($baseRate * $growthMultiplier + rand(-1, 1)));

            for ($i = 0; $i < $count; $i++) {
                $createdAt = $day->copy()->addHours(rand(0, 23))->addMinutes(rand(0, 59))->addSeconds(rand(0, 59));

                // Weighted random status
                $roll = rand(1, 100);
                if ($roll <= $statusWeights[0]) {
                    $status = $statuses[0];
                } elseif ($roll <= $statusWeights[0] + $statusWeights[1]) {
                    $status = $statuses[1];
                } else {
                    $status = $statuses[2];
                }

                $number = rand(1, 10000);
                $ts = $createdAt->format('Y-m-d H:i:s');

                $monsters[] = [
                    'text'       => $faker->unique()->sentence(rand(3, 6)),
                    'textarea'   => $faker->text(200),
                    'email'      => $faker->email(),
                    'number'     => $number,
                    'float'      => round($faker->randomFloat(2, 0, 1000), 2),
                    'status'     => $status,
                    'checkbox'   => rand(0, 1),
                    'date'       => $createdAt->format('Y-m-d'),
                    'datetime'   => $ts,
                    'start_date' => $createdAt->format('Y-m-d'),
                    'end_date'   => $createdAt->copy()->addDays(rand(1, 90))->format('Y-m-d'),
                    'select'     => null,
                    'icon_id'    => null,
                    'belongs_to_non_nullable' => 0,
                    'created_at' => $ts,
                    'updated_at' => $ts,
                ];
            }
        }

        foreach (array_chunk($monsters, 500) as $chunk) {
            Monster::insert($chunk);
        }

        $this->command?->info('    ✓ ' . count($monsters) . ' monsters');
    }

    // ─── PRODUCTS ────────────────────────────────────────────────────────

    private function seedProducts(): void
    {
        $this->command?->info('  → Products...');

        $faker = fake();
        $statuses = ['in-stock', 'out-of-stock', 'on-hold'];
        $conditions = ['NEW', 'USED', 'BROKEN'];

        $categoryIds = Category::pluck('id')->toArray();
        if (empty($categoryIds)) {
            Category::factory()->count(10)->create();
            $categoryIds = Category::pluck('id')->toArray();
        }

        $productNames = [
            'Widget', 'Gadget', 'Gizmo', 'Thingamajig', 'Doohickey',
            'Contraption', 'Apparatus', 'Device', 'Mechanism', 'Instrument',
            'Module', 'Component', 'Unit', 'Assembly', 'Kit',
            'Tool', 'Accessory', 'Attachment', 'Adapter', 'Connector',
        ];

        $adjectives = [
            'Premium', 'Deluxe', 'Ultra', 'Pro', 'Basic', 'Advanced',
            'Compact', 'Heavy-Duty', 'Lightweight', 'Portable', 'Smart',
            'Digital', 'Analog', 'Wireless', 'Turbo', 'Eco', 'Mini', 'Mega',
        ];

        $period = CarbonPeriod::create(
            Carbon::now()->subMonths(24)->startOfMonth(),
            '1 day',
            Carbon::now()
        );

        $products = [];

        foreach ($period as $day) {
            $month = (int) $day->format('m');

            // Products added more frequently over time (catalog growth)
            $baseRate = 1;

            // Q4 and Q1 see more product launches
            if (in_array($month, [1, 10, 11, 12])) {
                $baseRate = 2;
            }

            $monthsAgo = Carbon::now()->diffInMonths($day);
            $growthMultiplier = 1 + (24 - $monthsAgo) * 0.025;
            $count = max(0, (int) round($baseRate * $growthMultiplier + rand(-1, 1)));

            for ($i = 0; $i < $count; $i++) {
                $createdAt = $day->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59));
                $ts = $createdAt->format('Y-m-d H:i:s');

                // Price distribution: mostly mid-range, some cheap, some expensive
                $priceRoll = rand(1, 100);
                if ($priceRoll <= 20) {
                    $price = rand(5, 50);       // budget
                } elseif ($priceRoll <= 70) {
                    $price = rand(50, 300);      // mid-range
                } elseif ($priceRoll <= 90) {
                    $price = rand(300, 800);     // premium
                } else {
                    $price = rand(800, 2500);    // luxury
                }

                // Status weighted: 60% in-stock, 25% out-of-stock, 15% on-hold
                $statusRoll = rand(1, 100);
                if ($statusRoll <= 60) {
                    $status = 'in-stock';
                } elseif ($statusRoll <= 85) {
                    $status = 'out-of-stock';
                } else {
                    $status = 'on-hold';
                }

                // Condition weighted: 70% new, 20% used, 10% broken
                $conditionRoll = rand(1, 100);
                if ($conditionRoll <= 70) {
                    $condition = 'NEW';
                } elseif ($conditionRoll <= 90) {
                    $condition = 'USED';
                } else {
                    $condition = 'BROKEN';
                }

                $name = Arr::random($adjectives) . ' ' . Arr::random($productNames) . ' #' . rand(10000, 99999) . '-' . rand(100, 999);

                $products[] = [
                    'name'        => json_encode(['en' => $name]),
                    'description' => json_encode(['en' => $faker->sentence(10)]),
                    'details'     => json_encode(['en' => $faker->paragraph(3)]),
                    'price'       => $price,
                    'category_id' => Arr::random($categoryIds),
                    'status'      => $status,
                    'condition'   => $condition,
                    'created_at'  => $ts,
                    'updated_at'  => $ts,
                ];
            }
        }

        foreach (array_chunk($products, 500) as $chunk) {
            Product::insert($chunk);
        }

        $this->command?->info('    ✓ ' . count($products) . ' products');
    }
}
