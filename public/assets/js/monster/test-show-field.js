/**
 * This file tests the crud.field('name').show() method
 * on all Monster field types, assuming the fields.js
 * file is already loaded.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 ms-1 mb-4" href="javascript:testCrudFieldShow()">show()</a>');

function testCrudFieldShow() {
    // go through all Monster fields and hide them
    for (var i = 0; i <= monsterFields.length - 1; i++) {
        crud.field(monsterFields[i]).show();
    }

    alert('Calling show() on all monster fields. If you can\'t see a field... then show() doesn\'t work on it, please investigate.');
}

