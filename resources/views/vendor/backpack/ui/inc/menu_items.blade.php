{{-- This file is used for menu items by any Backpack v6 theme --}}

<x-backpack::menu-item title="Dashboard" icon="la la-dashboard" :link="backpack_url('dashboard')" />

@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

{{-- Addons --}}
<x-backpack::menu-dropdown title="Add-ons" icon="la la-puzzle-piece">
    <x-backpack::menu-dropdown title="News" icon="la la-newspaper-o" nested="true">
        <x-backpack::menu-dropdown-item title="Articles" icon="la la-newspaper-o" :link="backpack_url('article')" />
        <x-backpack::menu-dropdown-item title="Categories" icon="la la-list" :link="backpack_url('category')" />
        <x-backpack::menu-dropdown-item title="Tags" icon="la la-tag" :link="backpack_url('tag')" />
    </x-backpack::menu-dropdown>

    <x-backpack::menu-dropdown title="Authentication" icon="la la-user" nested="true">
        <x-backpack::menu-dropdown-item title="Users" icon="la la-user" :link="backpack_url('user')" />
        <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url('role')" />
        <x-backpack::menu-dropdown-item title="Permissions" icon="la la-key" :link="backpack_url('permission')" />
    </x-backpack::menu-dropdown>

    <x-backpack::menu-dropdown-item title="File Manager" icon="la la-files-o" :link="backpack_url('elfinder')" />
    <x-backpack::menu-dropdown-item title="Activity Logs" icon="la la-stream" :link="backpack_url('activity-log')" />
    <x-backpack::menu-dropdown-item title="Backups" icon="la la-hdd-o" :link="backpack_url('backup')" />
    <x-backpack::menu-dropdown-item title="Logs" icon="la la-terminal" :link="backpack_url('log')" />
    <x-backpack::menu-dropdown-item title="Settings" icon="la la-cog" :link="backpack_url('setting')" />
    <x-backpack::menu-dropdown-item title="Pages" icon="la la-file-o" :link="backpack_url('page')" />
    <x-backpack::menu-dropdown-item title="Menu" icon="la la-list" :link="backpack_url('menu-item')" />
</x-backpack::menu-dropdown>

<x-backpack::menu-separator title="Example CRUDs" />

{{-- Pets --}}
<x-backpack::menu-dropdown title="Pet Shop" icon="la la-store-alt">
    <x-backpack::menu-dropdown-item title="Invoices" icon="la la-file-text" :link="backpack_url('pet-shop/invoice')" />
    <x-backpack::menu-dropdown-item title="Owners" icon="la la-user" :link="backpack_url('pet-shop/owner')" />
    <x-backpack::menu-dropdown-item title="Pets" icon="la la-dog" :link="backpack_url('pet-shop/pet')" />
    <x-backpack::menu-dropdown-item title="Badges" icon="la la-certificate" :link="backpack_url('pet-shop/badge')" />
    <x-backpack::menu-dropdown-item title="Skills" icon="la la-ribbon" :link="backpack_url('pet-shop/skill')" />
    <x-backpack::menu-dropdown-item title="Comments" icon="la la-comment" :link="backpack_url('pet-shop/comment')" />

    <x-backpack::menu-dropdown-header title="Info" />
    <x-backpack::menu-dropdown-item title="About" icon="la la-question" :link="backpack_url('pet-shop/about')" />
</x-backpack::menu-dropdown>

{{-- Monsters --}}
<x-backpack::menu-dropdown title="Crazy Stuff" icon="la la-skull-crossbones">
    <x-backpack::menu-dropdown-item title="Monsters" icon="la la-optin-monster" :link="backpack_url('monster')" />
    <x-backpack::menu-dropdown-item title="Caves" icon="la la-dungeon" :link="backpack_url('cave')" />
    <x-backpack::menu-dropdown-item title="Stories" icon="la la-book" :link="backpack_url('story')" />
    <x-backpack::menu-dropdown-item title="Icons" icon="la la-info-circle" :link="backpack_url('icon')" />
    <x-backpack::menu-dropdown-item title="Products" icon="la la-shopping-cart" :link="backpack_url('product')" />
    <x-backpack::menu-dropdown-item title="Fluent Monsters" icon="la la-pastafarianism"
        :link="backpack_url('fluent-monster')" />
    <x-backpack::menu-dropdown-item title="Field Monsters" icon="la la-list-alt"
        :link="backpack_url('field-monster')" />
    <x-backpack::menu-dropdown-item title="Editable Monsters" icon="la la-spell-check"
        :link="backpack_url('editable-monster')" />
    <x-backpack::menu-dropdown-item title="Dummies" icon="la la-poo" :link="backpack_url('dummy')" />
</x-backpack::menu-dropdown>
