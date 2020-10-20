// Users list
if (document.querySelector('form .search-box') && document.querySelector('#user-search-input')) {
  var userSearchBox = document.querySelector('form .search-box');
  var classSearchBox = document.createElement('p');
  // append submit button
  classSearchBox.innerHTML = classes.list + '</select><input type="submit" id="class-search-submit" class="button" value="Search Classes"></input>';
  userSearchBox.append(classSearchBox);
}


// User profile page
if (document.querySelector('form#your-profile')) {
  var classDropdown = document.createElement('span');
  classDropdown.innerHTML = classes.list;
  var addButton = document.querySelector('a.button[data-event="add-row"]')
  var buttonGroup = addButton.parentElement;
  buttonGroup.append(classDropdown);
  classDropdown.addEventListener('change', addExistingClass);
  function addExistingClass(event) {
    addButton.click();
    var rows = document.querySelectorAll(':not(.acf-clone) > .acf-field-5f566e3c43594');
    var lastRow = rows.length ? rows[rows.length-1] : null;
    lastRow.querySelector('input').value = event.target.value;
  }
}