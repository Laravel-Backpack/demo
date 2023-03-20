/**
 * This file tests the crud.field('name').disable() method
 * on all Monster field types, assuming the fields.js
 * file is already loaded.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 ms-1 mb-4" href="javascript:testCrudFieldDisable()">disable()</a>');

function testCrudFieldDisable() {
    // go through all Monster fields and disable them
    for (var i = 0; i <= monsterFields.length - 1; i++) {
        crud.field(monsterFields[i]).disable();
    }

    alert('Calling disable() on all monster fields. If you can see a field that is NOT disabled... then disable() might not work on it, please investigate.');
}

