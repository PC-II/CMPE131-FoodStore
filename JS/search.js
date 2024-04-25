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
    results.forEach((result, i) => {
      if(i > 9) return;
      suggestionDropdown.insertAdjacentHTML(`afterbegin`, `<li>${result}</li>`)
    });
  }
  else
  {
    main.style.opacity = '1';
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
      if(list.includes(entry)) return;
      let words = entry.toLowerCase();
      words = words.split(' ');
      words.forEach(word => {
        if(word.startsWith(qItem))
        {
          list.push(entry);
        }
      })
    })
  });
  return list;
}

const testDb = [
  'cilantro',
  'strawberries',
  'celery',
  'raspberries',
  'broccoli',
  'blackberries',
  'carrot',
  'kale',
  'cucumber',
  'red bell pepper',
  'romaine Lettuce', 
  'baby Spinach',
  'italian Parsley',
  'boneless Skinless Chicken Breast',
  'radish',
  'italian Squash',
  'cauliflower',
  'canned Black Beans',
  'honeycrisp Apple',
  'bundle of Asparagus',
  'chicken Boneless Thighs',
  'sea Salt Blue Corn Tortilla Chips',
  'gala Apple',
  'green Cabbage',
  'yellow Onion',
  'low Sodium Garbanzo Beans',
  'sweet Tomatoes',
  'green Leaf Lettuce',
  'lacinato Kale',
  'garlic Bag',
  'extra Firm Tofu',
  'red Cabbage',
  'brussel Sprouts',
  'rainbow Carrots',
  'red Beet',
  'red Mango',
  'cage Free Dozen Brown Eggs',
  'green Peas',
  'green Bell Peppers',
  'beefsteak Tomato',
  'fuji Apple',
  'spaghetti Squash',
  'baby Bella Mushrooms',
  'russel Potato',
  'baby Bok Choy',
  'whole Grain Thin Sliced Bread',
  'lemon',
  'large Avocado',
  'ground Turkey',
  'grass-Fed 85% Lean Ground Beef',
  'organic Original Almond Milk',
  'organic Heavy Whipping Cream'
]