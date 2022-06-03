/**
 * This file includes all the fields inside Monster,
 * as an array, in order to be used for testing
 * the crud.field() JS library.
 */

var monsterFields = [
    // ---------------------------------
    // Monster Fields, by Name and Type
    // ---------------------------------
    // syntax: 'fieldName', // fieldType
    // ---------------------------------
    'checkbox', // checkbox
    'roles', // checklist
    // checklist_dependency
    'color', // color
    // custom_html
    'date', // date
    'datetime', // datetime
    'email', // email
    // enum
    'hidden', // hidden
    'month', // month
    'number', 'float', 'number_with_prefix', 'number_with_suffix', 'text_with_both_prefix_and_suffix', // number
    'password', // password
    'radio', // radio
    'range', // range
    'select', // select (1-n relationship)
    'select_grouped_id', // select_grouped
    'tags', // select_multiple (n-n relationship)
    'select_from_array', // select_from_array
    'summernote', // summernote
    'text', // text
    'textarea', // textarea
    'time', // time
    'upload', // upload
    'upload_multiple', // upload_multiple
    'url', // url
    // view
    'week', // week
    'address_algolia', 'address_algolia_string', // address_algolia PRO
    // address_google PRO
    'browse', // browse PRO
    'browse_multiple', // browse_multiple PRO
    'base64_image', // base64_image PRO
    'wysiwyg', // ckeditor PRO
    'color_picker', // color_picker PRO
    'start_date', 'end_date', // date_range PRO
    'date_picker', // date_picker PRO
    'datetime_picker', // datetime_picker PRO
    'easymde', // easymde PRO
    'icon_picker', // icon_picker PRO
    'image', // image PRO
    'address.street', 'address.country', 'sentiment.text', 'sentiment.user', 'category', 'postalboxer', 'countries', 'universes', 'bills', 'fallback_icon', 'icondummy', 'wish', 'postalboxes', 'ball', 'stars', 'recommends', 'products', // relationship PRO
    // repeatable PRO
    'select2', // select2 (1-n relationship) PRO
    'categories', // select2_multiple (n-n relationship) PRO
    'select2_nested_id', // select2_nested PRO
    'select2_grouped_id', // select2_grouped PRO
    'select_and_order', // select_and_order PRO
    'select2_from_array', // select2_from_array PRO
    'select2_from_ajax', // select2_from_ajax PRO
    'articles', // select2_from_ajax_multiple PRO
    'table', 'fake_table', // table PRO
    'tinymce', // tinymce PRO
    'video', // video PRO
    // 'wysiwyg', // wysiwyg PRO - included in ckeditor and summernote
];

// console.log(monsterFields);
