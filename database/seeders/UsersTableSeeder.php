<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = Department::create([
            'name' => 'Administration',
        ]);
        $employee = Employee::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'salary' => 5000.00,
            'image' => null,
            'department_id' => $department->id,
            'manager_id' => null,
        ]);
        User::create([
            'email' => 'admin@arib.com',
            'password' => Hash::make('12345678'),
            'phone' => '01012345678',
            'employee_id' => $employee->id,
        ]);
    }
}
