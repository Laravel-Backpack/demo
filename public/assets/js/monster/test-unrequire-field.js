/**
 * This file tests the crud.field('name').unrequire() method
 * on all Monster field types, assuming the fields.js
 * file is already loaded.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 ms-1 mb-4" href="javascript:testCrudFieldUnrequire()">unrequire()</a>');

function testCrudFieldUnrequire() {
    // go through all Monster fields and unrequire them
    for (var i = 0; i <= monsterFields.length - 1; i++) {
        crud.field(monsterFields[i]).unrequire();
    }

    alert('Calling unrequire() on all monster fields. If you can see a field WITH asterisk... then unrequire() doesn\'t work on it, please investigate.');
}

