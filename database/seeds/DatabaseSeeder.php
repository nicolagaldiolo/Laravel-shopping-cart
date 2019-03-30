<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $me = factory(App\User::class, 1)->create(
            [
                'name' => env('DEMOUSER', 'Demo'),
                'email' => env('DEMOEMAIL', 'demouser@example.com'),
                'password' => bcrypt(env('DEMOPASS', 'password'))
            ]
        );

        // vogliamo 10 utenti
        $others = factory(App\User::class, 9)->create();

        $users = $me->merge($others);

        $users->each(function($user){
            factory(App\Address::class, 3)->create([
                'user_id' => $user->id
            ]);
        });

        factory(App\Category::class, 20)->create()->each(function ($category){
           factory(App\Book::class, 50)->create([
              'category_id' => $category->id
           ]);
        });


    }
}
