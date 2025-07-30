<?php

namespace App\Filament\Trainer\Resources\CourseResource\Pages;

use App\Filament\Trainer\Resources\CourseResource;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewCourse extends ViewRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('withdraw')
                ->label(__('Withdraw to Personal Account'))
                ->icon('tabler-businessplan')
                ->form([
                    TextInput::make('amount')
                        ->label(__('Withdrawal Amount'))
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->suffix('د.ل')
                        ->default(fn() => $this->record->wallet->balance)
                        ->rule(function () {
                            return function (string $attribute, $value, $fail) {
                                if ($value > $this->record->wallet->balance) {
                                    $fail(__('You do not have enough funds.'));
                                }
                            };
                        }),

                ])
                ->action(function ($data) {
                    $trainer = $this->record->trainer; // should be a model, not an ID
                    $this->record->wallet->transfer($trainer->wallet, $data['amount']);
                    Notification::make()
                        ->success()
                        ->title(__('Withdrawal Successful'))
                        ->body(__('Successfully withdrawn :amount to your personal account.', ['amount' => $data['amount']]))
                        ->send();
                })
                ->requiresConfirmation()
        ];
    }

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
                Section::make('Enrollments')->schema([
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
                        ->suffix('د.ل')
                        ->translateLabel()
                        ->badge()
                        ->color('success')
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
