@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => 'Welcome back admin',
        'content'     => '',
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];

    $widgets['after_content'][] = [
        'type'       => 'chart',
        'controller' => \App\Http\Controllers\Admin\Charts\WeeklyUsersChartController::class,
        'class'   => 'card mb-2',
        'wrapper' => ['class'=> 'col-md-6'] ,
        'content' => [
            'header' => 'New Users',
            'body'   => 'This chart should make it obvious how many new users have signed up in the past 7 days.<br><br>',
        ]
    ];
@endphp

@section('content')
    
@endsection