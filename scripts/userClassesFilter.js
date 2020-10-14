if (document.querySelector('form .search-box') && document.querySelector('#user-search-input')) {
  var userSearchBox = document.querySelector('form .search-box');
  var classSearchBox = document.createElement('p');
  classSearchBox.innerHTML = classes.list;
  userSearchBox.append(classSearchBox);
}