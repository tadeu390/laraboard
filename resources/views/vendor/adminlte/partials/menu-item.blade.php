<?php  $item['class'] = 'treeview'; ?>
<?php  $item['href'] = "#"; ?>

@if (is_string($item))
        <li class="header">{{ $item }}</li>
    @else
        <li  @if(count($item['subMenus']) > 0 || count($item['modules']) > 0)
                class="{{$item['class']}}"
            @endif
        >
            <a href="{{ $item['href'] }}"
            @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
            >
                <i class="fa fa-fw fa-{{ !empty($item['icon']) ? $item['icon'] : 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                <span>{{ $item['name'] }}</span>
                @if (isset($item['label']))
                    <span class="pull-right-container">
                        <span class="label label-{{ isset($item['label_color']) ? $item['label_color'] : 'primary' }} pull-right">{{ $item['label'] }}</span>
                    </span>
                @elseif (count($item['subMenus']) > 0  || count($item['modules']) > 0)
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                @endif
            </a>

            <ul class="treeview-menu">
                @if (count($item['modules']) > 0)
                    @foreach ($item->modules as $module)

                        <?php //http://laraboard.tadeu/{$item['url']}
                            $url = "";
                            $class = "class=active";
                            for ($i = 1; Request::segment($i) != null; $i++) {
                                $url .= Request::segment($i);

                                if (is_numeric(Request::segment(($i + 1)))) {
                                    break;
                                }
                                if (Request::segment(($i + 1)) != null) {
                                    $url .= '/';
                                }
                            }

                            if ($module->url != $url)
                                $class = '';
                        ?>

                        <li {{$class}}>
                            <a href="{{url("{$module->url}")}}">
                                <i class="fa fa-fw fa-{{(empty($module->icon)) ? 'circle-o' : $module->icon }}"></i>
                                <span>{{$module->name}}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
                @if (count($item['subMenus']) > 0 || count($item['modules']) > 0)
                    @each('adminlte::partials.menu-item', $item['subMenus'], 'item')
                @endif
            </ul>
        </li>
    @endif