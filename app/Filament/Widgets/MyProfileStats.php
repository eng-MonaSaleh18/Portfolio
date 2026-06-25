<?php
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class MyProfileStats extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected function getStats(): array
{
    $user = auth()->user();

    return [
        \Filament\Widgets\StatsOverviewWidget\Stat::make('Name', $user->name)
            ->color('success')
            ->icon('heroicon-m-user'),

        \Filament\Widgets\StatsOverviewWidget\Stat::make('Email', $user->email)
            ->extraAttributes([
                'class' => 'cursor-default',
                'style' => '
                    font-size: 0.75rem; 
                    word-break: break-all; 
                    white-space: normal; 
                    line-height: 1.2;
                    max-width: 100%;
                    display: block;
                ',
            ])
            ->icon('heroicon-m-envelope')
            ->color('primary'),
    ];
}
}
