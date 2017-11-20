<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Repositories\{PermissionRepository, RoleRepository, UsersRepository};

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    private $roleRepository;        /** @var RoleRepository         $roleRepository         */
    private $permissionRepository;  /** @var PermissionRepository   $permissionRepository   */
    private $usersRepository;       /** @var UsersRepository        $usersRepository        */

    /**
     * UsersTableSeeder constructor.
     *
     * @param  RoleRepository        $roleRepository        Abstraction layer bewteen seeder and database.
     * @param  PermissionRepository  $permissionRepository  Abstraction layer between seeder and database. 
     * @param  UsersRepository       $usersRepository       Abstraction layer between seeder and database.
     * @return void
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository, UsersRepository $usersRepository) 
    {
        $this->roleRepository       = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->usersRepository      = $usersRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: Implementation transaltions for the command outputs.

        // Ask for database migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migrations before seeding, it will clear all old data!')) {
            // Call the php artisan migrate:refresh command.
            $this->command->call('migrate:refresh');
            $this->command->warn('Data cleared, started from blank database.');
        }

        // Confirm roles needed.
        if ($this->command->confirm('Create roles for users, default is Admin, Verantwoordelijke, Vrijwilliger, User.', true)) {
            // Ask the roles from input.
            $inputRoles = $this->command->ask('Enter roles in comma seperate format.', 'admin, verantwoordelijke, vrijwilliger, user');
            $rolesArray = explode(',', $inputRoles);

            foreach ($rolesArray as $role) { // Add roles
                $role = $this->roleRepository->entity()->firstOrCreate(['name' => trim($role)]);

                if ($role->name == 'admin') { // Assign all permissions
                    $role->syncPermissions($this->permissionRepository->all());
                    $this->command->info('Admin granted all permissions');
                } else { // For others by default only read access
                    $role->syncPermissions($this->permissionRepository->entity()->where('name', 'LIKE', 'view_%')->get());
                }

                $this->createUser($role); // Create the user in the database.
            }
        }
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if ($role->name == 'admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
