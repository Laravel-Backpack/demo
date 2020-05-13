<?php

namespace App\Http\Controllers\Admin\Charts\Lines;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Frappe\Chart;

class FrappeLineChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        $this->chart->dataset('Red', 'line', [1, 2, 8, 3])
                    ->color('rgba(205, 32, 31, 1)');
        $this->chart->dataset('Blue', 'line', [4, 3, 5, 1])
                    ->color('rgba(70, 127, 208, 1)');
        $this->chart->dataset('Yellow', 'line', [8, 1, 4, 3])
                    ->color('rgb(255, 193, 7)');
        $this->chart->dataset('Green', 'line', [1, 4, 7, 11])
                    ->color('rgb(66, 186, 150)');
        $this->chart->dataset('Purple', 'line', [2, 10, 5, 3])
                    ->color('rgb(96, 92, 168)');

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels(['One', 'Two', 'Three', 'Four']);
    }
}
