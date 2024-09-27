console.log("scripts");

// Event Listener fÃ¼r das Formular
document.getElementById('todoForm').addEventListener('submit', function (evt) {
    evt.preventDefault();
    const todoInput = document.getElementById('todoInput').value;

    // Neuer Eintrag per POST an den Server senden
    fetch('http://bcf.mshome.net/todo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ todo: todoInput }),
    })
    .then(response => response.json())
    .then((data) => {
        console.log(data);
        loadTodos();  // Liste neu laden
        document.getElementById('todoInput').value = '';  // Eingabefeld leeren
    });
});

// TODOs laden und in der Liste anzeigen
function loadTodos() {
    fetch('http://bcf.mshome.net/todo.php')
    .then(response => response.json())
    .then(todos => {
        const todoList = document.getElementById('todoList');
        todoList.innerHTML = '';  // Liste leeren

        // Alle Todos anzeigen
        todos.forEach(todo => {
            const li = document.createElement('li');
            li.textContent = todo;
            todoList.appendChild(li);
        });
    });
}

// TODOs beim Laden der Seite anzeigen
window.onload = loadTodos;
