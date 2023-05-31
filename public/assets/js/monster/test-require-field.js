/**
 * This file tests the crud.field('name').require() method
 * on all Monster field types, assuming the fields.js
 * file is already loaded.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 ms-1 mb-4" href="javascript:testCrudFieldRequire()">require()</a>');

function testCrudFieldRequire() {
    // go through all Monster fields and require them
    for (var i = 0; i <= monsterFields.length - 1; i++) {
        crud.field(monsterFields[i]).require();
    }

    alert('Calling require() on all monster fields. If you can see a field WITHOUT an asterisk... then require() doesn\'t work on it, please investigate.');
}

