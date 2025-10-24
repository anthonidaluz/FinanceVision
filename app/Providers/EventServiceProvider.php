<?php

namespace App\Providers;

use App\Events\LancamentoCreated;
use App\Listeners\CheckForAchievements;
use Illuminate\Auth\Events\Registered;
use App\Events\MetaCompleted;
use App\Listeners\AwardGoalCompletionAchievement;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\CategoryCreated;
use App\Listeners\CheckCategoryAchievements;
use App\Events\MetaCreated;
use App\Listeners\CheckMetaAchievements;
use App\Events\ReportViewed;
use App\Listeners\CheckReportAchievements;
use App\Events\DicasViewed;
use App\Listeners\CheckDicasAchievements;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        LancamentoCreated::class => [CheckForAchievements::class],

        CategoryCreated::class => [
            CheckCategoryAchievements::class,
        ],
        MetaCreated::class => [
            CheckMetaAchievements::class,
        ],

        ReportViewed::class => [
            CheckReportAchievements::class,
        ],

        DicasViewed::class => [
            CheckDicasAchievements::class,
        ],

        MetaCompleted::class => [
            AwardGoalCompletionAchievement::class,
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}