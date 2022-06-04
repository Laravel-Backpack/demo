// EXAMPLE 1
// MUST: when a checkbox is checked, show a second field;
crud.field('visible').onChange(field => {
  crud.field('visible_where').show(field.value === 1);
});

// EXAMPLE 2
// MUST: when a checkbox is checked, show a second field AND un-disable/un-readonly it;
crud.field('displayed').change(field => {
  crud.field('displayed_where')
    .show(field.value === 1)
    .enable(field.value === 1);
});

// EXAMPLE 3
// MUST: when a radio has something specific selected, show a second field;
crud.field('type').change(field => {
  crud.field('custom_type').show(field.value === 3);
});

// EXAMPLE 4
// MUST: when a select has something specific selected, show a second field;
crud.field('parent').change(field => {
  crud.field('custom_parent').show(field.value === 6);
});

// EXAMPLE 5
// MUST: when a checkbox is checked AND a select has a certain value, then do something;
let do_something = () => {
  console.log('Displayed AND custom parent.');
}
crud.field('displayed').change(field => {
  if (field.value === 1 && crud.field('parent').value === 6) {
    do_something();
  }
});
crud.field('parent').change(field => {
  if (field.value === 6 && crud.field('displayed').value === 1) {
    do_something();
  }
});

// EXAMPLE 6
// MUST: when a checkbox is checked OR a select has a certain value, then show a third field;
let do_something_else = () => {
  console.log('Displayed OR custom parent.');
}
crud.field('displayed').change(field => {
  if (field.value === 1 || crud.field('parent').value === 6) {
    do_something_else();
  }
});
crud.field('parent').change(field => {
  if (field.value === 6 || crud.field('displayed').value === 1) {
    do_something_else();
  }
});

// EXAMPLE 7
// SHOULD: when a select is a certain value, show a second field; if it's another value, show a third field;
crud.field('parent').change(field => {
  switch(field.value) {
    case 2:
      console.log('fake showing a second field');
      break;
    case 3:
      console.log('fake showing a third field');
      break;
    default:
      console.log('not doing anything');
  }
})

// EXAMPLE 8
// SHOULD: when a checkbox is checked, automatically check a different checkbox or radio;
crud.field('visible').change(field => {
  crud.field('displayed').check(field.value === 1);
});

// EXAMPLE 9
// COULD: when a text input is written into, write into a second input (eg. slug);
let slugify = text => 
  text.toString().toLowerCase().trim()
    .normalize('NFD')                // separate accent from letter
    .replace(/[\u0300-\u036f]/g, '') // remove all separated accents
    .replace(/\s+/g, '-')            // replace spaces with -
    .replace(/[^\w\-]+/g, '')        // remove all non-word chars
    .replace(/\-\-+/g, '-')          // replace multiple '-' with single '-'

crud.field('title').change(field => {
  crud.field('slug').input.value = slugify(field.value);
});

// EXAMPLE 10
// COULD: when multiple inputs change, change a last input to calculate the total or smth;
let calculate_discount_percentage = () => {
  let full_price = crud.field('full_price').value;
  let discounted_price = crud.field('discounted_price').value;
  let discount_percentage = (full_price - discounted_price) * 100 / full_price;

  crud.field('discount_percentage').input.value = discount_percentage;
}

crud.fields(['full_price', 'discounted_price']).forEach(field => {
  field.change(calculate_discount_percentage);
});

// EXAMPLE 11
// SHOUD: when dropdown subfield changes, disable another subfield
// TODO: change the example to a dedicated repeatable, in the last tab
// (right now it's in the Relationship tab, under Direct Relationships + Subfields... HasOne)
crud.field('wish').subfield('country').change(function(field) {
    console.log(field.value, field.rowNumber, field.value == '');
    crud.field('wish').subfield('body', field.rowNumber).enable(field.value == '');
 });

 //EXAMPLE 11
 // USING SUBFIELDS
 crud.field('repeatable_example_1').subfield('yes_or_no').change(function(field) {
    crud.field('repeatable_example_1').subfield('if_no', field.rowNumber).show(field.value == 'no').enable(field.value == 'no');
    crud.field('repeatable_example_1').subfield('if_yes', field.rowNumber).show(field.value == 'yes').enable(field.value == 'yes'); 
});

