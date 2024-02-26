<?php

namespace App\Providers;

use App\Policies\GroupPolicy;
use Modules\User\src\Model\User;
use Modules\Group\src\Model\Group;
use Illuminate\Support\Facades\Gate;
use Modules\Student\src\Model\Student;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Group::class => GroupPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $modulesList = moduleArray();

        if (!empty($modulesList)) {

            foreach ($modulesList as $module) {

                Gate::define($module['name'], function (User $user) use ($module) {

                    $roleJson = $user->group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module['name']);
                        return $check;
                    }
                    return false;
                });

                Gate::define($module['name'] . '.add', function (User $user) use ($module) {

                    $roleJson = $user->group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module['name'], 'add');
                        return $check;
                    }
                    return false;
                });

                Gate::define($module['name'] . '.edit', function (User $user) use ($module) {
                    $roleJson = $user->group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module['name'], 'edit');
                        return $check;
                    }
                    return false;
                });

                Gate::define($module['name'] . '.delete', function (User $user) use ($module) {
                    $roleJson = $user->group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module['name'], 'delete');
                        return $check;
                    }
                    return false;
                });

                // Gate::define($module['name'].'.permission', function(User $user) use ($module){
                //     $roleJson = $user->group->permissions;
                //     if(!empty($roleJson)){
                //         $roleArr = json_decode($roleJson,true);
                //         $check = isRole($roleArr,$module['name'],'permission');
                //         return $check;
                //     }
                //     return false;
                // });
            }
        }

        Gate::define('groups.permission', function (User $user) {
            $roleJson = $user->group->permissions;
            if (!empty($roleJson)) {
                $roleArr = json_decode($roleJson, true);
                $check = isRole($roleArr, 'groups', 'permission');
                return $check;
            }
            return false;
        });

        ResetPassword::createUrlUsing(function (Student $student, string $token) {
            return route('students.password_reset', ['token' => $token]) . '?email=' . $student->email;
        });
    }
}
