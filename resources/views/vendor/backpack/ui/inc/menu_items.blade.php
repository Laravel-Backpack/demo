{{--
    Demo menu. Five top-level entries:

      Dashboard      the Pet Shop dashboard
      Features       one page per Backpack feature (UI and CRUD operations)
      Free Add-ons   the free packages, each with its own live page
      Paid Add-ons   the paid packages; some link to a live example, the rest are TODO
      Examples       Pet Shop (a realistic app) and Crazy Stuff (every field & column)

    Greyed-out entries (<x-menu-todo-item>) are pages we still have to build.
    Backpack maintainers: every page from the old menu is still here, just re-homed.
--}}

<x-backpack::menu-item title="Dashboard" icon="la la-dashboard" :link="backpack_url('dashboard')" data-pan="menu-item-dashboard" />

{{-- FEATURES --}}
<x-backpack::menu-dropdown title="Features" icon="la la-star" data-pan="menu-item-features">
    <x-backpack::menu-dropdown-header title="UI" />
    <x-backpack::menu-dropdown-item title="Widgets" icon="la la-th-large" :link="backpack_url('features/widgets')" data-pan="menu-item-widgets" />
    <x-backpack::menu-dropdown-item title="Themes" icon="la la-palette" :link="backpack_url('features/themes')" data-pan="menu-item-themes" />
    <x-backpack::menu-dropdown-item title="Skins" icon="la la-swatchbook" :link="backpack_url('features/skins')" data-pan="menu-item-skins" />
    <x-backpack::menu-dropdown-item title="Alerts" icon="la la-bell" :link="backpack_url('features/alerts')" data-pan="menu-item-alerts" />
    <x-backpack::menu-dropdown-item title="Components" icon="la la-cubes" :link="backpack_url('features/components')" data-pan="menu-item-components" />
    <x-backpack::menu-dropdown-item title="Design" icon="la la-pencil-ruler" :link="backpack_url('features/design')" data-pan="menu-item-design" />

    {{-- Each links to a live CRUD page with ?explainer=<key>, which shows an explainer card at the top (see config/demo.php). --}}
    <x-backpack::menu-dropdown-header title="CRUD" />
    <x-menu-link-item title="List Operation" icon="la la-list" :link="backpack_url('pet-shop/owner?explainer=list')" label="FREE" data-pan="menu-item-op-list" />
    <x-menu-link-item title="Create Operation" icon="la la-plus" :link="backpack_url('pet-shop/owner/create?explainer=create')" label="FREE" data-pan="menu-item-op-create" />
    <x-menu-link-item title="Update Operation" icon="la la-edit" :link="backpack_url('pet-shop/pet/1/edit?explainer=update')" label="FREE" data-pan="menu-item-op-update" />
    <x-menu-link-item title="Delete Operation" icon="la la-trash" :link="backpack_url('pet-shop/skill?explainer=delete')" label="FREE" data-pan="menu-item-op-delete" />
    <x-menu-link-item title="Show Operation" icon="la la-eye" :link="backpack_url('pet-shop/invoice/1/show?explainer=show')" label="FREE" data-pan="menu-item-op-show" />
    <x-menu-link-item title="Clone Operation" icon="la la-clone" :link="backpack_url('product?explainer=clone')" label="FREE" data-pan="menu-item-op-clone" />
    <x-menu-link-item title="Reorder Operation" icon="la la-sort" :link="backpack_url('category/reorder?explainer=reorder')" label="FREE" data-pan="menu-item-op-reorder" />
    <x-menu-link-item title="Revise Operation" icon="la la-history" :link="backpack_url('icon?explainer=revise')" label="FREE" data-pan="menu-item-op-revise" />
    <x-menu-link-item title="InlineCreate Operation" icon="la la-plus-square" :link="backpack_url('monster/create?explainer=inline-create')" label="PRO" data-pan="menu-item-op-inline-create" />
    <x-menu-link-item title="Trash Operation" icon="la la-trash-restore" :link="backpack_url('pet-shop/invoice?explainer=trash')" label="PRO" data-pan="menu-item-op-trash" />
</x-backpack::menu-dropdown>

{{-- FREE ADD-ONS --}}
<x-backpack::menu-dropdown title="Free Add-ons" icon="la la-puzzle-piece" data-pan="menu-item-addons">
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
    <x-backpack::menu-dropdown-item title="Backups" icon="la la-hdd-o" :link="backpack_url('backup')" data-pan="menu-item-backup-manager" />
    <x-backpack::menu-dropdown-item title="Logs" icon="la la-terminal" :link="backpack_url('log')" data-pan="menu-item-log-manager" />
    <x-backpack::menu-dropdown-item title="Settings" icon="la la-cog" :link="backpack_url('setting')" data-pan="menu-item-settings" />
    <x-backpack::menu-dropdown-item title="Pages" icon="la la-file-o" :link="backpack_url('page')" data-pan="menu-item-page-manager" />
    <x-backpack::menu-dropdown-item title="Menu" icon="la la-list" :link="backpack_url('menu-item')" data-pan="menu-item-menu-manager" />
    <x-backpack::menu-dropdown-item title="Analytics" icon="la la-chart-bar" :link="backpack_url(config('backpack.pan.panel_route_prefix'))" data-pan="menu-item-analytics" />
</x-backpack::menu-dropdown>

{{-- PAID ADD-ONS --}}
<x-backpack::menu-dropdown title="Paid Add-ons" icon="la la-gem" data-pan="menu-item-paid-addons">
    <x-backpack::menu-dropdown-item title="PRO" icon="la la-gem" :link="backpack_url('monster')" data-pan="menu-item-pro" />
    @if(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class))
        <x-backpack::menu-dropdown-item title="DevTools" icon="la la-toolbox" :link="backpack_url('devtools/model')" data-pan="menu-item-devtools" />
    @else
        <x-menu-todo-item title="DevTools" icon="la la-toolbox" tooltip="Not installed in the online demo" />
    @endif
    <x-menu-todo-item title="Test Generators" icon="la la-vial" />
    <x-menu-todo-item title="Multi Auth" icon="la la-user-shield" />
    <x-backpack::menu-dropdown-item title="Editable Columns" icon="la la-spell-check" :link="backpack_url('editable-monster')" data-pan="menu-item-editable-columns" />
    <x-backpack::menu-dropdown-item title="Calendar Operation" icon="la la-calendar" :link="backpack_url('meeting')" data-pan="menu-item-calendar-operation" />
    <x-menu-todo-item title="Figma Template" icon="lab la-figma" />
    <x-backpack::menu-dropdown-item title="Report Operation" icon="la la-chart-line" :link="backpack_url('pet-shop/invoice')" data-pan="menu-item-report-operation" />
    <x-backpack::menu-dropdown-item title="Dataform Modal" icon="la la-window-restore" :link="backpack_url('features/components')" data-pan="menu-item-dataform-modal" />
    <x-menu-todo-item title="Auto Translate" icon="la la-globe" />
</x-backpack::menu-dropdown>

{{-- EXAMPLES --}}
<x-backpack::menu-dropdown title="Examples" icon="la la-flask" data-pan="menu-item-examples">
    <x-backpack::menu-dropdown title="Pet Shop" icon="la la-store-alt" nested="true" data-pan="menu-item-petshop">
        <x-backpack::menu-dropdown-item title="Invoices" icon="la la-file-text" :link="backpack_url('pet-shop/invoice')" data-pan="menu-item-invoices" />
        <x-backpack::menu-dropdown-item title="Owners" icon="la la-user" :link="backpack_url('pet-shop/owner')" data-pan="menu-item-owners" />
        <x-backpack::menu-dropdown-item title="Pets" icon="la la-dog" :link="backpack_url('pet-shop/pet')" data-pan="menu-item-pets" />
        <x-backpack::menu-dropdown-item title="Badges" icon="la la-certificate" :link="backpack_url('pet-shop/badge')" data-pan="menu-item-badges" />
        <x-backpack::menu-dropdown-item title="Skills" icon="la la-ribbon" :link="backpack_url('pet-shop/skill')" data-pan="menu-item-dogs" />
        <x-backpack::menu-dropdown-item title="Comments" icon="la la-comment" :link="backpack_url('pet-shop/comment')" data-pan="menu-item-comments" />

        <x-backpack::menu-dropdown-header title="Info" />
        <x-backpack::menu-dropdown-item title="About" icon="la la-question" :link="backpack_url('pet-shop/about')" data-pan="menu-item-about" />
    </x-backpack::menu-dropdown>

    <x-backpack::menu-dropdown title="Crazy Stuff" icon="la la-skull-crossbones" nested="true" data-pan="menu-item-crazy-stuff">
        <x-backpack::menu-dropdown-item title="Monsters" icon="la la-optin-monster" :link="backpack_url('monster')" data-pan="menu-item-mosters" />
        <x-backpack::menu-dropdown-item title="Caves" icon="la la-dungeon" :link="backpack_url('cave')" data-pan="menu-item-caves" />
        <x-backpack::menu-dropdown-item title="Stories" icon="la la-book" :link="backpack_url('story')" data-pan="menu-item-stories" />
        <x-backpack::menu-dropdown-item title="Icons" icon="la la-info-circle" :link="backpack_url('icon')" data-pan="menu-item-icons" />
        <x-backpack::menu-dropdown-item title="Products" icon="la la-shopping-cart" :link="backpack_url('product')" data-pan="menu-item-products" />
        <x-backpack::menu-dropdown-item title="Fluent Monsters" icon="la la-pastafarianism" :link="backpack_url('fluent-monster')" data-pan="menu-item-fluent-monsters" />
        <x-backpack::menu-dropdown-item title="Field Monsters" icon="la la-list-alt" :link="backpack_url('field-monster')" data-pan="menu-item-field-monsters" />
        <x-backpack::menu-dropdown-item title="Editable Monsters" icon="la la-spell-check" :link="backpack_url('editable-monster')" data-pan="menu-item-editable-monsters" />
        <x-backpack::menu-dropdown-item title="Dummies" icon="la la-poo" :link="backpack_url('dummy')" data-pan="menu-item-dummies" />
    </x-backpack::menu-dropdown>

    <x-backpack::menu-dropdown-header title="More demos" />
    <x-menu-todo-item title="E-commerce" icon="la la-shopping-bag" />
    <x-menu-todo-item title="Blog" icon="la la-pen-nib" label="FREE" />
    <x-menu-todo-item title="Marketing" icon="la la-bullhorn" />
    <x-menu-todo-item title="ERP" icon="la la-industry" />
</x-backpack::menu-dropdown>
