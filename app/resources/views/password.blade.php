<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style type="text/css">
            .tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
            .tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
            .tftable tr {background-color:#d4e3e5;}
            .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
            .tftable tr:hover {background-color:#ffffff;}
        </style>
        
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ route('/') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{__('page.home')}}</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{__('page.log')}}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{__('page.log')}}</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        @auth
            <section>
                <h1>{{__('page.password.mdp_page')}}</h1>
                <table class="tftable border=1">
                    @foreach($info_pass as $user)
                        <tr><th>{{__('page.password.url')}}: {{ $user->site }}</th><th>{{__('page.password.login')}} : {{ $user->login }}</th><th>{{__('page.password.password')}} : <a href="{{route('id',$user->id)}}">{{ $user->password }}</a></th></tr>
                    @endforeach
                </table>
            </section>
            <section>
                <h1>{{__('page.password.team_page')}}</h1>
                <table class="tftable border=1">
                    @foreach($info_teams as $team)
                        <tr><th>{{__('page.password.team_name')}}{{ $team->name }}</th></tr>
                    @endforeach
                </table>
            </section>
            <section>
                <form action="{{route('joinTeamController')}}" method="POST">
                    <h1>{{__('page.password.add_member')}}</h1><br>
                    @csrf
                        <label for="fname">{{__('page.password.new_member')}}</label><br>
                        <input type="text" id="member" name="member" class="@error('member') is-invalid @enderror"><br>
                        <label for="fname">{{__('page.password.team_join')}}</label><br>
                        <input type="text" id="team" name="team" class="@error('team') is-invalid @enderror"><br>
                        <input type="submit" value="{{__('pagination.submit')}}">
                        @if ($errors->any())
    
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    </form>
            </section>
        @endauth
    </body>
</html>
