/**
 * This file tests the crud.field('name').enable() method
 * on all Monster field types, assuming the fields.js
 * file is already loaded.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 ms-1 mb-4" href="javascript:testCrudFieldEnable()">enable()</a>');

function testCrudFieldEnable() {
    // go through all Monster fields and enable them
    for (var i = 0; i <= monsterFields.length - 1; i++) {
        crud.field(monsterFields[i]).enable();
    }

    alert('Calling enable() on all monster fields. If you can see a field that is still disabled... then enable() might not work on it, please investigate.');
}

