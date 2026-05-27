let cards = document.querySelectorAll('.grid-container .card')

function search(){
    let searchValue = document.getElementById('name-search').value.trim().toLowerCase()
    cards.forEach(card => {
        // the search selection has to be doneinside the function not outside because its needed to run the function
        // the cards can be done outside since its just needed for the for loop and doing it once is fine because it selects all so running it once won't be an issue unlike the search value where it has to check everytime the function is ran
        let name = card.querySelector('.name').textContent.trim().toLowerCase()
        if(searchValue === '' || name.includes(searchValue)){
            card.style.display = ''
        }
        else{
            card.style.display = 'none'
        }

    })
}