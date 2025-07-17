<?php

namespace App\Filament\Widgets;

use App\Models\Enrollment;
use Filament\Widgets\ChartWidget;

class EnrollmentsChart extends ChartWidget
{
    protected static ?string $heading = 'تطور التسجيلات مع الوقت';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 2;

    protected function getFilters(): ?array
    {
        return [
            'this_year' => 'السنة الحالية',
            'last_year' => 'السنة الماضية',
            'last_6_months' => 'آخر 6 أشهر',
            'last_12_months' => 'آخر 12 شهر',
        ];
    }

    protected function getData(): array
    {
        $range = match ($this->filter) {
            'last_year' => [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()],
            'last_6_months' => [now()->subMonths(6), now()],
            'last_12_months' => [now()->subMonths(12), now()],
            default => [now()->startOfYear(), now()],
        };

        $data = Enrollment::whereBetween('created_at', $range)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as total")
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('total', 'ym');

        $labels = [];
        $values = [];

        foreach ($data as $ym => $count) {
            [$year, $month] = explode('-', $ym);
            $labels[] = $this->arabicMonth((int) $month) . ' ' . $year;
            $values[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'عدد التسجيلات',
                    'data' => $values,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => '#BFDBFE',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function arabicMonth(int $month): string
    {
        return [
            1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل',
            5 => 'مايو', 6 => 'يونيو', 7 => 'يوليو', 8 => 'أغسطس',
            9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
        ][$month] ?? '';
    }
}
