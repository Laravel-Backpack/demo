/**
 * This file tests the crud.field('name').readonly() method
 * on all Monster field types, assuming the fields.js
 * file is already loaded.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 mb-4" href="javascript:testCrudFieldReadonlyOn()">readonlyOn()</a>');
$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 mb-4" href="javascript:testCrudFieldReadonlyOff()">readonlyOff()</a>');

function testCrudFieldReadonlyOn() {
    // go through all Monster fields and disable them
    for (var i = 0; i <= monsterFields.length - 1; i++) {
        crud.field(monsterFields[i]).readonly();
    }

    alert('Calling readonly() on all monster fields. If you can see a field that is NOT readonly... then readonly() might not work on it, please investigate.');
}

function testCrudFieldReadonlyOff() {
    // go through all Monster fields and disable them
    for (var i = 0; i <= monsterFields.length - 1; i++) {
        crud.field(monsterFields[i]).readonly(false);
    }

    alert('Calling readonly(false) on all monster fields. If you can see a field that is STILL readonly after... then readonly() might not work on it, please investigate.');
}

