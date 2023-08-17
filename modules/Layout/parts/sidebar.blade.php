<?php
$menu_active = $menu_active ?? '';
$menus = \Modules\User\ModuleProvider::getUserFrontendMenu();
if (!empty($menus)){
    foreach ($menus as $k => $menuItem) {
        if ((!empty($menuItem['permission']) and !\Auth::user()->hasPermission($menuItem['permission'])) or !$menuItem['enable'] ) {
            unset($menus[$k]);
            continue;
        }
        $menus[$k]['class'] = $menu_active == $k ? 'active' : '';
    }
}

?>
<div class="user-sidebar">
    <div class="sidebar-inner">
        <ul class="navigation">
            @foreach($menus as $key => $val)
                <li class="{{ $val['class'] }}">
                    <a href="{{ home_url().'/'.$val['url'] }}">
                        <i class="{{ $val['icon'] }}"></i> {{ $val['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
