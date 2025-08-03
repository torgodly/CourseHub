<?php

namespace App\Filament\Trainer\Resources\CourseResource\Pages;

use App\Enum\EnrollmentStatus;
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
                ->requiresConfirmation()
                ->label(__('Withdraw to Personal Account'))
                ->modalHeading(__('Withdraw to Personal Account'))
                ->modalDescription(__('30% will be deducted as a service fee.'))
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
                    $meta = [__(':amount د.ل withdrawn from ":course" to trainer account', [
                        'amount' => number_format($data['amount'], 2),
                        'course' => $this->record->title,
                    ])];
                    $this->record->wallet->transfer($trainer->wallet, $data['amount'], $meta);
                    //deduct service fee and put them in the admin wallet
                    $serviceFee = $data['amount'] * 0.3; // 30% service fee
                    $adminWallet = \App\Models\User::where('is_admin', true)->first()->wallet;
                    $this->record->wallet->transfer($adminWallet, $serviceFee, [
                        __('Service fee of :amount for ":course"', [
                            'amount' => number_format($serviceFee, 2),
                            'course' => $this->record->title,
                        ]),
                    ]);
                    Notification::make()
                        ->success()
                        ->title(__('Withdrawal Successful'))
                        ->body(__('Successfully withdrawn :amount to your personal account.', ['amount' => $data['amount']]))
                        ->send();
                })->disabled(fn() => $this->record->wallet->balance <= 0)
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
                Section::make(__('Enrollments'))->schema([
                    Grid::make(4)->schema([
                        TextEntry::make('enrollments_count')
                            ->state(fn ($record) => $record->enrollments->count())
                            ->translateLabel()
                            ->badge()
                            ->label('Enrollments'),
                        TextEntry::make('enrollments_pending_count')
                            ->translateLabel()
                            ->state(fn ($record) => $record->enrollments->where('status', EnrollmentStatus::Pending->value)->count())
                            ->badge()
                            ->color('warning')
                            ->label('Pending'),
                        //active
                        TextEntry::make('enrollments_active_count')
                            ->translateLabel()
                            ->state(fn ($record) => $record->enrollments->where('status', EnrollmentStatus::Active->value)->count())
                            ->badge()
                            ->color('blue')
                            ->label('Active'),
                        TextEntry::make('enrollments_completed_count')
                            ->translateLabel()
                            ->state(fn ($record) => $record->enrollments->where('status', EnrollmentStatus::Completed->value)->count())
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
