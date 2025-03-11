<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
public function run()
{
\App\Models\Contact::factory(35)->create();
}
}