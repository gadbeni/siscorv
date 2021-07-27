<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
            @section('breadcrumbs')
            <ol class="breadcrumb hidden-xs">
                @php
                $segments = array_filter(explode('/', str_replace(route('voyager.dashboard'), '', Request::url())));
                $url = route('voyager.dashboard');
                @endphp
                @if(count($segments) == 0)
                    <li class="active"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</li>
                @else
                    <li class="active">
                        <a href="{{ route('voyager.dashboard')}}"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</a>
                    </li>
                    @foreach ($segments as $segment)
                        @php
                        $url .= '/'.$segment;
                        @endphp
                        @if ($loop->last)
                            <li>{{ ucfirst(urldecode($segment)) }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}">{{ ucfirst(urldecode($segment)) }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ol>
            @show
        </div>
        <ul class="nav navbar-nav @if (__('voyager::generic.is_rtl') == 'true') navbar-left @else navbar-right @endif">
            <li id="badge-notification">
                @php
                    $funcionario = \App\Models\Persona::where('user_id', Auth::user()->id)->first();
                    $ingresos = [];
                    if ($funcionario) {
                        $funcionario_id = $funcionario->funcionario_id;
                        $ingresos = \App\Models\Entrada::with(['entity', 'derivaciones'])
                                    ->whereHas('derivaciones', function($q) use($funcionario_id){
                                        $q->where('funcionario_id_para', $funcionario_id)->where('deleted_at', NULL);
                                    })
                                    ->where('deleted_at', NULL)->get();
                    }
                    $cont = 0;
                    foreach ($ingresos as $item) {
                        $derivacion = $item->derivaciones[count($item->derivaciones)-1];
                        if ($funcionario_id == $derivacion->funcionario_id_para && $item->estado_id != 6 && !$derivacion->visto){
                            $cont++;
                        }
                    }
                @endphp
                @if ($cont)
                    <a href="{{ route('bandeja.index') }}"> <span class="voyager-bell text-danger" style="font-size: 25px"></span> <span class="badge" style="margin-left: -10px">{{ $cont }}</span> </a>                    
                @endif
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ $user_avatar }}" width="40px" class="profile-img"> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <div class="row">
                            <div class="col-md-4" style="padding: 0px">
                                <img src="{{ $user_avatar }}" width="60px" class="profile-img">
                            </div>
                            <div class="col-md-8" style="margin: 0px">
                                <h5>{{ Auth::user()->name }}</h5>
                                    <h6>{{ Auth::user()->email }}</h6>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    @if(is_array($nav_items) && !empty($nav_items))
                    @foreach($nav_items as $name => $item)
                    <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!}>
                        @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                        <form action="{{ route('voyager.logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-block">
                                @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                <i class="{!! $item['icon_class'] !!}"></i>
                                @endif
                                {{__($name)}}
                            </button>
                        </form>
                        @else
                        <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}" {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}>
                            @if(isset($item['icon_class']) && !empty($item['icon_class']))
                            <i class="{!! $item['icon_class'] !!}"></i>
                            @endif
                            {{__($name)}}
                        </a>
                        @endif
                    </li>
                    @endforeach
                    @endif
                </ul>
            </li>
          </ul>
    </div>
</nav>
