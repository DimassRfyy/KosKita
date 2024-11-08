<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TransactionStats extends BaseWidget
{
    protected function getStats(): array
    {
        $successfulTransactionsCount = Transaction::where('payment_status', 'success')->count();

        $totalSuccessfulAmount = Transaction::where('payment_status', 'success')->sum('total_amount');

        $downPaymentTotalAmount = Transaction::where('payment_status', 'success')->where('payment_method', 'down_payment')->sum('total_amount');
                                         
        $fullPaymentTotalAmount = Transaction::where('payment_status', 'success')->where('payment_method', 'full_payment')->sum('total_amount');
                                         
        return [
            Stat::make('Successful Transactions', $successfulTransactionsCount),
            Stat::make('Total Successful Amount', number_format($totalSuccessfulAmount, 0, ',', '.')),
            Stat::make('Total Full Payment Amount', number_format($fullPaymentTotalAmount, 0, ',', '.')),
            Stat::make('Total Down Payment Amount', number_format($downPaymentTotalAmount, 0, ',', '.')),
        ];
    }
    
}
