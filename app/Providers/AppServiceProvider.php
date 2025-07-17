<?php

namespace App\Providers;

use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TextInput::configureUsing(function (TextInput $textInput) {
            $textInput->translateLabel();
        });
        TextColumn::configureUsing(function (TextColumn $column) {
            $column->translateLabel();
        });
        IconColumn::configureUsing(function (IconColumn $column) {
            $column->translateLabel();
        });
        IconEntry::configureUsing(function (IconEntry $entry) {
            $entry->translateLabel();
        });

        TextEntry::configureUsing(function (TextEntry $entry) {
            $entry->translateLabel();
        });

        Section::configureUsing(function (Section $section) {
            $section->translateLabel();
        });
    }
}
