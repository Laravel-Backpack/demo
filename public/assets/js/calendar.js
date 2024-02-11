// calendar create operation
if (window.crud) {
  crud.field("end").input.value == ""
    ? (crud.field("all_day").check().input.value = 1)
    : crud.field("all_day").uncheck();

  crud
    .field("all_day")
    .onChange((field) => {
      field.value == 1
        ? (crud.field("end").hide().input.value = "")
        : crud.field("end").show();
    })
    .change();
}

// calendar list operation
document.getElementById("calendar").addEventListener("menuClick", (e) => {
  let { action, event, properties } = e.detail;
  if (action === "alert") alert(`Event ${event.id} — ${properties?.message}`);
});
