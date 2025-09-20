<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
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
            Section::make(__('Main Info'))->schema([
                Grid::make()->schema([
                    TextEntry::make('trainer.name')->label('Trainer'),
                    TextEntry::make('title')->label('Title'),
                    TextEntry::make('learn_goals')
                        ->badge()
                        ->color('success')
                        ->label('Learning Goals'),
                    TextEntry::make('requirements')
                        ->badge()
                        ->color('warning')
                        ->label('Requirements'),
                    TextEntry::make('description')->label('Description')->columnSpanFull(),

                ])

            ])->columnSpan(2),
            Group::make()->schema([
                Section::make(__('Enrollments'))->schema([
                    Grid::make(3)->schema([
                        TextEntry::make('enrollments_count')
                            ->translateLabel()
                            ->badge()
                            ->label('Enrollments'),
                        TextEntry::make('enrollments_pending_count')
                            ->translateLabel()
                            ->badge()
                            ->color('warning')
                            ->label('Pending'),
                        TextEntry::make('enrollments_completed_count')
                            ->translateLabel()
                            ->badge()
                            ->color('success')
                            ->label('Completed'),
                    ]),

                    TextEntry::make('balance')
                        ->color('success')
                        ->suffix('د.ل')
                        ->translateLabel()
                        ->badge()
                        ->color('success')
                        ->color('primary')
                        ->label('Total Revenue'),
                ]),
                Section::make(__('Course Details'))->schema([
                    Grid::make()->schema([
                        TextEntry::make('level')
                            ->badge()
                            ->label('Level'),
                        TextEntry::make('price')->label('Price'),
                        IconEntry::make('is_approved')
                            ->label('Approved')
                            ->boolean(), // shows badge for boolean true/false
                        TextEntry::make('status')
                            ->badge()
                            ->label('Status'),
                    ])
                ]),
            ])->columnSpan(1),

        ])->columns(3);
    }
}
