/**
 * This file tests custom crud.field('name').something() methods
 * on SOME Monster field types.
 */

$('nav[aria-label=breadcrumb]').append('<a class="btn btn-warning ml-1 ms-1 mb-4" href="javascript:testCustomFieldMethods()">custom methods</a>');

function testCustomFieldMethods() {

    alert('Tab 1 > checkbox will been checked... then unchecked after 3 seconds');

    crud.field('checkbox').check();

    setTimeout(function(){
        crud.field('checkbox').uncheck();
        // console.log('Tab 1 > checkbox has been unchecked');
    }, 3000);

}

