/**
 * This file tests the crud.field('name').hide() method
 * on all Monster field types, assuming the fields.js
 * file is already loaded.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-4 ms-3 mb-4" href="javascript:testCrudFieldHide()">hide()</a>');

function testCrudFieldHide() {
    // go through all Monster fields and hide them
    for (var i = 0; i <= monsterFields.length - 1; i++) {
        crud.field(monsterFields[i]).hide();
    }

    alert('Calling hide() on all monster fields. If you can see a field... then hide() doesn\'t work on it, please investigate.');
}

