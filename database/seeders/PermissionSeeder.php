<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-blog-posts']);
        Permission::create(['name' => 'edit-blog-posts']);
        Permission::create(['name' => 'delete-blog-posts']);

        Permission::create(['name' => 'create-tags']);
        Permission::create(['name' => 'edit-tags']);
        Permission::create(['name' => 'delete-tags']);

        $role1 = Role::findByName('admin');
        $role1->givePermissionTo(['create-users','edit-users','delete-users','create-blog-posts',
              'edit-blog-posts','delete-blog-posts','create-tags','edit-tags','delete-tags']);

        $role2 = Role::findByName('user');
        $role2->givePermissionTo(['create-blog-posts','edit-blog-posts',
                                  'create-tags','edit-tags','delete-tags']);

    }
}
