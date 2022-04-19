 // EXAMPLE 1
 // MUST: when a checkbox is checked, show a second field;
 crud.field('visible').onChange(function(e, value) {
    if (value == 1) {
        crud.field('visible_where').show();
    } else {
        crud.field('visible_where').hide();
    }
 });

 // EXAMPLE 2
 // MUST: when a checkbox is checked, show a second field AND un-disable/un-readonly it;
 crud.field('displayed').change(function(e, value) {
    if (value == 1) {
        crud.field('displayed_where').show().enable();
    } else {
        crud.field('displayed_where').hide().disable();
    }
 });

 // EXAMPLE 3
 // MUST: when a radio has something specific selected, show a second field;
 crud.field('type').change(function(e, value) {
    if (value == 3) {
        crud.field('custom_type').show();
    } else {
        crud.field('custom_type').hide();
    }
 });

 // EXAMPLE 4
 // MUST: when a select has something specific selected, show a second field;
 crud.field('parent').change(function(e, value) {
    if (value == 6) {
        crud.field('custom_parent').show();
    } else {
        crud.field('custom_parent').hide();
    }
 });

 // EXAMPLE 5
 // MUST: when a checkbox is checked AND a select has a certain value, then do something;
 function do_something() {
    console.log('Displayed AND custom parent.');
 }
 crud.field('displayed').change(function(e, value) {
    if (value == 1 && crud.field('parent').value == 6) {
        do_something();
    }
 });
 crud.field('parent').change(function(e, value) {
    if (value == 6 && crud.field('displayed').value == 1) {
        do_something();
    }
 });

 // EXAMPLE 6
 // MUST: when a checkbox is checked OR a select has a certain value, then show a third field;
 function do_something_else() {
    console.log('Displayed OR custom parent.');
 }
 crud.field('displayed').change(function(e, value) {
    if (value == 1 || crud.field('parent').value == 6) {
        do_something_else();
    }
 });
 crud.field('parent').change(function(e, value) {
    if (value == 6 || crud.field('displayed').value == 1) {
        do_something_else();
    }
 });

 // EXAMPLE 7
 // SHOULD: when a select is a certain value, show a second field; if it's another value, show a third field;
 crud.field('category_id').change(function(e, value) {
    switch(value) {
      case "2":
        console.log('fake showing a second field');
        // crud.field('second_field').show();
        break;
      case "3":
        console.log('fake showing a third field');
        // crud.field('third_field').show();
        break;
      default:
        console.log('not doing anything');
    }
 })

 // EXAMPLE 8
 // SHOULD: when a checkbox is checked, automatically check a different checkbox or radio;
 crud.field('visible').change(function(e, value) {
    if (value == 1) {
        crud.field('displayed').check();
    } else {
        crud.field('displayed').uncheck();
    }
 });

 // EXAMPLE 9
 // COULD: when a text input is written into, write into a second input (eg. slug);
 function slugify(string) {
  const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìıİłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
  const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
  const p = new RegExp(a.split('').join('|'), 'g')

  return string.toString().toLowerCase()
    .replace(/\s+/g, '-') // Replace spaces with -
    .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
    .replace(/&/g, '-and-') // Replace & with 'and'
    .replace(/[^\w\-]+/g, '') // Remove all non-word characters
    .replace(/\-\-+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, '') // Trim - from end of text
}
  crud.field('title').change(function(e, value) {
    var slug = slugify(value);
    crud.field('slug').input.val(slug);
 });

 // EXAMPLE 10
 // COULD: when multiple inputs change, change a last input to calculate the total or smth;
 function calculate_discount_percentage() {
    var full_price = crud.field('full_price').value;
    var discounted_price = crud.field('discounted_price').value;
    var discount = full_price - discounted_price;
    var discount_percentage = discount * 100 / full_price;

    crud.field('discount_percentage').input.val(discount_percentage);
 }

 $.each(crud.fields(['full_price', 'discounted_price']), function(index, field) {
    field.change(function(e, value) {
        calculate_discount_percentage();
    });
 });
