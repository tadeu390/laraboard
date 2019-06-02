<?php  $item['class'] = 'treeview'; ?>
<?php  $item['href'] = "#"; ?>

@if (is_string($item))
        <li class="header">{{ $item }}</li>
    @else
        <li  @if(count($item['subMenus']) > 0 || count($item['modules']) > 0)
                @if(in_array($item->name, $module_path))
                    class="{{$item['class']}} menu-open"
                @else
                    class="{{$item['class']}}"
                @endif
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

            <ul class="treeview-menu"
                @if(in_array($item->name, $module_path))
                    style="display: block;"
                @endif
            >
                @foreach ($item->modules as $module)
                    @canPermission('READ', $module->nick_name)
                        <?php
                            $url = "";
                            $class = "class=active";
                            if ($module->url != $url_browser) {
                                $class = '';
                            }
                        ?>
                        <li {{$class}}>
                            <a href="{{url("{$module->url}")}}" onclick="createCookieModule('<?php  echo $module->url; ?>');">
                                <i class="fa fa-fw fa-{{(empty($module->icon)) ? 'circle-o' : $module->icon }}"></i>
                                <span>{{$module->name}}</span>
                            </a>
                        </li>
                    @endcanPermission
                @endforeach
                @if (count($item['subMenus']) > 0 || count($item['modules']) > 0)
                    @each('adminlte::partials.menu-item', $item['subMenus'], 'item')
                @endif
            </ul>
        </li>
    @endif

    <script type="text/javascript">
        function createCookieModule(url)
        {
            document.cookie = "current_module=John Doe; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
            document.cookie = "current_module="+url+";path=/";
        }
    </script>