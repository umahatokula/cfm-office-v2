<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREATE AND ATTACH PERMISSIONS
        $createrequisition = Permission::create(['name' => 'create requisition']);
        $readrequisition = Permission::create(['name' => 'read requisition']);
        $updaterequisition = Permission::create(['name' => 'update requisition']);
        $deleterequisition = Permission::create(['name' => 'delete requisition']);
        $approverequisition = Permission::create(['name' => 'approve requisition']);
        $disapproverequisition = Permission::create(['name' => 'disapprove requisition']);

        $makeservicedataentry = Permission::create(['name' => 'make service data entry']);
        $makechildrenchurchdataentry = Permission::create(['name' => 'make children church data entry']);
        $managecells = Permission::create(['name' => 'manage cells']);
        $viewallattendance = Permission::create(['name' => 'view all attendance']);
        $viewownattendance = Permission::create(['name' => 'view own attendance']);
        $viewallfinances = Permission::create(['name' => 'view all finances']);
        $viewownfinances = Permission::create(['name' => 'view own finances']);

        $viewallchurches = Permission::create(['name' => 'view all churches']);
        $viewownchurch = Permission::create(['name' => 'view own church']);
        
        $generatereports = Permission::create(['name' => 'generate reports']);



        // CREATE ROLES
        $generaloverseer = Role::create(['name' => 'generaloverseer']);
        $coordinatorchurches = Role::create(['name' => 'coordinatorchurches']);
        $residentpastor = Role::create(['name' => 'residentpastor']);
        $associatepastor = Role::create(['name' => 'associatepastor']);
        $secretary = Role::create(['name' => 'secretary']);
        $treasurer = Role::create(['name' => 'treasurer']);
        $smsuser = Role::create(['name' => 'smsuser']);
        $member = Role::create(['name' => 'member']);


        // ASSIGN PERMISSIONS TO ROLES
        $generaloverseer->givePermissionTo([$readrequisition, $updaterequisition, $deleterequisition, $approverequisition, $disapproverequisition, $makeservicedataentry, $makechildrenchurchdataentry, $managecells, $viewallattendance, $viewownattendance, $viewallfinances, $viewownfinances, $viewallchurches, $viewownchurch, $generatereports]);
        
        $coordinatorchurches->givePermissionTo([$readrequisition, $updaterequisition, $deleterequisition, $approverequisition, $disapproverequisition, $makeservicedataentry, $makechildrenchurchdataentry, $managecells, $viewallattendance, $viewownattendance, $viewallfinances, $viewownfinances, $viewallchurches, $viewownchurch, $generatereports]);

        $residentpastor->givePermissionTo([$readrequisition, $updaterequisition, $deleterequisition, $approverequisition, $disapproverequisition, $makeservicedataentry, $makechildrenchurchdataentry, $managecells, $viewownattendance, $viewownfinances, $viewownchurch]);

        $associatepastor->givePermissionTo([$readrequisition, $updaterequisition, $approverequisition, $disapproverequisition, $makeservicedataentry, $makechildrenchurchdataentry, $managecells, $viewownattendance, $viewownfinances, $viewownchurch]);

        $secretary->givePermissionTo([$readrequisition, $updaterequisition, $makeservicedataentry, $makechildrenchurchdataentry, $viewownattendance, $viewownfinances, $viewownchurch, $viewallchurches, $generatereports]);

        $treasurer->givePermissionTo([$readrequisition, $viewownfinances, $viewownchurch]);


    }
}
