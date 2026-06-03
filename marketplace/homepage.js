const filterForm = document.getElementById('homepage-filters');
const navbarSearch = document.getElementById('navbar-search');
const hiddenQ = filterForm ? filterForm.querySelector('input[name="q"]') : null;

if (navbarSearch && hiddenQ) {
  navbarSearch.addEventListener('input', function () {
    hiddenQ.value = navbarSearch.value.trim();
  });
}
