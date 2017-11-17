<?php

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UsersRepository;
use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    private $roleRepository;        /** @var RoleRepository  */
    private $permissionRepository;  /** @var PermissionRepository */
    private $usersRepository;       /** @var UsersRepository */

    /**
     * UsersTableSeeder constructor.
     *
     * @param  RoleRepository        $roleRepository
     * @param  PermissionRepository  $permissionRepository
     * @param  UsersRepository       $usersRepository
     * @return void
     */
    public function __construct(
        RoleRepository $roleRepository, PermissionRepository $permissionRepository, UsersRepository $usersRepository
    ) {
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
        // Ask for database migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migrations before seeding, it will clear all old data!')) {
            // Call the php artisan migrate:refresh command.
            $this->command->call('migrate:refresh');
            $this->command->warn('Data cleared, started from blank database.');
        }

        // Confirm roles needed.
        if ($this->command->confirm('Create roles for users, default is Admin and Verantwoordelijke. [y/N]', true)) {
            // Ask the roles from input.
            $inputRoles = $this->command->ask('Enter roles in comma seperate format.', 'admin, verantwoordelijke, user');
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
        if( $role->name == 'admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
        }
    }
}
