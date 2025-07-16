<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewCourse extends ViewRecord
{
    protected static string $resource = CourseResource::class;


    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Main Info')->schema([
               Grid::make()->schema([
                   TextEntry::make('trainer.name')->label('Trainer'),
                   TextEntry::make('title')->label('Title'),
                   TextEntry::make('description')->label('Description')->columnSpanFull(),
                   TextEntry::make('learn_goals')
                       ->badge()
                       ->color('success')
                       ->label('Learning Goals'),
                   TextEntry::make('requirements')
                       ->badge()
                       ->color('warning')
                       ->label('Requirements'),
               ])

            ])->columnSpan(2),
            Section::make('Course Details')->schema([
                Grid::make()->schema([
                    TextEntry::make('level')->label('Level'),
                    TextEntry::make('price')->label('Price'),
                    IconEntry::make('is_approved')
                        ->label('Approved')
                        ->boolean(), // shows badge for boolean true/false
                    TextEntry::make('status')->label('Status'),
                ])
            ])->columnSpan(1),
        ])->columns(3);
    }
}
