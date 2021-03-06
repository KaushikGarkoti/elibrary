document.addEventListener('DOMContentLoaded', (e) => {
    const elems = document.querySelectorAll('.sidenav');
    const instances = M.Sidenav.init(elems, {
        edge: 'left',
        preventScrolling: true,
    });
    if (getQueryVariable('opr') == 'add') {
        addBook();
    }
    if (getQueryVariable('opr') == 'del') {
        deleteBook();
    }


    function addBook() {
        const container = document.getElementById('book-container');
        const target_row = container.lastElementChild;
        console.log(container.childElementCount);
        const row = document.createElement('div');
        row.className = 'row';
        const column = document.createElement('div');
        column.classList.add('col', 's12', 'm3');
        column
            .appendChild (createCard( getQueryVariable('name'), 
                getQueryVariable('Author'), getQueryVariable('textarea1'), 
                getQueryVariable('fileurl'), getQueryVariable('bookID')));
   
        if (target_row.childElementCount < 4) {
            if(target_row.lastElementChild.innerHTML !== column.innerHTML)
            target_row.appendChild(column);
        } else {
            row.appendChild(column);
            container.appendChild(row);
        }
    }


    function deleteBook() {
        const container = document.getElementById('book-container');
       const el =  document.getElementById(`book${getQueryVariable('bookID')}`);
       container.removeChild(el);
    }



     
    function getQueryVariable(reqkey) {
        var url = window.location.href,
            vars = {};
        url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
             key = decodeURIComponent(key);
             value = decodeURIComponent(value);
             vars[key] = value;
        });
        return vars[reqkey];
    }
    
    function createCard(name, author, textarea1, fileurl, bookID) {
        const card = document.createElement('div');
        card.innerHTML = 
        `<div class="card custom-card">
            <div class="card-image">
                <img src=${fileurl} style="height: 300px">
                <span class="card-title">${name}</span>
                <a href = "./editbook.php?id=${bookID}" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">create</i></a>
            </div>
            <div class="card-action">
                <a class="black-text" href="#">${author}</a>
                <a class="black-text" href="./book.php?id=${bookID}">View Book</a>
            </div>
        </div>`
        return card;
    }

})
    
   
   