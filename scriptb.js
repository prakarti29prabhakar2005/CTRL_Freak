let list = document.getElementById('list');
let filter = document.querySelector('.filter');
let count = document.getElementById('count');
let listProducts = [
    {
        id: 1,
        name: 'Book Title 1',
        price: 205600,
        quantity: 0,
        author: 'Author 1',
        nature: {
            color: ['white', 'black'],
            size: ['S', 'M', 'L'],
            type: 'Book'
        }
    },
    // Add more book items with the 'type: 'Book'' property
];

let productFilter = listProducts;

// Function to show book items
function showBooks(productFilter) {
    count.innerText = productFilter.length;
    list.innerHTML = '';
    productFilter.forEach(item => {
        if (item.nature.type === 'Book') {
            let newBookContainer = document.createElement('div');
            newBookContainer.classList.add('book-item');

            // create book title
            let newTitle = document.createElement('div');
            newTitle.classList.add('title');
            newTitle.innerText = item.name;
            newBookContainer.appendChild(newTitle);
            // create author
            let newAuthor = document.createElement('div');
            newAuthor.classList.add('author');
            newAuthor.innerText = 'Author: ' + item.author;
            newBookContainer.appendChild(newAuthor);
            // create price
            let newPrice = document.createElement('div');
            newPrice.classList.add('price');
            newPrice.innerText = 'Price: ' + item.price.toLocaleString() + 'dd';
            newBookContainer.appendChild(newPrice);

            list.appendChild(newBookContainer);
        }
    });
}

// Call showBooks function with the initial data
showBooks(productFilter);
