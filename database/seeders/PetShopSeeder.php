<?php

namespace Database\Seeders;

use App\Models\PetShop\Badge;
use App\Models\PetShop\Comment;
use App\Models\PetShop\Owner;
use App\Models\PetShop\Pet;
use App\Models\PetShop\Skill;
use Carbon\CarbonImmutable;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PetShopSeeder extends Seeder
{
    private $ownerRoles = ['Owner', 'Caretaker', 'Traineer'];

    private $petSpeciesAndBreeds = [
        'Dog'  => ['Yorkshire', 'Bulldog', 'Bull Terrier'],
        'Cat'  => ['Sphynx', 'Persa', 'Ragdoll'],
        'Bird' => ['Pidgeon', 'Parrot'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app()->make(Generator::class);

        $this->call(PetSeeder::class);
        $this->call(OwnerSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(MillionCommentsSeeder::class);

        $pets = Pet::all();
        $owners = Owner::all();
        $skills = Skill::all();
        $badges = Badge::all();

        // deal with pet stuff
        foreach ($pets as $pet) {
            // add one owner for the pet owners list
            $owner = $owners->random();
            $pet->owners()->sync([$owner->id => ['role' => Arr::random($this->ownerRoles)]]);

            // add 1-3 skills for each pet
            $petSkills = $skills->random(rand(1, 3))->pluck('id')->toArray();
            $pet->skills()->sync($petSkills);

            // add the pet passport
            $petSpecie = array_rand($this->petSpeciesAndBreeds, 1);
            $petBreed = Arr::random($this->petSpeciesAndBreeds[$petSpecie]);
            $birthDate = CarbonImmutable::parse($faker->dateTimeThisDecade());
            $passportDate = $birthDate->addDays(rand(11, 25));
            $passportExpiryDate = $passportDate->addYears(5);

            $pet->passport()->create([
                'number'        => $faker->ean13(),
                'issuance_date' => $passportDate->toDateString(),
                'expiry_date'   => $passportExpiryDate->toDateString(),
                'first_name'    => $faker->firstName,
                'middle_name'   => $faker->word,
                'last_name'     => $faker->lastName,
                'birth_date'    => $birthDate->toDateString(),
                'species'       => $petSpecie,
                'breed'         => $petBreed,
                'colour'        => $faker->colorName(),
                'notes'         => $faker->text,
                'country'       => $faker->country,
            ]);

            // add the avatar
            $avatar = rand(1, 3);
            $pet->avatar()->create([
                'url' => 'uploads/animal'.$avatar.'.jpg',
            ]);

            // add comments
            $comments = rand(1, 5);
            while ($comments) {
                Comment::create([
                    'body'             => $faker->text,
                    'commentable_type' => get_class($pet),
                    'commentable_id'   => $pet->id,
                    'user_id'          => 1,
                ]);
                $comments--;
            }

            // add badges
            $petBadges = [];
            $badgesToAdd = array_map(function ($badge) use ($faker) {
                return [$badge => ['note' => $faker->sentence]];
            }, $badges->random(3)->pluck('id')->toArray());
            foreach ($badgesToAdd as $badge) {
                $petBadges[array_key_first($badge)] = $badge[array_key_first($badge)];
            }
            $pet->badges()->sync($petBadges);
        }
    }
}
