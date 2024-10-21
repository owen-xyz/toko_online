<?php
namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
/**
* Seed the application's database.
*/
public function run(): void
{
User::create([
'nama' => 'Administrator',
'email' => 'admin@gmail.com',
'role' => '1',
'status' => 1,
'hp' => '0812345678901',
'password' => bcrypt('P@55word'),
]);
#untuk record berikutnya silahkan, beri nilai berbeda pada nilai: nama, email, hp dengan nilai masing-masing anggota kelompok
User::create([
'nama' => 'Sopian Aji',
'email' => 'sopian4ji@gmail.com',
'role' => '0',
'status' => 1,
'hp' => '081234567892',
'password' => bcrypt('P@55word'),
]);
User::create([
'nama' => 'owen',
'email' => 'muhamadowen02@gmail.com',
'role' => '2',
'status' => 1,
'hp' => '081234567893',
'password' => bcrypt('080102'),
]);
}
}