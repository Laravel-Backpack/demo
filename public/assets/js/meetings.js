// calendar view operation
document.getElementById("calendar")?.addEventListener("menuClick", (e) => {
  let { action, event, properties } = e.detail;
  if (action === "alert") alert(`Event ${event.id} — ${properties?.message}`);
});
