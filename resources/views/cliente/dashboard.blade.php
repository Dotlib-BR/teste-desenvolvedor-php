@extends('layouts.dashboard')
@section('content')
<div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">

              <h1 class="text-2xl font-semibold">Dashboard</h1>
             
            </div>

            <!-- Content -->
            <div class="mt-2">
              <!-- State cards -->
              <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
            
              </div>

              <!-- Charts -->
              <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                @include('partials.dashboard.widgets.charts.chart-bar')
                @include('partials.dashboard.widgets.charts.doughnut')
                @include('partials.dashboard.widgets.charts.ativos')
                @include('partials.dashboard.widgets.charts.linha')

             

              </div>
            </div>
@endsection