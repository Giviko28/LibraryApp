document.getElementById("add_author").addEventListener("click", function () {
    const authorsDiv = document.getElementById("authors");
    const authorsList  = document.getElementById("authorList");


    const newAuthorDiv = authorsList.cloneNode(true);

    authorsDiv.appendChild(newAuthorDiv);
});
