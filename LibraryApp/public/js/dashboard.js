const main = document.querySelector('#main');
window.addEventListener('load', () => {
    main.classList.toggle('hidden');
});

let selectCount = 1;

// const axiosClient = axios.create({
//     baseURL: '/api'
// });

const authorCount = document.querySelectorAll('#oldAuthors').length;

for(let i = 1; i<=authorCount; i++) {
    const selector = `#select${i}`;
    const button = document.querySelector(selector);
    button.addEventListener('click', () => {
        const parentDiv = button.parentElement;
        parentDiv.remove();
    })
};

document.getElementById("add_author").addEventListener("click", function () {
    const authorsDiv = document.getElementById("authors");
    const authorsList = document.getElementById("authorList");

    const newAuthorDiv = authorsList.cloneNode(true);

    newAuthorDiv.id = 'authorList' + selectCount;

    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent = "Delete";
    deleteButton.className = 'pl-4 text-red-600';
    deleteButton.addEventListener("click", function () {
        newAuthorDiv.remove();
    });

    newAuthorDiv.appendChild(deleteButton);

    authorsDiv.appendChild(newAuthorDiv);

    selectCount++;
});


// const deleteAuthor = (book) => {
//     const form = document.querySelector('#book-update');
//     const formData = new FormData(form);
//     const data = {};
//     formData.forEach((value, key) => {
//         data[key] = value;
//     });
//
//     axiosClient.post(`/dashboard/books/${book}/update`, data)
//         .then(response => {
//             console.log(response);
//         })
//         .catch(error => {
//             console.error(error);
//         })
// }
