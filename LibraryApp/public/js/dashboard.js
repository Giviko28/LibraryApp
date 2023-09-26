let selectCount = 1;
const deleteButtons = document.querySelectorAll(".delete-button");

deleteButtons.forEach(function (button) {
    button.addEventListener("click", function () {
        // Get the parent div of the clicked "Delete" button and remove it
        const parentDiv = button.parentElement;
        parentDiv.remove();
    });
});

document.getElementById("add_author").addEventListener("click", function () {
    const authorsDiv = document.getElementById("authors");
    const authorsList = document.getElementById("authorList");

    const newAuthorDiv = authorsList.cloneNode(true);

    newAuthorDiv.id = 'authorList' + selectCount;

    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent = "X";
    deleteButton.addEventListener("click", function () {
        newAuthorDiv.remove();
    });

    newAuthorDiv.appendChild(deleteButton);

    authorsDiv.appendChild(newAuthorDiv);

    selectCount++;
});
