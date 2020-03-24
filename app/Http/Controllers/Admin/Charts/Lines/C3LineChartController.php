<?php

namespace App\Http\Controllers\Admin\Charts\Lines;

use App\User;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\C3\Chart;

class C3LineChartController extends ChartController
{
	public function setup()
	{
		$this->chart = new Chart;

		$this->chart->dataset('Red', 'line', [1, 2, 8, 3])
					->options(['
						color' => 'rgba(205, 32, 31, 1)',
					]);
		$this->chart->dataset('Blue', 'line', [4, 3, 5, 1])
					->options(['
						color' => 'rgba(70, 127, 208, 1)',
					]);
		$this->chart->dataset('Yellow', 'line', [8, 1, 4, 3])
					->options([
						'color' => 'rgb(255, 193, 7)',
					]);
		$this->chart->dataset('Green', 'line', [1, 4, 7, 11])
					->options([
						'color' => 'rgb(77, 189, 116)',
					]);
		$this->chart->dataset('Purple', 'line', [2, 10, 5, 3])
					->options([
						'color' => 'rgb(96, 92, 168)',
					]);

		// MANDATORY. Set the labels for the dataset points
		$this->chart->labels(['One', 'Two', 'Three', 'Four']);
    }
}
