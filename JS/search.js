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
    results.forEach((result, i) => {
      if(i > 9) return;
      suggestionDropdown.insertAdjacentHTML(`beforeend`, `<li>${result}</li>`)
    });
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

const testDb = [
  'Cilantro',
  'Strawberries',
  'Celery',
  'Raspberries',
  'Broccoli',
  'Blackberries',
  'Carrot',
  'Kale',
  'Cucumber',
  'Red Bell Pepper',
  'Romaine Lettuce', 
  'Baby Spinach',
  'Italian Parsley',
  'Boneless Skinless Chicken Breast',
  'Radish',
  'Italian Squash',
  'Cauliflower',
  'Canned Black Beans',
  'Honeycrisp Apple',
  'Bundle of Asparagus',
  'Chicken Boneless Thighs',
  'Sea Salt Blue Corn Tortilla Chips',
  'Gala Apple',
  'Green Cabbage',
  'Yellow Onion',
  'Low Sodium Garbanzo Beans',
  'Sweet Tomatoes',
  'Green Leaf Lettuce',
  'Lacinato Kale',
  'Garlic Bag',
  'Extra Firm Tofu',
  'Red Cabbage',
  'Brussel Sprouts',
  'Rainbow Carrots',
  'Red Beet',
  'Red Mango',
  'Cage Free Dozen Brown Eggs',
  'Green Peas',
  'Green Bell Peppers',
  'Beefsteak Tomato',
  'Fuji Apple',
  'Spaghetti Squash',
  'Baby Bella Mushrooms',
  'Russel Potato',
  'Baby Bok Choy',
  'Whole Grain Thin Sliced Bread',
  'Lemon',
  'Large Avocado',
  'Ground Turkey',
  'Grass-Fed 85% Lean Ground Beef',
  'Organic Original Almond Milk',
  'Organic Heavy Whipping Cream'
]