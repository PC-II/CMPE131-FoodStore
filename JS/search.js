


const searchInput = document.querySelector('.search-bar input');
const main = document.querySelector('main');
const searchSuggestions = document.querySelector('.search-suggestions');
const suggestionDropdown = searchSuggestions.querySelector('ul');
searchInput.addEventListener('input', () => {
  // dim the main section
  suggestionDropdown.innerHTML = ``;
  if(searchInput.value.length > 0)
  {
    main.style.opacity = '0.3';
    searchSuggestions.classList.remove('hidden');
    searchSuggestions.style.maxHeight = `none`;
    const results = queryDb(searchInput.value);
    if(results.length == 0)
    {
      suggestionDropdown.insertAdjacentHTML(`beforeend`, `<li style="color: gray;">Could not find result for "${searchInput.value}"</li>`)
    }
    else
    {
      results.forEach((result, i) => {
        if(i > 9) return;
        suggestionDropdown.insertAdjacentHTML(`beforeend`, `<li>${result}</li>`)
      });

      const suggestions = searchSuggestions.querySelectorAll('li');
      suggestions.forEach(suggestion => {
        suggestion.addEventListener('click', () => {
          alert(suggestion.textContent);
        })
      })
    }
  }
  else
  {
    main.style.opacity = ``;
    searchSuggestions.classList.add('hidden');
  }
});


const queryDb = (q) => {
  let list = [];
  q = q.toLowerCase();
  const qList = q.split(' ');
  qList.forEach(qItem => {
    if(qItem == '') return;
    testDb.forEach(entry => {
      const words = entry.toLowerCase().split(' ');
      words.forEach(word => {
        if(list.includes(entry)) return;
        if(word.startsWith(qItem))
          list.push(entry);
      });
    });
  });

  const releventItems = list.filter(item => item.toLowerCase().startsWith(q)).sort();
  const nonReleventItems = list.filter(item => !item.toLowerCase().startsWith(q)).sort();
  list = [...releventItems, ...nonReleventItems];

  return list;
}


let testDb = [
'Banana',
'Lemon',
'Lime',
'Orange',
'Strawberries',
'Blueberries',
'Raspberries',
'Blackberries',
'Mango',
'Pineapples',
'Pink Lady Apples',
'Cucumber',
'Red Bell Peppers',
'Yellow Onion',
'Red Onion',
'Broccoli',
'Garlic',
'Roma Tomato',
'Ginger Root',
'Carrot',
'Cauliflower',
'Gold potato',
'Cabbage',
'Chicken Breast',
'Chicken Thighs Boneless',
'Ground Beef',
'Bacon',
'Salmon Fillet Portion',
'Ribeye Steak',
'Frozen Shrimp',
'Cage free Large Grade A Eggs 12',
'Pasture-Raised Eggs 18',
'Tofu',
'Oat Milk', 
'Butter',
'Whole Milk gallon',
'Cream Cheese',
'Greek Yogurt Cup',
'Cottage Cheese',
]

// Make an AJAX request to the PHP script
fetch('get_products.php')
   .then(response => response.json())
   .then(productNames => {
        // Update the testDb array
        testDb = productNames;
        console.log('Updated testDb:', testDb);
    })
   .catch(error => console.error('Error:', error));