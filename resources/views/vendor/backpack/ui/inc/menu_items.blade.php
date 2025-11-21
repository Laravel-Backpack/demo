{{-- This file is used for menu items by any Backpack v6 theme --}}

<x-backpack::menu-item title="Dashboard" icon="la la-dashboard" :link="backpack_url('dashboard')" data-pan="menu-item-dashboard" />
<x-backpack::menu-item title="New in v7" icon="la la-exclamation-circle" :link="backpack_url('new-in-v7')"  data-pan="menu-item-new-in-v7" />

@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

{{-- Addons --}}
<x-backpack::menu-dropdown title="Add-ons" icon="la la-puzzle-piece" data-pan="menu-item-addons">
    <x-backpack::menu-dropdown title="News" icon="la la-newspaper-o" nested="true" data-pan="menu-item-news">
        <x-backpack::menu-dropdown-item title="Articles" icon="la la-newspaper-o" :link="backpack_url('article')" data-pan="menu-item-articles" />
        <x-backpack::menu-dropdown-item title="Categories" icon="la la-list" :link="backpack_url('category')" data-pan="menu-item-categories" />
        <x-backpack::menu-dropdown-item title="Tags" icon="la la-tag" :link="backpack_url('tag')" data-pan="menu-item-tags" />
    </x-backpack::menu-dropdown>

    <x-backpack::menu-dropdown title="Authentication" icon="la la-user" nested="true" data-pan="menu-item-auth">
        <x-backpack::menu-dropdown-item title="Users" icon="la la-user" :link="backpack_url('user')" data-pan="menu-item-users" />
        <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url('role')" data-pan="menu-item-roles" />
        <x-backpack::menu-dropdown-item title="Permissions" icon="la la-key" :link="backpack_url('permission')" data-pan="menu-item-permissions" />
    </x-backpack::menu-dropdown>

    <x-backpack::menu-dropdown-item title="File Manager" icon="la la-files-o" :link="backpack_url('elfinder')" data-pan="menu-item-filemanager" />
    <x-backpack::menu-dropdown-item title="Activity Logs" icon="la la-stream" :link="backpack_url('activity-log')" data-pan="menu-item-activity-log" />
    <x-backpack::menu-dropdown-item title="Translation Manager" icon="la la-language" :link="backpack_url('translation-manager')" data-pan="menu-item-translation-manager" />
    <x-backpack::menu-dropdown-item title="Meetings (Calendar Operation)" icon="la la-calendar" :link="backpack_url('meeting')" data-pan="menu-item-calendar-operation" />
    <x-backpack::menu-dropdown-item title="Backups" icon="la la-hdd-o" :link="backpack_url('backup')" data-pan="menu-item-backup-manager" />
    <x-backpack::menu-dropdown-item title="Logs" icon="la la-terminal" :link="backpack_url('log')" data-pan="menu-item-log-manager" />
    <x-backpack::menu-dropdown-item title="Settings" icon="la la-cog" :link="backpack_url('setting')" data-pan="menu-item-settings" />
    <x-backpack::menu-dropdown-item title="Pages" icon="la la-file-o" :link="backpack_url('page')" data-pan="menu-item-page-manager" />
    <x-backpack::menu-dropdown-item title="Menu" icon="la la-list" :link="backpack_url('menu-item')" data-pan="menu-item-menu-manager" />
    <x-backpack::menu-dropdown-item title="Analytics" icon="la la-chart-bar" :link="backpack_url(config('backpack.pan.panel_route_prefix'))" data-pan="menu-item-analytics" />
</x-backpack::menu-dropdown>

<x-backpack::menu-separator title="Example CRUDs" />

{{-- Pets --}}
<x-backpack::menu-dropdown title="Pet Shop" icon="la la-store-alt" data-pan="menu-item-petshop">
    <x-backpack::menu-dropdown-item title="Invoices" icon="la la-file-text" :link="backpack_url('pet-shop/invoice')" data-pan="menu-item-invoices" />
    <x-backpack::menu-dropdown-item title="Owners" icon="la la-user" :link="backpack_url('pet-shop/owner')" data-pan="menu-item-owners" />
    <x-backpack::menu-dropdown-item title="Pets" icon="la la-dog" :link="backpack_url('pet-shop/pet')" data-pan="menu-item-pets" />
    <x-backpack::menu-dropdown-item title="Badges" icon="la la-certificate" :link="backpack_url('pet-shop/badge')" data-pan="menu-item-badges" />
    <x-backpack::menu-dropdown-item title="Skills" icon="la la-ribbon" :link="backpack_url('pet-shop/skill')" data-pan="menu-item-dogs" />
    <x-backpack::menu-dropdown-item title="Comments" icon="la la-comment" :link="backpack_url('pet-shop/comment')" data-pan="menu-item-comments" />

    <x-backpack::menu-dropdown-header title="Info" />
    <x-backpack::menu-dropdown-item title="About" icon="la la-question" :link="backpack_url('pet-shop/about')" data-pan="menu-item-about" />
</x-backpack::menu-dropdown>

{{-- Monsters --}}
<x-backpack::menu-dropdown title="Crazy Stuff" icon="la la-skull-crossbones">
    <x-backpack::menu-dropdown-item title="Monsters" icon="la la-optin-monster" :link="backpack_url('monster')" data-pan="menu-item-mosters"  />
    <x-backpack::menu-dropdown-item title="Caves" icon="la la-dungeon" :link="backpack_url('cave')" data-pan="menu-item-caves"  />
    <x-backpack::menu-dropdown-item title="Stories" icon="la la-book" :link="backpack_url('story')" data-pan="menu-item-stories" />
    <x-backpack::menu-dropdown-item title="Icons" icon="la la-info-circle" :link="backpack_url('icon')" data-pan="menu-item-icons" />
    <x-backpack::menu-dropdown-item title="Products" icon="la la-shopping-cart" :link="backpack_url('product')" data-pan="menu-item-products" />
    <x-backpack::menu-dropdown-item title="Fluent Monsters" icon="la la-pastafarianism"
        :link="backpack_url('fluent-monster')" data-pan="menu-item-fluent-monsters" />
    <x-backpack::menu-dropdown-item title="Field Monsters" icon="la la-list-alt"
        :link="backpack_url('field-monster')" data-pan="menu-item-field-monsters" />
    <x-backpack::menu-dropdown-item title="Editable Monsters" icon="la la-spell-check"
        :link="backpack_url('editable-monster')" data-pan="menu-item-editable-monsters" />
    <x-backpack::menu-dropdown-item title="Dummies" icon="la la-poo" :link="backpack_url('dummy')" data-pan="menu-item-dummies" />
</x-backpack::menu-dropdown>
