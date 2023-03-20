/**
 * This file tests the crud.field('name').onChange() method
 * on all Monster field types, assuming the fields.js
 * file is already loaded.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 ms-1 mb-4" href="javascript:testCrudFieldOnChange()">onChange()</a>');

function testCrudFieldOnChange() {
    alert('Open your browser\'s console, then use each field you want to test. A line should be output in your console, every time a change event is triggered.');

    // add an onChange event on all fields
    monsterFields.forEach(name => {
        crud.field(name).onChange(field => {
            console.log(`Value for field ${field.name} (type ${field.type}) was changed to ${field.value}`);
        });
    });
}
