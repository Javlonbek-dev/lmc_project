<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Course;
use App\Models\User;
use App\Policies\CoursePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('delete-course', function (User $user, Course $course) {
            return $user->id === $course->instructor_id;
        });
        Gate::define('store-course', function (User $user, Course $course) {
            return $user->id === $course->instructor_id;
        });
    }
}
