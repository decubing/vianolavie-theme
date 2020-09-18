if (document.querySelector('form .search-box') && document.querySelector('#user-search-input')) {
  var userSearchBox = document.querySelector('form .search-box');
  var classSearchBox = document.createElement('p');
  classSearchBox.innerHTML = `<input type="search" id="user-class-search-input" name="class-s" ></input>\n<input type="submit" id="class-search-submit" class="button" value="Search Classes"></input>`;
  userSearchBox.append(classSearchBox);
}